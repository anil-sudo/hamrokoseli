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
        return view('seller.dashboard');
    }

    public function product_management(Request $request)
    {
        $vendor = auth()->user()->vendor;

        if (! $vendor) {
            return redirect()->route('dashboard')
                ->with('error', 'Vendor profile not found. Please contact support.');
        }

        $vendorId = $vendor->id;

        $query = Product::with(['category', 'images', 'variants'])
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

    public function store(Request $request)
    {
        // Conditional Validation Rules
        $rules = [
            'product_name' => 'required|string|max:200',
            'category' => 'required|exists:categories,id',
            'product_type' => 'nullable|string|max:100',
            'description' => 'required|string|max:2000',
            'specifications' => 'nullable|array',
            'specifications.*.key' => 'nullable|string|max:100',
            'specifications.*.value' => 'nullable|string|max:255',
            'images' => 'required|array|max:4',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:10240',
        ];

        $isVariantMode = $request->has('variants') && is_array($request->variants) && count($request->variants) > 0;

        if ($isVariantMode) {
            // VARIANTS MODE
            $rules['variants.*.sku'] = 'required|string|max:100|distinct|unique:product_variants,sku';
            $rules['variants.*.size'] = 'nullable|string|max:50';
            $rules['variants.*.color'] = 'nullable|string|max:50';
            $rules['variants.*.price'] = 'nullable|numeric|min:0';
            $rules['variants.*.stock'] = 'nullable|integer|min:0';
            $rules['variants.*.discounted_price'] = 'nullable|numeric|min:0';
        } else {
            // NORMAL MODE
            $rules['base_price'] = 'required|numeric|min:1';
            $rules['discounted_price'] = 'nullable|numeric|min:0|lt:base_price';
            $rules['sku'] = 'required|string|max:100|unique:products,sku';
            $rules['stock'] = 'required|integer|min:0';
        }

        $validated = $request->validate($rules);

        // Determine main product price and stock
        $productStock = 0;
        $productPrice = 0;
        if (! $isVariantMode) {
            $productPrice = $validated['base_price'];
            $productStock = $validated['stock'] ?? 0;
        } else {
            $prices = collect($validated['variants'] ?? [])->pluck('price')->filter();
            $productPrice = $prices->min() ?? 0;

            $productStock = collect($validated['variants'] ?? [])
                ->sum(fn ($v) => (int) ($v['stock'] ?? 0));
        }

        // Custom validation for variant discount amount
        if ($isVariantMode && ! empty($validated['variants'])) {
            foreach ($validated['variants'] as $index => $variant) {
                if (isset($variant['discounted_price']) && $variant['discounted_price'] !== '') {
                    $vPrice = ! empty($variant['price']) ? $variant['price'] : $productPrice;
                    if ($variant['discounted_price'] >= $vPrice) {
                        return back()->withErrors([
                            "variants.{$index}.discounted_price" => "The variant discount amount must be less than its price."
                        ])->withInput();
                    }
                }
            }
        }

        // Generate SKU for main product when using variants
        $mainSku = $validated['sku'] ?? null;
        if ($isVariantMode && empty($mainSku)) {
            $mainSku = strtoupper(Str::slug($validated['product_name'], '-')).'-'.strtoupper(Str::random(6));
        }

        // Create Product
        $productDiscountAmount = isset($validated['discounted_price'])
            ? floatval($validated['discounted_price'])
            : 0;

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
            'price' => $productPrice,
            'discount_price' => $productDiscountAmount > 0
                && $productDiscountAmount < $productPrice
                ? ($productPrice - $productDiscountAmount)
                : null,
            'stock' => $productStock,
            'sku' => $mainSku,
            'status' => 'active',
        ]);

        // Save Variants
        if ($isVariantMode && ! empty($validated['variants'])) {
            foreach ($validated['variants'] as $variant) {
                if (empty($variant['sku'])) {
                    continue;
                }

                $vPrice = ! empty($variant['price']) ? floatval($variant['price']) : $productPrice;
                $vDiscountAmount = isset($variant['discounted_price']) && $variant['discounted_price'] !== ''
                    ? floatval($variant['discounted_price'])
                    : 0;

                ProductVariant::create([
                    'product_id' => $product->id,
                    'sku' => $variant['sku'],
                    'size' => $variant['size'] ?? null,
                    'color' => $variant['color'] ?? null,
                    'price' => $vPrice,
                    'discount_price' => $vDiscountAmount > 0
                        && $vDiscountAmount < $vPrice
                        ? ($vPrice - $vDiscountAmount)
                        : null,
                    'stock' => $variant['stock'] ?? 0,
                    'status' => 'active',
                ]);
            }
        }

        // Save Images
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
