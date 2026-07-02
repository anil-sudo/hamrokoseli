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

        <!-- 2. Featured Products from Vendors Section - 3 COLUMNS ON MOBILE -->
        <section class="max-w-7xl mx-auto -mt-20 sm:-mt-24 px-4 sm:px-6 mb-12 sm:mb-16 relative z-20">
            <div class="mb-3 sm:mb-4 text-left">
                <div class="inline-flex items-center gap-1.5 bg-[#e5b842] text-brand-dark text-[10px] sm:text-xs font-bold uppercase tracking-wider px-3 sm:px-4 py-1 sm:py-1.5 rounded-md shadow-sm">
                    <span>Flash Sale &mdash; Limited Time</span>
                </div>
            </div>
            
            <!-- Grid: 3 columns on mobile, 2 on tablet, 4 on desktop -->
            <div class="grid grid-cols-3 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 sm:gap-3 md:gap-4 lg:gap-6">
                @forelse($featuredProducts as $product)
                    @php
                        $imageUrl = $product->primaryImageUrl();
                        $dDiscount = $product->resolvedDiscountPrice();
                        $hasDiscount = !is_null($dDiscount) && $dDiscount > 0 && $dDiscount < $product->price;
                        $discountPrice = $hasDiscount ? $dDiscount : $product->price;
                    @endphp
                    <!-- Product Card -->
                    <div class="bg-[#FDFBF7] rounded-xl sm:rounded-2xl overflow-hidden shadow-sm border border-amber-900/5 hover:shadow-md transition group">
                        <div class="h-28 xs:h-32 sm:h-40 md:h-48 lg:h-56 overflow-hidden bg-slate-100 relative cursor-pointer view-details-btn"
                             data-id="{{ $product->id }}"
                             data-name="{{ $product->name }}"
                             data-price="{{ intval($discountPrice) }}"
                             data-original-price="{{ intval($product->price) }}"
                             data-discount="{{ $hasDiscount ? 'true' : 'false' }}"
                             data-image="{{ $imageUrl }}"
                             data-category="{{ $product->category?->cat_name ?? 'Uncategorized' }}"
                             data-vendor="{{ $product->vendor?->vendor_name ?? 'Unknown' }}"
                             data-desc="{{ Str::limit($product->description, 100) }}"
                             data-stock="{{ $product->stock }}">
                            <img src="{{ $imageUrl }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <button class="wishlist-btn absolute top-3 right-3 text-[#C65A3A] hover:text-[#b04a2c] transition-colors text-lg sm:text-xl drop-shadow focus:outline-none"
                                    data-product-id="{{ $product->id }}"
                                    data-product-name="{{ $product->name }}"
                                    data-product-price="{{ intval($discountPrice) }}"
                                    data-product-image="{{ $imageUrl }}"
                                    data-product-desc="{{ Str::limit($product->description, 100) }}"
                                    data-product-category="{{ $product->category?->cat_name ?? 'Uncategorized' }}">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <div class="p-1.5 sm:p-2 md:p-3 lg:p-4">
                            <h4 class="text-slate-500 font-semibold text-[8px] sm:text-[9px] md:text-[10px] uppercase tracking-wider mb-0.5 sm:mb-1 truncate">{{ $product->category?->cat_name ?? 'Uncategorized' }}</h4>
                            <h3 class="text-[10px] sm:text-xs md:text-sm lg:text-base font-bold text-brand-dark mb-1 sm:mb-2 line-clamp-2 cursor-pointer hover:text-brand-primary transition-colors view-details-btn"
                                data-id="{{ $product->id }}"
                                data-name="{{ $product->name }}"
                                data-price="{{ intval($discountPrice) }}"
                                data-original-price="{{ intval($product->price) }}"
                                data-discount="{{ $hasDiscount ? 'true' : 'false' }}"
                                data-image="{{ $imageUrl }}"
                                data-category="{{ $product->category?->cat_name ?? 'Uncategorized' }}"
                                data-vendor="{{ $product->vendor?->vendor_name ?? 'Unknown' }}"
                                data-desc="{{ Str::limit($product->description, 100) }}"
                                data-stock="{{ $product->stock }}">
                                {{ $product->name }}
                            </h3>
                            <div class="flex items-center justify-between mt-2 pt-2 border-t border-slate-100/60">
                                <div class="flex flex-col">
                                    <span class="text-brand-primary font-bold text-[10px] sm:text-xs md:text-sm">Rs. {{ number_format($discountPrice, 0) }}</span>
                                    @if($hasDiscount)
                                        <span class="text-slate-400 text-[8px] sm:text-[9px] md:text-xs line-through">Rs. {{ number_format($product->price, 0) }}</span>
                                    @endif
                                </div>
                                <button class="add-to-cart-btn bg-[#b55b3d] hover:bg-[#a04f33] text-white text-[8px] sm:text-[9px] md:text-[10px] lg:text-xs font-semibold px-2 py-1 rounded-lg transition"
                                        data-product-id="{{ $product->id }}"
                                        data-product-name="{{ $product->name }}"
                                        data-product-price="{{ intval($discountPrice) }}"
                                        data-product-image="{{ $imageUrl }}"
                                        data-product-desc="{{ Str::limit($product->description, 100) }}"
                                        data-product-category="{{ $product->category?->cat_name ?? 'Uncategorized' }}">
                                    Add
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-8">
                        <p class="text-slate-500">No featured products available at this time.</p>
                    </div>
                @endforelse
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
                        <span>Today's Deals</span>
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
                        <div class="h-24 xs:h-28 sm:h-36 md:h-44 lg:h-48 overflow-hidden bg-slate-100 relative cursor-pointer view-details-btn"
                             data-id="105"
                             data-name="Merino Wool Sweater"
                             data-price="1299"
                             data-original-price="1624"
                             data-discount="true"
                             data-image="{{ asset('images/Sweaters.png') }}"
                             data-category="Artisan Weaves"
                             data-vendor="Artisan Weaves"
                             data-desc="High-quality merino wool sweater woven by local weavers."
                             data-rating="4"
                             data-reviews="124"
                             data-stock="20">
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
                            <h4 class="text-[9px] sm:text-[10px] md:text-xs lg:text-sm font-bold text-brand-dark my-0.5 sm:my-1 line-clamp-2 cursor-pointer hover:text-brand-primary transition-colors view-details-btn"
                                data-id="105"
                                data-name="Merino Wool Sweater"
                                data-price="1299"
                                data-original-price="1624"
                                data-discount="true"
                                data-image="{{ asset('images/Sweaters.png') }}"
                                data-category="Artisan Weaves"
                                data-vendor="Artisan Weaves"
                                data-desc="High-quality merino wool sweater woven by local weavers."
                                data-rating="4"
                                data-reviews="124"
                                data-stock="20">Merino Wool Sweater</h4>
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
                                <button class="add-to-cart-btn bg-[#b55b3d] hover:bg-[#a04f33] text-white text-[8px] sm:text-[9px] md:text-[10px] lg:text-xs font-semibold px-1.5 sm:px-2 py-0.5 sm:py-1 md:px-2.5 md:py-1 rounded-lg transition"
                                        data-product-id="105"
                                        data-product-name="Merino Wool Sweater"
                                        data-product-price="1299"
                                        data-product-image="{{ asset('images/Sweaters.png') }}"
                                        data-product-desc="High-quality merino wool sweater woven by local weavers."
                                        data-product-category="Artisan Weaves">
                                    Add
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Deal Card 2 -->
                    <div class="bg-white rounded-xl sm:rounded-2xl overflow-hidden shadow-sm border border-[#ebd7be]/40 hover:shadow-md transition group">
                        <div class="h-24 xs:h-28 sm:h-36 md:h-44 lg:h-48 overflow-hidden bg-slate-100 relative cursor-pointer view-details-btn"
                             data-id="106"
                             data-name="Bamboo Sunglasses"
                             data-price="899"
                             data-original-price="1124"
                             data-discount="true"
                             data-image="{{ asset('images/SunGlass.png') }}"
                             data-category="Eco Eyewear"
                             data-vendor="Eco Eyewear"
                             data-desc="Stylish sunglasses crafted from sustainable natural bamboo wood."
                             data-rating="4"
                             data-reviews="89"
                             data-stock="30">
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
                            <h4 class="text-[9px] sm:text-[10px] md:text-xs lg:text-sm font-bold text-brand-dark my-0.5 sm:my-1 line-clamp-2 cursor-pointer hover:text-brand-primary transition-colors view-details-btn"
                                data-id="106"
                                data-name="Bamboo Sunglasses"
                                data-price="899"
                                data-original-price="1124"
                                data-discount="true"
                                data-image="{{ asset('images/SunGlass.png') }}"
                                data-category="Eco Eyewear"
                                data-vendor="Eco Eyewear"
                                data-desc="Stylish sunglasses crafted from sustainable natural bamboo wood."
                                data-rating="4"
                                data-reviews="89"
                                data-stock="30">Bamboo Sunglasses</h4>
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
                                <button class="add-to-cart-btn bg-[#b55b3d] hover:bg-[#a04f33] text-white text-[8px] sm:text-[9px] md:text-[10px] lg:text-xs font-semibold px-1.5 sm:px-2 py-0.5 sm:py-1 md:px-2.5 md:py-1 rounded-lg transition"
                                        data-product-id="106"
                                        data-product-name="Bamboo Sunglasses"
                                        data-product-price="899"
                                        data-product-image="{{ asset('images/SunGlass.png') }}"
                                        data-product-desc="Stylish sunglasses crafted from sustainable natural bamboo wood."
                                        data-product-category="Eco Eyewear">
                                    Add
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Deal Card 3 -->
                    <div class="bg-white rounded-xl sm:rounded-2xl overflow-hidden shadow-sm border border-[#ebd7be]/40 hover:shadow-md transition group">
                        <div class="h-24 xs:h-28 sm:h-36 md:h-44 lg:h-48 overflow-hidden bg-slate-100 relative cursor-pointer view-details-btn"
                             data-id="107"
                             data-name="Teak Wood Side Table"
                             data-price="8999"
                             data-original-price="11249"
                             data-discount="true"
                             data-image="{{ asset('images/Table.png') }}"
                             data-category="Woodcraft"
                             data-vendor="Woodcraft Nepal"
                             data-desc="Sturdy, hand-crafted teak wood side table with rustic charm."
                             data-rating="4"
                             data-reviews="56"
                             data-stock="8">
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
                            <h4 class="text-[9px] sm:text-[10px] md:text-xs lg:text-sm font-bold text-brand-dark my-0.5 sm:my-1 line-clamp-2 cursor-pointer hover:text-brand-primary transition-colors view-details-btn"
                                data-id="107"
                                data-name="Teak Wood Side Table"
                                data-price="8999"
                                data-original-price="11249"
                                data-discount="true"
                                data-image="{{ asset('images/Table.png') }}"
                                data-category="Woodcraft"
                                data-vendor="Woodcraft Nepal"
                                data-desc="Sturdy, hand-crafted teak wood side table with rustic charm."
                                data-rating="4"
                                data-reviews="56"
                                data-stock="8">Teak Wood Side Table</h4>
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
                                <button class="add-to-cart-btn bg-[#b55b3d] hover:bg-[#a04f33] text-white text-[8px] sm:text-[9px] md:text-[10px] lg:text-xs font-semibold px-1.5 sm:px-2 py-0.5 sm:py-1 md:px-2.5 md:py-1 rounded-lg transition"
                                        data-product-id="107"
                                        data-product-name="Teak Wood Side Table"
                                        data-product-price="8999"
                                        data-product-image="{{ asset('images/Table.png') }}"
                                        data-product-desc="Sturdy, hand-crafted teak wood side table with rustic charm."
                                        data-product-category="Woodcraft">
                                    Add
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Deal Card 4 -->
                    <div class="bg-white rounded-xl sm:rounded-2xl overflow-hidden shadow-sm border border-[#ebd7be]/40 hover:shadow-md transition group">
                        <div class="h-24 xs:h-28 sm:h-36 md:h-44 lg:h-48 overflow-hidden bg-slate-100 relative cursor-pointer view-details-btn"
                             data-id="108"
                             data-name="Ceramic Bowl Set"
                             data-price="3499"
                             data-original-price="4374"
                             data-discount="true"
                             data-image="{{ asset('images/Pottery.png') }}"
                             data-category="Clay Studio"
                             data-vendor="Clay Studio Nepal"
                             data-desc="Set of handmade ceramic bowls, clay-fired and glazed by local potters."
                             data-rating="4"
                             data-reviews="203"
                             data-stock="12">
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
                            <h4 class="text-[9px] sm:text-[10px] md:text-xs lg:text-sm font-bold text-brand-dark my-0.5 sm:my-1 line-clamp-2 cursor-pointer hover:text-brand-primary transition-colors view-details-btn"
                                data-id="108"
                                data-name="Ceramic Bowl Set"
                                data-price="3499"
                                data-original-price="4374"
                                data-discount="true"
                                data-image="{{ asset('images/Pottery.png') }}"
                                data-category="Clay Studio"
                                data-vendor="Clay Studio Nepal"
                                data-desc="Set of handmade ceramic bowls, clay-fired and glazed by local potters."
                                data-rating="4"
                                data-reviews="203"
                                data-stock="12">Ceramic Bowl Set</h4>
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
                                <button class="add-to-cart-btn bg-[#b55b3d] hover:bg-[#a04f33] text-white text-[8px] sm:text-[9px] md:text-[10px] lg:text-xs font-semibold px-1.5 sm:px-2 py-0.5 sm:py-1 md:px-2.5 md:py-1 rounded-lg transition"
                                        data-product-id="108"
                                        data-product-name="Ceramic Bowl Set"
                                        data-product-price="3499"
                                        data-product-image="{{ asset('images/Pottery.png') }}"
                                        data-product-desc="Set of handmade ceramic bowls, clay-fired and glazed by local potters."
                                        data-product-category="Clay Studio">
                                    Add
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 5. Trending Now Section -->
        <section id="trending-now" class="max-w-7xl mx-auto px-4 sm:px-6 mb-12 sm:mb-16">
            <div class="bg-[#E5DCD0]/60 border border-[#ebd7be]/40 rounded-2xl sm:rounded-3xl p-4 sm:p-6 md:p-8 shadow-sm">
                
                <h3 class="text-xl sm:text-2xl md:text-3xl font-bold text-brand-dark flex items-center gap-2 mb-6">
                    <span>Trending Now</span>
                </h3>

                <!-- Grid: 3 columns on desktop, 1 on mobile -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6">
                    <!-- Trending Item 1 -->
                    <div class="flex items-center gap-3 sm:gap-4 bg-white p-3 sm:p-4 rounded-xl sm:rounded-2xl shadow-sm border border-[#ebd7be]/40 group transition">
                        <div class="w-12 h-12 sm:w-14 sm:h-14 md:w-16 md:h-16 rounded-lg sm:rounded-xl overflow-hidden shrink-0 bg-slate-100 cursor-pointer view-details-btn"
                             data-id="109"
                             data-name="Macrame Plant Hanger"
                             data-price="549"
                             data-original-price="549"
                             data-image="{{ asset('images/Sweaters.png') }}"
                             data-category="Home Decor"
                             data-vendor="Knot & Craft"
                             data-desc="Beautifully hand-knotted macrame plant hanger for indoor plants."
                             data-rating="4.8"
                             data-reviews="2300"
                             data-stock="50">
                            <img src="{{ asset('images/Sweaters.png') }}" alt="Trending product" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        </div>
                        <div class="flex-grow">
                            <h4 class="text-xs sm:text-sm md:text-base font-bold text-brand-dark group-hover:text-brand-primary transition-colors line-clamp-1 cursor-pointer view-details-btn"
                                data-id="109"
                                data-name="Macrame Plant Hanger"
                                data-price="549"
                                data-original-price="549"
                                data-image="{{ asset('images/Sweaters.png') }}"
                                data-category="Home Decor"
                                data-vendor="Knot & Craft"
                                data-desc="Beautifully hand-knotted macrame plant hanger for indoor plants."
                                data-rating="4.8"
                                data-reviews="2300"
                                data-stock="50">Macrame Plant Hanger</h4>
                            <span class="text-brand-primary font-bold text-xs sm:text-sm">Rs. 549</span>
                            <div class="flex items-center gap-1 text-[9px] sm:text-xs text-amber-500 font-semibold mt-0.5">
                                <i class="fa-solid fa-star"></i>
                                <span>4.8</span>
                                <span class="text-slate-400 ml-0.5 sm:ml-1 hidden xs:inline">(2.3k sold)</span>
                            </div>
                        </div>
                        <button class="add-to-cart-btn shrink-0 bg-[#b55b3d] hover:bg-[#a04f33] text-white text-[9px] sm:text-xs font-semibold px-2 py-1 sm:px-3 sm:py-1.5 rounded-lg transition"
                                data-product-id="109"
                                data-product-name="Macrame Plant Hanger"
                                data-product-price="549"
                                data-product-image="{{ asset('images/Sweaters.png') }}"
                                data-product-desc="Beautifully hand-knotted macrame plant hanger for indoor plants."
                                data-product-category="Home Decor">
                            Add
                        </button>
                    </div>

                    <!-- Trending Item 2 -->
                    <div class="flex items-center gap-3 sm:gap-4 bg-white p-3 sm:p-4 rounded-xl sm:rounded-2xl shadow-sm border border-[#ebd7be]/40 group transition">
                        <div class="w-12 h-12 sm:w-14 sm:h-14 md:w-16 md:h-16 rounded-lg sm:rounded-xl overflow-hidden shrink-0 bg-slate-100 cursor-pointer view-details-btn"
                             data-id="110"
                             data-name="Handloom Cotton Scarf"
                             data-price="799"
                             data-original-price="799"
                             data-image="{{ asset('images/SunGlass.png') }}"
                             data-category="Textile"
                             data-vendor="Handloom House"
                             data-desc="Soft and lightweight handloom cotton scarf with vibrant traditional patterns."
                             data-rating="4.7"
                             data-reviews="1800"
                             data-stock="40">
                            <img src="{{ asset('images/SunGlass.png') }}" alt="Trending product" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        </div>
                        <div class="flex-grow">
                            <h4 class="text-xs sm:text-sm md:text-base font-bold text-brand-dark group-hover:text-brand-primary transition-colors line-clamp-1 cursor-pointer view-details-btn"
                                data-id="110"
                                data-name="Handloom Cotton Scarf"
                                data-price="799"
                                data-original-price="799"
                                data-image="{{ asset('images/SunGlass.png') }}"
                                data-category="Textile"
                                data-vendor="Handloom House"
                                data-desc="Soft and lightweight handloom cotton scarf with vibrant traditional patterns."
                                data-rating="4.7"
                                data-reviews="1800"
                                data-stock="40">Handloom Cotton Scarf</h4>
                            <span class="text-brand-primary font-bold text-xs sm:text-sm">Rs. 799</span>
                            <div class="flex items-center gap-1 text-[9px] sm:text-xs text-amber-500 font-semibold mt-0.5">
                                <i class="fa-solid fa-star"></i>
                                <span>4.7</span>
                                <span class="text-slate-400 ml-0.5 sm:ml-1 hidden xs:inline">(1.8k sold)</span>
                            </div>
                        </div>
                        <button class="add-to-cart-btn shrink-0 bg-[#b55b3d] hover:bg-[#a04f33] text-white text-[9px] sm:text-xs font-semibold px-2 py-1 sm:px-3 sm:py-1.5 rounded-lg transition"
                                data-product-id="110"
                                data-product-name="Handloom Cotton Scarf"
                                data-product-price="799"
                                data-product-image="{{ asset('images/SunGlass.png') }}"
                                data-product-desc="Soft and lightweight handloom cotton scarf with vibrant traditional patterns."
                                data-product-category="Textile">
                            Add
                        </button>
                    </div>

                    <!-- Trending Item 3 -->
                    <div class="flex items-center gap-3 sm:gap-4 bg-white p-3 sm:p-4 rounded-xl sm:rounded-2xl shadow-sm border border-[#ebd7be]/40 group transition">
                        <div class="w-12 h-12 sm:w-14 sm:h-14 md:w-16 md:h-16 rounded-lg sm:rounded-xl overflow-hidden shrink-0 bg-slate-100 cursor-pointer view-details-btn"
                             data-id="111"
                             data-name="Hand-Painted Coaster Set"
                             data-price="349"
                             data-original-price="349"
                             data-image="{{ asset('images/Table.png') }}"
                             data-category="Home Decor"
                             data-vendor="Patan Artisans"
                             data-desc="Set of 4 beautifully hand-painted wooden coasters with traditional Nepali art."
                             data-rating="4.9"
                             data-reviews="3100"
                             data-stock="60">
                            <img src="{{ asset('images/Table.png') }}" alt="Trending product" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        </div>
                        <div class="flex-grow">
                            <h4 class="text-xs sm:text-sm md:text-base font-bold text-brand-dark group-hover:text-brand-primary transition-colors line-clamp-1 cursor-pointer view-details-btn"
                                data-id="111"
                                data-name="Hand-Painted Coaster Set"
                                data-price="349"
                                data-original-price="349"
                                data-image="{{ asset('images/Table.png') }}"
                                data-category="Home Decor"
                                data-vendor="Patan Artisans"
                                data-desc="Set of 4 beautifully hand-painted wooden coasters with traditional Nepali art."
                                data-rating="4.9"
                                data-reviews="3100"
                                data-stock="60">Hand-Painted Coaster Set</h4>
                            <span class="text-brand-primary font-bold text-xs sm:text-sm">Rs. 349</span>
                            <div class="flex items-center gap-1 text-[9px] sm:text-xs text-amber-500 font-semibold mt-0.5">
                                <i class="fa-solid fa-star"></i>
                                <span>4.9</span>
                                <span class="text-slate-400 ml-0.5 sm:ml-1 hidden xs:inline">(3.1k sold)</span>
                            </div>
                        </div>
                        <button class="add-to-cart-btn shrink-0 bg-[#b55b3d] hover:bg-[#a04f33] text-white text-[9px] sm:text-xs font-semibold px-2 py-1 sm:px-3 sm:py-1.5 rounded-lg transition"
                                data-product-id="111"
                                data-product-name="Hand-Painted Coaster Set"
                                data-product-price="349"
                                data-product-image="{{ asset('images/Table.png') }}"
                                data-product-desc="Set of 4 beautifully hand-painted wooden coasters with traditional Nepali art."
                                data-product-category="Home Decor">
                            Add
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- 6. Top Sellers Section - 3 COLUMNS ON MOBILE -->
        <section id="top-sellers" class="max-w-7xl mx-auto px-4 sm:px-6 mb-12 sm:mb-20">
            <div class="bg-[#E5DCD0]/60 border border-[#ebd7be]/40 rounded-2xl sm:rounded-3xl p-3 sm:p-4 md:p-6 lg:p-10 shadow-sm">
                
                <div class="flex items-center justify-between mb-4 sm:mb-5 md:mb-6 lg:mb-8">
                    <h3 class="text-xl sm:text-2xl md:text-3xl font-bold text-brand-dark flex items-center gap-2">
                        <span>Top Sellers</span>
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
                        <div class="h-24 xs:h-28 sm:h-36 md:h-44 lg:h-48 overflow-hidden bg-slate-100 relative cursor-pointer view-details-btn"
                             data-id="116"
                             data-name="Heritage Wool Blanket"
                             data-price="6999"
                             data-original-price="6999"
                             data-image="{{ asset('images/Sweaters.png') }}"
                             data-category="The Wool Studio"
                             data-vendor="The Wool Studio"
                             data-desc="Beautiful heritage wool blanket woven with traditional motifs."
                             data-rating="4"
                             data-reviews="892"
                             data-stock="15">
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
                            <h4 class="text-[9px] sm:text-[10px] md:text-xs lg:text-sm font-bold text-brand-dark my-0.5 sm:my-1 line-clamp-2 cursor-pointer hover:text-brand-primary transition-colors view-details-btn"
                                data-id="116"
                                data-name="Heritage Wool Blanket"
                                data-price="6999"
                                data-original-price="6999"
                                data-image="{{ asset('images/Sweaters.png') }}"
                                data-category="The Wool Studio"
                                data-vendor="The Wool Studio"
                                data-desc="Beautiful heritage wool blanket woven with traditional motifs."
                                data-rating="4"
                                data-reviews="892"
                                data-stock="15">Heritage Wool Blanket</h4>
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
                                <button class="add-to-cart-btn bg-[#b55b3d] hover:bg-[#a04f33] text-white text-[8px] sm:text-[9px] md:text-[10px] lg:text-xs font-semibold px-1.5 sm:px-2 py-0.5 sm:py-1 md:px-2.5 md:py-1 rounded-lg transition"
                                        data-product-id="116"
                                        data-product-name="Heritage Wool Blanket"
                                        data-product-price="6999"
                                        data-product-image="{{ asset('images/Sweaters.png') }}"
                                        data-product-desc="Beautiful heritage wool blanket woven with traditional motifs."
                                        data-product-category="The Wool Studio"
                                        data-product-tag="Best">
                                    Add
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Seller Card 2 -->
                    <div class="bg-white rounded-xl sm:rounded-2xl overflow-hidden shadow-sm border border-[#ebd7be]/40 hover:shadow-md transition group">
                        <div class="h-24 xs:h-28 sm:h-36 md:h-44 lg:h-48 overflow-hidden bg-slate-100 relative cursor-pointer view-details-btn"
                             data-id="117"
                             data-name="Labradorite Pendant"
                             data-price="3299"
                             data-original-price="3299"
                             data-image="{{ asset('images/SunGlass.png') }}"
                             data-category="Gem & Co."
                             data-vendor="Gem & Co."
                             data-desc="Stunning handcrafted labradorite gemstone pendant set in sterling silver."
                             data-rating="4"
                             data-reviews="654"
                             data-stock="22">
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
                            <span class="text-slate-400 font-semibold text-[7px] sm:text-[8px] md:text-[9px] lg:text-[10px] uppercase tracking-wider truncate block">Gem &amp; Co.</span>
                            <h4 class="text-[9px] sm:text-[10px] md:text-xs lg:text-sm font-bold text-brand-dark my-0.5 sm:my-1 line-clamp-2 cursor-pointer hover:text-brand-primary transition-colors view-details-btn"
                                data-id="117"
                                data-name="Labradorite Pendant"
                                data-price="3299"
                                data-original-price="3299"
                                data-image="{{ asset('images/SunGlass.png') }}"
                                data-category="Gem & Co."
                                data-vendor="Gem & Co."
                                data-desc="Stunning handcrafted labradorite gemstone pendant set in sterling silver."
                                data-rating="4"
                                data-reviews="654"
                                data-stock="22">Labradorite Pendant</h4>
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
                                <button class="add-to-cart-btn bg-[#b55b3d] hover:bg-[#a04f33] text-white text-[8px] sm:text-[9px] md:text-[10px] lg:text-xs font-semibold px-1.5 sm:px-2 py-0.5 sm:py-1 md:px-2.5 md:py-1 rounded-lg transition"
                                        data-product-id="117"
                                        data-product-name="Labradorite Pendant"
                                        data-product-price="3299"
                                        data-product-image="{{ asset('images/SunGlass.png') }}"
                                        data-product-desc="Stunning handcrafted labradorite gemstone pendant set in sterling silver."
                                        data-product-category="Gem & Co.">
                                    Add
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Seller Card 3 -->
                    <div class="bg-white rounded-xl sm:rounded-2xl overflow-hidden shadow-sm border border-[#ebd7be]/40 hover:shadow-md transition group">
                        <div class="h-24 xs:h-28 sm:h-36 md:h-44 lg:h-48 overflow-hidden bg-slate-100 relative cursor-pointer view-details-btn"
                             data-id="118"
                             data-name="Reclaimed Wood Shelf"
                             data-price="15999"
                             data-original-price="15999"
                             data-image="{{ asset('images/Table.png') }}"
                             data-category="Urban Rustic"
                             data-vendor="Urban Rustic"
                             data-desc="Sturdy, rustic wooden wall shelf hand-made from reclaimed Nepalese timber."
                             data-rating="4"
                             data-reviews="423"
                             data-stock="7">
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
                            <h4 class="text-[9px] sm:text-[10px] md:text-xs lg:text-sm font-bold text-brand-dark my-0.5 sm:my-1 line-clamp-2 cursor-pointer hover:text-brand-primary transition-colors view-details-btn"
                                data-id="118"
                                data-name="Reclaimed Wood Shelf"
                                data-price="15999"
                                data-original-price="15999"
                                data-image="{{ asset('images/Table.png') }}"
                                data-category="Urban Rustic"
                                data-vendor="Urban Rustic"
                                data-desc="Sturdy, rustic wooden wall shelf hand-made from reclaimed Nepalese timber."
                                data-rating="4"
                                data-reviews="423"
                                data-stock="7">Reclaimed Wood Shelf</h4>
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
                                <button class="add-to-cart-btn bg-[#b55b3d] hover:bg-[#a04f33] text-white text-[8px] sm:text-[9px] md:text-[10px] lg:text-xs font-semibold px-1.5 sm:px-2 py-0.5 sm:py-1 md:px-2.5 md:py-1 rounded-lg transition"
                                        data-product-id="118"
                                        data-product-name="Reclaimed Wood Shelf"
                                        data-product-price="15999"
                                        data-product-image="{{ asset('images/Table.png') }}"
                                        data-product-desc="Sturdy, rustic wooden wall shelf hand-made from reclaimed Nepalese timber."
                                        data-product-category="Urban Rustic">
                                    Add
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Seller Card 4 -->
                    <div class="bg-white rounded-xl sm:rounded-2xl overflow-hidden shadow-sm border border-[#ebd7be]/40 hover:shadow-md transition group">
                        <div class="h-24 xs:h-28 sm:h-36 md:h-44 lg:h-48 overflow-hidden bg-slate-100 relative cursor-pointer view-details-btn"
                             data-id="119"
                             data-name="Raku Fired Vase"
                             data-price="4499"
                             data-original-price="4499"
                             data-image="{{ asset('images/Pottery.png') }}"
                             data-category="Earth & Clay"
                             data-vendor="Earth & Clay"
                             data-desc="Exquisite raku-fired pottery vase with metallic glaze finish."
                             data-rating="4"
                             data-reviews="567"
                             data-stock="18">
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
                            <span class="text-slate-400 font-semibold text-[7px] sm:text-[8px] md:text-[9px] lg:text-[10px] uppercase tracking-wider truncate block">Earth &amp; Clay</span>
                            <h4 class="text-[9px] sm:text-[10px] md:text-xs lg:text-sm font-bold text-brand-dark my-0.5 sm:my-1 line-clamp-2 cursor-pointer hover:text-brand-primary transition-colors view-details-btn"
                                data-id="119"
                                data-name="Raku Fired Vase"
                                data-price="4499"
                                data-original-price="4499"
                                data-image="{{ asset('images/Pottery.png') }}"
                                data-category="Earth & Clay"
                                data-vendor="Earth & Clay"
                                data-desc="Exquisite raku-fired pottery vase with metallic glaze finish."
                                data-rating="4"
                                data-reviews="567"
                                data-stock="18">Raku Fired Vase</h4>
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
                                <button class="add-to-cart-btn bg-[#b55b3d] hover:bg-[#a04f33] text-white text-[8px] sm:text-[9px] md:text-[10px] lg:text-xs font-semibold px-1.5 sm:px-2 py-0.5 sm:py-1 md:px-2.5 md:py-1 rounded-lg transition"
                                        data-product-id="119"
                                        data-product-name="Raku Fired Vase"
                                        data-product-price="4499"
                                        data-product-image="{{ asset('images/Pottery.png') }}"
                                        data-product-desc="Exquisite raku-fired pottery vase with metallic glaze finish."
                                        data-product-category="Earth & Clay">
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