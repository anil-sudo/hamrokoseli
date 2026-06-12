<x-seller_layout title="Add New Product">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between items-start gap-4 mb-8">
        <h1 class="text-2xl font-semibold text-(--text-color)">Add New Product</h1>
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

    <form id="productForm"
          method="POST"
          action="{{ route('product.store') }}"
          enctype="multipart/form-data"
          class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        @csrf

        <!-- Left Side - Main Form -->
        <div class="lg:col-span-8 space-y-6">

            <!-- General Information -->
            <div class="bg-(--card-bg) rounded-3xl shadow-sm hover:shadow-md border border-(--text-color)/20 p-6 lg:p-8">
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
                            value="{{ old('product_name') }}"
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
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category') == $cat->id ? 'selected' : '' }}>
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
                                value="{{ old('product_type') }}"
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
                            placeholder="Describe your product in detail...">{{ old('description') }}</textarea>
                        <p id="charCount" class="text-xs text-gray-400 text-right mt-1">0/2000</p>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Product Specifications -->
            <div class="bg-(--card-bg) rounded-3xl shadow-sm hover:shadow-md border border-(--text-color)/20 p-6 lg:p-8">
                <h2 class="text-xl font-semibold mb-6 flex items-center gap-2">
                    <i data-lucide="settings" class="w-6 h-6 text-(--primary-color)"></i>
                    Product Specifications
                </h2>
                <p class="text-sm text-(--text-color)/70 mb-4">Add specifications like Material, Weight, Size, etc.</p>

                <div id="specifications" class="space-y-4">
                    {{-- Repopulate specs on validation failure --}}
                    @if(old('specifications'))
                        @foreach(old('specifications') as $i => $spec)
                            <div class="flex gap-3 items-center spec-row">
                                <input type="text" name="specifications[{{ $i }}][key]"
                                    value="{{ $spec['key'] ?? '' }}"
                                    placeholder="e.g. Material"
                                    class="flex-1 px-4 py-3 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-sm focus:outline-none focus:border-(--secondary-color)">
                                <input type="text" name="specifications[{{ $i }}][value]"
                                    value="{{ $spec['value'] ?? '' }}"
                                    placeholder="e.g. 100% Wool"
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

            <!-- Variants -->
            <div class="bg-(--card-bg) rounded-3xl shadow-sm hover:shadow-md border border-(--text-color)/20 p-6 lg:p-8">
                <h2 class="text-xl font-semibold mb-6 flex items-center gap-2">
                    <i data-lucide="layers" class="w-6 h-6 text-(--primary-color)"></i>
                    Variants
                </h2>
                <p class="text-sm text-(--text-color)/70 mb-4">Add variants like Size, Color, etc.</p>

                <div id="variants" class="space-y-4">
                    {{-- Repopulate variants on validation failure --}}
                    @if(old('variants'))
                        @foreach(old('variants') as $i => $variant)
                            <div class="variant-row border border-(--text-color)/10 rounded-2xl p-4 bg-(--card-dark)/40">
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-3 mb-3">
                                    <input type="text" name="variants[{{ $i }}][sku]"
                                        value="{{ $variant['sku'] ?? '' }}"
                                        placeholder="SKU *"
                                        class="px-4 py-3 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-sm focus:outline-none focus:border-(--secondary-color)">
                                    <input type="text" name="variants[{{ $i }}][size]"
                                        value="{{ $variant['size'] ?? '' }}"
                                        placeholder="Size (e.g. M, L, XL)"
                                        class="px-4 py-3 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-sm focus:outline-none focus:border-(--secondary-color)">
                                    <input type="text" name="variants[{{ $i }}][color]"
                                        value="{{ $variant['color'] ?? '' }}"
                                        placeholder="Color"
                                        class="px-4 py-3 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-sm focus:outline-none focus:border-(--secondary-color)">
                                    <input type="number" name="variants[{{ $i }}][price]"
                                        value="{{ $variant['price'] ?? '' }}"
                                        placeholder="Price override (Rs.)" min="0" step="1"
                                        class="px-4 py-3 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-sm focus:outline-none focus:border-(--secondary-color)">
                                    <input type="number" name="variants[{{ $i }}][stock]"
                                        value="{{ $variant['stock'] ?? 0 }}"
                                        placeholder="Stock" min="0"
                                        class="px-4 py-3 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-sm focus:outline-none focus:border-(--secondary-color)">
                                </div>
                                <button type="button" onclick="this.closest('.variant-row').remove()"
                                    class="text-sm text-red-400 hover:text-red-600 flex items-center gap-1">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i> Remove variant
                                </button>
                            </div>
                        @endforeach
                    @endif
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
            <div class="bg-(--card-bg) rounded-3xl shadow-sm hover:shadow-md border border-(--text-color)/20 p-6 lg:p-8">
                <h2 class="text-xl font-semibold mb-6 flex items-center gap-2">
                    <i data-lucide="image" class="w-6 h-6 text-(--primary-color)"></i>
                    Product Media
                </h2>

                <div id="uploadArea"
                    class="border-2 border-dashed border-(--text-color)/40 rounded-3xl p-8 text-center mb-6 hover:border-(--secondary-color) transition cursor-pointer"
                    onclick="document.getElementById('mediaInput').click()">
                    <div class="w-12 h-12 mx-auto mb-3 flex items-center justify-center bg-(--card-dark) rounded-full">
                        <i data-lucide="upload-cloud" class="w-6 h-6 text-(--text-color)"></i>
                    </div>
                    <p class="font-medium">Click to upload or drag and drop</p>
                    <p class="text-sm text-(--text-color)/70 mt-1">PNG, JPG up to 10MB (Max 4 images)</p>
                    <input type="file" id="mediaInput" name="images[]" multiple accept="image/*" class="hidden"
                        onchange="previewImages(event)">
                </div>

                <div id="previewGrid" class="grid grid-cols-4 gap-2"></div>
                @error('images.*')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Pricing & Inventory -->
            <div class="bg-(--card-bg) rounded-3xl shadow-sm hover:shadow-md border border-(--text-color)/20 p-6 lg:p-8">
                <h2 class="text-xl font-semibold mb-6 flex items-center gap-2">
                    <i data-lucide="dollar-sign" class="w-6 h-6 text-(--primary-color)"></i>
                    Pricing & Inventory
                </h2>

                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-medium text-(--text-dark) mb-2">
                            Base Price (Rs.) <span class="text-(--secondary-color)">*</span>
                        </label>
                        <input type="number" id="base_price" name="base_price"
                            value="{{ old('base_price', 0) }}" step="1" min="0" required
                            class="w-full px-5 py-4 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-base focus:outline-none focus:border-(--secondary-color) transition duration-200">
                        @error('base_price')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-(--text-dark) mb-2">Discount Price</label>
                            <input type="number" id="discounted_price" name="discounted_price"
                                value="{{ old('discounted_price', 0) }}" step="1" min="0"
                                class="w-full px-5 py-4 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-base focus:outline-none focus:border-(--secondary-color) transition duration-200">
                            @error('discounted_price')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-(--text-dark) mb-2">
                                SKU <span class="text-(--secondary-color)">*</span>
                            </label>
                            <input type="text" id="sku" name="sku"
                                value="{{ old('sku') }}"
                                placeholder="e.g. HK-001" required
                                class="w-full px-3 py-4 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-base focus:outline-none focus:border-(--secondary-color) transition duration-200">
                            @error('sku')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-(--text-dark) mb-2">
                            Stock Quantity <span class="text-(--secondary-color)">*</span>
                        </label>
                        <input type="number" id="stock" name="stock"
                            value="{{ old('stock', 0) }}" min="0" required
                            class="w-full px-5 py-4 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-base focus:outline-none focus:border-(--secondary-color) transition duration-200">
                        @error('stock')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Actions -->
        <div class="lg:col-span-12 flex flex-row sm:justify-between sm:items-center gap-4 mt-10">
            <a href="{{ route('product-management') }}"
                class="inline-flex items-center gap-2 px-6 py-3.5 border border-(--secondary-color) hover:bg-(--card-bg) bg-(--text-light)/70 rounded-2xl font-medium w-fit sm:w-auto">
                Cancel
            </a>
            <button type="submit"
                class="inline-flex items-center gap-2 px-8 py-3.5 bg-(--secondary-color)/95 hover:bg-(--secondary-color) text-(--text-light) rounded-2xl font-semibold transition w-fit sm:w-auto">
                Save & Continue
                <i data-lucide="arrow-right" class="w-5 h-5"></i>
            </button>
        </div>
    </form>

    <script>
        // ── Character counter ──────────────────────────────────────────────────
        const descriptionEl = document.getElementById('description');
        const charCountEl   = document.getElementById('charCount');

        function updateCharCount() {
            charCountEl.textContent = descriptionEl.value.length + '/2000';
        }
        descriptionEl.addEventListener('input', updateCharCount);
        updateCharCount(); // run on load (for old() repopulation)

        // ── Specifications ─────────────────────────────────────────────────────
        let specIndex = {{ old('specifications') ? count(old('specifications')) : 0 }};

        function addSpecification() {
            const container = document.getElementById('specifications');
            const row = document.createElement('div');
            row.className = 'flex gap-3 items-center spec-row';
            row.innerHTML = `
                <input type="text" name="specifications[${specIndex}][key]"
                    placeholder="e.g. Material"
                    class="flex-1 px-4 py-3 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-sm focus:outline-none focus:border-(--secondary-color)">
                <input type="text" name="specifications[${specIndex}][value]"
                    placeholder="e.g. 100% Wool"
                    class="flex-1 px-4 py-3 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-sm focus:outline-none focus:border-(--secondary-color)">
                <button type="button" onclick="this.closest('.spec-row').remove()"
                    class="p-2 text-red-400 hover:text-red-600 transition">
                    <i data-lucide="trash-2" class="w-5 h-5"></i>
                </button>
            `;
            container.appendChild(row);
            specIndex++;
            lucide.createIcons(); // re-render lucide icons in new row
        }

        // ── Variants ───────────────────────────────────────────────────────────
        let variantIndex = {{ old('variants') ? count(old('variants')) : 0 }};

        function addVariant() {
            const container = document.getElementById('variants');
            const row = document.createElement('div');
            row.className = 'variant-row border border-(--text-color)/10 rounded-2xl p-4 bg-(--card-dark)/40';
            row.innerHTML = `
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3 mb-3">
                    <input type="text" name="variants[${variantIndex}][sku]"
                        placeholder="SKU *"
                        class="px-4 py-3 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-sm focus:outline-none focus:border-(--secondary-color)">
                    <input type="text" name="variants[${variantIndex}][size]"
                        placeholder="Size (e.g. M, L, XL)"
                        class="px-4 py-3 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-sm focus:outline-none focus:border-(--secondary-color)">
                    <input type="text" name="variants[${variantIndex}][color]"
                        placeholder="Color"
                        class="px-4 py-3 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-sm focus:outline-none focus:border-(--secondary-color)">
                    <input type="number" name="variants[${variantIndex}][price]"
                        placeholder="Price override (Rs.)" min="0" step="1"
                        class="px-4 py-3 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-sm focus:outline-none focus:border-(--secondary-color)">
                    <input type="number" name="variants[${variantIndex}][stock]"
                        placeholder="Stock" min="0" value="0"
                        class="px-4 py-3 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-sm focus:outline-none focus:border-(--secondary-color)">
                </div>
                <button type="button" onclick="this.closest('.variant-row').remove()"
                    class="text-sm text-red-400 hover:text-red-600 flex items-center gap-1">
                    <i data-lucide="trash-2" class="w-4 h-4"></i> Remove variant
                </button>
            `;
            container.appendChild(row);
            variantIndex++;
            lucide.createIcons();
        }

        // ── Image preview ──────────────────────────────────────────────────────
        function previewImages(event) {
            const files   = Array.from(event.target.files).slice(0, 4);
            const grid    = document.getElementById('previewGrid');
            grid.innerHTML = '';

            files.forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const wrapper = document.createElement('div');
                    wrapper.className = 'relative';
                    wrapper.innerHTML = `
                        <img src="${e.target.result}"
                             class="w-full aspect-square object-cover rounded-xl border border-(--text-color)/20"
                             alt="Preview ${index + 1}">
                        ${index === 0 ? '<span class="absolute bottom-1 left-1 text-xs bg-black/60 text-white px-1.5 py-0.5 rounded">Main</span>' : ''}
                    `;
                    grid.appendChild(wrapper);
                };
                reader.readAsDataURL(file);
            });
        }

        // Drag-and-drop support on the upload area
        const uploadArea = document.getElementById('uploadArea');
        uploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadArea.classList.add('border-(--secondary-color)');
        });
        uploadArea.addEventListener('dragleave', () => {
            uploadArea.classList.remove('border-(--secondary-color)');
        });
        uploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadArea.classList.remove('border-(--secondary-color)');
            const input = document.getElementById('mediaInput');
            input.files = e.dataTransfer.files;
            previewImages({ target: input });
        });
    </script>

</x-seller_layout>