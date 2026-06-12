<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SellerController extends Controller
{
    public function login()
    {
        return view('seller.login');
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
        $vendorId = 1; // replace with auth()->user()->vendor->id later

        $query = Product::with(['category', 'images'])
            ->where('vendor_id', $vendorId);

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by stock status
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

    public function productEdit()
    {
        return view('seller.product-edit');
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
            'variants.*.sku' => 'required_with:variants|string|max:100|distinct',
            'variants.*.size' => 'nullable|string|max:50',
            'variants.*.color' => 'nullable|string|max:50',
            'variants.*.price' => 'nullable|numeric|min:0',
            'variants.*.stock' => 'nullable|integer|min:0',
            'images' => 'nullable|array|max:4',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        // --- 1. Create the product ---
        // For now vendor_id is hardcoded to 1; replace with auth()->user()->vendor->id
        // once auth is set up.
        $product = Product::create([
            'vendor_id' => 1,
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

        // --- 2. Save variants ---
        if (! empty($validated['variants'])) {
            foreach ($validated['variants'] as $variant) {
                // Skip completely empty rows
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

        // --- 3. Save images ---
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
        $product = Product::findOrFail($id);
        $product->images()->delete();
        $product->delete();

        return redirect()->route('product-management')->with('success', 'Product deleted successfully.');
    }

    public function order()
    {
        return view('seller.order');
    }

    public function orderDetails()
    {
        return view('seller.order-details');
    }

    // ─── Helpers ──────────────────────────────────────────────────────────────

    /**
     * Remove spec rows where both key and value are empty.
     */
    private function filterSpecs(array $specs): array
    {
        return array_values(array_filter($specs, function ($spec) {
            return ! empty($spec['key']) || ! empty($spec['value']);
        }));
    }
}
