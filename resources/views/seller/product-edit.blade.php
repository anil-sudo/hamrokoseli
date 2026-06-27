<x-seller_layout title="Edit Product">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between items-start gap-4 mb-8">
        <h1 class="text-2xl font-semibold text-(--text-color)">Edit Product</h1>
        <a href="{{ route('product-management') }}"
            class="inline-flex items-center gap-2 px-6 py-3.5 border border-(--secondary-color) hover:bg-(--card-bg) bg-(--text-light)/70 rounded-2xl font-medium w-fit sm:w-auto">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
            Back to Products
        </a>
    </div>

    <form id="productForm" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-12 gap-6">
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
                        <input type="text" id="product_name" required
                            class="w-full px-5 py-4 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-base focus:outline-none focus:border-(--secondary-color)">
                        <p class="error text-red-500 text-sm mt-1 hidden"></p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-(--text-dark) mb-2">Category <span
                                    class="text-(--secondary-color)">*</span></label>
                            <select id="category" required
                                class="w-full px-5 py-4 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-base">
                                <option value="thing">Clothing</option>
                                <option value="essories">Accessories</option>
                                <option value="e">Home & Living</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-(--text-dark) mb-2">Product Type</label>
                            <input type="text" id="product_type"
                                class="w-full px-5 py-4 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-base">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-(--text-dark) mb-2">Description <span
                                class="text-(--secondary-color)">*</span></label>
                        <textarea id="description" rows="8" required maxlength="2000"
                            class="w-full px-5 py-4 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-base"> </textarea>
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
                <div id="specifications" class="space-y-4"></div>
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
                <div id="variants" class="space-y-4"></div>
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
                    <input type="file" id="mediaInput" multiple accept="image/*" class="hidden">
                </div>
                <div id="previewGrid" class="grid grid-cols-4 gap-4"></div>
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
                        <input type="number" id="base_price" value="0" min="0" required
                            class="w-full px-5 py-4 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-base">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-(--text-dark) mb-2">Discount Price</label>
                            <input type="number" id="discounted_price" value="0" min="0"
                                class="w-full px-5 py-4 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-base">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-(--text-dark) mb-2">SKU <span
                                    class="text-(--secondary-color)">*</span></label>
                            <input type="text" id="sku" required
                                class="w-full px-5 py-4 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-base">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-(--text-dark) mb-2">Stock Quantity <span
                                class="text-(--secondary-color)">*</span></label>
                        <input type="number" id="stock" name="stock" value="0" min="0" required
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
