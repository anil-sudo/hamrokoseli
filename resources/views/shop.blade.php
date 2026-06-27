<x-frontend-layout>
    
    <style>
        /* Hide browser number-input spinner arrows */
        .qty-val-input::-webkit-outer-spin-button,
        .qty-val-input::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }
        .qty-val-input { -moz-appearance: textfield; }
    </style>
    <div class="bg-[#F4EAE1] text-[#3A2A1F] min-h-screen py-8 sm:py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">

            {{-- ==================== MAIN LAYOUT ==================== --}}
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-start">

                {{-- ===== LEFT SIDEBAR ===== --}}
                <aside class="md:col-span-4 lg:col-span-3">
                    <div class="bg-[#FFF7EF] rounded-3xl p-6 border border-[#ebd7be]/50 shadow-sm">

                        {{-- Header --}}
                        <div class="flex items-center justify-between pb-4 border-b border-[#ebd7be]/60 mb-5">
                            <button id="filter-mobile-toggle" type="button" class="flex items-center gap-2 text-left focus:outline-none flex-grow md:pointer-events-none">
                                <h2 class="text-xl font-bold text-[#C65A3A]">Filters</h2>
                                <i id="filter-toggle-icon" class="fas fa-chevron-down text-[#C65A3A] transition-transform duration-300 md:hidden"></i>
                            </button>
                            <button id="reset-filters" type="button"
                                class="text-xs font-bold text-[#C65A3A] hover:text-[#b04a2c] flex items-center gap-1.5 transition-colors shrink-0">
                                <i class="fas fa-rotate-right text-[10px]"></i> Reset
                            </button>
                        </div>

                        <div id="filter-body" class="hidden md:block mt-5 space-y-5">
                            {{-- Collections --}}
                            <div class="mb-5">
                                <button class="w-full flex items-center justify-between text-left focus:outline-none py-1">
                                    <span
                                        class="text-xs font-bold uppercase tracking-wider text-[#1F3D2E]">Collections</span>
                                    <i class="fas fa-minus text-[10px] text-[#C65A3A]"></i>
                                </button>
                                <div class="flex flex-wrap gap-2 mt-3" id="collections-container">
                                    <button type="button"
                                        class="collection-pill px-4 py-1.5 bg-[#C65A3A] text-white text-xs font-semibold rounded-full border border-[#C65A3A] hover:bg-[#b04a2c] transition-all shadow-sm cursor-pointer">All</button>
                                    <button type="button"
                                        class="collection-pill px-4 py-1.5 bg-transparent text-[#1F3D2E] text-xs font-semibold rounded-full border border-[#C65A3A] hover:bg-[#C65A3A]/10 transition-all cursor-pointer">Best
                                        sellers</button>
                                    <button type="button"
                                        class="collection-pill px-4 py-1.5 bg-transparent text-[#1F3D2E] text-xs font-semibold rounded-full border border-[#C65A3A] hover:bg-[#C65A3A]/10 transition-all cursor-pointer">New
                                        arrivals</button>
                                    <button type="button"
                                        class="collection-pill px-4 py-1.5 bg-transparent text-[#1F3D2E] text-xs font-semibold rounded-full border border-[#C65A3A] hover:bg-[#C65A3A]/10 transition-all cursor-pointer">Festive</button>
                                </div>
                            </div>

                            {{-- Categories --}}
                            <div class="pt-5 border-t border-[#ebd7be]/40 mb-5">
                                <button class="w-full flex items-center justify-between text-left focus:outline-none py-1">
                                    <span
                                        class="text-xs font-bold uppercase tracking-wider text-[#1F3D2E]">Categories</span>
                                    <i class="fas fa-minus text-[10px] text-[#C65A3A]"></i>
                                </button>
                                <div class="mt-4 space-y-3">
                                    <label class="flex items-center justify-between cursor-pointer group">
                                        <span
                                            class="flex items-center gap-2.5 text-sm text-[#3A2A1F]/80 group-hover:text-[#3A2A1F] transition-colors">
                                            <input type="radio" name="category" value="all" checked
                                                class="category-radio w-4 h-4 border-[#ebd7be] accent-[#C65A3A] focus:ring-0 bg-[#FFF7EF]">
                                            All Categories
                                        </span>
                                    </label>
                                    <label class="flex items-center justify-between cursor-pointer group">
                                        <span
                                            class="flex items-center gap-2.5 text-sm text-[#3A2A1F]/80 group-hover:text-[#3A2A1F] transition-colors">
                                            <input type="radio" name="category" value="textiles"
                                                class="category-radio w-4 h-4 border-[#ebd7be] accent-[#C65A3A] focus:ring-0 bg-[#FFF7EF]">
                                            Clothing &amp; Textiles
                                        </span>
                                    </label>
                                    <label class="flex items-center justify-between cursor-pointer group">
                                        <span
                                            class="flex items-center gap-2.5 text-sm text-[#3A2A1F]/80 group-hover:text-[#3A2A1F] transition-colors">
                                            <input type="radio" name="category" value="woodcraft"
                                                class="category-radio w-4 h-4 border-[#ebd7be] accent-[#C65A3A] focus:ring-0 bg-[#FFF7EF]">
                                            Woodcraft
                                        </span>
                                    </label>
                                    <label class="flex items-center justify-between cursor-pointer group">
                                        <span
                                            class="flex items-center gap-2.5 text-sm text-[#3A2A1F]/80 group-hover:text-[#3A2A1F] transition-colors">
                                            <input type="radio" name="category" value="metalware"
                                                class="category-radio w-4 h-4 border-[#ebd7be] accent-[#C65A3A] focus:ring-0 bg-[#FFF7EF]">
                                            Metalware
                                        </span>
                                    </label>
                                    <label class="flex items-center justify-between cursor-pointer group">
                                        <span
                                            class="flex items-center gap-2.5 text-sm text-[#3A2A1F]/80 group-hover:text-[#3A2A1F] transition-colors">
                                            <input type="radio" name="category" value="pottery-ceramics"
                                                class="category-radio w-4 h-4 border-[#ebd7be] accent-[#C65A3A] focus:ring-0 bg-[#FFF7EF]">
                                            Pottery &amp; Ceramics
                                        </span>
                                    </label>
                                    <label class="flex items-center justify-between cursor-pointer group">
                                        <span
                                            class="flex items-center gap-2.5 text-sm text-[#3A2A1F]/80 group-hover:text-[#3A2A1F] transition-colors">
                                            <input type="radio" name="category" value="art-paint"
                                                class="category-radio w-4 h-4 border-[#ebd7be] accent-[#C65A3A] focus:ring-0 bg-[#FFF7EF]">
                                            Art &amp; Paint
                                        </span>
                                    </label>
                                    <label class="flex items-center justify-between cursor-pointer group">
                                        <span
                                            class="flex items-center gap-2.5 text-sm text-[#3A2A1F]/80 group-hover:text-[#3A2A1F] transition-colors">
                                            <input type="radio" name="category" value="pottery"
                                                class="category-radio w-4 h-4 border-[#ebd7be] accent-[#C65A3A] focus:ring-0 bg-[#FFF7EF]">
                                            Pottery
                                        </span>
                                    </label>
                                </div>
                            </div>

                            {{-- Price Range --}}
                            <div class="pt-5 border-t border-[#ebd7be]/40 mb-5">
                                <button class="w-full flex items-center justify-between text-left focus:outline-none py-1">
                                    <span class="text-xs font-bold uppercase tracking-wider text-[#1F3D2E]">Price
                                        Range</span>
                                    <i class="fas fa-minus text-[10px] text-[#C65A3A]"></i>
                                </button>
                                <div class="mt-4 px-1">
                                    {{-- Dual range slider --}}
                                    <div class="relative w-full h-1.5 mt-3 mb-6">
                                        <div class="absolute h-full w-full bg-[#ebd7be]/50 rounded-full"></div>
                                        <div id="slider-track-accent" class="absolute h-full bg-[#C65A3A] rounded-full"
                                            style="left:0%;right:0%;"></div>
                                        <input type="range" id="price-min" min="0" max="5000" value="0"
                                            class="range-slider-input">
                                        <input type="range" id="price-max" min="0" max="5000" value="5000"
                                            class="range-slider-input">
                                    </div>
                                    {{-- Min / Max inputs --}}
                                    <div
                                        class="flex items-center justify-between gap-2 text-xs font-semibold text-[#3A2A1F]/70">
                                        <div
                                            class="flex items-center bg-[#ebd7be]/20 rounded-xl border border-[#ebd7be]/60 px-3 py-2 w-[45%]">
                                            <span class="mr-1 text-[#3A2A1F]/60">Rs.</span>
                                            <input type="number" id="input-min" value="0" min="0" max="5000"
                                                class="w-full bg-transparent border-none p-0 text-[#1F3D2E] font-bold focus:outline-none [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                                        </div>
                                        <span class="text-[#3A2A1F]/50 font-bold">TO</span>
                                        <div
                                            class="flex items-center bg-[#ebd7be]/20 rounded-xl border border-[#ebd7be]/60 px-3 py-2 w-[45%]">
                                            <span class="mr-1 text-[#3A2A1F]/60">Rs.</span>
                                            <input type="number" id="input-max" value="5000" min="0" max="5000"
                                                class="w-full bg-transparent border-none p-0 text-[#1F3D2E] font-bold focus:outline-none [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Region (collapsed) --}}
                            <div class="pt-5 border-t border-[#ebd7be]/40 mb-5">
                                <button class="w-full flex items-center justify-between text-left focus:outline-none py-1">
                                    <span class="text-xs font-bold uppercase tracking-wider text-[#1F3D2E]">Region</span>
                                    <i class="fas fa-plus text-[10px] text-[#C65A3A]"></i>
                                </button>
                            </div>

                            {{-- Availability --}}
                            <div class="pt-5 border-t border-[#ebd7be]/40">
                                <button class="w-full flex items-center justify-between text-left focus:outline-none py-1">
                                    <span
                                        class="text-xs font-bold uppercase tracking-wider text-[#1F3D2E]">Availability</span>
                                    <i class="fas fa-minus text-[10px] text-[#C65A3A]"></i>
                                </button>
                                <div class="mt-4 flex items-center gap-3">
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" class="sr-only peer">
                                        <div
                                            class="w-9 h-5 bg-[#ebd7be] rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#C65A3A]">
                                        </div>
                                    </label>
                                    <span class="text-sm font-semibold text-[#3A2A1F]/80">In Stock Only</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </aside>
                {{-- END LEFT SIDEBAR --}}

                {{-- ===== RIGHT: PRODUCT GRID ===== --}}
                <main class="md:col-span-8 lg:col-span-9">

                    {{-- ==================== PAGE HEADER ==================== --}}
                    <div class="mb-6 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
                        <div>
                            <h1 class="text-3xl md:text-4xl font-bold text-[#1F3D2E] tracking-tight">Shop
                                Authentic Crafts</h1>
                            <p class="text-[#3A2A1F]/70 text-sm mt-1">Discover hand-crafted pieces from Nepal's finest
                                master craftspeople.</p>
                        </div>
                        <div class="flex items-center gap-2 self-start sm:self-auto">
                            <span class="text-xs font-semibold uppercase tracking-wider text-[#3A2A1F]/60">Sort
                                by:</span>
                            <div class="relative inline-block">
                                <select id="sort-select"
                                    class="appearance-none bg-[#FFF7EF] border border-[#ebd7be] rounded-full px-5 py-2.5 pr-10 text-sm font-semibold focus:outline-none focus:ring-2 focus:ring-[#1F3D2E]/25 text-[#1F3D2E] cursor-pointer shadow-sm">
                                    <option>Newest First</option>
                                    <option>Price: Low to High</option>
                                    <option>Price: High to Low</option>
                                    <option>Popularity</option>
                                </select>
                                <div
                                    class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-[#1F3D2E]/70">
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

    @forelse($products as $product)
        <div
            data-category="{{ strtolower($product->category?->name ?? 'uncategorized') }}"
            class="product-card bg-white rounded-3xl overflow-hidden border border-[#ebd7be]/40 shadow-sm hover:shadow-md transition duration-300 flex flex-col group">

            <div class="relative w-full aspect-[4/5] overflow-hidden rounded-t-3xl">

                <img
                    src="{{ $product->primaryImageUrl() }}"
                    alt="{{ $product->name }}"
                    class="w-full h-full object-cover group-hover:scale-105 transition duration-500">

                @if($product->vendor)
                    <div class="absolute top-4 right-4 bg-white/95 text-[#1F3D2E] text-[10px] font-bold tracking-wider uppercase px-3 py-1.5 rounded-full shadow-sm">
                        {{ $product->vendor->business_name ?? $product->vendor->name }}
                    </div>
                @endif

                <button
                    class="wishlist-btn absolute bottom-4 right-4 text-[#C65A3A] hover:text-[#b04a2c] transition-colors text-xl drop-shadow"
                    data-product-id="{{ $product->id }}"
                    data-product-name="{{ $product->name }}"
                    data-product-price="{{ $product->effectivePrice() }}"
                    data-product-image="{{ $product->primaryImageUrl() }}"
                    data-product-desc="{{ $product->description }}"
                    data-product-category="{{ $product->category?->name }}">
                    <i class="far fa-heart"></i>
                </button>

            </div>

            <div class="p-5 flex-grow flex flex-col justify-between">

                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-[#3A2A1F]/50 block mb-1">
                        {{ $product->category?->name ?? 'General' }}
                    </span>

                    <h3 class="text-lg font-bold text-[#1F3D2E] mb-2 leading-tight group-hover:text-[#C65A3A] transition-colors line-clamp-1">
                        {{ $product->name }}
                    </h3>

                    <span class="text-[#C65A3A] font-bold text-base block mb-4">
                        Rs {{ number_format($product->effectivePrice(), 2) }}
                    </span>
                </div>

                    <a href="{{ route('viewdetails', $product->id) }}"
                       class="view-details-btn w-full flex items-center justify-center gap-2 bg-[#C65A3A] hover:bg-[#b04a2c] text-white text-sm font-semibold py-3 px-4 rounded-xl shadow-sm hover:shadow transition duration-300"
                       data-id="{{ $product->id }}"
                       data-name="{{ $product->name }}"
                       data-price="{{ $product->effectivePrice() }}"
                       data-original-price="{{ $product->originalPrice() }}"
                       data-discount="{{ $product->hasDiscount() ? 'true' : 'false' }}"
                       data-discount-price="{{ $product->resolvedDiscountPrice() ?? '' }}"
                       data-image="{{ $product->primaryImageUrl() }}"
                       data-category="{{ $product->category?->name ?? 'Crafts' }}"
                       data-vendor="{{ $product->vendor->business_name ?? $product->vendor->name ?? 'Local Artisan' }}"
                       data-desc="{{ $product->description }}"
                       data-rating="{{ $product->rating ?? 5 }}"
                       data-reviews="{{ $product->reviews_count ?? 24 }}"
                       data-stock="{{ $product->stock ?? 10 }}">
                        <i class="fa-solid fa-circle-plus text-xs"></i>
                        View Details
                    </a>

            </div>
        </div>
    @empty
        <div class="col-span-3 text-center py-12">
            No products found.
        </div>
    @endforelse

</div>

                    {{-- ==================== PAGINATION ==================== --}}
                    <div class="flex items-center justify-center gap-3 mt-12 pb-6">
                        <a href="#"
                            class="w-10 h-10 rounded-full border border-[#1F3D2E]/20 flex items-center justify-center text-[#1F3D2E] hover:border-[#1F3D2E] hover:bg-[#1F3D2E]/5 transition duration-300 shadow-sm">
                            <i class="fas fa-chevron-left text-xs"></i>
                        </a>
                        <div class="flex items-center gap-1">
                            <a href="#"
                                class="w-10 h-10 flex flex-col items-center justify-center text-sm font-bold text-[#1F3D2E] relative">
                                <span>1</span>
                                <span class="absolute bottom-1 w-5 h-0.5 bg-[#1F3D2E] rounded-full"></span>
                            </a>
                            <a href="#"
                                class="w-10 h-10 flex items-center justify-center text-sm font-semibold text-[#3A2A1F]/60 hover:text-[#1F3D2E] transition-colors">2</a>
                            <a href="#"
                                class="w-10 h-10 flex items-center justify-center text-sm font-semibold text-[#3A2A1F]/60 hover:text-[#1F3D2E] transition-colors">3</a>
                            <span class="text-sm font-semibold text-[#3A2A1F]/40 px-2 select-none">...</span>
                            <a href="#"
                                class="w-10 h-10 flex items-center justify-center text-sm font-semibold text-[#3A2A1F]/60 hover:text-[#1F3D2E] transition-colors">12</a>
                        </div>
                        <a href="#"
                            class="w-10 h-10 rounded-full border border-[#1F3D2E]/20 flex items-center justify-center text-[#1F3D2E] hover:border-[#1F3D2E] hover:bg-[#1F3D2E]/5 transition duration-300 shadow-sm">
                            <i class="fas fa-chevron-right text-xs"></i>
                        </a>
                    </div>

                </main>
                {{-- END RIGHT PRODUCT GRID --}}

            </div>{{-- end main layout grid --}}
        </div>
    </div>

    {{-- ==================== RANGE SLIDER & COLLECTION PILLS JS ==================== --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Mobile filters toggle
            const filterToggle = document.getElementById('filter-mobile-toggle');
            const filterBody = document.getElementById('filter-body');
            const filterToggleIcon = document.getElementById('filter-toggle-icon');

            if (filterToggle && filterBody) {
                filterToggle.addEventListener('click', function () {
                    const isHidden = filterBody.classList.contains('hidden');
                    if (isHidden) {
                        filterBody.classList.remove('hidden');
                        if (filterToggleIcon) {
                            filterToggleIcon.classList.remove('fa-chevron-down');
                            filterToggleIcon.classList.add('fa-chevron-up');
                        }
                    } else {
                        filterBody.classList.add('hidden');
                        if (filterToggleIcon) {
                            filterToggleIcon.classList.remove('fa-chevron-up');
                            filterToggleIcon.classList.add('fa-chevron-down');
                        }
                    }
                });
            }

            // Accordion toggles for filter subsections
            const subsectionButtons = document.querySelectorAll('#filter-body > div > button');
            subsectionButtons.forEach(btn => {
                btn.addEventListener('click', function () {
                    const content = btn.nextElementSibling;
                    if (!content) return;

                    const icon = btn.querySelector('i.fas');
                    const isCollapsed = content.classList.contains('hidden');

                    if (isCollapsed) {
                        content.classList.remove('hidden');
                        if (icon) {
                            icon.classList.remove('fa-plus');
                            icon.classList.add('fa-minus');
                        }
                    } else {
                        content.classList.add('hidden');
                        if (icon) {
                            icon.classList.remove('fa-minus');
                            icon.classList.add('fa-plus');
                        }
                    }
                });
            });

            // Price range slider selectors
            const minSlider = document.getElementById('price-min');
            const maxSlider = document.getElementById('price-max');
            const minInput = document.getElementById('input-min');
            const maxInput = document.getElementById('input-max');
            const trackAccent = document.getElementById('slider-track-accent');
            const MIN_GAP = 100;

            function updateTrack(minVal, maxVal) {
                const minPct = (minVal / parseInt(minSlider.max)) * 100;
                const maxPct = 100 - (maxVal / parseInt(maxSlider.max)) * 100;
                trackAccent.style.left = minPct + '%';
                trackAccent.style.right = maxPct + '%';
            }

            function onSliderChange() {
                let minVal = parseInt(minSlider.value);
                let maxVal = parseInt(maxSlider.value);
                if (maxVal - minVal < MIN_GAP) {
                    if (document.activeElement === minSlider) {
                        minVal = maxVal - MIN_GAP;
                        minSlider.value = minVal;
                    } else {
                        maxVal = minVal + MIN_GAP;
                        maxSlider.value = maxVal;
                    }
                }
                minInput.value = minVal;
                maxInput.value = maxVal;
                updateTrack(minVal, maxVal);
            }

            function onInputChange() {
                let minVal = Math.max(0, parseInt(minInput.value) || 0);
                let maxVal = Math.min(5000, parseInt(maxInput.value) || 5000);
                if (maxVal - minVal < MIN_GAP) {
                    if (document.activeElement === minInput) {
                        minVal = Math.max(0, maxVal - MIN_GAP);
                    } else {
                        maxVal = Math.min(5000, minVal + MIN_GAP);
                    }
                }
                minSlider.value = minVal;
                maxSlider.value = maxVal;
                minInput.value = minVal;
                maxInput.value = maxVal;
                updateTrack(minVal, maxVal);
            }

            minSlider.addEventListener('input', onSliderChange);
            maxSlider.addEventListener('input', onSliderChange);
            minInput.addEventListener('change', onInputChange);
            maxInput.addEventListener('change', onInputChange);

            // Initialise slider accent
            updateTrack(parseInt(minSlider.value), parseInt(maxSlider.value));

            // Collection Pills Selectable Logic
            const pills = document.querySelectorAll('.collection-pill');
            pills.forEach(pill => {
                pill.addEventListener('click', () => {
                    pills.forEach(p => {
                        p.classList.remove('bg-[#C65A3A]', 'text-white', 'shadow-sm', 'hover:bg-[#b04a2c]');
                        p.classList.add('bg-transparent', 'text-[#1F3D2E]', 'hover:bg-[#C65A3A]/10');
                    });
                    pill.classList.remove('bg-transparent', 'text-[#1F3D2E]', 'hover:bg-[#C65A3A]/10');
                    pill.classList.add('bg-[#C65A3A]', 'text-white', 'shadow-sm', 'hover:bg-[#b04a2c]');
                });
            });

            // Category Filtering Logic
            const productCards = document.querySelectorAll('.product-card');
            const categoryRadios = document.querySelectorAll('.category-radio');

            function applyCategoryFilter() {
                const checkedRadio = document.querySelector('.category-radio:checked');
                const categoryValue = checkedRadio ? checkedRadio.value : 'all';

                productCards.forEach(card => {
                    const cardCategory = card.getAttribute('data-category');
                    if (categoryValue === 'all' || cardCategory === categoryValue) {
                        card.style.display = '';
                    } else {
                        card.style.display = 'none';
                    }
                });
            }

            categoryRadios.forEach(radio => {
                radio.addEventListener('change', applyCategoryFilter);
            });

            // Parse URL parameters on page load
            const urlParams = new URLSearchParams(window.location.search);
            const categoryParam = urlParams.get('category');
            if (categoryParam) {
                const radioToSelect = document.querySelector(`.category-radio[value="${categoryParam}"]`);
                if (radioToSelect) {
                    radioToSelect.checked = true;
                }
            }
            applyCategoryFilter();

            // Reset Button Logic
            document.getElementById('reset-filters').addEventListener('click', function () {
                // Reset collection pills — activate "All", deactivate others
                pills.forEach((p, i) => {
                    if (i === 0) {
                        p.classList.remove('bg-transparent', 'text-[#1F3D2E]', 'hover:bg-[#C65A3A]/10');
                        p.classList.add('bg-[#C65A3A]', 'text-white', 'shadow-sm', 'hover:bg-[#b04a2c]');
                    } else {
                        p.classList.remove('bg-[#C65A3A]', 'text-white', 'shadow-sm', 'hover:bg-[#b04a2c]');
                        p.classList.add('bg-transparent', 'text-[#1F3D2E]', 'hover:bg-[#C65A3A]/10');
                    }
                });

                // Reset category radio buttons
                const allRadio = document.querySelector('.category-radio[value="all"]');
                if (allRadio) {
                    allRadio.checked = true;
                }
                applyCategoryFilter();

                // Reset all checkboxes in the sidebar
                document.querySelectorAll('aside input[type="checkbox"]').forEach(cb => {
                    cb.checked = false;
                });

                // Reset price range slider to 0 – 5000
                minSlider.value = 0;
                maxSlider.value = 5000;
                minInput.value = 0;
                maxInput.value = 5000;
                updateTrack(0, 5000);
            });
        });
    </script>
</x-frontend-layout>