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

                        {{-- Card 1: Copper Singing Bowl --}}
                        <div data-category="metalware"
                            class="product-card bg-white rounded-3xl overflow-hidden border border-[#ebd7be]/40 shadow-sm hover:shadow-md transition duration-300 flex flex-col group">
                            <div class="relative w-full aspect-[4/5] overflow-hidden rounded-t-3xl">
                                <img src="{{ asset('images/1st-image.png') }}" alt="Copper Singing Bowl"
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                <div
                                    class="absolute top-4 right-4 bg-white/95 text-[#1F3D2E] text-[10px] font-bold tracking-wider uppercase px-3 py-1.5 rounded-full shadow-sm">
                                    Terai Plains</div>
                                <button
                                    class="absolute bottom-4 right-4 text-[#C65A3A] hover:text-[#b04a2c] transition-colors text-xl drop-shadow"><i
                                        class="far fa-heart"></i></button>
                            </div>
                            <div class="p-5 flex-grow flex flex-col justify-between">
                                <div>
                                    <span
                                        class="text-[10px] font-bold uppercase tracking-wider text-[#3A2A1F]/50 block mb-1">Metalwork</span>
                                    <h3
                                        class="text-lg font-bold text-[#1F3D2E] mb-2 leading-tight group-hover:text-[#C65A3A] transition-colors line-clamp-1">
                                        Copper Singing Bowl</h3>
                                    <span class="text-[#C65A3A] font-bold text-base block mb-4">Rs 4,500</span>
                                </div>
                                <a href="#"
                                    class="w-full flex items-center justify-center gap-2 bg-[#C65A3A] hover:bg-[#b04a2c] text-white text-sm font-semibold py-3 px-4 rounded-xl shadow-sm hover:shadow transition duration-300">
                                    <i class="fa-solid fa-circle-plus text-xs"></i> View Details
                                </a>
                            </div>
                        </div>

                        {{-- Card 2: Thimi Crackle Bowl --}}
                        <div data-category="pottery"
                            class="product-card bg-white rounded-3xl overflow-hidden border border-[#ebd7be]/40 shadow-sm hover:shadow-md transition duration-300 flex flex-col group">
                            <div class="relative w-full aspect-[4/5] overflow-hidden rounded-t-3xl">
                                <img src="{{ asset('images/2nd-image.png') }}" alt="Thimi Crackle Bowl"
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                <button
                                    class="absolute bottom-4 right-4 text-[#C65A3A] hover:text-[#b04a2c] transition-colors text-xl drop-shadow"><i
                                        class="far fa-heart"></i></button>
                            </div>
                            <div class="p-5 flex-grow flex flex-col justify-between">
                                <div>
                                    <span
                                        class="text-[10px] font-bold uppercase tracking-wider text-[#3A2A1F]/50 block mb-1">Ceramics</span>
                                    <h3
                                        class="text-lg font-bold text-[#1F3D2E] mb-2 leading-tight group-hover:text-[#C65A3A] transition-colors line-clamp-1">
                                        Thimi Crackle Bowl</h3>
                                    <span class="text-[#C65A3A] font-bold text-base block mb-4">Rs 3,500</span>
                                </div>
                                <a href="#"
                                    class="w-full flex items-center justify-center gap-2 bg-[#C65A3A] hover:bg-[#b04a2c] text-white text-sm font-semibold py-3 px-4 rounded-xl shadow-sm hover:shadow transition duration-300">
                                    <i class="fa-solid fa-circle-plus text-xs"></i> View Details
                                </a>
                            </div>
                        </div>

                        {{-- Card 3: Patan Floral Lattice --}}
                        <div data-category="woodcraft"
                            class="product-card bg-white rounded-3xl overflow-hidden border border-[#ebd7be]/40 shadow-sm hover:shadow-md transition duration-300 flex flex-col group">
                            <div class="relative w-full aspect-[4/5] overflow-hidden rounded-t-3xl">
                                <img src="{{ asset('images/Table.png') }}" alt="Patan Floral Lattice"
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                <button
                                    class="absolute bottom-4 right-4 text-[#C65A3A] hover:text-[#b04a2c] transition-colors text-xl drop-shadow"><i
                                        class="far fa-heart"></i></button>
                            </div>
                            <div class="p-5 flex-grow flex flex-col justify-between">
                                <div>
                                    <span
                                        class="text-[10px] font-bold uppercase tracking-wider text-[#3A2A1F]/50 block mb-1">Woodwork</span>
                                    <h3
                                        class="text-lg font-bold text-[#1F3D2E] mb-2 leading-tight group-hover:text-[#C65A3A] transition-colors line-clamp-1">
                                        Patan Floral Lattice</h3>
                                    <span class="text-[#C65A3A] font-bold text-base block mb-4">Rs 2,500</span>
                                </div>
                                <a href="#"
                                    class="w-full flex items-center justify-center gap-2 bg-[#C65A3A] hover:bg-[#b04a2c] text-white text-sm font-semibold py-3 px-4 rounded-xl shadow-sm hover:shadow transition duration-300">
                                    <i class="fa-solid fa-circle-plus text-xs"></i> View Details
                                </a>
                            </div>
                        </div>

                        {{-- Card 4: Hand-Woven Dhankuta Dhaka --}}
                        <div data-category="textiles"
                            class="product-card bg-white rounded-3xl overflow-hidden border border-[#ebd7be]/40 shadow-sm hover:shadow-md transition duration-300 flex flex-col group">
                            <div class="relative w-full aspect-[4/5] overflow-hidden rounded-t-3xl">
                                <img src="{{ asset('images/4th-image.png') }}" alt="Hand-Woven Dhankuta Dhaka"
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                <button
                                    class="absolute bottom-4 right-4 text-[#C65A3A] hover:text-[#b04a2c] transition-colors text-xl drop-shadow"><i
                                        class="far fa-heart"></i></button>
                            </div>
                            <div class="p-5 flex-grow flex flex-col justify-between">
                                <div>
                                    <span
                                        class="text-[10px] font-bold uppercase tracking-wider text-[#3A2A1F]/50 block mb-1">Textiles</span>
                                    <h3
                                        class="text-lg font-bold text-[#1F3D2E] mb-2 leading-tight group-hover:text-[#C65A3A] transition-colors line-clamp-1">
                                        Hand-Woven Dhankuta Dhaka</h3>
                                    <span class="text-[#C65A3A] font-bold text-base block mb-4">Rs 2,500</span>
                                </div>
                                <a href="#"
                                    class="w-full flex items-center justify-center gap-2 bg-[#C65A3A] hover:bg-[#b04a2c] text-white text-sm font-semibold py-3 px-4 rounded-xl shadow-sm hover:shadow transition duration-300">
                                    <i class="fa-solid fa-circle-plus text-xs"></i> View Details
                                </a>
                            </div>
                        </div>

                        {{-- Card 5: Himalayan Lokta Journal --}}
                        <div data-category="pottery-ceramics"
                            class="product-card bg-white rounded-3xl overflow-hidden border border-[#ebd7be]/40 shadow-sm hover:shadow-md transition duration-300 flex flex-col group">
                            <div class="relative w-full aspect-[4/5] overflow-hidden rounded-t-3xl">
                                <img src="{{ asset('images/aboutus.jpg') }}" alt="Himalayan Lokta Journal"
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                <div
                                    class="absolute top-4 right-4 bg-white/95 text-[#1F3D2E] text-[10px] font-bold tracking-wider uppercase px-3 py-1.5 rounded-full shadow-sm">
                                    Mustang</div>
                                <button
                                    class="absolute bottom-4 right-4 text-[#C65A3A] hover:text-[#b04a2c] transition-colors text-xl drop-shadow"><i
                                        class="far fa-heart"></i></button>
                            </div>
                            <div class="p-5 flex-grow flex flex-col justify-between">
                                <div>
                                    <span
                                        class="text-[10px] font-bold uppercase tracking-wider text-[#3A2A1F]/50 block mb-1">Paper</span>
                                    <h3
                                        class="text-lg font-bold text-[#1F3D2E] mb-2 leading-tight group-hover:text-[#C65A3A] transition-colors line-clamp-1">
                                        Himalayan Lokta Journal</h3>
                                    <span class="text-[#C65A3A] font-bold text-base block mb-4">Rs 1,500</span>
                                </div>
                                <a href="#"
                                    class="w-full flex items-center justify-center gap-2 bg-[#C65A3A] hover:bg-[#b04a2c] text-white text-sm font-semibold py-3 px-4 rounded-xl shadow-sm hover:shadow transition duration-300">
                                    <i class="fa-solid fa-circle-plus text-xs"></i> View Details
                                </a>
                            </div>
                        </div>

                        {{-- Card 6: Silver Filigree Pendant --}}
                        <div data-category="metalware"
                            class="product-card bg-white rounded-3xl overflow-hidden border border-[#ebd7be]/40 shadow-sm hover:shadow-md transition duration-300 flex flex-col group">
                            <div class="relative w-full aspect-[4/5] overflow-hidden rounded-t-3xl">
                                <img src="{{ asset('images/Jewlery and Accessory.png') }}" alt="Silver Filigree Pendant"
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                <div
                                    class="absolute top-4 right-4 bg-white/95 text-[#1F3D2E] text-[10px] font-bold tracking-wider uppercase px-3 py-1.5 rounded-full shadow-sm">
                                    Kathmandu Valley</div>
                                <button
                                    class="absolute bottom-4 right-4 text-[#C65A3A] hover:text-[#b04a2c] transition-colors text-xl drop-shadow"><i
                                        class="far fa-heart"></i></button>
                            </div>
                            <div class="p-5 flex-grow flex flex-col justify-between">
                                <div>
                                    <span
                                        class="text-[10px] font-bold uppercase tracking-wider text-[#3A2A1F]/50 block mb-1">Jewelry</span>
                                    <h3
                                        class="text-lg font-bold text-[#1F3D2E] mb-2 leading-tight group-hover:text-[#C65A3A] transition-colors line-clamp-1">
                                        Silver Filigree Pendant</h3>
                                    <span class="text-[#C65A3A] font-bold text-base block mb-4">Rs 4,500</span>
                                </div>
                                <a href="#"
                                    class="w-full flex items-center justify-center gap-2 bg-[#C65A3A] hover:bg-[#b04a2c] text-white text-sm font-semibold py-3 px-4 rounded-xl shadow-sm hover:shadow transition duration-300">
                                    <i class="fa-solid fa-circle-plus text-xs"></i> View Details
                                </a>
                            </div>
                        </div>

                    </div>{{-- end product grid --}}

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

    <!-- Product Details Modal Overlay -->
    <div id="product-details-modal" class="fixed inset-0 z-[99999] hidden bg-black/60 backdrop-blur-sm overflow-y-auto p-4 sm:p-6 md:p-10 transition-opacity duration-300 opacity-0">
        
        <!-- Modal Content Container -->
        <div class="relative bg-[#F4EAE1] max-w-6xl mx-auto rounded-3xl overflow-hidden shadow-2xl border border-[#ebd7be]/50 transform scale-95 opacity-0 transition-all duration-300 ease-out" id="product-details-container">
            
            <!-- Close Button -->
            <button id="close-product-details" class="absolute top-4 right-4 z-50 bg-white/80 hover:bg-white text-slate-800 rounded-full w-10 h-10 flex items-center justify-center shadow-md transition hover:scale-105 active:scale-95 cursor-pointer">
                <i class="fas fa-times text-lg"></i>
            </button>

            <div class="p-6 sm:p-8 md:p-10 lg:p-12 space-y-8">
                
                <!-- Breadcrumbs -->
                <div class="text-[#3A2A1F]/60 text-xs font-semibold">
                    Home &nbsp;&rsaquo;&nbsp; Shop &nbsp;&rsaquo;&nbsp; <span class="text-[#C65A3A]">Singing Bowls</span>
                </div>

                <!-- TOP HALF: Two Column Content Flow -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-start">
                    
                    <!-- Left Column: Gallery, Mobile Buy Section, Badges, Tabs & Specs -->
                    <div class="lg:col-span-6 space-y-6">
                        
                        <!-- Left Area: Image Gallery -->
                        <div class="flex gap-4">
                            <!-- Thumbnails vertical column -->
                            <div class="flex flex-col gap-3 shrink-0">
                                <img src="{{ asset('images/1st-image.png') }}" alt="Thumbnail 1" class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl border-2 border-[#C65A3A] object-cover cursor-pointer hover:opacity-90 transition shadow-sm">
                                <img src="{{ asset('images/pot.png') }}" alt="Thumbnail 2" class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl border border-[#ebd7be] object-cover cursor-pointer hover:opacity-90 transition shadow-sm">
                                <img src="{{ asset('images/aboutus.jpg') }}" alt="Thumbnail 3" class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl border border-[#ebd7be] object-cover cursor-pointer hover:opacity-90 transition shadow-sm">
                            </div>
                            <!-- Main image -->
                            <div class="flex-grow aspect-[4/3] rounded-3xl overflow-hidden border border-[#ebd7be]/30 shadow-md bg-white">
                                <img src="{{ asset('images/1st-image.png') }}" id="main-product-image" alt="Hand-Hammered Copper Singing Bowl" class="w-full h-full object-cover">
                            </div>
                        </div>

                        <!-- MOBILE ONLY: Buy Info Section -->
                        <div class="block lg:hidden space-y-6 mt-4">
                            <div class="space-y-3">
                                <span class="inline-flex items-center gap-1.5 bg-[#E5DCD0]/70 text-[#1F3D2E] text-[10px] font-bold tracking-wider uppercase px-3 py-1 rounded-full">
                                    Authentic Handmade
                                </span>
                                <div class="flex items-center gap-2 text-xs">
                                    <div class="flex text-yellow-500 gap-0.5">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                    </div>
                                    <span class="text-[#3A2A1F]/60 font-semibold">(42 Reviews)</span>
                                </div>
                                <h1 class="text-2xl font-bold text-[#1F3D2E] leading-tight font-serif">Hand-Hammered Copper Singing Bowl</h1>
                                <div class="text-[#C65A3A] font-extrabold text-xl">Rs 4,500</div>
                            </div>
                            <p class="text-[#3A2A1F]/80 text-sm leading-relaxed font-medium">
                                Experience the meditative resonance of ancient Patan. This bowl is forged from high-grade copper using traditional hammering techniques passed down through seven generations of the Shakya lineage.
                            </p>
                            <!-- Artist Card -->
                            <div class="bg-[#FFF7EF] border border-[#ebd7be]/40 rounded-2xl p-4 flex items-center justify-between shadow-sm">
                                <div class="flex items-center gap-3">
                                    <img src="{{ asset('images/logo.jpeg') }}" alt="Kancha" class="w-10 h-10 rounded-full object-cover border border-[#ebd7be]">
                                    <div>
                                        <h3 class="text-xs font-bold text-[#C65A3A] leading-tight">Kancha's Pottery</h3>
                                        <p class="text-[10px] text-[#3A2A1F]/60 font-semibold mt-0.5">Master Artisan from Patan Industrial Estate</p>
                                    </div>
                                </div>
                                <a href="#" class="text-[11px] font-bold text-[#C65A3A] hover:text-[#b04a2c] transition-colors border border-[#C65A3A]/40 px-2.5 py-1 rounded-full bg-white/60">
                                    Visit Studio
                                </a>
                            </div>
                            <!-- Quantity -->
                            <div class="flex items-center gap-4">
                                <span class="text-sm font-bold text-[#1F3D2E]">Quantity</span>
                                <div class="flex items-center border border-[#ebd7be] rounded-full bg-white px-3 py-1.5 gap-4 shadow-sm">
                                    <button type="button" class="qty-minus-btn text-[#3A2A1F] hover:text-[#C65A3A] font-bold text-sm w-5 h-5 flex items-center justify-center focus:outline-none transition">−</button>
                                    <input type="number" class="qty-val-input text-sm font-bold text-[#1F3D2E] w-10 text-center bg-transparent border-none outline-none" value="1" min="1" max="999">
                                    <button type="button" class="qty-plus-btn text-[#3A2A1F] hover:text-[#C65A3A] font-bold text-sm w-5 h-5 flex items-center justify-center focus:outline-none transition">+</button>
                                </div>
                            </div>
                            <!-- Buttons -->
                            <div class="flex gap-3 pt-2">
                                <button class="bg-[#C65A3A] hover:bg-[#b04a2c] text-white font-bold py-3 px-5 rounded-2xl flex-1 text-center shadow-md active:scale-[0.98] transition text-sm">
                                    Add to Cart
                                </button>
                                <button class="border-2 border-[#C65A3A] text-[#C65A3A] hover:bg-[#C65A3A]/10 font-bold py-3 px-5 rounded-2xl flex-1 text-center active:scale-[0.98] transition text-sm">
                                    Buy Now
                                </button>
                            </div>
                        </div>

                        <!-- Shipping and Returns Quick Badges -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4 border-t border-[#ebd7be]/30">
                            <div class="flex items-start gap-3 bg-[#FFF7EF]/50 p-3 rounded-xl border border-[#ebd7be]/30">
                                <i class="fas fa-truck text-[#C65A3A] text-lg mt-0.5"></i>
                                <div>
                                    <h4 class="text-xs font-bold text-[#1F3D2E] uppercase tracking-wide">Insured Shipping</h4>
                                    <p class="text-[10px] text-[#3A2A1F]/60 font-semibold mt-0.5">3-5 days delivery across Nepal</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3 bg-[#FFF7EF]/50 p-3 rounded-xl border border-[#ebd7be]/30">
                                <i class="fas fa-rotate-left text-[#C65A3A] text-lg mt-0.5"></i>
                                <div>
                                    <h4 class="text-xs font-bold text-[#1F3D2E] uppercase tracking-wide">15-Day Returns</h4>
                                    <p class="text-[10px] text-[#3A2A1F]/60 font-semibold mt-0.5">Easy exchange if not satisfied</p>
                                </div>
                            </div>
                        </div>

                        <!-- Left: Tabs & Specifications (Starting right below shipping badges with no desktop row gap) -->
                        <div class="pt-6 border-t border-[#ebd7be]/40 space-y-6">
                            <!-- Tabs headers -->
                            <div class="flex border-b border-[#ebd7be]/40 gap-6">
                                <button class="tab-btn pb-3 text-sm font-bold text-[#C65A3A] border-b-2 border-[#C65A3A] focus:outline-none transition" data-tab="details">
                                    Product Details
                                </button>
                                <button class="tab-btn pb-3 text-sm font-semibold text-[#3A2A1F]/60 hover:text-[#3A2A1F] focus:outline-none transition" data-tab="story">
                                    Craftsmanship Story
                                </button>
                                <button class="tab-btn pb-3 text-sm font-semibold text-[#3A2A1F]/60 hover:text-[#3A2A1F] focus:outline-none transition" data-tab="shipping">
                                    Shipping &amp; Returns
                                </button>
                            </div>
                            <!-- Tab Panel: Product Details -->
                            <div class="tab-panel space-y-4" data-panel="details">
                                <h3 class="text-lg font-bold text-[#1F3D2E] font-serif">Traditional Specifications</h3>
                                <ul class="space-y-3">
                                    <li class="flex items-start gap-3 text-sm text-[#3A2A1F]/80 font-medium">
                                        <span class="w-2 h-2 rounded bg-[#C65A3A] mt-1.5 shrink-0"></span>
                                        <span><strong>Material:</strong> 99.9% Pure Recycled Copper from Patan's metal workshops.</span>
                                    </li>
                                    <li class="flex items-start gap-3 text-sm text-[#3A2A1F]/80 font-medium">
                                        <span class="w-2 h-2 rounded bg-[#C65A3A] mt-1.5 shrink-0"></span>
                                        <span><strong>Diameter:</strong> 7 inches (Standard Ritual Size).</span>
                                    </li>
                                    <li class="flex items-start gap-3 text-sm text-[#3A2A1F]/80 font-medium">
                                        <span class="w-2 h-2 rounded bg-[#C65A3A] mt-1.5 shrink-0"></span>
                                        <span><strong>Weight:</strong> Approximately 850 grams.</span>
                                    </li>
                                    <li class="flex items-start gap-3 text-sm text-[#3A2A1F]/80 font-medium">
                                        <span class="w-2 h-2 rounded bg-[#C65A3A] mt-1.5 shrink-0"></span>
                                        <span><strong>Includes:</strong> Hand-carved Rosewood mallet and silk-embroidered cushion.</span>
                                    </li>
                                    <li class="flex items-start gap-3 text-sm text-[#3A2A1F]/80 font-medium">
                                        <span class="w-2 h-2 rounded bg-[#C65A3A] mt-1.5 shrink-0"></span>
                                        <span><strong>Tuning:</strong> Fundamental frequency tuned to the Heart Chakra (Anahata).</span>
                                    </li>
                                </ul>
                            </div>

                            <!-- Tab Panel: Craftsmanship Story -->
                            <div class="tab-panel space-y-4 hidden" data-panel="story">
                                <h3 class="text-lg font-bold text-[#1F3D2E] font-serif">The Art Behind Every Piece</h3>
                                <p class="text-sm text-[#3A2A1F]/80 font-medium leading-relaxed">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                </p>
                                <p class="text-sm text-[#3A2A1F]/80 font-medium leading-relaxed">
                                    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                </p>
                                <div class="bg-[#FFF7EF] border border-[#ebd7be]/40 rounded-xl p-4 space-y-2">
                                    <h4 class="text-xs font-bold uppercase tracking-wider text-[#C65A3A]">Generational Craft</h4>
                                    <p class="text-sm text-[#3A2A1F]/70 font-medium leading-relaxed">
                                        Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper.
                                    </p>
                                </div>
                                <ul class="space-y-2">
                                    <li class="flex items-start gap-3 text-sm text-[#3A2A1F]/80 font-medium">
                                        <span class="w-2 h-2 rounded bg-[#C65A3A] mt-1.5 shrink-0"></span>
                                        <span><strong>Heritage:</strong> Seven generations of Shakya metalsmithing lineage from Patan Durbar Square.</span>
                                    </li>
                                    <li class="flex items-start gap-3 text-sm text-[#3A2A1F]/80 font-medium">
                                        <span class="w-2 h-2 rounded bg-[#C65A3A] mt-1.5 shrink-0"></span>
                                        <span><strong>Process:</strong> Each bowl requires over 40 hours of hand-hammering using ancestral wooden mallets.</span>
                                    </li>
                                    <li class="flex items-start gap-3 text-sm text-[#3A2A1F]/80 font-medium">
                                        <span class="w-2 h-2 rounded bg-[#C65A3A] mt-1.5 shrink-0"></span>
                                        <span><strong>Authenticity:</strong> Certified by the Patan Artisan Guild and stamped with the maker's signature mark.</span>
                                    </li>
                                </ul>
                            </div>

                            <!-- Tab Panel: Shipping & Returns -->
                            <div class="tab-panel space-y-4 hidden" data-panel="shipping">
                                <h3 class="text-lg font-bold text-[#1F3D2E] font-serif">Delivery &amp; Return Policy</h3>
                                <p class="text-sm text-[#3A2A1F]/80 font-medium leading-relaxed">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.
                                </p>
                                <div class="space-y-3">
                                    <div class="flex items-start gap-3 bg-[#FFF7EF]/60 p-3 rounded-xl border border-[#ebd7be]/30">
                                        <i class="fas fa-truck text-[#C65A3A] text-base mt-0.5"></i>
                                        <div>
                                            <h4 class="text-xs font-bold text-[#1F3D2E] uppercase tracking-wide">Standard Delivery</h4>
                                            <p class="text-[11px] text-[#3A2A1F]/60 font-medium mt-0.5">Kathmandu Valley: 2–3 business days. Outside Valley: 5–7 business days. Free shipping on orders above Rs 2,000.</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-3 bg-[#FFF7EF]/60 p-3 rounded-xl border border-[#ebd7be]/30">
                                        <i class="fas fa-bolt text-[#C65A3A] text-base mt-0.5"></i>
                                        <div>
                                            <h4 class="text-xs font-bold text-[#1F3D2E] uppercase tracking-wide">Express Delivery</h4>
                                            <p class="text-[11px] text-[#3A2A1F]/60 font-medium mt-0.5">Same-day delivery available within Kathmandu ring road. Order before 12:00 PM for guaranteed same-day dispatch.</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-3 bg-[#FFF7EF]/60 p-3 rounded-xl border border-[#ebd7be]/30">
                                        <i class="fas fa-rotate-left text-[#C65A3A] text-base mt-0.5"></i>
                                        <div>
                                            <h4 class="text-xs font-bold text-[#1F3D2E] uppercase tracking-wide">15-Day Returns</h4>
                                            <p class="text-[11px] text-[#3A2A1F]/60 font-medium mt-0.5">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Items must be unused and in original packaging.</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-3 bg-[#FFF7EF]/60 p-3 rounded-xl border border-[#ebd7be]/30">
                                        <i class="fas fa-shield-halved text-[#C65A3A] text-base mt-0.5"></i>
                                        <div>
                                            <h4 class="text-xs font-bold text-[#1F3D2E] uppercase tracking-wide">Secure Packaging</h4>
                                            <p class="text-[11px] text-[#3A2A1F]/60 font-medium mt-0.5">Excepteur sint occaecat cupidatat non proident. All fragile items are double-boxed with foam padding and anti-shock wrapping.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Right Column: DESKTOP Product Info & Artisan Note -->
                    <div class="lg:col-span-6 space-y-6">
                        
                        <!-- DESKTOP ONLY: Buy Info Section -->
                        <div class="hidden lg:block space-y-6">
                            <div class="space-y-3">
                                <span class="inline-flex items-center gap-1.5 bg-[#E5DCD0]/70 text-[#1F3D2E] text-[10px] font-bold tracking-wider uppercase px-3 py-1 rounded-full">
                                    Authentic Handmade
                                </span>
                                <div class="flex items-center gap-2 text-xs">
                                    <div class="flex text-yellow-500 gap-0.5">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                    </div>
                                    <span class="text-[#3A2A1F]/60 font-semibold">(42 Reviews)</span>
                                </div>
                                <h1 class="text-3xl font-bold text-[#1F3D2E] leading-tight font-serif">Hand-Hammered Copper Singing Bowl</h1>
                                <div class="text-[#C65A3A] font-extrabold text-2xl">Rs 4,500</div>
                            </div>

                            <p class="text-[#3A2A1F]/80 text-sm leading-relaxed font-medium">
                                Experience the meditative resonance of ancient Patan. This bowl is forged from high-grade copper using traditional hammering techniques passed down through seven generations of the Shakya lineage.
                            </p>

                            <!-- Artist Card -->
                            <div class="bg-[#FFF7EF] border border-[#ebd7be]/40 rounded-2xl p-4 flex items-center justify-between shadow-sm">
                                <div class="flex items-center gap-3">
                                    <img src="{{ asset('images/logo.jpeg') }}" alt="Kancha" class="w-12 h-12 rounded-full object-cover border border-[#ebd7be]">
                                    <div>
                                        <h3 class="text-sm font-bold text-[#C65A3A] leading-tight">Kancha's Pottery</h3>
                                        <p class="text-[11px] text-[#3A2A1F]/60 font-semibold mt-0.5">Master Artisan from Patan Industrial Estate</p>
                                    </div>
                                </div>
                                <a href="#" class="text-xs font-bold text-[#C65A3A] hover:text-[#b04a2c] transition-colors border border-[#C65A3A]/40 px-3 py-1.5 rounded-full bg-white/60">
                                    Visit Studio
                                </a>
                            </div>

                            <!-- Quantity Section -->
                            <div class="flex items-center gap-4">
                                <span class="text-sm font-bold text-[#1F3D2E]">Quantity</span>
                                <div class="flex items-center border border-[#ebd7be] rounded-full bg-white px-3 py-1.5 gap-4 shadow-sm">
                                    <button type="button" class="qty-minus-btn text-[#3A2A1F] hover:text-[#C65A3A] font-bold text-sm w-5 h-5 flex items-center justify-center focus:outline-none transition">−</button>
                                    <input type="number" class="qty-val-input text-sm font-bold text-[#1F3D2E] w-10 text-center bg-transparent border-none outline-none" value="1" min="1" max="999">
                                    <button type="button" class="qty-plus-btn text-[#3A2A1F] hover:text-[#C65A3A] font-bold text-sm w-5 h-5 flex items-center justify-center focus:outline-none transition">+</button>
                                </div>
                            </div>

                            <!-- Call To Action Buttons -->
                            <div class="flex gap-3 pt-2">
                                <button class="bg-[#C65A3A] hover:bg-[#b04a2c] text-white font-bold py-3.5 px-6 rounded-2xl flex-1 text-center shadow-md active:scale-[0.98] transition">
                                    Add to Cart
                                </button>
                                <button class="border-2 border-[#C65A3A] text-[#C65A3A] hover:bg-[#C65A3A]/10 font-bold py-3.5 px-6 rounded-2xl flex-1 text-center active:scale-[0.98] transition">
                                    Buy Now
                                </button>
                            </div>
                        </div>

                        <!-- Right: Artisan Note -->
                        <div class="bg-[#FFF7EF] border border-[#ebd7be]/40 rounded-2xl p-6 space-y-4 shadow-sm">
                            <h4 class="text-xs font-bold uppercase tracking-wider text-[#1F3D2E]/60">Artisan's Note</h4>
                            <p class="text-sm font-medium text-[#1F3D2E] italic leading-relaxed">
                                "Each strike of the hammer is a prayer. We don't just shape metal; we trap resonance within it. This bowl is designed to sustain a vibration for up to 45 seconds, perfect for mindfulness and healing rituals."
                            </p>
                            <div class="flex items-center gap-3 pt-2">
                                <div class="w-8 h-8 rounded-full bg-[#1F3D2E] text-white flex items-center justify-center font-bold text-xs">
                                    K
                                </div>
                                <span class="text-xs font-bold text-[#1F3D2E]">Kancha Shakya, Master Metalsmith</span>
                            </div>
                        </div>

                    </div>
                </div>

                    <!-- Customer Stories Section -->
                    <div class="pt-8 border-t border-[#ebd7be]/40 space-y-6">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <div>
                                <h3 class="text-2xl font-bold text-[#1F3D2E] font-serif">Customer Stories</h3>
                                <p class="text-[#3A2A1F]/60 text-xs font-semibold mt-1">Hear from those who bring Nepali heritage into their homes.</p>
                            </div>
                            <button class="border border-[#C65A3A] text-[#C65A3A] hover:bg-[#C65A3A] hover:text-white transition-all font-bold text-xs px-5 py-2.5 rounded-full focus:outline-none">
                                Write a Review
                            </button>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <!-- Review 1 -->
                            <div class="bg-[#FFF7EF] border border-[#ebd7be]/40 rounded-2xl p-5 space-y-3 flex flex-col justify-between shadow-sm">
                                <div class="space-y-2">
                                    <div class="flex text-yellow-500 gap-0.5 text-xs">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                    </div>
                                    <p class="text-xs font-medium text-[#3A2A1F]/80 leading-relaxed">
                                        "The sustain is incredible. You can really feel the craftsmanship compared to mass-produced bowls."
                                    </p>
                                </div>
                                <div class="flex items-center gap-2 pt-2">
                                    <div class="w-6 h-6 rounded-full bg-[#E5DCD0]/60 shrink-0"></div>
                                    <span class="text-[10px] font-bold text-[#1F3D2E]">Anita R., Kathmandu</span>
                                </div>
                            </div>
                            <!-- Review 2 -->
                            <div class="bg-[#FFF7EF] border border-[#ebd7be]/40 rounded-2xl p-5 space-y-3 flex flex-col justify-between shadow-sm">
                                <div class="space-y-2">
                                    <div class="flex text-yellow-500 gap-0.5 text-xs">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                    </div>
                                    <p class="text-xs font-medium text-[#3A2A1F]/80 leading-relaxed">
                                        "Beautiful centerpiece. The copper has a wonderful warm glow that lights up my living room."
                                    </p>
                                </div>
                                <div class="flex items-center gap-2 pt-2">
                                    <div class="w-6 h-6 rounded-full bg-[#E5DCD0]/60 shrink-0"></div>
                                    <span class="text-[10px] font-bold text-[#1F3D2E]">Siddhartha L., Pokhara</span>
                                </div>
                            </div>
                            <!-- Review 3 -->
                            <div class="bg-[#FFF7EF] border border-[#ebd7be]/40 rounded-2xl p-5 space-y-3 flex flex-col justify-between shadow-sm">
                                <div class="space-y-2">
                                    <div class="flex text-yellow-500 gap-0.5 text-xs">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                    </div>
                                    <p class="text-xs font-medium text-[#3A2A1F]/80 leading-relaxed">
                                        "Gifted this to my mother and she was moved to tears by the quality. Support our local artisans!"
                                    </p>
                                </div>
                                <div class="flex items-center gap-2 pt-2">
                                    <div class="w-6 h-6 rounded-full bg-[#E5DCD0]/60 shrink-0"></div>
                                    <span class="text-[10px] font-bold text-[#1F3D2E]">Pranish T., Lalitpur</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
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

            // ==================== PRODUCT DETAILS MODAL LOGIC ====================
            const productDetailsModal = document.getElementById('product-details-modal');
            const productDetailsContainer = document.getElementById('product-details-container');
            const viewDetailsButtons = document.querySelectorAll('.product-card a');
            const closeDetailsBtn = document.getElementById('close-product-details');

            function openProductDetails(e) {
                e.preventDefault();
                if (productDetailsModal && productDetailsContainer) {
                    productDetailsModal.classList.remove('hidden');
                    productDetailsModal.classList.add('block');
                    setTimeout(() => {
                        productDetailsModal.classList.remove('opacity-0');
                        productDetailsModal.classList.add('opacity-100');
                        productDetailsContainer.classList.remove('scale-95', 'opacity-0');
                        productDetailsContainer.classList.add('scale-100', 'opacity-100');
                    }, 10);
                    document.body.style.overflow = 'hidden';
                }
            }

            function closeProductDetails() {
                if (productDetailsModal && productDetailsContainer) {
                    productDetailsModal.classList.remove('opacity-100');
                    productDetailsModal.classList.add('opacity-0');
                    productDetailsContainer.classList.remove('scale-100', 'opacity-100');
                    productDetailsContainer.classList.add('scale-95', 'opacity-0');
                    setTimeout(() => {
                        productDetailsModal.classList.remove('block');
                        productDetailsModal.classList.add('hidden');
                    }, 300);
                    document.body.style.overflow = '';
                }
            }

            viewDetailsButtons.forEach(btn => {
                btn.addEventListener('click', openProductDetails);
            });

            if (closeDetailsBtn) {
                closeDetailsBtn.addEventListener('click', closeProductDetails);
            }

            if (productDetailsModal) {
                productDetailsModal.addEventListener('click', function(e) {
                    if (e.target === productDetailsModal) {
                        closeProductDetails();
                    }
                });
            }

            // Thumbnail image switcher
            const thumbnails = document.querySelectorAll('#product-details-modal img[alt^="Thumbnail"]');
            const mainImg = document.getElementById('main-product-image');
            thumbnails.forEach(thumb => {
                thumb.addEventListener('click', function() {
                    if (mainImg) {
                        mainImg.src = thumb.src;
                        // highlight selected thumbnail border
                        thumbnails.forEach(t => {
                            t.classList.remove('border-2', 'border-[#C65A3A]');
                            t.classList.add('border', 'border-[#ebd7be]');
                        });
                        thumb.classList.remove('border', 'border-[#ebd7be]');
                        thumb.classList.add('border-2', 'border-[#C65A3A]');
                    }
                });
            });

            // Quantity controls — sync all instances (mobile + desktop)
            function syncAllQtyInputs(newVal) {
                document.querySelectorAll('.qty-val-input').forEach(inp => {
                    inp.value = newVal;
                });
            }
            function getQtyValue() {
                const first = document.querySelector('.qty-val-input');
                return first ? (parseInt(first.value) || 1) : 1;
            }
            document.querySelectorAll('.qty-plus-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    syncAllQtyInputs(getQtyValue() + 1);
                });
            });
            document.querySelectorAll('.qty-minus-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const cur = getQtyValue();
                    if (cur > 1) syncAllQtyInputs(cur - 1);
                });
            });
            document.querySelectorAll('.qty-val-input').forEach(inp => {
                inp.addEventListener('change', function() {
                    let val = parseInt(this.value) || 1;
                    if (val < 1) val = 1;
                    if (val > 999) val = 999;
                    syncAllQtyInputs(val);
                });
                inp.addEventListener('input', function() {
                    // allow free typing; sanitize on blur/change
                    if (this.value < 1) this.value = 1;
                });
            });

            // Tab switcher logic
            const tabButtons = document.querySelectorAll('.tab-btn');
            const tabPanels = document.querySelectorAll('.tab-panel');
            tabButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    const target = btn.getAttribute('data-tab');
                    // Update button styles
                    tabButtons.forEach(b => {
                        b.classList.remove('text-[#C65A3A]', 'border-b-2', 'border-[#C65A3A]', 'font-bold');
                        b.classList.add('text-[#3A2A1F]/60', 'font-semibold');
                    });
                    btn.classList.add('text-[#C65A3A]', 'border-b-2', 'border-[#C65A3A]', 'font-bold');
                    btn.classList.remove('text-[#3A2A1F]/60', 'font-semibold');
                    // Show/hide panels
                    tabPanels.forEach(panel => {
                        if (panel.getAttribute('data-panel') === target) {
                            panel.classList.remove('hidden');
                        } else {
                            panel.classList.add('hidden');
                        }
                    });
                });
            });
        });
    </script>
</x-frontend-layout>