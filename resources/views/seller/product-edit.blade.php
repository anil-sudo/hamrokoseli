<x-seller_layout title="Edit Product">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between items-start gap-4 mb-8">
        <h1 class="text-2xl font-semibold text-(--text-color)">Edit Product</h1>
        <a href="{{ route('product-management') }}"
            class="inline-flex items-center gap-2 px-6 py-3.5 border border-(--secondary-color) hover:bg-(--card-bg) bg-(--text-light)/70 rounded-2xl font-medium w-fit sm:w-auto">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
            Back to Products
        </a>
    </div>

    {{-- Validation errors --}}
    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-2xl">
            <ul class="list-disc list-inside text-sm text-red-600 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div id="toastContainer" class="fixed top-5 right-5 z-50 space-y-3"></div>

    <form id="productForm" method="POST" action="{{ route('product.update', $product->id) }}"
        enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        @csrf
        @method('PUT')

        <!-- Left Side - Main Form -->
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
                        <label class="block text-sm font-medium text-(--text-dark) mb-2">
                            Product Name <span class="text-(--secondary-color)">*</span>
                        </label>
                        <input type="text" id="product_name" name="product_name" required
                            value="{{ old('product_name', $product->name) }}"
                            class="w-full px-5 py-4 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-base focus:outline-none focus:border-(--secondary-color) transition duration-200"
                            placeholder="e.g. Handmade Himalayan Wool Sweater">
                        @error('product_name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-(--text-dark) mb-2">
                                Category <span class="text-(--secondary-color)">*</span>
                            </label>
                            <select id="category" name="category" required
                                class="w-full px-5 py-4 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-base focus:outline-none focus:border-(--secondary-color) transition duration-200">
                                <option value="">Select category</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ old('category', $product->category_id) == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->cat_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-(--text-dark) mb-2">Product Type</label>
                            <input type="text" id="product_type" name="product_type"
                                value="{{ old('product_type', $product->product_type) }}"
                                class="w-full px-5 py-4 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-base focus:outline-none focus:border-(--secondary-color) transition duration-200"
                                placeholder="e.g. Local Made">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-(--text-dark) mb-2">
                            Description <span class="text-(--secondary-color)">*</span>
                        </label>
                        <textarea id="description" name="description" rows="8" required maxlength="2000"
                            class="w-full px-5 py-4 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-base focus:outline-none focus:border-(--secondary-color) transition duration-200"
                            placeholder="Describe your product in detail...">{{ old('description', $product->description) }}</textarea>
                        <p id="charCount" class="text-xs text-gray-400 text-right mt-1">0/2000</p>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Product Specifications -->
            <div
                class="bg-(--card-bg) rounded-3xl shadow-sm hover:shadow-md border border-(--text-color)/20 p-6 lg:p-8">
                <h2 class="text-xl font-semibold mb-6 flex items-center gap-2">
                    <i data-lucide="settings" class="w-6 h-6 text-(--primary-color)"></i>
                    Product Specifications <span class="text-(--secondary-color)">*</span>
                </h2>
                <p class="text-sm text-(--text-color)/70 mb-4">Add specifications like Material, Weight, Size, etc.</p>

                <div id="specifications" class="space-y-4">
                    @php
                        $specs = old('specifications', $product->specifications ?? []);
                    @endphp
                    @if (!empty($specs))
                        @foreach ($specs as $i => $spec)
                            <div class="flex gap-3 items-center spec-row">
                                <input type="text" name="specifications[{{ $i }}][key]"
                                    value="{{ $spec['key'] ?? '' }}" placeholder="e.g. Material"
                                    class="flex-1 px-4 py-3 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-sm focus:outline-none focus:border-(--secondary-color)">
                                <input type="text" name="specifications[{{ $i }}][value]"
                                    value="{{ $spec['value'] ?? '' }}" placeholder="e.g. 100% Wool"
                                    class="flex-1 px-4 py-3 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-sm focus:outline-none focus:border-(--secondary-color)">
                                <button type="button" onclick="this.closest('.spec-row').remove()"
                                    class="p-2 text-red-400 hover:text-red-600 transition">
                                    <i data-lucide="trash-2" class="w-5 h-5"></i>
                                </button>
                            </div>
                        @endforeach
                    @endif
                </div>

                <button type="button" onclick="addSpecification()"
                    class="mt-6 inline-flex items-center gap-2 px-6 py-3 border border-(--secondary-color) hover:bg-(--card-dark) bg-(--card-dark)/80 text-(--text-color) rounded-2xl font-medium">
                    <i data-lucide="plus" class="w-5 h-5"></i>
                    Add New Specification
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
                    Product Image <span class="text-(--secondary-color)">*</span>
                </h2>

                <div id="uploadArea"
                    class="border-2 border-dashed border-(--text-color)/40 rounded-3xl p-8 text-center mb-6 hover:border-(--secondary-color) transition cursor-pointer">
                    <div class="w-12 h-12 mx-auto mb-3 flex items-center justify-center bg-(--card-dark) rounded-full">
                        <i data-lucide="upload-cloud" class="w-6 h-6 text-(--text-color)"></i>
                    </div>
                    <p class="font-medium">Click to upload or drag and drop</p>
                    <p class="text-sm text-(--text-color)/70 mt-1">PNG, JPG, WebP (Max 100KB)</p>
                    <input type="file" id="mediaInput" name="images[]" accept="image/*" class="hidden">
                </div>

                <div id="previewGrid" class="mt-6 grid grid-cols-1 gap-4">
                    @if ($product->images->first())
                        <div class="aspect-square border rounded-2xl overflow-hidden relative">
                            <img src="{{ asset('storage/' . $product->images->first()->path) }}"
                                class="w-full h-full object-cover">
                        </div>
                    @endif
                </div>
                @error('images.*')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Pricing & Inventory -->
            <div id="pricingSection"
                class="bg-(--card-bg) rounded-3xl shadow-sm hover:shadow-md border border-(--text-color)/20 p-6 lg:p-8">
                <h2 class="text-xl font-semibold mb-6 flex items-center gap-2">
                    <i data-lucide="dollar-sign" class="w-6 h-6 text-(--primary-color)"></i>
                    Pricing & Inventory <span class="text-(--secondary-color)">*</span>
                </h2>

                <div class="space-y-5">
                    <!-- Current Price Display -->
                    @php
                        $basePrice = $product->price;
                        $discountedPrice = $product->discount_price;
                        $hasDiscount = $discountedPrice !== null && $discountedPrice > 0 && $discountedPrice < $basePrice;
                        $discountPercent = $hasDiscount ? round((($basePrice - $discountedPrice) / $basePrice) * 100) : 0;
                        $discountAmount = $hasDiscount ? ($basePrice - $discountedPrice) : 0;
                    @endphp

                    @if ($hasDiscount)
                        <div class="bg-green-50 border border-green-200 rounded-xl p-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600">Final Price</p>
                                    <p class="text-2xl font-bold text-green-700">Rs.{{ number_format($discountedPrice, 2) }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm text-gray-500 line-through">
                                        Rs.{{ number_format($basePrice, 2) }}</p>
                                    <p class="text-xs text-green-600 font-semibold">
                                        You Save: Rs.{{ number_format($discountAmount, 2) }}
                                        <span class="ml-1 bg-green-200 text-green-800 px-2 py-0.5 rounded-full">
                                            -{{ $discountPercent }}%
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="bg-gray-50 border border-gray-200 rounded-xl p-4">
                            <p class="text-sm text-gray-600">
                                <span class="font-semibold">Current Price:</span>
                                Rs.{{ number_format($basePrice, 2) }}
                            </p>
                        </div>
                    @endif

                    <div>
                        <label class="block text-sm font-medium text-(--text-dark) mb-2">
                            Base Price (Rs.) <span class="text-(--secondary-color)">*</span>
                        </label>
                        <input type="number" id="base_price" name="base_price"
                            value="{{ old('base_price', $product->price) }}" min="0" required step="0.01"
                            class="w-full px-5 py-4 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-base focus:outline-none focus:border-(--secondary-color) transition duration-200"
                            oninput="calculateFinalPrice()">
                        @error('base_price')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-(--text-dark) mb-2">
                            Discount (%)
                        </label>
                        <input type="number" id="discount_amount" name="discount_amount"
                            value="{{ old('discount_amount', ($product->discount_price && $product->discount_price > 0 && $product->discount_price < $product->price) ? round((($product->price - $product->discount_price) / $product->price) * 100) : '') }}"
                            min="0" max="99" step="1"
                            class="w-full px-5 py-4 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-base focus:outline-none focus:border-(--secondary-color) transition duration-200"
                            placeholder="Enter discount percentage (e.g. 10 for 10% off)"
                            oninput="updateDiscountPreview()">
                        <div id="pricePreview" class="mt-2 text-sm text-gray-600"></div>
                        @error('discount_amount')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-(--text-dark) mb-2">
                                SKU <span class="text-(--secondary-color)">*</span>
                            </label>
                            <input type="text" id="sku" name="sku" required
                                value="{{ old('sku', $product->sku) }}"
                                class="w-full px-5 py-4 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-base focus:outline-none focus:border-(--secondary-color) transition duration-200">
                            @error('sku')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-(--text-dark) mb-2">
                                Stock Quantity <span class="text-(--secondary-color)">*</span>
                            </label>
                            <input type="number" id="stock" name="stock"
                                value="{{ old('stock', $product->stock) }}" min="0" required
                                class="w-full px-5 py-4 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-base focus:outline-none focus:border-(--secondary-color) transition duration-200">
                            @error('stock')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-(--text-dark) mb-2">
                    Product Status <span class="text-(--secondary-color)">*</span>
                </label>
                <select name="status" required
                    class="w-full px-5 py-4 bg-(--card-bg) border border-(--bg-color)/30 rounded-xl text-base focus:outline-none focus:border-(--secondary-color)">
                    <option value="active" {{ old('status', $product->status) == 'active' ? 'selected' : '' }}>
                        Active (Publish Now)
                    </option>
                    <option value="draft" {{ old('status', $product->status) == 'draft' ? 'selected' : '' }}>
                        Draft (Save for Later)
                    </option>
                </select>
            </div>
        </div>

        <!-- Bottom Actions -->
        <div class="lg:col-span-12 flex flex-row justify-between items-center gap-4 mt-10">
            <a href="{{ route('product-management') }}"
                class="inline-flex items-center gap-2 px-6 py-3.5 border border-(--secondary-color) hover:bg-(--card-bg) bg-(--text-light)/70 rounded-2xl font-medium w-fit sm:w-auto">
                Cancel
            </a>

            <button type="submit"
                class="inline-flex items-center gap-2 px-8 py-3.5 bg-(--secondary-color)/95 hover:bg-(--secondary-color) text-(--text-light) rounded-2xl font-semibold transition w-fit sm:w-auto">
                <i data-lucide="save" class="w-5 h-5"></i>
                Update Product
            </button>
        </div>
    </form>

    @push('scripts')
    <script>
        // Calculate and preview final price
        function calculateFinalPrice() {
            const basePrice = parseFloat(document.getElementById('base_price').value) || 0;
            const discountPercent = parseFloat(document.getElementById('discount_amount').value) || 0;
            const preview = document.getElementById('pricePreview');

            if (discountPercent > 0 && discountPercent <= 99) {
                const finalPrice = basePrice - (basePrice * discountPercent / 100);
                preview.innerHTML = `
                    <div class="flex items-center gap-4">
                        <span class="font-semibold text-green-600">
                            Final Price: Rs.${finalPrice.toFixed(2)}
                        </span>
                        <span class="text-xs bg-green-100 text-green-800 px-2 py-0.5 rounded-full">
                            Save ${discountPercent}%
                        </span>
                    </div>
                    <div class="text-xs text-gray-400">
                        Base: Rs.${basePrice.toFixed(2)} - Discount: ${discountPercent}%
                    </div>
                `;
            } else if (discountPercent > 99 || discountPercent < 0) {
                preview.innerHTML = `<span class="text-red-500">Discount percentage must be between 0 and 99</span>`;
            } else {
                preview.innerHTML = `<span class="text-gray-400">No discount applied</span>`;
            }
        }

        // Character counter for description
        document.addEventListener('DOMContentLoaded', function() {
            const description = document.getElementById('description');
            const charCount = document.getElementById('charCount');

            function updateCharCount() {
                const count = description.value.length;
                charCount.textContent = count + '/2000';
                if (count > 1900) {
                    charCount.classList.add('text-red-500');
                    charCount.classList.remove('text-gray-400');
                } else {
                    charCount.classList.remove('text-red-500');
                    charCount.classList.add('text-gray-400');
                }
            }

            description.addEventListener('input', updateCharCount);
            updateCharCount();

            // Initialize price preview
            calculateFinalPrice();
        });

        // Toggle variants section
        function toggleVariants() {
            const variantsSection = document.getElementById('variantsSection');
            const toggleBtn = document.getElementById('variantToggleBtn');

            if (variantsSection.classList.contains('hidden')) {
                variantsSection.classList.remove('hidden');
                toggleBtn.innerHTML = '<i data-lucide="toggle-right" class="w-5 h-5"></i> Hide Variants';
            } else {
                variantsSection.classList.add('hidden');
                toggleBtn.innerHTML = '<i data-lucide="toggle-left" class="w-5 h-5"></i> Add Variants';
            }

            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        }

        // Add new specification
        function addSpecification() {
            const container = document.getElementById('specifications');
            const index = container.children.length;
            const row = document.createElement('div');
            row.className = 'flex gap-3 items-center spec-row';
            row.innerHTML = `
                <input type="text" name="specifications[${index}][key]" placeholder="e.g. Material"
                    class="flex-1 px-4 py-3 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-sm focus:outline-none focus:border-(--secondary-color)">
                <input type="text" name="specifications[${index}][value]" placeholder="e.g. 100% Wool"
                    class="flex-1 px-4 py-3 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-sm focus:outline-none focus:border-(--secondary-color)">
                <button type="button" onclick="this.closest('.spec-row').remove()"
                    class="p-2 text-red-400 hover:text-red-600 transition">
                    <i data-lucide="trash-2" class="w-5 h-5"></i>
                </button>
            `;
            container.appendChild(row);

            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        }

        // Add new variant
        function addVariant() {
            const container = document.getElementById('variants');
            const index = container.children.length;
            const row = document.createElement('div');
            row.className = 'variant-row border border-(--text-color)/20 rounded-2xl p-5 bg-(--card-dark)/50';
            row.innerHTML = `
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3 mb-3">
                    <input type="text" name="variants[${index}][sku]" placeholder="SKU *"
                        class="px-4 py-3 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-sm focus:outline-none focus:border-(--secondary-color)">
                    <input type="text" name="variants[${index}][size]" placeholder="Size (e.g. M, L, XL)"
                        class="px-4 py-3 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-sm focus:outline-none focus:border-(--secondary-color)">
                    <input type="text" name="variants[${index}][color]" placeholder="Color"
                        class="px-4 py-3 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-sm focus:outline-none focus:border-(--secondary-color)">
                    <input type="number" name="variants[${index}][price]" placeholder="Base Price" min="0" step="1"
                        class="px-4 py-3 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-sm focus:outline-none focus:border-(--secondary-color)">
                    <input type="number" name="variants[${index}][discount_amount]" placeholder="Discount (%)" min="0" max="99" step="1"
                        class="px-4 py-3 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-sm focus:outline-none focus:border-(--secondary-color)">
                    <input type="number" name="variants[${index}][stock]" placeholder="Stock" min="0"
                        class="px-4 py-3 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-sm focus:outline-none focus:border-(--secondary-color)">
                </div>
                <div id="variantPreview_${index}" class="text-sm text-gray-600 mb-2"></div>
                <button type="button" onclick="this.closest('.variant-row').remove()"
                    class="text-sm text-red-400 hover:text-red-600 flex items-center gap-1">
                    <i data-lucide="trash-2" class="w-4 h-4"></i> Remove variant
                </button>
            `;
            container.appendChild(row);

            // Add real-time calculation for variant
            const inputs = row.querySelectorAll('input[type="number"]');
            inputs.forEach(input => {
                input.addEventListener('input', function() {
                    calculateVariantPrice(this.closest('.variant-row'));
                });
            });

            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        }

        // Calculate variant final price
        function calculateVariantPrice(row) {
            const price = parseFloat(row.querySelector('input[name*="[price]"]').value) || 0;
            const discountPercent = parseFloat(row.querySelector('input[name*="[discount_amount]"]').value) || 0;
            const preview = row.querySelector('[id^="variantPreview_"]');

            if (discountPercent > 0 && discountPercent <= 99) {
                const finalPrice = price - (price * discountPercent / 100);
                preview.innerHTML = `
                    <span class="font-semibold text-green-600">Final: Rs.${finalPrice.toFixed(2)}</span>
                    <span class="text-xs bg-green-100 text-green-800 px-2 py-0.5 rounded-full ml-2">-${discountPercent}%</span>
                `;
            } else if (discountPercent > 99 || discountPercent < 0) {
                preview.innerHTML = `<span class="text-red-500">Discount percentage must be between 0 and 99</span>`;
            } else {
                preview.innerHTML = `<span class="text-gray-400">No discount applied</span>`;
            }
        }

        // Remove existing image
        function removeExistingImage(button, imageId) {
            const container = document.getElementById('removedImagesContainer');
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'remove_images[]';
            input.value = imageId;
            container.appendChild(input);

            const imageDiv = button.closest('.existing-image');
            imageDiv.style.opacity = '0.5';
            imageDiv.style.pointerEvents = 'none';
            button.innerHTML = '<i data-lucide="check" class="w-4 h-4"></i>';
            button.classList.remove('bg-red-500');
            button.classList.add('bg-green-500');

            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        }

        // Image upload preview
        document.addEventListener('DOMContentLoaded', function() {
            const uploadArea = document.getElementById('uploadArea');
            const mediaInput = document.getElementById('mediaInput');
            const previewGrid = document.getElementById('previewGrid');
            const existingCount = {{ $product->images->count() }};
            let uploadedFiles = [];

            function updatePreview() {
                const existingImages = previewGrid.querySelectorAll('.existing-image');
                const newFiles = previewGrid.querySelectorAll('.new-image');
                newFiles.forEach(el => el.remove());

                uploadedFiles.forEach((file, index) => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const div = document.createElement('div');
                        div.className = 'aspect-square border-2 border-green-400 rounded-2xl overflow-hidden relative new-image';
                        div.innerHTML = `
                            <img src="${e.target.result}" class="w-full h-full object-cover">
                            <button type="button" onclick="removeNewImage(this, ${index})"
                                class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1.5">
                                <i data-lucide="x" class="w-4 h-4"></i>
                            </button>
                            <div class="absolute bottom-2 left-2 bg-black/50 text-white text-xs px-2 py-1 rounded">
                                ${file.name.length > 15 ? file.name.substring(0, 15) + '...' : file.name}
                            </div>
                        `;
                        previewGrid.appendChild(div);

                        if (typeof lucide !== 'undefined') {
                            lucide.createIcons();
                        }
                    };
                    reader.readAsDataURL(file);
                });
            }

            window.removeNewImage = function(button, index) {
                uploadedFiles.splice(index, 1);
                button.closest('.new-image').remove();

                const dt = new DataTransfer();
                uploadedFiles.forEach(file => dt.items.add(file));
                mediaInput.files = dt.files;
            };

            uploadArea.addEventListener('click', function() {
                mediaInput.click();
            });

            uploadArea.addEventListener('dragover', function(e) {
                e.preventDefault();
                this.classList.add('border-(--secondary-color)');
            });

            uploadArea.addEventListener('dragleave', function(e) {
                e.preventDefault();
                this.classList.remove('border-(--secondary-color)');
            });

            uploadArea.addEventListener('drop', function(e) {
                e.preventDefault();
                this.classList.remove('border-(--secondary-color)');

                const files = e.dataTransfer.files;
                const totalFiles = existingCount + uploadedFiles.length + files.length;

                if (totalFiles > 4) {
                    alert('Maximum 4 images allowed. You already have ' + existingCount + ' images and ' + uploadedFiles.length + ' new files.');
                    return;
                }

                for (let file of files) {
                    if (file.type.startsWith('image/')) {
                        uploadedFiles.push(file);
                    }
                }

                const dt = new DataTransfer();
                uploadedFiles.forEach(file => dt.items.add(file));
                mediaInput.files = dt.files;

                updatePreview();
            });

            mediaInput.addEventListener('change', function() {
                const files = Array.from(this.files);
                const totalFiles = existingCount + uploadedFiles.length + files.length;

                if (totalFiles > 4) {
                    alert('Maximum 4 images allowed. You already have ' + existingCount + ' images.');
                    this.value = '';
                    return;
                }

                uploadedFiles = files;
                updatePreview();
            });
        });
    </script>
    @endpush

    @vite('resources/js/product-edit.js')
</x-seller_layout>