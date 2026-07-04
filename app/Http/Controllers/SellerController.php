<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        if (Auth::attempt($credentials)) {

            $user = Auth::user();

            if ($user->vendor->status === 'active') {
                // $request->session()->regenerate();
                return redirect()->route('dashboard');
            } else {
                Auth::logout();
                $request->session()->invalidate();

                return redirect()->intended('seller-login');
            }
        }

        // Use 'vendor' guard instead of default
        // if (Auth::guard('vendor')->attempt($credentials, $request->boolean('remember'))) {
        //     $user = Auth::guard('vendor')->user();

        //     if ($user->role !== 'vendor' || ! $user->is_active) {
        //         Auth::guard('vendor')->logout();

        //         return back()->withInput($request->only('email'))
        //             ->withErrors(['email' => 'You do not have a seller account.']);
        //     }

        //     if (! $user->hasRole('vendor')) {
        //         $user->assignRole('vendor');
        //     }

        //     if (! $user->vendor) {
        //         $user->vendor()->create([
        //             'vendor_name' => $user->name,
        //             'owner_name' => $user->name,
        //             'email' => $user->email,
        //             'phone' => $user->phone ?? '0000000000',
        //             'status' => 'pending',
        //         ]);
        //     }

        //     $request->session()->regenerate();

        //     return redirect()->route('dashboard');
        // }

        return back()->withInput($request->only('email'))
            ->withErrors(['email' => 'These credentials do not match our records.']);
    }

    public function logout(Request $request)
    {
        Auth::guard('vendor')->logout();
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
        $dealEndsAt = \App\Models\Setting::getValue('todays_deal_ends_at');
        if (!$dealEndsAt) {
            $dealEndsAt = now()->endOfDay()->toDateTimeString();
        }
        return view('seller.dashboard', compact('dealEndsAt'));
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
            'products', 'totalProducts', 'activeProducts',
            'outOfStock', 'draftProducts', 'categories'
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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:200',
            'category' => 'required|exists:categories,id',
            'product_type' => 'nullable|string|max:100',
            'description' => 'required|string|max:2000',
            'base_price' => 'required|numeric|min:0',
            'discounted_price' => 'nullable|numeric|min:0',
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
                                    ? $validated['discounted_price']
                                    : null,
            'stock' => $validated['stock'],
            'sku' => $validated['sku'],
            'status' => 'draft',
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

    public function update(Request $request, $id)
    {
        abort_if(auth()->user()->cannot('update products'), 403, 'You do not have permission to update products.');
        // update logic here
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

    public function order()
    {
        return view('seller.order');
    }

    public function orderDetails()
    {
        return view('seller.order-details');
    }

    public function sellerProfile()
    {
        return view('seller.profile');
    }

    public function sellerReview()
    {
        return view('seller.review');
    }

    public function sellerPayment()
    {
        return view('seller.payment');
    }

    public function paymentDetails()
    {
        return view('seller.payment-details');
    }

    public function sellerNotification()
    {
        return view('seller.notification');
    }

    public function sellerSupport()
    {
        return view('seller.support');
    }

    public function createTicket()
    {
        return view('seller.create-ticket');
    }

    public function sellerTicket()
    {
        return view('seller.tickets');
    }
    // ─── Helpers ──────────────────────────────────────────────────────────────

    private function filterSpecs(array $specs): array
    {
        return array_values(array_filter($specs, function ($spec) {
            return ! empty($spec['key']) || ! empty($spec['value']);
        }));
    }
}
