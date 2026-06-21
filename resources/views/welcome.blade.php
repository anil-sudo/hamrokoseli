<x-frontend-layout>



<div class="bg-[#F4EAE1] text-brand-dark leading-relaxed flex flex-col min-h-screen">

    <!-- Main Content -->
    <main class="w-full flex-grow">

        <!-- 1. Hero Welcome Banner -->
        <section class="relative bg-gradient-to-b from-[#1f3d2e] to-transparent text-white pt-12 sm:pt-16 pb-32 sm:pb-40 text-center px-4 sm:px-6">
            <div class="max-w-4xl mx-auto relative z-10">
                <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold mb-3 sm:mb-4 tracking-tight leading-tight">
                    Discover Authentic Artisan Crafts
                </h2>
                <p class="text-emerald-100/90 text-sm sm:text-base md:text-lg mb-6 sm:mb-8 max-w-xl mx-auto px-2">
                    Support local artisans and find unique, handmade treasures
                </p>
                
                <a href="{{ route('shop') }}" class="bg-[#b55b3d] hover:bg-[#a04f33] text-white font-bold px-6 sm:px-8 py-2.5 sm:py-3 rounded-full shadow-md transition duration-300 inline-block tracking-wide text-sm sm:text-base">
                    Shop Now
                </a>
            </div>
        </section>

        <!-- 2. Flash Sale Products Section - 3 COLUMNS ON MOBILE -->
        <section class="max-w-7xl mx-auto -mt-20 sm:-mt-24 px-4 sm:px-6 mb-12 sm:mb-16 relative z-20">
            <div class="mb-3 sm:mb-4 text-left">
                <div class="inline-flex items-center gap-1.5 bg-[#e5b842] text-brand-dark text-[10px] sm:text-xs font-bold uppercase tracking-wider px-3 sm:px-4 py-1 sm:py-1.5 rounded-md shadow-sm">
                    <span>⚡ Flash Sale - Limited Time</span>
                </div>
            </div>
            
            <!-- Grid: 3 columns on mobile, 2 on tablet, 4 on desktop -->
            <div class="grid grid-cols-3 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 sm:gap-3 md:gap-4 lg:gap-6">
                <!-- Product Card 1 -->
                <div class="bg-[#FDFBF7] rounded-xl sm:rounded-2xl overflow-hidden shadow-sm border border-amber-900/5 hover:shadow-md transition group">
                    <div class="h-28 xs:h-32 sm:h-40 md:h-48 lg:h-56 overflow-hidden bg-slate-100 relative">
                        <img src="{{ asset('images/Sweaters.png') }}" alt="Textiles" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        <button class="wishlist-btn absolute top-3 right-3 text-[#C65A3A] hover:text-[#b04a2c] transition-colors text-lg sm:text-xl drop-shadow focus:outline-none"
                                data-product-id="101"
                                data-product-name="Handwoven Wool Sweater"
                                data-product-price="1299"
                                data-product-image="{{ asset('images/Sweaters.png') }}"
                                data-product-desc="Warm and cozy handwoven merino wool sweater from the Himalayas."
                                data-product-category="Textile"
                                data-product-tag="Artisan Made">
                            <i class="far fa-heart"></i>
                        </button>
                    </div>
                    <div class="p-1.5 sm:p-2 md:p-3 lg:p-4">
                        <h4 class="text-slate-500 font-semibold text-[8px] sm:text-[9px] md:text-[10px] uppercase tracking-wider mb-0.5 sm:mb-1 truncate">Textile</h4>
                        <h3 class="text-[10px] sm:text-xs md:text-sm lg:text-base font-bold text-brand-dark mb-1 sm:mb-2 line-clamp-2">Handwoven Wool Sweater</h3>
                        <div class="flex flex-col sm:flex-row sm:items-center gap-0.5 sm:gap-1">
                            <span class="text-brand-primary font-bold text-[10px] sm:text-xs md:text-sm">Rs. 1,299</span>
                            <span class="text-slate-400 text-[8px] sm:text-[9px] md:text-xs line-through">Rs. 1,899</span>
                        </div>
                    </div>
                </div>

                <!-- Product Card 2 -->
                <div class="bg-[#FDFBF7] rounded-xl sm:rounded-2xl overflow-hidden shadow-sm border border-amber-900/5 hover:shadow-md transition group">
                    <div class="h-28 xs:h-32 sm:h-40 md:h-48 lg:h-56 overflow-hidden bg-slate-100 relative">
                        <img src="{{ asset('images/SunGlass.png') }}" alt="Accessories" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        <button class="wishlist-btn absolute top-3 right-3 text-[#C65A3A] hover:text-[#b04a2c] transition-colors text-lg sm:text-xl drop-shadow focus:outline-none"
                                data-product-id="102"
                                data-product-name="Wooden Sunglasses"
                                data-product-price="899"
                                data-product-image="{{ asset('images/SunGlass.png') }}"
                                data-product-desc="Eco-friendly and stylish hand-crafted wooden sunglasses."
                                data-product-category="Accessories">
                            <i class="far fa-heart"></i>
                        </button>
                    </div>
                    <div class="p-1.5 sm:p-2 md:p-3 lg:p-4">
                        <h4 class="text-slate-500 font-semibold text-[8px] sm:text-[9px] md:text-[10px] uppercase tracking-wider mb-0.5 sm:mb-1 truncate">Accessories</h4>
                        <h3 class="text-[10px] sm:text-xs md:text-sm lg:text-base font-bold text-brand-dark mb-1 sm:mb-2 line-clamp-2">Wooden Sunglasses</h3>
                        <div class="flex flex-col sm:flex-row sm:items-center gap-0.5 sm:gap-1">
                            <span class="text-brand-primary font-bold text-[10px] sm:text-xs md:text-sm">Rs. 899</span>
                            <span class="text-slate-400 text-[8px] sm:text-[9px] md:text-xs line-through">Rs. 1,299</span>
                        </div>
                    </div>
                </div>

                <!-- Product Card 3 -->
                <div class="bg-[#FDFBF7] rounded-xl sm:rounded-2xl overflow-hidden shadow-sm border border-amber-900/5 hover:shadow-md transition group">
                    <div class="h-28 xs:h-32 sm:h-40 md:h-48 lg:h-56 overflow-hidden bg-slate-100 relative">
                        <img src="{{ asset('images/Table.png') }}" alt="Furniture" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        <button class="wishlist-btn absolute top-3 right-3 text-[#C65A3A] hover:text-[#b04a2c] transition-colors text-lg sm:text-xl drop-shadow focus:outline-none"
                                data-product-id="103"
                                data-product-name="Solid Wood Coffee Table"
                                data-product-price="12999"
                                data-product-image="{{ asset('images/Table.png') }}"
                                data-product-desc="Durable coffee table hand-crafted from solid Nepalese Shorea wood."
                                data-product-category="Furniture">
                            <i class="far fa-heart"></i>
                        </button>
                    </div>
                    <div class="p-1.5 sm:p-2 md:p-3 lg:p-4">
                        <h4 class="text-slate-500 font-semibold text-[8px] sm:text-[9px] md:text-[10px] uppercase tracking-wider mb-0.5 sm:mb-1 truncate">Furniture</h4>
                        <h3 class="text-[10px] sm:text-xs md:text-sm lg:text-base font-bold text-brand-dark mb-1 sm:mb-2 line-clamp-2">Solid Wood Coffee Table</h3>
                        <div class="flex flex-col sm:flex-row sm:items-center gap-0.5 sm:gap-1">
                            <span class="text-brand-primary font-bold text-[10px] sm:text-xs md:text-sm">Rs. 12,999</span>
                            <span class="text-slate-400 text-[8px] sm:text-[9px] md:text-xs line-through">Rs. 15,999</span>
                        </div>
                    </div>
                </div>

                <!-- Product Card 4 -->
                <div class="bg-[#FDFBF7] rounded-xl sm:rounded-2xl overflow-hidden shadow-sm border border-amber-900/5 hover:shadow-md transition group">
                    <div class="h-28 xs:h-32 sm:h-40 md:h-48 lg:h-56 overflow-hidden bg-slate-100 relative">
                        <img src="{{ asset('images/Pottery.png') }}" alt="Pottery" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        <button class="wishlist-btn absolute top-3 right-3 text-[#C65A3A] hover:text-[#b04a2c] transition-colors text-lg sm:text-xl drop-shadow focus:outline-none"
                                data-product-id="104"
                                data-product-name="Hand-Painted Ceramic Vase"
                                data-product-price="2499"
                                data-product-image="{{ asset('images/Pottery.png') }}"
                                data-product-desc="Beautiful ceramic vase hand-painted with traditional patterns."
                                data-product-category="Pottery">
                            <i class="far fa-heart"></i>
                        </button>
                    </div>
                    <div class="p-1.5 sm:p-2 md:p-3 lg:p-4">
                        <h4 class="text-slate-500 font-semibold text-[8px] sm:text-[9px] md:text-[10px] uppercase tracking-wider mb-0.5 sm:mb-1 truncate">Pottery</h4>
                        <h3 class="text-[10px] sm:text-xs md:text-sm lg:text-base font-bold text-brand-dark mb-1 sm:mb-2 line-clamp-2">Hand-Painted Ceramic Vase</h3>
                        <div class="flex flex-col sm:flex-row sm:items-center gap-0.5 sm:gap-1">
                            <span class="text-brand-primary font-bold text-[10px] sm:text-xs md:text-sm">Rs. 2,499</span>
                            <span class="text-slate-400 text-[8px] sm:text-[9px] md:text-xs line-through">Rs. 3,499</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 3. Shop By Category Section - 3 COLUMNS ON MOBILE -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 mb-12 sm:mb-16">
            <div class="flex items-center justify-between mb-4 sm:mb-6 md:mb-8">
                <h3 class="text-xl sm:text-2xl md:text-3xl font-bold text-brand-dark">Shop by Category</h3>
                <a href="{{ route('categories') }}" class="text-brand-primary hover:text-[#a04f33] font-bold text-xs sm:text-sm flex items-center gap-1 transition-colors hover:underline">
                    <span>See All</span>
                    <i class="fa-solid fa-chevron-right text-[10px] sm:text-xs"></i>
                </a>
            </div>

            <!-- Grid: 3 columns on mobile, 2 on tablet, 4 on desktop -->
            <div class="grid grid-cols-3 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 sm:gap-3 md:gap-4 lg:gap-6">
                <!-- Category 1 -->
                <div class="bg-[#FDFBF7] rounded-xl sm:rounded-2xl overflow-hidden shadow-sm border border-amber-900/5 hover:shadow-md transition group cursor-pointer">
                    <div class="h-24 xs:h-28 sm:h-36 md:h-44 lg:h-56 overflow-hidden bg-slate-100">
                        <img src="{{ asset('images/Pottery and Ceramics.png') }}" alt="Pottery & Ceramics" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    </div>
                    <div class="p-1.5 sm:p-2 md:p-3 text-center">
                        <h4 class="text-[10px] sm:text-xs md:text-sm lg:text-base font-bold text-brand-dark group-hover:text-brand-primary transition-colors line-clamp-1">Pottery & Ceramics</h4>
                    </div>
                </div>

                <!-- Category 2 -->
                <div class="bg-[#FDFBF7] rounded-xl sm:rounded-2xl overflow-hidden shadow-sm border border-amber-900/5 hover:shadow-md transition group cursor-pointer">
                    <div class="h-24 xs:h-28 sm:h-36 md:h-44 lg:h-56 overflow-hidden bg-slate-100">
                        <img src="{{ asset('images/Textile and Fabrics.png') }}" alt="Textile & Fabric" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    </div>
                    <div class="p-1.5 sm:p-2 md:p-3 text-center">
                        <h4 class="text-[10px] sm:text-xs md:text-sm lg:text-base font-bold text-brand-dark group-hover:text-brand-primary transition-colors line-clamp-1">Textile & Fabric</h4>
                    </div>
                </div>

                <!-- Category 3 -->
                <div class="bg-[#FDFBF7] rounded-xl sm:rounded-2xl overflow-hidden shadow-sm border border-amber-900/5 hover:shadow-md transition group cursor-pointer">
                    <div class="h-24 xs:h-28 sm:h-36 md:h-44 lg:h-56 overflow-hidden bg-slate-100">
                        <img src="{{ asset('images/Jewlery and Accessory.png') }}" alt="Jewelry & Accessories" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    </div>
                    <div class="p-1.5 sm:p-2 md:p-3 text-center">
                        <h4 class="text-[10px] sm:text-xs md:text-sm lg:text-base font-bold text-brand-dark group-hover:text-brand-primary transition-colors line-clamp-1">Jewelry & Accessories</h4>
                    </div>
                </div>

                <!-- Category 4 -->
                <div class="bg-[#FDFBF7] rounded-xl sm:rounded-2xl overflow-hidden shadow-sm border border-amber-900/5 hover:shadow-md transition group cursor-pointer">
                    <div class="h-24 xs:h-28 sm:h-36 md:h-44 lg:h-56 overflow-hidden bg-slate-100">
                        <img src="{{ asset('images/Home Decor.png') }}" alt="Home Decor" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    </div>
                    <div class="p-1.5 sm:p-2 md:p-3 text-center">
                        <h4 class="text-[10px] sm:text-xs md:text-sm lg:text-base font-bold text-brand-dark group-hover:text-brand-primary transition-colors line-clamp-1">Home Decor</h4>
                    </div>
                </div>
            </div>
        </section>

        <!-- 4. Today's Deals Section - 3 COLUMNS ON MOBILE -->
        <section id="todays-deals" class="max-w-7xl mx-auto px-4 sm:px-6 mb-12 sm:mb-16">
            <div class="bg-[#E5DCD0]/60 border border-[#ebd7be]/40 rounded-2xl sm:rounded-3xl p-3 sm:p-4 md:p-6 lg:p-8 shadow-sm">
                
                <div class="flex items-center justify-between mb-4 sm:mb-5 md:mb-6 lg:mb-8">
                    <h3 class="text-xl sm:text-2xl md:text-3xl font-bold text-brand-dark flex items-center gap-2">
                        <span>🔥 Today's Deals</span>
                    </h3>
                    <a href="{{ route('todays-deals') }}" class="text-brand-primary hover:text-[#a04f33] font-bold text-xs sm:text-sm flex items-center gap-1 transition-colors hover:underline">
                        <span>See All</span>
                        <i class="fa-solid fa-chevron-right text-[10px] sm:text-xs"></i>
                    </a>
                </div>

                <!-- Grid: 3 columns on mobile, 2 on tablet, 4 on desktop -->
                <div class="grid grid-cols-3 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 sm:gap-3 md:gap-4 lg:gap-6">
                    <!-- Deal Card 1 -->
                    <div class="bg-white rounded-xl sm:rounded-2xl overflow-hidden shadow-sm border border-[#ebd7be]/40 relative hover:shadow-md transition group">
                        <span class="absolute top-1 left-1 sm:top-2 sm:left-2 bg-[#e5b842] text-brand-dark text-[8px] sm:text-[9px] md:text-[10px] font-extrabold uppercase px-1.5 sm:px-2 py-0.5 sm:py-1 rounded-full z-10 shadow-sm">
                            -20%
                        </span>
                        <div class="h-24 xs:h-28 sm:h-36 md:h-44 lg:h-48 overflow-hidden bg-slate-100 relative">
                            <img src="{{ asset('images/Sweaters.png') }}" alt="Deal 1" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <button class="wishlist-btn absolute top-2 right-2 text-[#C65A3A] hover:text-[#b04a2c] transition-colors text-base drop-shadow focus:outline-none"
                                    data-product-id="105"
                                    data-product-name="Merino Wool Sweater"
                                    data-product-price="1299"
                                    data-product-image="{{ asset('images/Sweaters.png') }}"
                                    data-product-desc="High-quality merino wool sweater woven by local weavers."
                                    data-product-category="Artisan Weaves">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <div class="p-1.5 sm:p-2 md:p-3 lg:p-4">
                            <span class="text-slate-400 font-semibold text-[7px] sm:text-[8px] md:text-[9px] lg:text-[10px] uppercase tracking-wider truncate block">Artisan Weaves</span>
                            <h4 class="text-[9px] sm:text-[10px] md:text-xs lg:text-sm font-bold text-brand-dark my-0.5 sm:my-1 line-clamp-2">Merino Wool Sweater</h4>
                            <div class="flex items-center gap-0.5 sm:gap-1 text-[8px] sm:text-[9px] md:text-[10px] lg:text-[11px] mb-1 sm:mb-2 text-slate-500">
                                <span class="flex text-amber-500 gap-0.5">
                                    <i class="fa-solid fa-star text-[6px] sm:text-[8px]"></i>
                                    <i class="fa-solid fa-star text-[6px] sm:text-[8px]"></i>
                                    <i class="fa-solid fa-star text-[6px] sm:text-[8px]"></i>
                                    <i class="fa-solid fa-star text-[6px] sm:text-[8px]"></i>
                                    <i class="fa-regular fa-star text-[6px] sm:text-[8px]"></i>
                                </span>
                                <span class="hidden xs:inline">(124)</span>
                            </div>
                            <div class="flex items-center justify-between mt-1 sm:mt-1.5 md:mt-2 pt-1 sm:pt-1.5 border-t border-slate-100">
                                <span class="text-brand-primary font-bold text-[9px] sm:text-[10px] md:text-xs lg:text-sm">Rs. 1,299</span>
                                <button class="bg-[#b55b3d] hover:bg-[#a04f33] text-white text-[8px] sm:text-[9px] md:text-[10px] lg:text-xs font-semibold px-1.5 sm:px-2 py-0.5 sm:py-1 md:px-2.5 md:py-1 rounded-lg transition">
                                    Add
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Deal Card 2 -->
                    <div class="bg-white rounded-xl sm:rounded-2xl overflow-hidden shadow-sm border border-[#ebd7be]/40 hover:shadow-md transition group">
                        <div class="h-24 xs:h-28 sm:h-36 md:h-44 lg:h-48 overflow-hidden bg-slate-100 relative">
                            <img src="{{ asset('images/SunGlass.png') }}" alt="Deal 2" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <button class="wishlist-btn absolute top-2 right-2 text-[#C65A3A] hover:text-[#b04a2c] transition-colors text-base drop-shadow focus:outline-none"
                                    data-product-id="106"
                                    data-product-name="Bamboo Sunglasses"
                                    data-product-price="899"
                                    data-product-image="{{ asset('images/SunGlass.png') }}"
                                    data-product-desc="Stylish sunglasses crafted from sustainable natural bamboo wood."
                                    data-product-category="Eco Eyewear">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <div class="p-1.5 sm:p-2 md:p-3 lg:p-4">
                            <span class="text-slate-400 font-semibold text-[7px] sm:text-[8px] md:text-[9px] lg:text-[10px] uppercase tracking-wider truncate block">Eco Eyewear</span>
                            <h4 class="text-[9px] sm:text-[10px] md:text-xs lg:text-sm font-bold text-brand-dark my-0.5 sm:my-1 line-clamp-2">Bamboo Sunglasses</h4>
                            <div class="flex items-center gap-0.5 sm:gap-1 text-[8px] sm:text-[9px] md:text-[10px] lg:text-[11px] mb-1 sm:mb-2 text-slate-500">
                                <span class="flex text-amber-500 gap-0.5">
                                    <i class="fa-solid fa-star text-[6px] sm:text-[8px]"></i>
                                    <i class="fa-solid fa-star text-[6px] sm:text-[8px]"></i>
                                    <i class="fa-solid fa-star text-[6px] sm:text-[8px]"></i>
                                    <i class="fa-solid fa-star text-[6px] sm:text-[8px]"></i>
                                    <i class="fa-regular fa-star text-[6px] sm:text-[8px]"></i>
                                </span>
                                <span class="hidden xs:inline">(89)</span>
                            </div>
                            <div class="flex items-center justify-between mt-1 sm:mt-1.5 md:mt-2 pt-1 sm:pt-1.5 border-t border-slate-100">
                                <span class="text-brand-primary font-bold text-[9px] sm:text-[10px] md:text-xs lg:text-sm">Rs. 899</span>
                                <button class="bg-[#b55b3d] hover:bg-[#a04f33] text-white text-[8px] sm:text-[9px] md:text-[10px] lg:text-xs font-semibold px-1.5 sm:px-2 py-0.5 sm:py-1 md:px-2.5 md:py-1 rounded-lg transition">
                                    Add
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Deal Card 3 -->
                    <div class="bg-white rounded-xl sm:rounded-2xl overflow-hidden shadow-sm border border-[#ebd7be]/40 hover:shadow-md transition group">
                        <div class="h-24 xs:h-28 sm:h-36 md:h-44 lg:h-48 overflow-hidden bg-slate-100 relative">
                            <img src="{{ asset('images/Table.png') }}" alt="Deal 3" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <button class="wishlist-btn absolute top-2 right-2 text-[#C65A3A] hover:text-[#b04a2c] transition-colors text-base drop-shadow focus:outline-none"
                                    data-product-id="107"
                                    data-product-name="Teak Wood Side Table"
                                    data-product-price="8999"
                                    data-product-image="{{ asset('images/Table.png') }}"
                                    data-product-desc="Sturdy, hand-crafted teak wood side table with rustic charm."
                                    data-product-category="Woodcraft">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <div class="p-1.5 sm:p-2 md:p-3 lg:p-4">
                            <span class="text-slate-400 font-semibold text-[7px] sm:text-[8px] md:text-[9px] lg:text-[10px] uppercase tracking-wider truncate block">Woodcraft</span>
                            <h4 class="text-[9px] sm:text-[10px] md:text-xs lg:text-sm font-bold text-brand-dark my-0.5 sm:my-1 line-clamp-2">Teak Wood Side Table</h4>
                            <div class="flex items-center gap-0.5 sm:gap-1 text-[8px] sm:text-[9px] md:text-[10px] lg:text-[11px] mb-1 sm:mb-2 text-slate-500">
                                <span class="flex text-amber-500 gap-0.5">
                                    <i class="fa-solid fa-star text-[6px] sm:text-[8px]"></i>
                                    <i class="fa-solid fa-star text-[6px] sm:text-[8px]"></i>
                                    <i class="fa-solid fa-star text-[6px] sm:text-[8px]"></i>
                                    <i class="fa-solid fa-star text-[6px] sm:text-[8px]"></i>
                                    <i class="fa-regular fa-star text-[6px] sm:text-[8px]"></i>
                                </span>
                                <span class="hidden xs:inline">(56)</span>
                            </div>
                            <div class="flex items-center justify-between mt-1 sm:mt-1.5 md:mt-2 pt-1 sm:pt-1.5 border-t border-slate-100">
                                <span class="text-brand-primary font-bold text-[9px] sm:text-[10px] md:text-xs lg:text-sm">Rs. 8,999</span>
                                <button class="bg-[#b55b3d] hover:bg-[#a04f33] text-white text-[8px] sm:text-[9px] md:text-[10px] lg:text-xs font-semibold px-1.5 sm:px-2 py-0.5 sm:py-1 md:px-2.5 md:py-1 rounded-lg transition">
                                    Add
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Deal Card 4 -->
                    <div class="bg-white rounded-xl sm:rounded-2xl overflow-hidden shadow-sm border border-[#ebd7be]/40 hover:shadow-md transition group">
                        <div class="h-24 xs:h-28 sm:h-36 md:h-44 lg:h-48 overflow-hidden bg-slate-100 relative">
                            <img src="{{ asset('images/Pottery.png') }}" alt="Deal 4" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <button class="wishlist-btn absolute top-2 right-2 text-[#C65A3A] hover:text-[#b04a2c] transition-colors text-base drop-shadow focus:outline-none"
                                    data-product-id="108"
                                    data-product-name="Ceramic Bowl Set"
                                    data-product-price="3499"
                                    data-product-image="{{ asset('images/Pottery.png') }}"
                                    data-product-desc="Set of handmade ceramic bowls, clay-fired and glazed by local potters."
                                    data-product-category="Clay Studio">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <div class="p-1.5 sm:p-2 md:p-3 lg:p-4">
                            <span class="text-slate-400 font-semibold text-[7px] sm:text-[8px] md:text-[9px] lg:text-[10px] uppercase tracking-wider truncate block">Clay Studio</span>
                            <h4 class="text-[9px] sm:text-[10px] md:text-xs lg:text-sm font-bold text-brand-dark my-0.5 sm:my-1 line-clamp-2">Ceramic Bowl Set</h4>
                            <div class="flex items-center gap-0.5 sm:gap-1 text-[8px] sm:text-[9px] md:text-[10px] lg:text-[11px] mb-1 sm:mb-2 text-slate-500">
                                <span class="flex text-amber-500 gap-0.5">
                                    <i class="fa-solid fa-star text-[6px] sm:text-[8px]"></i>
                                    <i class="fa-solid fa-star text-[6px] sm:text-[8px]"></i>
                                    <i class="fa-solid fa-star text-[6px] sm:text-[8px]"></i>
                                    <i class="fa-solid fa-star text-[6px] sm:text-[8px]"></i>
                                    <i class="fa-regular fa-star text-[6px] sm:text-[8px]"></i>
                                </span>
                                <span class="hidden xs:inline">(203)</span>
                            </div>
                            <div class="flex items-center justify-between mt-1 sm:mt-1.5 md:mt-2 pt-1 sm:pt-1.5 border-t border-slate-100">
                                <span class="text-brand-primary font-bold text-[9px] sm:text-[10px] md:text-xs lg:text-sm">Rs. 3,499</span>
                                <button class="bg-[#b55b3d] hover:bg-[#a04f33] text-white text-[8px] sm:text-[9px] md:text-[10px] lg:text-xs font-semibold px-1.5 sm:px-2 py-0.5 sm:py-1 md:px-2.5 md:py-1 rounded-lg transition">
                                    Add
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 5. Featured Products & Trending Now Split Section -->
        <section id="featured-products" class="max-w-7xl mx-auto px-4 sm:px-6 mb-12 sm:mb-16">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 sm:gap-6 md:gap-8">
                
                <!-- Left Panel: Featured Products -->
                <div class="lg:col-span-8 bg-[#E5DCD0]/60 border border-[#ebd7be]/40 rounded-2xl sm:rounded-3xl p-3 sm:p-4 md:p-6 lg:p-8 shadow-sm">
                    
                    <div class="flex items-center justify-between mb-4 sm:mb-5 md:mb-6 lg:mb-8">
                        <h3 class="text-xl sm:text-2xl md:text-3xl font-bold text-brand-dark">⭐ Featured Products</h3>
                        <a href="{{ route('featured-products') }}" class="text-brand-primary hover:text-[#a04f33] font-bold text-xs sm:text-sm flex items-center gap-1 transition-colors hover:underline">
                            <span>See All</span>
                            <i class="fa-solid fa-chevron-right text-[10px] sm:text-xs"></i>
                        </a>
                    </div>

                    <!-- Grid: 2 columns on mobile and up -->
                    <div class="grid grid-cols-2 gap-2 sm:gap-3 md:gap-4 lg:gap-6">
                        <!-- Featured Card 1 -->
                        <div class="bg-white rounded-xl sm:rounded-2xl overflow-hidden shadow-sm border border-[#ebd7be]/40 relative hover:shadow-md transition group">
                            <span class="absolute top-1 left-1 sm:top-2 sm:left-2 bg-[#b55b3d] text-white text-[8px] sm:text-[9px] md:text-[10px] font-extrabold uppercase px-1.5 sm:px-2 py-0.5 sm:py-1 rounded-full z-10 shadow-sm">
                                Featured
                            </span>
                            <div class="h-24 xs:h-28 sm:h-36 md:h-44 lg:h-48 overflow-hidden bg-slate-100 relative">
                                <img src="{{ asset('images/Sweaters.png') }}" alt="Featured 1" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                <button class="wishlist-btn absolute top-2 right-2 text-[#C65A3A] hover:text-[#b04a2c] transition-colors text-base drop-shadow focus:outline-none"
                                        data-product-id="109"
                                        data-product-name="Cashmere Blend Scarf"
                                        data-product-price="2499"
                                        data-product-image="{{ asset('images/Sweaters.png') }}"
                                        data-product-desc="Luxurious and warm cashmere blend scarf woven by hand in Kathmandu."
                                        data-product-category="Artisan Weaves">
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>
                            <div class="p-1.5 sm:p-2 md:p-3 lg:p-4">
                                <span class="text-slate-400 font-semibold text-[7px] sm:text-[8px] md:text-[9px] lg:text-[10px] uppercase tracking-wider truncate block">Artisan Weaves</span>
                                <h4 class="text-[9px] sm:text-[10px] md:text-xs lg:text-sm font-bold text-brand-dark my-0.5 sm:my-1 line-clamp-2">Cashmere Blend Scarf</h4>
                                <div class="flex items-center gap-0.5 sm:gap-1 text-[8px] sm:text-[9px] md:text-[10px] lg:text-[11px] mb-1 sm:mb-2 text-slate-500">
                                    <span class="flex text-amber-500 gap-0.5">
                                        <i class="fa-solid fa-star text-[6px] sm:text-[8px]"></i>
                                        <i class="fa-solid fa-star text-[6px] sm:text-[8px]"></i>
                                        <i class="fa-solid fa-star text-[6px] sm:text-[8px]"></i>
                                        <i class="fa-solid fa-star text-[6px] sm:text-[8px]"></i>
                                        <i class="fa-regular fa-star text-[6px] sm:text-[8px]"></i>
                                    </span>
                                    <span class="hidden xs:inline">(178)</span>
                                </div>
                                <div class="flex items-center justify-between mt-1 sm:mt-1.5 md:mt-2 pt-1 sm:pt-1.5 border-t border-slate-100">
                                    <span class="text-brand-primary font-bold text-[9px] sm:text-[10px] md:text-xs lg:text-sm">Rs. 2,499</span>
                                    <button class="bg-[#b55b3d] hover:bg-[#a04f33] text-white text-[8px] sm:text-[9px] md:text-[10px] lg:text-xs font-semibold px-1.5 sm:px-2 py-0.5 sm:py-1 md:px-2.5 md:py-1 rounded-lg transition">
                                        Add
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Featured Card 2 -->
                        <div class="bg-white rounded-xl sm:rounded-2xl overflow-hidden shadow-sm border border-[#ebd7be]/40 hover:shadow-md transition group">
                            <div class="h-24 xs:h-28 sm:h-36 md:h-44 lg:h-48 overflow-hidden bg-slate-100 relative">
                                <img src="{{ asset('images/SunGlass.png') }}" alt="Featured 2" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                <button class="wishlist-btn absolute top-2 right-2 text-[#C65A3A] hover:text-[#b04a2c] transition-colors text-base drop-shadow focus:outline-none"
                                        data-product-id="110"
                                        data-product-name="Brass Wall Art"
                                        data-product-price="4999"
                                        data-product-image="{{ asset('images/SunGlass.png') }}"
                                        data-product-desc="Intricately hand-hammered traditional Nepalese brass wall decor."
                                        data-product-category="Lumiere">
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>
                            <div class="p-1.5 sm:p-2 md:p-3 lg:p-4">
                                <span class="text-slate-400 font-semibold text-[7px] sm:text-[8px] md:text-[9px] lg:text-[10px] uppercase tracking-wider truncate block">Lumiere</span>
                                <h4 class="text-[9px] sm:text-[10px] md:text-xs lg:text-sm font-bold text-brand-dark my-0.5 sm:my-1 line-clamp-2">Brass Wall Art</h4>
                                <div class="flex items-center gap-0.5 sm:gap-1 text-[8px] sm:text-[9px] md:text-[10px] lg:text-[11px] mb-1 sm:mb-2 text-slate-500">
                                    <span class="flex text-amber-500 gap-0.5">
                                        <i class="fa-solid fa-star text-[6px] sm:text-[8px]"></i>
                                        <i class="fa-solid fa-star text-[6px] sm:text-[8px]"></i>
                                        <i class="fa-solid fa-star text-[6px] sm:text-[8px]"></i>
                                        <i class="fa-solid fa-star text-[6px] sm:text-[8px]"></i>
                                        <i class="fa-regular fa-star text-[6px] sm:text-[8px]"></i>
                                    </span>
                                    <span class="hidden xs:inline">(92)</span>
                                </div>
                                <div class="flex items-center justify-between mt-1 sm:mt-1.5 md:mt-2 pt-1 sm:pt-1.5 border-t border-slate-100">
                                    <span class="text-brand-primary font-bold text-[9px] sm:text-[10px] md:text-xs lg:text-sm">Rs. 4,999</span>
                                    <button class="bg-[#b55b3d] hover:bg-[#a04f33] text-white text-[8px] sm:text-[9px] md:text-[10px] lg:text-xs font-semibold px-1.5 sm:px-2 py-0.5 sm:py-1 md:px-2.5 md:py-1 rounded-lg transition">
                                        Add
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Featured Card 3 -->
                        <div class="bg-white rounded-xl sm:rounded-2xl overflow-hidden shadow-sm border border-[#ebd7be]/40 hover:shadow-md transition group">
                            <div class="h-24 xs:h-28 sm:h-36 md:h-44 lg:h-48 overflow-hidden bg-slate-100 relative">
                                <img src="{{ asset('images/Table.png') }}" alt="Featured 3" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                <button class="wishlist-btn absolute top-2 right-2 text-[#C65A3A] hover:text-[#b04a2c] transition-colors text-base drop-shadow focus:outline-none"
                                        data-product-id="111"
                                        data-product-name="Modern Armchair"
                                        data-product-price="24999"
                                        data-product-image="{{ asset('images/Table.png') }}"
                                        data-product-desc="Stylish and highly comfortable hand-finished modern wooden armchair."
                                        data-product-category="Furnish Lab">
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>
                            <div class="p-1.5 sm:p-2 md:p-3 lg:p-4">
                                <span class="text-slate-400 font-semibold text-[7px] sm:text-[8px] md:text-[9px] lg:text-[10px] uppercase tracking-wider truncate block">Furnish Lab</span>
                                <h4 class="text-[9px] sm:text-[10px] md:text-xs lg:text-sm font-bold text-brand-dark my-0.5 sm:my-1 line-clamp-2">Modern Armchair</h4>
                                <div class="flex items-center gap-0.5 sm:gap-1 text-[8px] sm:text-[9px] md:text-[10px] lg:text-[11px] mb-1 sm:mb-2 text-slate-500">
                                    <span class="flex text-amber-500 gap-0.5">
                                        <i class="fa-solid fa-star text-[6px] sm:text-[8px]"></i>
                                        <i class="fa-solid fa-star text-[6px] sm:text-[8px]"></i>
                                        <i class="fa-solid fa-star text-[6px] sm:text-[8px]"></i>
                                        <i class="fa-solid fa-star text-[6px] sm:text-[8px]"></i>
                                        <i class="fa-regular fa-star text-[6px] sm:text-[8px]"></i>
                                    </span>
                                    <span class="hidden xs:inline">(45)</span>
                                </div>
                                <div class="flex items-center justify-between mt-1 sm:mt-1.5 md:mt-2 pt-1 sm:pt-1.5 border-t border-slate-100">
                                    <span class="text-brand-primary font-bold text-[9px] sm:text-[10px] md:text-xs lg:text-sm">Rs. 24,999</span>
                                    <button class="bg-[#b55b3d] hover:bg-[#a04f33] text-white text-[8px] sm:text-[9px] md:text-[10px] lg:text-xs font-semibold px-1.5 sm:px-2 py-0.5 sm:py-1 md:px-2.5 md:py-1 rounded-lg transition">
                                        Add
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Featured Card 4 -->
                        <div class="bg-white rounded-xl sm:rounded-2xl overflow-hidden shadow-sm border border-[#ebd7be]/40 relative hover:shadow-md transition group">
                            <span class="absolute top-1 left-1 sm:top-2 sm:left-2 bg-[#b55b3d] text-white text-[8px] sm:text-[9px] md:text-[10px] font-extrabold uppercase px-1.5 sm:px-2 py-0.5 sm:py-1 rounded-full z-10 shadow-sm">
                                Featured
                            </span>
                            <div class="h-24 xs:h-28 sm:h-36 md:h-44 lg:h-48 overflow-hidden bg-slate-100 relative">
                                <img src="{{ asset('images/Pottery.png') }}" alt="Featured 4" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                <button class="wishlist-btn absolute top-2 right-2 text-[#C65A3A] hover:text-[#b04a2c] transition-colors text-base drop-shadow focus:outline-none"
                                        data-product-id="112"
                                        data-product-name="Stoneware Dinner Set"
                                        data-product-price="5999"
                                        data-product-image="{{ asset('images/Pottery.png') }}"
                                        data-product-desc="Complete traditional clay stoneware dining set, fired and glazed."
                                        data-product-category="Clay & Kiln">
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>
                            <div class="p-1.5 sm:p-2 md:p-3 lg:p-4">
                                <span class="text-slate-400 font-semibold text-[7px] sm:text-[8px] md:text-[9px] lg:text-[10px] uppercase tracking-wider truncate block">Clay & Kiln</span>
                                <h4 class="text-[9px] sm:text-[10px] md:text-xs lg:text-sm font-bold text-brand-dark my-0.5 sm:my-1 line-clamp-2">Stoneware Dinner Set</h4>
                                <div class="flex items-center gap-0.5 sm:gap-1 text-[8px] sm:text-[9px] md:text-[10px] lg:text-[11px] mb-1 sm:mb-2 text-slate-500">
                                    <span class="flex text-amber-500 gap-0.5">
                                        <i class="fa-solid fa-star text-[6px] sm:text-[8px]"></i>
                                        <i class="fa-solid fa-star text-[6px] sm:text-[8px]"></i>
                                        <i class="fa-solid fa-star text-[6px] sm:text-[8px]"></i>
                                        <i class="fa-solid fa-star text-[6px] sm:text-[8px]"></i>
                                        <i class="fa-regular fa-star text-[6px] sm:text-[8px]"></i>
                                    </span>
                                    <span class="hidden xs:inline">(312)</span>
                                </div>
                                <div class="flex items-center justify-between mt-1 sm:mt-1.5 md:mt-2 pt-1 sm:pt-1.5 border-t border-slate-100">
                                    <span class="text-brand-primary font-bold text-[9px] sm:text-[10px] md:text-xs lg:text-sm">Rs. 5,999</span>
                                    <button class="bg-[#b55b3d] hover:bg-[#a04f33] text-white text-[8px] sm:text-[9px] md:text-[10px] lg:text-xs font-semibold px-1.5 sm:px-2 py-0.5 sm:py-1 md:px-2.5 md:py-1 rounded-lg transition">
                                        Add
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Panel: Trending Now -->
                <div class="lg:col-span-4 bg-[#E5DCD0]/60 border border-[#ebd7be]/40 rounded-2xl sm:rounded-3xl p-3 sm:p-4 md:p-6 lg:p-8 shadow-sm h-fit">
                    <h3 class="text-lg sm:text-xl md:text-2xl font-bold text-brand-dark flex items-center gap-2 mb-3 sm:mb-4 md:mb-6">
                        <span>📈 Trending Now</span>
                    </h3>

                    <div class="space-y-2 sm:space-y-3 md:space-y-4">
                        <!-- Trending Item 1 -->
                        <div class="flex items-center gap-2 sm:gap-3 md:gap-4 bg-white p-1.5 sm:p-2 md:p-3 rounded-xl sm:rounded-2xl shadow-sm border border-[#ebd7be]/40 group transition cursor-pointer">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 md:w-14 md:h-14 rounded-lg sm:rounded-xl overflow-hidden shrink-0 bg-slate-100">
                                <img src="{{ asset('images/Sweaters.png') }}" alt="Trending product" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            </div>
                            <div class="flex-grow">
                                <h4 class="text-[10px] sm:text-xs md:text-sm font-bold text-brand-dark group-hover:text-brand-primary transition-colors line-clamp-1">Macrame Plant Hanger</h4>
                                <span class="text-brand-primary font-bold text-[9px] sm:text-[10px] md:text-xs">Rs. 549</span>
                                <div class="flex items-center gap-1 text-[7px] sm:text-[8px] md:text-[9px] text-amber-500 font-semibold mt-0.5">
                                    <i class="fa-solid fa-star"></i>
                                    <span>4.8</span>
                                    <span class="text-slate-400 ml-0.5 sm:ml-1 hidden xs:inline">(2.3k sold)</span>
                                </div>
                            </div>
                        </div>

                        <!-- Trending Item 2 -->
                        <div class="flex items-center gap-2 sm:gap-3 md:gap-4 bg-white p-1.5 sm:p-2 md:p-3 rounded-xl sm:rounded-2xl shadow-sm border border-[#ebd7be]/40 group transition cursor-pointer">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 md:w-14 md:h-14 rounded-lg sm:rounded-xl overflow-hidden shrink-0 bg-slate-100">
                                <img src="{{ asset('images/SunGlass.png') }}" alt="Trending product" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            </div>
                            <div class="flex-grow">
                                <h4 class="text-[10px] sm:text-xs md:text-sm font-bold text-brand-dark group-hover:text-brand-primary transition-colors line-clamp-1">Handloom Cotton Scarf</h4>
                                <span class="text-brand-primary font-bold text-[9px] sm:text-[10px] md:text-xs">Rs. 799</span>
                                <div class="flex items-center gap-1 text-[7px] sm:text-[8px] md:text-[9px] text-amber-500 font-semibold mt-0.5">
                                    <i class="fa-solid fa-star"></i>
                                    <span>4.7</span>
                                    <span class="text-slate-400 ml-0.5 sm:ml-1 hidden xs:inline">(1.8k sold)</span>
                                </div>
                            </div>
                        </div>

                        <!-- Trending Item 3 -->
                        <div class="flex items-center gap-2 sm:gap-3 md:gap-4 bg-white p-1.5 sm:p-2 md:p-3 rounded-xl sm:rounded-2xl shadow-sm border border-[#ebd7be]/40 group transition cursor-pointer">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 md:w-14 md:h-14 rounded-lg sm:rounded-xl overflow-hidden shrink-0 bg-slate-100">
                                <img src="{{ asset('images/Table.png') }}" alt="Trending product" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            </div>
                            <div class="flex-grow">
                                <h4 class="text-[10px] sm:text-xs md:text-sm font-bold text-brand-dark group-hover:text-brand-primary transition-colors line-clamp-1">Hand-Painted Coaster Set</h4>
                                <span class="text-brand-primary font-bold text-[9px] sm:text-[10px] md:text-xs">Rs. 349</span>
                                <div class="flex items-center gap-1 text-[7px] sm:text-[8px] md:text-[9px] text-amber-500 font-semibold mt-0.5">
                                    <i class="fa-solid fa-star"></i>
                                    <span>4.9</span>
                                    <span class="text-slate-400 ml-0.5 sm:ml-1 hidden xs:inline">(3.1k sold)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 6. Top Sellers Section - 3 COLUMNS ON MOBILE -->
        <section id="top-sellers" class="max-w-7xl mx-auto px-4 sm:px-6 mb-12 sm:mb-20">
            <div class="bg-[#E5DCD0]/60 border border-[#ebd7be]/40 rounded-2xl sm:rounded-3xl p-3 sm:p-4 md:p-6 lg:p-10 shadow-sm">
                
                <div class="flex items-center justify-between mb-4 sm:mb-5 md:mb-6 lg:mb-8">
                    <h3 class="text-xl sm:text-2xl md:text-3xl font-bold text-brand-dark flex items-center gap-2">
                        <span>🏆 Top Sellers</span>
                    </h3>
                    <a href="{{ route('top-sellers') }}" class="text-brand-primary hover:text-[#a04f33] font-bold text-xs sm:text-sm flex items-center gap-1 transition-colors hover:underline">
                        <span>See All</span>
                        <i class="fa-solid fa-chevron-right text-[10px] sm:text-xs"></i>
                    </a>
                </div>

                <!-- Grid: 3 columns on mobile, 2 on tablet, 4 on desktop -->
                <div class="grid grid-cols-3 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 sm:gap-3 md:gap-4 lg:gap-6">
                    <!-- Seller Card 1 -->
                    <div class="bg-white rounded-xl sm:rounded-2xl overflow-hidden shadow-sm border border-[#ebd7be]/40 relative hover:shadow-md transition group">
                        <span class="absolute top-1 left-1 sm:top-2 sm:left-2 bg-[#e5b842] text-brand-dark text-[8px] sm:text-[9px] md:text-[10px] font-extrabold uppercase px-1.5 sm:px-2 py-0.5 sm:py-1 rounded-full z-10 shadow-sm">
                            Best
                        </span>
                        <div class="h-24 xs:h-28 sm:h-36 md:h-44 lg:h-48 overflow-hidden bg-slate-100 relative">
                            <img src="{{ asset('images/Sweaters.png') }}" alt="Seller 1" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <button class="wishlist-btn absolute top-2 right-2 text-[#C65A3A] hover:text-[#b04a2c] transition-colors text-base drop-shadow focus:outline-none"
                                    data-product-id="116"
                                    data-product-name="Heritage Wool Blanket"
                                    data-product-price="6999"
                                    data-product-image="{{ asset('images/Sweaters.png') }}"
                                    data-product-desc="Beautiful heritage wool blanket woven with traditional motifs."
                                    data-product-category="The Wool Studio"
                                    data-product-tag="Best">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <div class="p-1.5 sm:p-2 md:p-3 lg:p-4">
                            <span class="text-slate-400 font-semibold text-[7px] sm:text-[8px] md:text-[9px] lg:text-[10px] uppercase tracking-wider truncate block">The Wool Studio</span>
                            <h4 class="text-[9px] sm:text-[10px] md:text-xs lg:text-sm font-bold text-brand-dark my-0.5 sm:my-1 line-clamp-2">Heritage Wool Blanket</h4>
                            <div class="flex items-center gap-0.5 sm:gap-1 text-[8px] sm:text-[9px] md:text-[10px] lg:text-[11px] mb-1 sm:mb-2 text-slate-500">
                                <span class="flex text-amber-500 gap-0.5">
                                    <i class="fa-solid fa-star text-[6px] sm:text-[8px]"></i>
                                    <i class="fa-solid fa-star text-[6px] sm:text-[8px]"></i>
                                    <i class="fa-solid fa-star text-[6px] sm:text-[8px]"></i>
                                    <i class="fa-solid fa-star text-[6px] sm:text-[8px]"></i>
                                    <i class="fa-regular fa-star text-[6px] sm:text-[8px]"></i>
                                </span>
                                <span class="hidden xs:inline">(892)</span>
                            </div>
                            <div class="flex items-center justify-between mt-1 sm:mt-1.5 md:mt-2 pt-1 sm:pt-1.5 border-t border-slate-100">
                                <span class="text-brand-primary font-bold text-[9px] sm:text-[10px] md:text-xs lg:text-sm">Rs. 6,999</span>
                                <button class="bg-[#b55b3d] hover:bg-[#a04f33] text-white text-[8px] sm:text-[9px] md:text-[10px] lg:text-xs font-semibold px-1.5 sm:px-2 py-0.5 sm:py-1 md:px-2.5 md:py-1 rounded-lg transition">
                                    Add
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Seller Card 2 -->
                    <div class="bg-white rounded-xl sm:rounded-2xl overflow-hidden shadow-sm border border-[#ebd7be]/40 hover:shadow-md transition group">
                        <div class="h-24 xs:h-28 sm:h-36 md:h-44 lg:h-48 overflow-hidden bg-slate-100 relative">
                            <img src="{{ asset('images/SunGlass.png') }}" alt="Seller 2" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <button class="wishlist-btn absolute top-2 right-2 text-[#C65A3A] hover:text-[#b04a2c] transition-colors text-base drop-shadow focus:outline-none"
                                    data-product-id="117"
                                    data-product-name="Labradorite Pendant"
                                    data-product-price="3299"
                                    data-product-image="{{ asset('images/SunGlass.png') }}"
                                    data-product-desc="Stunning handcrafted labradorite gemstone pendant set in sterling silver."
                                    data-product-category="Gem & Co.">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <div class="p-1.5 sm:p-2 md:p-3 lg:p-4">
                            <span class="text-slate-400 font-semibold text-[7px] sm:text-[8px] md:text-[9px] lg:text-[10px] uppercase tracking-wider truncate block">Gem & Co.</span>
                            <h4 class="text-[9px] sm:text-[10px] md:text-xs lg:text-sm font-bold text-brand-dark my-0.5 sm:my-1 line-clamp-2">Labradorite Pendant</h4>
                            <div class="flex items-center gap-0.5 sm:gap-1 text-[8px] sm:text-[9px] md:text-[10px] lg:text-[11px] mb-1 sm:mb-2 text-slate-500">
                                <span class="flex text-amber-500 gap-0.5">
                                    <i class="fa-solid fa-star text-[6px] sm:text-[8px]"></i>
                                    <i class="fa-solid fa-star text-[6px] sm:text-[8px]"></i>
                                    <i class="fa-solid fa-star text-[6px] sm:text-[8px]"></i>
                                    <i class="fa-solid fa-star text-[6px] sm:text-[8px]"></i>
                                    <i class="fa-regular fa-star text-[6px] sm:text-[8px]"></i>
                                </span>
                                <span class="hidden xs:inline">(654)</span>
                            </div>
                            <div class="flex items-center justify-between mt-1 sm:mt-1.5 md:mt-2 pt-1 sm:pt-1.5 border-t border-slate-100">
                                <span class="text-brand-primary font-bold text-[9px] sm:text-[10px] md:text-xs lg:text-sm">Rs. 3,299</span>
                                <button class="bg-[#b55b3d] hover:bg-[#a04f33] text-white text-[8px] sm:text-[9px] md:text-[10px] lg:text-xs font-semibold px-1.5 sm:px-2 py-0.5 sm:py-1 md:px-2.5 md:py-1 rounded-lg transition">
                                    Add
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Seller Card 3 -->
                    <div class="bg-white rounded-xl sm:rounded-2xl overflow-hidden shadow-sm border border-[#ebd7be]/40 hover:shadow-md transition group">
                        <div class="h-24 xs:h-28 sm:h-36 md:h-44 lg:h-48 overflow-hidden bg-slate-100 relative">
                            <img src="{{ asset('images/Table.png') }}" alt="Seller 3" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <button class="wishlist-btn absolute top-2 right-2 text-[#C65A3A] hover:text-[#b04a2c] transition-colors text-base drop-shadow focus:outline-none"
                                    data-product-id="118"
                                    data-product-name="Reclaimed Wood Shelf"
                                    data-product-price="15999"
                                    data-product-image="{{ asset('images/Table.png') }}"
                                    data-product-desc="Sturdy, rustic wooden wall shelf hand-made from reclaimed Nepalese timber."
                                    data-product-category="Urban Rustic">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <div class="p-1.5 sm:p-2 md:p-3 lg:p-4">
                            <span class="text-slate-400 font-semibold text-[7px] sm:text-[8px] md:text-[9px] lg:text-[10px] uppercase tracking-wider truncate block">Urban Rustic</span>
                            <h4 class="text-[9px] sm:text-[10px] md:text-xs lg:text-sm font-bold text-brand-dark my-0.5 sm:my-1 line-clamp-2">Reclaimed Wood Shelf</h4>
                            <div class="flex items-center gap-0.5 sm:gap-1 text-[8px] sm:text-[9px] md:text-[10px] lg:text-[11px] mb-1 sm:mb-2 text-slate-500">
                                <span class="flex text-amber-500 gap-0.5">
                                    <i class="fa-solid fa-star text-[6px] sm:text-[8px]"></i>
                                    <i class="fa-solid fa-star text-[6px] sm:text-[8px]"></i>
                                    <i class="fa-solid fa-star text-[6px] sm:text-[8px]"></i>
                                    <i class="fa-solid fa-star text-[6px] sm:text-[8px]"></i>
                                    <i class="fa-regular fa-star text-[6px] sm:text-[8px]"></i>
                                </span>
                                <span class="hidden xs:inline">(423)</span>
                            </div>
                            <div class="flex items-center justify-between mt-1 sm:mt-1.5 md:mt-2 pt-1 sm:pt-1.5 border-t border-slate-100">
                                <span class="text-brand-primary font-bold text-[9px] sm:text-[10px] md:text-xs lg:text-sm">Rs. 15,999</span>
                                <button class="bg-[#b55b3d] hover:bg-[#a04f33] text-white text-[8px] sm:text-[9px] md:text-[10px] lg:text-xs font-semibold px-1.5 sm:px-2 py-0.5 sm:py-1 md:px-2.5 md:py-1 rounded-lg transition">
                                    Add
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Seller Card 4 -->
                    <div class="bg-white rounded-xl sm:rounded-2xl overflow-hidden shadow-sm border border-[#ebd7be]/40 hover:shadow-md transition group">
                        <div class="h-24 xs:h-28 sm:h-36 md:h-44 lg:h-48 overflow-hidden bg-slate-100 relative">
                            <img src="{{ asset('images/Pottery.png') }}" alt="Seller 4" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <button class="wishlist-btn absolute top-2 right-2 text-[#C65A3A] hover:text-[#b04a2c] transition-colors text-base drop-shadow focus:outline-none"
                                    data-product-id="119"
                                    data-product-name="Raku Fired Vase"
                                    data-product-price="4499"
                                    data-product-image="{{ asset('images/Pottery.png') }}"
                                    data-product-desc="Exquisite raku-fired pottery vase with metallic glaze finish."
                                    data-product-category="Earth & Clay">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <div class="p-1.5 sm:p-2 md:p-3 lg:p-4">
                            <span class="text-slate-400 font-semibold text-[7px] sm:text-[8px] md:text-[9px] lg:text-[10px] uppercase tracking-wider truncate block">Earth & Clay</span>
                            <h4 class="text-[9px] sm:text-[10px] md:text-xs lg:text-sm font-bold text-brand-dark my-0.5 sm:my-1 line-clamp-2">Raku Fired Vase</h4>
                            <div class="flex items-center gap-0.5 sm:gap-1 text-[8px] sm:text-[9px] md:text-[10px] lg:text-[11px] mb-1 sm:mb-2 text-slate-500">
                                <span class="flex text-amber-500 gap-0.5">
                                    <i class="fa-solid fa-star text-[6px] sm:text-[8px]"></i>
                                    <i class="fa-solid fa-star text-[6px] sm:text-[8px]"></i>
                                    <i class="fa-solid fa-star text-[6px] sm:text-[8px]"></i>
                                    <i class="fa-solid fa-star text-[6px] sm:text-[8px]"></i>
                                    <i class="fa-regular fa-star text-[6px] sm:text-[8px]"></i>
                                </span>
                                <span class="hidden xs:inline">(567)</span>
                            </div>
                            <div class="flex items-center justify-between mt-1 sm:mt-1.5 md:mt-2 pt-1 sm:pt-1.5 border-t border-slate-100">
                                <span class="text-brand-primary font-bold text-[9px] sm:text-[10px] md:text-xs lg:text-sm">Rs. 4,499</span>
                                <button class="bg-[#b55b3d] hover:bg-[#a04f33] text-white text-[8px] sm:text-[9px] md:text-[10px] lg:text-xs font-semibold px-1.5 sm:px-2 py-0.5 sm:py-1 md:px-2.5 md:py-1 rounded-lg transition">
                                    Add
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
</div>
</x-frontend-layout>