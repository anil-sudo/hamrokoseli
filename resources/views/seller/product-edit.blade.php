<x-seller_layout title="Edit Product">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between items-start gap-4 mb-8">
        <h1 class="text-2xl font-semibold text-(--text-color)">Edit Product</h1>
        <a href="{{ route('product-management') }}"
            class="inline-flex items-center gap-2 px-6 py-3.5 border border-(--secondary-color) hover:bg-(--card-bg) bg-(--text-light)/70 rounded-2xl font-medium w-fit sm:w-auto">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
            Back to Products
        </a>
    </div>

    <form id="productForm" method="POST" action="{{ route('product.update', $product->id) }}" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        @csrf
        <!-- Left Side -->
        <div class="lg:col-span-8 space-y-6">
            <!-- General Information -->
            <div
                class="bg-(--card-bg) rounded-3xl shadow-sm hover:shadow-md border border-(--text-color)/20 p-6 lg:p-8">
                <h2 class="text-xl font-semibold mb-6 flex items-center gap-2">
                    <i data-lucide="info" class="w-6 h-6 text-(--primary-color)"></i>
                    General Information
                </h2>
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-(--text-dark) mb-2">Product Name <span
                                class="text-(--secondary-color)">*</span></label>
                        <input type="text" id="product_name" name="product_name" required
                            value="{{ old('product_name', $product->name) }}"
                            class="w-full px-5 py-4 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-base focus:outline-none focus:border-(--secondary-color)">
                        <p class="error text-red-500 text-sm mt-1 hidden"></p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-(--text-dark) mb-2">Category <span
                                    class="text-(--secondary-color)">*</span></label>
                            <select id="category" name="category" required
                                class="w-full px-5 py-4 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-base">
                                <option value="">Select category</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category', $product->category_id) == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->cat_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-(--text-dark) mb-2">Product Type</label>
                            <input type="text" id="product_type" name="product_type"
                                value="{{ old('product_type', $product->product_type) }}"
                                class="w-full px-5 py-4 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-base">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-(--text-dark) mb-2">Description <span
                                class="text-(--secondary-color)">*</span></label>
                        <textarea id="description" name="description" rows="8" required maxlength="2000"
                            class="w-full px-5 py-4 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-base">{{ old('description', $product->description) }}</textarea>
                        <p id="charCount" class="text-xs text-gray-400 text-right mt-1">0/2000</p>
                    </div>
                </div>
            </div>

            <!-- Product Specifications -->
            <div
                class="bg-(--card-bg) rounded-3xl shadow-sm hover:shadow-md border border-(--text-color)/20 p-6 lg:p-8">
                <h2 class="text-xl font-semibold mb-6 flex items-center gap-2">
                    <i data-lucide="settings" class="w-6 h-6 text-(--primary-color)"></i>
                    Product Specifications
                </h2>
                <div id="specifications" class="space-y-4">
                    @php
                        $specs = old('specifications', $product->specifications ?? []);
                        if (is_string($specs)) {
                            $specs = json_decode($specs, true) ?? [];
                        }
                    @endphp
                    @foreach ($specs as $i => $spec)
                        <div class="flex gap-3 items-center spec-row border border-(--text-color)/20 rounded-2xl p-5 bg-(--card-dark)/50">
                            <div class="grid grid-cols-1 sm:grid-cols-12 gap-4 w-full">
                                <div class="sm:col-span-5 col-span-12">
                                    <label class="block text-xs font-medium text-(--text-color)/70 mb-1">Specification Name</label>
                                    <input type="text" name="specifications[{{ $i }}][key]" value="{{ $spec['key'] ?? '' }}" placeholder="e.g. Material"
                                        class="w-full px-4 py-3 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-base focus:outline-none focus:border-(--secondary-color)">
                                </div>
                                <div class="sm:col-span-6 col-span-12">
                                    <label class="block text-xs font-medium text-(--text-color)/70 mb-1">Value</label>
                                    <input type="text" name="specifications[{{ $i }}][value]" value="{{ $spec['value'] ?? '' }}" placeholder="e.g. 100% Wool"
                                        class="w-full px-4 py-3 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-base focus:outline-none focus:border-(--secondary-color)">
                                </div>
                                <div class="sm:col-span-1 col-span-12 flex sm:items-end">
                                    <button type="button" onclick="this.closest('.border').remove()"
                                        class="w-full sm:w-11 h-11 flex items-center justify-center text-(--secondary-color) hover:text-red-500 rounded-2xl transition">
                                        <i data-lucide="trash-2" class="w-5 h-5"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button type="button" onclick="addSpecification()"
                    class="mt-6 inline-flex items-center gap-2 px-6 py-3 border border-(--secondary-color) hover:bg-(--card-dark) bg-(--card-dark)/80 text-(--text-color) rounded-2xl font-medium">
                    <i data-lucide="plus" class="w-5 h-5"></i>
                    Add New Specification
                </button>
            </div>

            <!-- Variants -->
            <div
                class="bg-(--card-bg) rounded-3xl shadow-sm hover:shadow-md border border-(--text-color)/20 p-6 lg:p-8">
                <h2 class="text-xl font-semibold mb-6 flex items-center gap-2">
                    <i data-lucide="layers" class="w-6 h-6 text-(--primary-color)"></i>
                    Variants
                </h2>
                <div id="variants" class="space-y-4">
                    @foreach ($product->variants as $i => $variant)
                        <div class="variant-row border border-(--text-color)/20 rounded-2xl p-5 bg-(--card-dark)/50">
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-3 mb-3">
                                <input type="text" name="variants[{{ $i }}][sku]"
                                    value="{{ $variant->sku }}" placeholder="SKU *" required
                                    class="px-4 py-3 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-sm focus:outline-none focus:border-(--secondary-color)">
                                <input type="text" name="variants[{{ $i }}][size]"
                                    value="{{ $variant->size }}" placeholder="Size (e.g. M, L, XL)"
                                    class="px-4 py-3 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-sm focus:outline-none focus:border-(--secondary-color)">
                                <input type="text" name="variants[{{ $i }}][color]"
                                    value="{{ $variant->color }}" placeholder="Color"
                                    class="px-4 py-3 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-sm focus:outline-none focus:border-(--secondary-color)">
                                <input type="number" name="variants[{{ $i }}][price]"
                                    value="{{ $variant->price }}" placeholder="Price"
                                    min="0" step="1"
                                    class="px-4 py-3 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-sm focus:outline-none focus:border-(--secondary-color)">
                                <input type="number" name="variants[{{ $i }}][discounted_price]"
                                    value="{{ ($variant->discount_price && $variant->discount_price > 0 && $variant->discount_price < $variant->price) ? ($variant->price - $variant->discount_price) : '' }}" placeholder="Discount (Rs.)"
                                    min="0" step="1"
                                    class="px-4 py-3 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-sm focus:outline-none focus:border-(--secondary-color)">
                                <input type="number" name="variants[{{ $i }}][stock]"
                                    value="{{ $variant->stock }}" placeholder="Stock" min="0"
                                    class="px-4 py-3 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-sm focus:outline-none focus:border-(--secondary-color)">
                            </div>
                            <button type="button" onclick="this.closest('.variant-row').remove()"
                                class="text-sm text-red-400 hover:text-red-600 flex items-center gap-1">
                                <i data-lucide="trash-2" class="w-4 h-4"></i> Remove variant
                            </button>
                        </div>
                    @endforeach
                </div>
                <button type="button" onclick="addVariant()"
                    class="mt-6 inline-flex items-center gap-2 px-6 py-3 border border-(--secondary-color) hover:bg-(--card-dark) bg-(--card-dark)/80 text-(--text-color) rounded-2xl font-medium">
                    <i data-lucide="plus" class="w-5 h-5"></i>
                    Add New Variant
                </button>
            </div>
        </div>

        <!-- Right Sidebar -->
        <div class="lg:col-span-4 space-y-6">
            <!-- Product Media -->
            <div
                class="bg-(--card-bg) rounded-3xl shadow-sm hover:shadow-md border border-(--text-color)/20 p-6 lg:p-8">
                <h2 class="text-xl font-semibold mb-6 flex items-center gap-2">
                    <i data-lucide="image" class="w-6 h-6 text-(--primary-color)"></i>
                    Product Media
                </h2>
                <div id="uploadArea"
                    class="border-2 border-dashed border-(--text-color)/40 rounded-3xl p-8 text-center mb-6 hover:border-(--secondary-color) transition cursor-pointer">
                    <div class="w-12 h-12 mx-auto mb-3 flex items-center justify-center bg-(--card-dark) rounded-full">
                        <i data-lucide="upload-cloud" class="w-6 h-6 text-(--text-color)"></i>
                    </div>
                    <p class="font-medium">Click to upload or drag and drop</p>
                    <p class="text-sm text-(--text-color)/70 mt-1">PNG, JPG up to 10MB (Max 4 images)</p>
                    <input type="file" id="mediaInput" name="images[]" multiple accept="image/*" class="hidden">
                </div>
                <div id="previewGrid" class="grid grid-cols-4 gap-4">
                    @foreach($product->images as $image)
                        <div class="aspect-square border border-(--text-color)/20 rounded-2xl overflow-hidden relative group">
                            <img src="{{ asset('storage/' . $image->path) }}" class="w-full h-full object-cover">
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Pricing & Inventory -->
            <div
                class="bg-(--card-bg) rounded-3xl shadow-sm hover:shadow-md border border-(--text-color)/20 p-6 lg:p-8">
                <h2 class="text-xl font-semibold mb-6 flex items-center gap-2">
                    <i data-lucide="dollar-sign" class="w-6 h-6 text-(--primary-color)"></i>
                    Pricing & Inventory
                </h2>
                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-medium text-(--text-dark) mb-2">Base Price (Rs.) <span
                                class="text-(--secondary-color)">*</span></label>
                        <input type="number" id="base_price" name="base_price" value="{{ old('base_price', $product->price) }}" min="0" required
                            class="w-full px-5 py-4 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-base">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-(--text-dark) mb-2">Discount (Rs.)</label>
                            <input type="number" id="discounted_price" name="discounted_price" value="{{ old('discounted_price', ($product->discount_price && $product->discount_price > 0 && $product->discount_price < $product->price) ? ($product->price - $product->discount_price) : 0) }}" min="0"
                                class="w-full px-5 py-4 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-base">
                            <p id="discount_preview" class="text-xs text-green-600 font-medium mt-1.5 hidden"></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-(--text-dark) mb-2">SKU <span
                                    class="text-(--secondary-color)">*</span></label>
                            <input type="text" id="sku" name="sku" value="{{ old('sku', $product->sku) }}" required
                                class="w-full px-5 py-4 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-base">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-(--text-dark) mb-2">Stock Quantity <span
                                class="text-(--secondary-color)">*</span></label>
                        <input type="number" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" min="0" required
                            class="w-full px-5 py-4 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-base">
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Actions -->
        <!-- Bottom Actions -->
        <div class="lg:col-span-12 flex flex-row sm:justify-between sm:items-center gap-4 mt-10">
            <a href=""
                class="inline-flex items-center gap-2 px-6 py-3.5 border border-(--secondary-color) hover:bg-(--card-bg) bg-(--text-light)/70 rounded-2xl font-medium w-fit sm:w-auto">
                Cancel
            </a>

            <button type="submit"
                class="inline-flex items-center gap-2 px-8 py-3.5 bg-(--secondary-color)/95 hover:bg-(--secondary-color) text-(--text-light) rounded-2xl font-semibold transition w-fit sm:w-auto">
                Update Product
            </button>
        </div>
    </form>

@vite('resources/js/product-edit.js')

</x-seller_layout>
