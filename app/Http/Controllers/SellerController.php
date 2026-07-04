<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Payout;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\SupportTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SellerController extends Controller
{
    public function login()
    {
        return view('seller.login');
    }

    public function loginSubmit(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            $user = Auth::user();

            // Block if not vendor or not active
            if ($user->role !== 'vendor' || ! $user->is_active) {
                Auth::logout();

                return back()
                    ->withInput($request->only('email'))
                    ->withErrors([
                        'email' => 'You do not have a seller account.',
                    ]);
            }

            // Sync Spatie role if missing
            if (! $user->hasRole('vendor')) {
                $user->assignRole('vendor');
            }

            // Auto-create vendor record if missing
            if (! $user->vendor) {
                $user->vendor()->create([
                    'vendor_name' => $user->name,
                    'owner_name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone ?? '0000000000',
                    'status' => 'pending',
                ]);
            }

            // Refresh user and vendor relation
            $user->load('vendor');
            $vendor = $user->vendor;

            if (! $vendor) {
                Auth::logout();

                return redirect()
                    ->route('seller.login')
                    ->with('error', 'Vendor account not found.');
            }

            if ($vendor->status !== 'active') {
                Auth::logout();

                return redirect()
                    ->route('seller.login')
                    ->with('error', 'Your account is pending approval.');
            }

            return redirect()->route('dashboard');
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors([
                'email' => 'These credentials do not match our records.',
            ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('seller.login');
    }

    public function seller()
    {
        return view('seller.register');
    }

    public function dashboard()
    {
        $vendor = auth()->user()->vendor;

        if (! $vendor) {
            return redirect()->route('seller.login')
                ->with('error', 'Vendor profile not found. Please contact support.');
        }

        $vendorId = $vendor->id;

        // Items that actually count as sales (exclude cancelled/returned lines).
        $soldItems = OrderItem::where('vendor_id', $vendorId)
            ->whereNotIn('status', ['cancelled', 'returned']);

        $stats = [
            'total_sales' => (clone $soldItems)->sum('subtotal'),
            'total_orders' => (clone $soldItems)->select('order_id')->distinct()->count('order_id'),
            'active_products' => Product::where('vendor_id', $vendorId)->where('status', 'active')->count(),
            'avg_rating' => (float) ($vendor->rating ?? 0),
            'review_count' => $vendor->reviews()->count(),
        ];

        // ─── Sales trend for the last 7 days ───────────────────────────────
        $days = collect(range(6, 0))->map(fn ($daysAgo) => now()->subDays($daysAgo)->startOfDay());

        $dailyTotals = (clone $soldItems)
            ->where('created_at', '>=', now()->subDays(6)->startOfDay())
            ->selectRaw('DATE(created_at) as day, SUM(subtotal) as total')
            ->groupBy('day')
            ->pluck('total', 'day');

        $maxDailyTotal = max(1, $dailyTotals->max() ?? 0);

        $salesTrend = $days->map(function ($date) use ($dailyTotals, $maxDailyTotal) {
            $total = (float) ($dailyTotals[$date->toDateString()] ?? 0);

            return [
                'label' => $date->format('D'),
                'total' => $total,
                'height' => $total > 0 ? max(8, (int) round(($total / $maxDailyTotal) * 140)) : 4,
            ];
        });

        // ─── Recent orders (latest 5 order lines for this vendor) ─────────
        $recentItems = OrderItem::with(['order.user', 'order.payment'])
            ->where('vendor_id', $vendorId)
            ->latest()
            ->take(5)
            ->get();

        $dealEndsAt = \App\Models\Setting::getValue('todays_deal_ends_at');
        if (!$dealEndsAt) {
            $dealEndsAt = now()->endOfDay()->toDateTimeString();
        }

        return view('seller.dashboard', compact('vendor', 'stats', 'salesTrend', 'recentItems', 'dealEndsAt'));
    }

    public function product_management(Request $request)
    {
        $vendor = auth()->user()->vendor;

        if (! $vendor) {
            return redirect()->route('dashboard')
                ->with('error', 'Vendor profile not found. Please contact support.');
        }

        $vendorId = $vendor->id;

        $query = Product::with(['category', 'images'])
            ->where('vendor_id', $vendorId);

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('stock_status')) {
            match ($request->stock_status) {
                'in_stock' => $query->where('stock', '>', 5),
                'low_stock' => $query->whereBetween('stock', [1, 5]),
                'out_of_stock' => $query->where('stock', 0),
                default => null,
            };
        }

        $products = $query->latest()->paginate(10);
        $totalProducts = Product::where('vendor_id', $vendorId)->count();
        $activeProducts = Product::where('vendor_id', $vendorId)->where('status', 'active')->count();
        $outOfStock = Product::where('vendor_id', $vendorId)->where('stock', 0)->count();
        $draftProducts = Product::where('vendor_id', $vendorId)->where('status', 'draft')->count();
        $categories = Category::where('status', 'active')->get();

        return view('seller.product-management', compact(
            'products',
            'totalProducts',
            'activeProducts',
            'outOfStock',
            'draftProducts',
            'categories'
        ));
    }

    public function productCreate()
    {
        $categories = Category::where('status', 'active')->get();

        return view('seller.product-create', compact('categories'));
    }

    public function productEdit($id)
    {
        $product = Product::with(['category', 'images', 'variants'])
            ->where('vendor_id', auth()->user()->vendor->id)
            ->findOrFail($id);
        $categories = Category::where('status', 'active')->get();

        return view('seller.product-edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::where('vendor_id', auth()->user()->vendor->id)->findOrFail($id);

        $validated = $request->validate([
            'product_name' => 'required|string|max:200',
            'category' => 'required|exists:categories,id',
            'product_type' => 'nullable|string|max:100',
            'description' => 'required|string|max:2000',
            'base_price' => 'nullable|numeric|min:0',
            'discount_amount' => 'nullable|numeric|min:0', // Changed from discount_price
            'sku' => 'nullable|string|max:100|unique:products,sku,'.$product->id,
            'stock' => 'nullable|integer|min:0',
            'specifications' => 'nullable|array',
            'specifications.*.key' => 'nullable|string|max:100',
            'specifications.*.value' => 'nullable|string|max:255',
            'variants' => 'nullable|array',
            'variants.*.id' => 'nullable|integer',
            'variants.*.sku' => 'required_with:variants|string|max:100|distinct',
            'variants.*.size' => 'nullable|string|max:50',
            'variants.*.color' => 'nullable|string|max:50',
            'variants.*.price' => 'nullable|numeric|min:0',
            'variants.*.discount_amount' => 'nullable|numeric|min:0', // Changed
            'variants.*.stock' => 'nullable|integer|min:0',
            'images' => 'nullable|array|max:4',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:10240',
            'remove_images' => 'nullable|array',
            'remove_images.*' => 'integer|exists:images,id',
        ]);

        $basePrice = $validated['base_price'] ?? $product->price;
        if (! empty($validated['discount_amount']) && $validated['discount_amount'] >= $basePrice) {
            return back()->withErrors(['discount_amount' => 'Discount must be less than the base price.'])->withInput();
        }

        $product->update([
            'category_id' => $validated['category'],
            'name' => $validated['product_name'],
            'slug' => Str::slug($validated['product_name']).'-'.Str::lower(Str::random(5)),
            'product_type' => $validated['product_type'] ?? null,
            'description' => $validated['description'],
            'specifications' => ! empty($validated['specifications']) ? $this->filterSpecs($validated['specifications']) : null,
            'price' => $validated['base_price'] ?? $product->price,
            'discount_price' => ($validated['discount_amount'] ?? 0) > 0 ? (($validated['base_price'] ?? $product->price) - $validated['discount_amount']) : null,
            'stock' => $validated['stock'] ?? $product->stock,
            'sku' => $validated['sku'] ?? $product->sku,
        ]);

        // Update variants
        if (! empty($validated['variants'])) {
            $existingVariantIds = $product->variants()->pluck('id')->toArray();
            $updatedVariantIds = [];

            foreach ($validated['variants'] as $variantData) {
                if (empty($variantData['sku'])) {
                    continue;
                }

                if (! empty($variantData['id']) && in_array($variantData['id'], $existingVariantIds)) {
                    $variant = ProductVariant::find($variantData['id']);
                    $variant->update([
                        'sku' => $variantData['sku'],
                        'size' => $variantData['size'] ?? null,
                        'color' => $variantData['color'] ?? null,
                        'price' => ! empty($variantData['price']) ? $variantData['price'] : null,
                        'discount_price' => ! empty($variantData['discount_amount']) ? ($variantData['price'] - $variantData['discount_amount']) : null,
                        'stock' => $variantData['stock'] ?? 0,
                    ]);
                    $updatedVariantIds[] = $variant->id;
                } else {
                    $newVariant = ProductVariant::create([
                        'product_id' => $product->id,
                        'sku' => $variantData['sku'],
                        'size' => $variantData['size'] ?? null,
                        'color' => $variantData['color'] ?? null,
                        'price' => ! empty($variantData['price']) ? $variantData['price'] : null,
                        'discount_price' => ! empty($variantData['discount_amount']) ? ($variantData['price'] - $variantData['discount_amount']) : null,
                        'stock' => $variantData['stock'] ?? 0,
                        'status' => 'active',
                    ]);
                    $updatedVariantIds[] = $newVariant->id;
                }
            }
            $variantsToDelete = array_diff($existingVariantIds, $updatedVariantIds);
            ProductVariant::whereIn('id', $variantsToDelete)->delete();
        } else {
            $product->variants()->delete();
        }

        if (! empty($validated['remove_images'])) {
            $imagesToRemove = $product->images()->whereIn('id', $validated['remove_images'])->get();
            foreach ($imagesToRemove as $img) {
                if (Storage::disk('public')->exists($img->path)) {
                    Storage::disk('public')->delete($img->path);
                }
                $img->delete();
            }
        }

        if ($request->hasFile('images')) {
            $remainingCount = $product->images()->count();
            foreach ($request->file('images') as $index => $file) {
                if ($remainingCount >= 4) {
                    break;
                }

                $path = $file->store('products', 'public');
                $product->images()->create([
                    'path' => $path,
                    'type' => 'gallery',
                    'is_primary' => $remainingCount === 0 && $index === 0 ? 1 : 0,
                ]);
                $remainingCount++;
            }
        }

        return redirect()->route('product-management')->with('success', 'Product updated successfully!');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:200',
            'category' => 'required|exists:categories,id',
            'product_type' => 'nullable|string|max:100',
            'description' => 'required|string|max:2000',
            'base_price' => 'required|numeric|min:0',
            'discounted_price' => 'nullable|numeric|min:0|lt:base_price',
            'sku' => 'required|string|max:100|unique:products,sku',
            'stock' => 'required|integer|min:0',
            'specifications' => 'nullable|array',
            'specifications.*.key' => 'nullable|string|max:100',
            'specifications.*.value' => 'nullable|string|max:255',
            'variants' => 'nullable|array',
            'variants.*.sku' => 'required_with:variants|string|max:100|distinct|unique:product_variants,sku',
            'variants.*.size' => 'nullable|string|max:50',
            'variants.*.color' => 'nullable|string|max:50',
            'variants.*.price' => 'nullable|numeric|min:0',
            'variants.*.stock' => 'nullable|integer|min:0',
            'images' => 'nullable|array|max:4',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        // 1. Create the product
        $product = Product::create([
            'vendor_id' => auth()->user()->vendor->id,
            'category_id' => $validated['category'],
            'name' => $validated['product_name'],
            'slug' => Str::slug($validated['product_name']).'-'.Str::lower(Str::random(5)),
            'product_type' => $validated['product_type'] ?? null,
            'description' => $validated['description'],
            'specifications' => ! empty($validated['specifications'])
                ? $this->filterSpecs($validated['specifications'])
                : null,
            'price' => $validated['base_price'],
            'discount_price' => ($validated['discounted_price'] ?? 0) > 0
                                    ? ($validated['base_price'] - $validated['discounted_price'])
                                    : null,
            'stock' => $validated['stock'],
            'sku' => $validated['sku'],
            'status' => 'active',
        ]);

        // 2. Save variants
        if (! empty($validated['variants'])) {
            foreach ($validated['variants'] as $variant) {
                if (empty($variant['sku'])) {
                    continue;
                }

                ProductVariant::create([
                    'product_id' => $product->id,
                    'sku' => $variant['sku'],
                    'size' => $variant['size'] ?? null,
                    'color' => $variant['color'] ?? null,
                    'price' => ! empty($variant['price']) ? $variant['price'] : null,
                    'stock' => $variant['stock'] ?? 0,
                    'status' => 'active',
                ]);
            }
        }

        // 3. Save images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $file) {
                $path = $file->store('products', 'public');

                $product->images()->create([
                    'path' => $path,
                    'type' => 'gallery',
                    'is_primary' => $index === 0 ? 1 : 0,
                ]);
            }
        }

        return redirect()
            ->route('product-management')
            ->with('success', 'Product "'.$product->name.'" created successfully!');
    }

    public function destroy($id)
    {
        $product = Product::where('vendor_id', auth()->user()->vendor->id)
            ->findOrFail($id);

        $product->images()->delete();
        $product->variants()->delete();
        $product->delete();

        return redirect()
            ->route('product-management')
            ->with('success', 'Product deleted successfully.');
    }

    public function order(Request $request)
    {
        $vendor = auth()->user()->vendor;

        if (! $vendor) {
            return redirect()->route('dashboard')
                ->with('error', 'Vendor profile not found. Please contact support.');
        }

        $vendorId = $vendor->id;

        // ─── Tab → order_item status mapping (fulfillment tabs) ───────────
        $statusMap = [
            'new' => ['pending'],
            'cancelled' => ['cancelled', 'returned'],
        ];

        // ─── Tab → payment status mapping (payment tabs) ───────────────────
        $paymentMap = [
            'paid' => ['completed'],
            'pending_payment' => ['pending'],
        ];

        $activeTab = $request->query('status', 'all');

        $applyTabFilter = function ($query) use ($activeTab, $statusMap, $paymentMap) {
            if (isset($statusMap[$activeTab])) {
                $query->whereIn('status', $statusMap[$activeTab]);
            } elseif ($activeTab === 'paid') {
                $query->whereHas('order.payment', fn ($pq) => $pq->whereIn('status', $paymentMap['paid']));
            } elseif ($activeTab === 'pending_payment') {
                // Orders paid via COD (or otherwise missing a payment row) are
                // treated as "payment pending" too, same as the badge shown
                // on the order details page.
                $query->where(function ($pq) use ($paymentMap) {
                    $pq->whereHas('order.payment', fn ($ppq) => $ppq->whereIn('status', $paymentMap['pending_payment']))
                        ->orWhereDoesntHave('order.payment');
                });
            }
        };

        $query = OrderItem::with(['order.user', 'order.payment', 'product'])
            ->where('vendor_id', $vendorId);

        if ($activeTab !== 'all') {
            $applyTabFilter($query);
        }

        if ($request->filled('search')) {
            $search = $request->query('search');

            $query->where(function ($q) use ($search) {
                $q->where('order_id', 'like', "%{$search}%")
                    ->orWhereHas('order.user', function ($uq) use ($search) {
                        $uq->where('name', 'like', "%{$search}%");
                    });
            });
        }

        $orderItems = $query->latest()->paginate(10)->withQueryString();

        // ─── Counts for the tab badges (unaffected by the active filter) ──
        $baseCount = fn () => OrderItem::where('vendor_id', $vendorId);

        $counts = [
            'all' => $baseCount()->count(),
            'new' => $baseCount()->whereIn('status', $statusMap['new'])->count(),
            'paid' => $baseCount()->whereHas('order.payment', fn ($pq) => $pq->whereIn('status', $paymentMap['paid']))->count(),
            'pending_payment' => $baseCount()->where(function ($pq) use ($paymentMap) {
                $pq->whereHas('order.payment', fn ($ppq) => $ppq->whereIn('status', $paymentMap['pending_payment']))
                    ->orWhereDoesntHave('order.payment');
            })->count(),
            'cancelled' => $baseCount()->whereIn('status', $statusMap['cancelled'])->count(),
        ];

        return view('seller.order', compact('orderItems', 'counts', 'activeTab'));
    }

    public function orderDetails(Request $request)
    {
        $vendor = auth()->user()->vendor;

        if (! $vendor) {
            return redirect()->route('dashboard')
                ->with('error', 'Vendor profile not found. Please contact support.');
        }

        // Every order in this schema is already scoped to a single vendor
        // (checkout groups cart lines by vendor before an Order is created),
        // so we just need to confirm this order actually belongs to them.
        $order = Order::with(['user', 'shippingAddress', 'payment'])
            ->whereHas('orderItems', fn ($q) => $q->where('vendor_id', $vendor->id))
            ->find($request->query('order'));

        if (! $order) {
            abort(404);
        }

        $items = $order->orderItems()
            ->where('vendor_id', $vendor->id)
            ->with(['product.images', 'variant'])
            ->get();

        $subtotal = $items->sum('subtotal');

        return view('seller.order-details', compact('order', 'items', 'subtotal'));
    }

    public function updatePaymentStatus(Request $request, Order $order)
    {
        $vendor = auth()->user()->vendor;

        if (! $vendor) {
            return redirect()->route('dashboard')
                ->with('error', 'Vendor profile not found. Please contact support.');
        }

        // Make sure this order actually belongs to the current vendor.
        $belongsToVendor = $order->orderItems()->where('vendor_id', $vendor->id)->exists();

        if (! $belongsToVendor) {
            abort(404);
        }

        $validated = $request->validate([
            'payment_status' => 'required|in:pending,completed,failed,refunded',
        ]);

        $payment = $order->payment;

        if (! $payment) {
            return redirect()
                ->route('order-details', ['order' => $order->id])
                ->with('error', 'No payment record found for this order.');
        }

        // Vendors mainly need to confirm they have received the money
        // (pending -> paid), but we also allow flagging failed/refunded.
        if ($payment->status !== $validated['payment_status']) {
            if ($validated['payment_status'] === 'completed') {
                $payment->markAsCompleted($payment->transaction_id ?? ('MANUAL-'.Str::upper(Str::random(10))));
            } elseif ($validated['payment_status'] === 'failed') {
                $payment->markAsFailed();
            } elseif ($validated['payment_status'] === 'refunded') {
                $payment->markAsRefunded();
            } else {
                $payment->update(['status' => 'pending']);
            }
        }

        $labels = [
            'pending' => 'Pending',
            'completed' => 'Paid',
            'failed' => 'Failed',
            'refunded' => 'Refunded',
        ];

        return redirect()
            ->route('order-details', ['order' => $order->id])
            ->with('success', 'Payment status updated to '.$labels[$validated['payment_status']].'.');
    }

    public function returnProducts()
    {
        return view('seller.return');
    }

    public function returnDetails()
    {
        return view('seller.return-details');
    }

    public function sellerProfile()
    {
        $user = auth()->user();
        $vendor = $user?->vendor;

        return view('seller.profile', compact('user', 'vendor'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150|unique:users,email,'.$user->id,
            'phone' => 'nullable|string|max:20',
            'profile_pic' => 'nullable|image|max:2048',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if ($request->hasFile('profile_pic')) {
            $path = $request->file('profile_pic')->store('profiles', 'public');
            $user->profile_pic = $path;
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = auth()->user();
        if (! \Hash::check($request->current_password, $user->password)) {
            return redirect()->back()
                ->withErrors(['current_password' => 'Current password is incorrect.'])
                ->withInput();
        }

        $user->password = \Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('password_success', 'Password changed successfully.');
    }

    public function sellerReview()
    {
        return view('seller.review');
    }

    public function sellerPayment(Request $request)
    {
        $vendor = auth()->user()->vendor;

        if (! $vendor) {
            return redirect()->route('dashboard')
                ->with('error', 'Vendor profile not found. Please contact support.');
        }

        $vendorId = $vendor->id;

        // ─── Base query: vendor's order items that have a completed payment ──
        // We join order_items → orders → payments to find items the vendor
        // has actually been paid for (payment.status = 'completed').
        // Cancelled / returned items are excluded from earnings.
        $paidItemsBase = OrderItem::where('order_items.vendor_id', $vendorId)
            ->whereNotIn('order_items.status', ['cancelled', 'returned'])
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->join('payments', 'payments.order_id', '=', 'orders.id')
            ->where('payments.status', 'completed');

        // ─── Total Earnings: sum of subtotals from paid, non-cancelled items ─
        $totalEarnings = (clone $paidItemsBase)->sum('order_items.subtotal');

        // ─── Total Payouts: sum of completed payouts for this vendor ─────────
        $totalPayouts = Payout::where('vendor_id', $vendorId)
            ->where('status', 'completed')
            ->sum('amount');

        // ─── Pending Settlement: orders confirmed/shipped but not yet paid ───
        // These are items on orders that exist but payment is still pending.
        $pendingSettlement = OrderItem::where('order_items.vendor_id', $vendorId)
            ->whereNotIn('order_items.status', ['cancelled', 'returned'])
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->join('payments', 'payments.order_id', '=', 'orders.id')
            ->where('payments.status', 'pending')
            ->sum('order_items.subtotal');

        // ─── Current Balance: total earned minus total paid out ───────────────
        $currentBalance = max(0, $totalEarnings - $totalPayouts);

        // ─── Payment transaction history (from the payments table) ───────────
        // Each row here represents a customer payment for an order containing
        // this vendor's items. We show these as the "payout history" since
        // the payouts table may still be empty for new setups.
        $period = $request->query('period', '30');

        $paymentHistoryQuery = Payment::select(
            'payments.id',
            'payments.gateway',
            'payments.total_amount',
            'payments.status',
            'payments.transaction_id',
            'payments.reference_id',
            'payments.paid_at',
            'payments.created_at',
            DB::raw('SUM(order_items.subtotal) as vendor_subtotal')
        )
            ->join('orders', 'orders.id', '=', 'payments.order_id')
            ->join('order_items', 'order_items.order_id', '=', 'orders.id')
            ->where('order_items.vendor_id', $vendorId)
            ->whereNotIn('order_items.status', ['cancelled', 'returned'])
            ->where('payments.status', 'completed')
            ->groupBy(
                'payments.id',
                'payments.gateway',
                'payments.total_amount',
                'payments.status',
                'payments.transaction_id',
                'payments.reference_id',
                'payments.paid_at',
                'payments.created_at'
            )
            ->latest('payments.created_at');

        if ($period !== 'all') {
            $paymentHistoryQuery->where('payments.created_at', '>=', now()->subDays((int) $period));
        }

        $paymentHistory = $paymentHistoryQuery->paginate(10)->withQueryString();

        // ─── Payout requests (admin-initiated payouts to the vendor) ─────────
        $payouts = Payout::where('vendor_id', $vendorId)->latest()->get();

        return view('seller.payment', compact(
            'vendor',
            'totalEarnings',
            'totalPayouts',
            'pendingSettlement',
            'currentBalance',
            'paymentHistory',
            'payouts',
            'period'
        ));
    }

    public function paymentDetails()
    {
        return view('seller.payment-details');
    }

    public function sellerNotification()
    {
        $user = auth()->user();

        $notifications = $user->appNotifications()->latest()->paginate(10);

        $counts = [
            'all' => $user->appNotifications()->where('is_read', false)->count(),
            'orders' => $user->appNotifications()->where('is_read', false)->whereIn('type', [
                'order_placed', 'order_confirmed', 'order_shipped', 'order_delivered', 'order_cancelled', 'return_requested', 'return_approved',
            ])->count(),
            'payouts' => $user->appNotifications()->where('is_read', false)->whereIn('type', [
                'payout_processed', 'payment_received',
            ])->count(),
            'store' => $user->appNotifications()->where('is_read', false)->whereNotIn('type', [
                'order_placed', 'order_confirmed', 'order_shipped', 'order_delivered', 'order_cancelled', 'return_requested', 'return_approved', 'payout_processed', 'payment_received',
            ])->count(),
        ];

        return view('seller.notification', compact('notifications', 'counts'));
    }

    public function markNotificationRead($id)
    {
        $notification = auth()->user()->appNotifications()->findOrFail($id);
        $notification->markAsRead();

        return response()->json(['success' => true]);
    }

    public function markAllNotificationsRead()
    {
        auth()->user()->appNotifications()->where('is_read', false)->update([
            'is_read' => true,
            'read_at' => now(),
        ]);

        return response()->json(['success' => true]);
    }

    public function sellerSupport()
    {
        return view('seller.support');
    }

    public function createTicket()
    {
        return view('seller.create-ticket');
    }

    public function storeTicket(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:100',
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $vendor = auth()->user()->vendor;
        if (! $vendor) {
            return redirect()->back()->with('error', 'Vendor profile not found.');
        }

        SupportTicket::create([
            'vendor_id' => $vendor->id,
            'ticket_number' => 'TK-'.mt_rand(10000, 99999),
            'category' => $validated['category'],
            'subject' => $validated['subject'],
            'description' => $validated['description'],
            'status' => 'Pending',
        ]);

        return redirect()->route('seller-ticket')->with('success', 'Support ticket created successfully!');
    }

    public function sellerTicket()
    {
        $vendor = auth()->user()->vendor;
        if (! $vendor) {
            return redirect()->route('dashboard')->with('error', 'Vendor profile not found.');
        }

        $tickets = SupportTicket::where('vendor_id', $vendor->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('seller.tickets', compact('tickets'));
    }
    // ─── Helpers ──────────────────────────────────────────────────────────────

    private function filterSpecs(array $specs): array
    {
        return array_values(array_filter($specs, function ($spec) {
            return ! empty($spec['key']) || ! empty($spec['value']);
        }));
    }
}
