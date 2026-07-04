@vite('resources/js/today-deals.js')
<x-frontend-layout>

    <main class="bg-[#f7fafc] min-h-screen">
        <!-- Hero Section -->
        <section class="bg-gradient-to-r from-[#d93537] to-[#ff6b5b] text-white py-16 px-4 md:px-8 lg:px-16">
            <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <span
                        class="inline-block bg-white bg-opacity-20 text-black text-xs font-bold px-3 py-1 rounded-full mb-4">LIMITED
                        TIME OFFER</span>
                    <h1
                        class="text-[30px] md:text-[24px] font-bold leading-[38px] md:leading-[30px] tracking-[-0.02em] mb-4 font-['Plus_Jakarta_Sans']">
                        Authentic Nepali Heritage</h1>
                    <p class="text-white text-opacity-90 text-base leading-6 mb-6">Experience the pinnacle of Nepalese
                        craftsmanship with our exclusive artisanal collection. Up to 60% off for the next 24 hours.</p>

                    <!-- Countdown Timer -->
                    <div id="deal-countdown" data-ends-at="{{ $dealEndsAt }}" class="flex gap-6 mb-8 font-['Plus_Jakarta_Sans']">
                        <div class="text-center">
                            <div id="countdown-hours" class="text-3xl font-bold">00</div>
                            <div class="text-xs font-semibold text-white text-opacity-80 uppercase">
                                Hours
                            </div>
                        </div>

                        <span class="text-2xl font-bold">:</span>

                        <div class="text-center">
                            <div id="countdown-minutes" class="text-3xl font-bold">00</div>
                            <div class="text-xs font-semibold text-white text-opacity-80 uppercase">
                                Mins
                            </div>
                        </div>

                        <span class="text-2xl font-bold">:</span>

                        <div class="text-center">
                            <div id="countdown-seconds" class="text-3xl font-bold">00</div>
                            <div class="text-xs font-semibold text-white text-opacity-80 uppercase">
                                Secs
                            </div>
                        </div>
                    </div>


                    <button
                        class="bg-white text-[#d93537] font-bold px-8 py-3 rounded-full hover:bg-opacity-90 transition font-['Plus_Jakarta_Sans']">Shop
                        The Drop</button>
                </div>

                <div class="flex justify-center">
                    <img src="{{ asset('images/Pottery.png') }}" alt="Authentic Nepali Heritage"
                        class="max-w-md rounded-2xl shadow-lg">
                </div>
            </div>
        </section>

        <!-- Lightning Deals Section -->
        <section class="py-12 px-4 md:px-8 lg:px-16">
            <div class="max-w-7xl mx-auto">
                <div class="flex justify-between items-center mb-8">
                    <div class="flex items-center gap-3">
                        <span class="text-2xl">Alart</span>
                        <h2 class="text-2xl font-bold text-[#181c1e] font-['Plus_Jakarta_Sans']">Today's Deals</h2>
                    </div>
                </div>

                <!-- Filter Controls -->
                <div class="bg-white rounded-lg border border-[#e0e3e5] p-6 mb-8">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                        <!-- Category Filter -->
                        <div>
                            <span class="text-xs font-bold uppercase tracking-wider text-[#181c1e] block mb-3">Filter by
                                Category</span>
                            <div class="flex flex-wrap gap-2" id="category-filters">
                                <button data-category="all"
                                    class="filter-pill px-4 py-2 border border-[#b51822] text-[#181c1e] text-xs font-bold rounded-full hover:bg-[#b51822] hover:text-white transition active">
                                    All Categories
                                </button>
                                @if (isset($categories))
                                    @foreach ($categories as $cat)
                                        <button data-category="{{ strtolower($cat) }}"
                                            class="filter-pill px-4 py-2 border border-[#e0e3e5] text-[#181c1e] text-xs font-bold rounded-full hover:border-[#b51822] transition">
                                            {{ $cat }}
                                        </button>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <!-- Sort -->
                        <div class="flex items-center gap-3">
                            <span class="text-xs font-bold uppercase tracking-wider text-[#181c1e]">Sort By:</span>
                            <select id="sort-select"
                                class="border border-[#e0e3e5] rounded-lg px-4 py-2 text-sm font-semibold text-[#181c1e] focus:outline-none focus:ring-2 focus:ring-[#b51822]">
                                <option value="discount">Biggest Discount</option>
                                <option value="price-asc">Price: Low to High</option>
                                <option value="price-desc">Price: High to Low</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Product Grid -->
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6" id="product-grid">
                    @if (isset($products) && $products->count() > 0)
                        @foreach ($products as $product)
                            @php
                                $price = $product->price;
                                $discountPrice = $product->discount_price ?? null;
                                $hasDiscount = !is_null($discountPrice) && $discountPrice < $price;
                                $displayPrice = $hasDiscount ? $discountPrice : $price;
                                $discountPercentage = $hasDiscount
                                    ? round((($price - $discountPrice) / $price) * 100)
                                    : 0;
                            @endphp
                            <div class="bg-white rounded-[16px] border border-[#e0e3e5] overflow-hidden hover:shadow-lg transition-all product-card"
                                data-id="{{ $product->id }}" data-name="{{ $product->name }}"
                                data-price="{{ $displayPrice }}"
                                data-category="{{ strtolower($product->category->cat_name ?? '') }}"
                                data-discount="{{ $discountPercentage }}">
                                <div class="relative aspect-square bg-gray-200 overflow-hidden">
                                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                                        class="w-full h-full object-cover hover:scale-105 transition duration-300">
                                    @if ($hasDiscount)
                                        <span
                                            class="absolute top-3 left-3 bg-[#b51822] text-white text-xs font-bold px-3 py-1 rounded-full">-{{ $discountPercentage }}%
                                            OFF</span>
                                    @endif
                                </div>
                                <div class="p-4">
                                    <h3
                                        class="font-bold text-[16px] leading-6 text-[#181c1e] mb-2 font-['Plus_Jakarta_Sans'] line-clamp-2">
                                        {{ $product->name }}</h3>
                                    <p class="text-[22px] font-bold text-[#b51822] mb-1 font-['Plus_Jakarta_Sans']">Rs.
                                        {{ number_format($displayPrice) }}</p>
                                    @if ($hasDiscount)
                                        <p class="text-sm text-[#5b403e] line-through mb-2">Rs.
                                            {{ number_format($price) }}</p>
                                    @endif
                                    <div class="flex items-center gap-1 mb-4">
                                        <span class="text-yellow-400">★★★★★</span>
                                        <span class="text-xs text-[#5b403e]">({{ $product->reviews_count ?? 0 }}
                                            Reviews)</span>
                                    </div>
                                    <div class="flex gap-2">
                                        <button
                                            class="flex-1 bg-[#b51822] text-white py-2 rounded-lg font-semibold hover:bg-[#930013] transition text-sm view-details-btn"
                                            data-name="{{ $product->name }}" data-price="{{ $displayPrice }}"
                                            data-original-price="{{ $price }}"
                                            data-image="{{ asset($product->image) }}"
                                            data-category="{{ $product->category->cat_name ?? '' }}"
                                            data-vendor="{{ $product->vendor->vendor_name ?? 'Local Artisan' }}"
                                            data-desc="{{ $product->description }}"
                                            data-rating="{{ $product->rating ?? 5 }}"
                                            data-reviews="{{ $product->reviews_count ?? 0 }}"
                                            data-stock="{{ $product->stock ?? 10 }}">
                                            View Details
                                        </button>
                                        <button
                                            class="px-3 py-2 border border-[#e0e3e5] rounded-lg hover:bg-[#ebeef0] transition">...</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-span-full text-center py-12">
                            <p class="text-[#5b403e] text-lg">No products available</p>
                        </div>
                    @endif
                </div>
            </div>
        </section>

        <!-- Featured Star Deal Carousel Section -->
        <section class="bg-[#2d3133] text-white py-16 px-4 md:px-8 lg:px-16">
            <div class="max-w-7xl mx-auto">
                <div class="flex justify-between items-center mb-8">
                    <div class="flex items-center gap-2">
                        <span class="text-xl">⭐</span>
                        <h2 class="text-2xl font-bold font-['Plus_Jakarta_Sans']">Featured Star Deals</h2>
                    </div>
                    <div class="flex gap-3">
                        <button id="featured-prev"
                            class="p-2 border border-white rounded-lg hover:bg-white hover:text-[#2d3133] transition">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button id="featured-next"
                            class="p-2 border border-white rounded-lg hover:bg-white hover:text-[#2d3133] transition">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>

                <!-- Carousel Container -->
                <div class="relative overflow-hidden">
                    <div id="featured-carousel" class="flex gap-6 transition-transform duration-500 ease-out">
                        <!-- Featured Product 1 -->
                        <div class="featured-card flex-shrink-0 w-full">
                            <div class="grid md:grid-cols-2 gap-6 items-center bg-[#1a1a1a] rounded-2xl p-6">
                                <div class="flex justify-center">
                                    <img src="{{ asset('images/Pottery.png') }}" alt="Hand-Knotted Wool Mandala Rug"
                                        class="w-full max-w-xs rounded-lg">
                                </div>
                                <div>
                                    <span
                                        class="inline-block bg-white bg-opacity-20 text-black text-xs font-bold px-3 py-1 rounded-full mb-3">FEATURED</span>
                                    <h3 class="text-2xl font-bold mb-3 font-['Plus_Jakarta_Sans']">Hand-Knotted Wool
                                        Mandala Rug</h3>
                                    <p class="text-white text-opacity-80 text-sm leading-6 mb-4">Exquisite hand-knotted
                                        wool rug featuring traditional mandala patterns. A masterpiece of Nepalese
                                        weaving heritage.</p>
                                    <p class="text-sm text-white text-opacity-70 mb-1">Regularly Rs. 65,000</p>
                                    <p class="text-4xl font-bold mb-4 font-['Plus_Jakarta_Sans']">Rs. 45,000</p>
                                    <div class="flex gap-3">
                                        <button
                                            class="bg-[#d4a017] hover:bg-[#b38a0a] text-black font-bold px-6 py-2 rounded-full transition flex items-center gap-2 font-['Plus_Jakarta_Sans'] text-sm">
                                            Buy Now <span>→</span>
                                        </button>
                                        <button
                                            class="border border-white text-white font-bold px-6 py-2 rounded-full hover:bg-white hover:text-[#2d3133] transition text-sm">Details</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Featured Product 2 -->
                        <div class="featured-card flex-shrink-0 w-full">
                            <div class="grid md:grid-cols-2 gap-6 items-center bg-[#1a1a1a] rounded-2xl p-6">
                                <div class="flex justify-center">
                                    <img src="{{ asset('images/Pottery.png') }}" alt="Traditional Dhaka Textile"
                                        class="w-full max-w-xs rounded-lg">
                                </div>
                                <div>
                                    <span
                                        class="inline-block bg-white bg-opacity-20 text-black text-xs font-bold px-3 py-1 rounded-full mb-3">FEATURED</span>
                                    <h3 class="text-2xl font-bold mb-3 font-['Plus_Jakarta_Sans']">Traditional Dhaka
                                        Textile</h3>
                                    <p class="text-white text-opacity-80 text-sm leading-6 mb-4">Authentic handwoven
                                        Dhaka fabric with intricate traditional patterns, perfect for traditional
                                        clothing.</p>
                                    <p class="text-sm text-white text-opacity-70 mb-1">Regularly Rs. 20,600</p>
                                    <p class="text-4xl font-bold mb-4 font-['Plus_Jakarta_Sans']">Rs. 12,400</p>
                                    <div class="flex gap-3">
                                        <button
                                            class="bg-[#d4a017] hover:bg-[#b38a0a] text-black font-bold px-6 py-2 rounded-full transition flex items-center gap-2 font-['Plus_Jakarta_Sans'] text-sm">
                                            Buy Now <span>→</span>
                                        </button>
                                        <button
                                            class="border border-white text-white font-bold px-6 py-2 rounded-full hover:bg-white hover:text-[#2d3133] transition text-sm">Details</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Featured Product 3 -->
                        <div class="featured-card flex-shrink-0 w-full">
                            <div class="grid md:grid-cols-2 gap-6 items-center bg-[#1a1a1a] rounded-2xl p-6">
                                <div class="flex justify-center">
                                    <img src="{{ asset('images/Pottery.png') }}" alt="Himalayan Salt Lamp"
                                        class="w-full max-w-xs rounded-lg">
                                </div>
                                <div>
                                    <span
                                        class="inline-block bg-white bg-opacity-20 text-black text-xs font-bold px-3 py-1 rounded-full mb-3">FEATURED</span>
                                    <h3 class="text-2xl font-bold mb-3 font-['Plus_Jakarta_Sans']">Himalayan Salt Lamp
                                    </h3>
                                    <p class="text-white text-opacity-80 text-sm leading-6 mb-4">Premium natural
                                        Himalayan salt lamp that creates a warm ambiance and promotes wellness in your
                                        home.</p>
                                    <p class="text-sm text-white text-opacity-70 mb-1">Regularly Rs. 2,300</p>
                                    <p class="text-4xl font-bold mb-4 font-['Plus_Jakarta_Sans']">Rs. 1,850</p>
                                    <div class="flex gap-3">
                                        <button
                                            class="bg-[#d4a017] hover:bg-[#b38a0a] text-black font-bold px-6 py-2 rounded-full transition flex items-center gap-2 font-['Plus_Jakarta_Sans'] text-sm">
                                            Buy Now <span>→</span>
                                        </button>
                                        <button
                                            class="border border-white text-white font-bold px-6 py-2 rounded-full hover:bg-white hover:text-[#2d3133] transition text-sm">Details</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Featured Product 4 -->
                        <div class="featured-card flex-shrink-0 w-full">
                            <div class="grid md:grid-cols-2 gap-6 items-center bg-[#1a1a1a] rounded-2xl p-6">
                                <div class="flex justify-center">
                                    <img src="{{ asset('images/Pottery.png') }}" alt="Silver Filigree Jewelry"
                                        class="w-full max-w-xs rounded-lg">
                                </div>
                                <div>
                                    <span
                                        class="inline-block bg-white bg-opacity-20 text-black text-xs font-bold px-3 py-1 rounded-full mb-3">FEATURED</span>
                                    <h3 class="text-2xl font-bold mb-3 font-['Plus_Jakarta_Sans']">Silver Filigree
                                        Jewelry Set</h3>
                                    <p class="text-white text-opacity-80 text-sm leading-6 mb-4">Exquisite handcrafted
                                        silver filigree jewelry set showcasing traditional Nepalese metalwork artistry.
                                    </p>
                                    <p class="text-sm text-white text-opacity-70 mb-1">Regularly Rs. 4,500</p>
                                    <p class="text-4xl font-bold mb-4 font-['Plus_Jakarta_Sans']">Rs. 3,200</p>
                                    <div class="flex gap-3">
                                        <button
                                            class="bg-[#d4a017] hover:bg-[#b38a0a] text-black font-bold px-6 py-2 rounded-full transition flex items-center gap-2 font-['Plus_Jakarta_Sans'] text-sm">
                                            Buy Now <span>→</span>
                                        </button>
                                        <button
                                            class="border border-white text-white font-bold px-6 py-2 rounded-full hover:bg-white hover:text-[#2d3133] transition text-sm">Details</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Featured Product 5 -->
                        <div class="featured-card flex-shrink-0 w-full">
                            <div class="grid md:grid-cols-2 gap-6 items-center bg-[#1a1a1a] rounded-2xl p-6">
                                <div class="flex justify-center">
                                    <img src="{{ asset('images/Pottery.png') }}" alt="Botanical Brass Candle"
                                        class="w-full max-w-xs rounded-lg">
                                </div>
                                <div>
                                    <span
                                        class="inline-block bg-white bg-opacity-20 text-white text-xs font-bold px-3 py-1 rounded-full mb-3">FEATURED</span>
                                    <h3 class="text-2xl font-bold mb-3 font-['Plus_Jakarta_Sans']">Botanical Brass
                                        Candle</h3>
                                    <p class="text-white text-opacity-80 text-sm leading-6 mb-4">Hand-poured botanical
                                        candle in an elegant brass holder, perfect for creating a luxurious atmosphere.
                                    </p>
                                    <p class="text-sm text-white text-opacity-70 mb-1">Regularly Rs. 1,500</p>
                                    <p class="text-4xl font-bold mb-4 font-['Plus_Jakarta_Sans']">Rs. 950</p>
                                    <div class="flex gap-3">
                                        <button
                                            class="bg-[#d4a017] hover:bg-[#b38a0a] text-black font-bold px-6 py-2 rounded-full transition flex items-center gap-2 font-['Plus_Jakarta_Sans'] text-sm">
                                            Buy Now <span>→</span>
                                        </button>
                                        <button
                                            class="border border-white text-white font-bold px-6 py-2 rounded-full hover:bg-white hover:text-[#2d3133] transition text-sm">Details</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Trending Now Section -->
        <section class="py-16 px-4 md:px-8 lg:px-16">
            <div class="max-w-7xl mx-auto">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-2xl font-bold text-[#181c1e] flex items-center gap-2 font-['Plus_Jakarta_Sans']">
                        <span class="text-2xl">📈</span> Trending Now
                    </h2>
                    <div class="flex gap-3">
                        <button id="trending-prev"
                            class="p-2 border border-[#e0e3e5] rounded-lg hover:bg-[#ebeef0] transition">
                            <i class="fas fa-chevron-left text-[#181c1e]"></i>
                        </button>
                        <button id="trending-next"
                            class="p-2 border border-[#e0e3e5] rounded-lg hover:bg-[#ebeef0] transition">
                            <i class="fas fa-chevron-right text-[#181c1e]"></i>
                        </button>
                    </div>
                </div>

                <!-- Trending Carousel -->
                <div class="relative overflow-hidden">
                    <div id="trending-carousel" class="flex gap-6 transition-transform duration-500 ease-out">
                        <!-- Trending Product 1 -->
                        <div class="trending-card flex-shrink-0 w-full md:w-1/2 lg:w-1/4">
                            <div
                                class="bg-white rounded-[16px] border border-[#e0e3e5] overflow-hidden hover:shadow-lg transition-all">
                                <div class="aspect-square bg-gray-200 flex items-center justify-center">
                                    <img src="{{ asset('images/Pottery.png') }}" alt="Silver Filigree Jewelry Set"
                                        class="w-full h-full object-cover">
                                </div>
                                <div class="p-4">
                                    <span
                                        class="text-xs font-bold text-[#b51822] uppercase tracking-widest">Accessories</span>
                                    <h3 class="font-bold text-[16px] text-[#181c1e] mb-2 font-['Plus_Jakarta_Sans']">
                                        Silver Filigree Jewelry Set</h3>
                                    <p class="text-[22px] font-bold text-[#181c1e] font-['Plus_Jakarta_Sans']">Rs.
                                        3,200</p>
                                </div>
                            </div>
                        </div>

                        <!-- Trending Product 2 -->
                        <div class="trending-card flex-shrink-0 w-full md:w-1/2 lg:w-1/4">
                            <div
                                class="bg-white rounded-[16px] border border-[#e0e3e5] overflow-hidden hover:shadow-lg transition-all">
                                <div class="aspect-square bg-gray-200 flex items-center justify-center">
                                    <img src="{{ asset('images/Pottery.png') }}" alt="Botanical Brass Candle"
                                        class="w-full h-full object-cover">
                                </div>
                                <div class="p-4">
                                    <span class="text-xs font-bold text-[#b51822] uppercase tracking-widest">Home
                                        Decor</span>
                                    <h3 class="font-bold text-[16px] text-[#181c1e] mb-2 font-['Plus_Jakarta_Sans']">
                                        Botanical Brass Candle</h3>
                                    <p class="text-[22px] font-bold text-[#181c1e] font-['Plus_Jakarta_Sans']">Rs. 950
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Trending Product 3 -->
                        <div class="trending-card flex-shrink-0 w-full md:w-1/2 lg:w-1/4">
                            <div
                                class="bg-white rounded-[16px] border border-[#e0e3e5] overflow-hidden hover:shadow-lg transition-all">
                                <div class="aspect-square bg-gray-200 flex items-center justify-center">
                                    <img src="{{ asset('images/Pottery.png') }}" alt="Carved Wooden Deity Mask"
                                        class="w-full h-full object-cover">
                                </div>
                                <div class="p-4">
                                    <span class="text-xs font-bold text-[#b51822] uppercase tracking-widest">Art</span>
                                    <h3 class="font-bold text-[16px] text-[#181c1e] mb-2 font-['Plus_Jakarta_Sans']">
                                        Carved Wooden Deity Mask</h3>
                                    <p class="text-[22px] font-bold text-[#181c1e] font-['Plus_Jakarta_Sans']">Rs.
                                        1,600</p>
                                </div>
                            </div>
                        </div>

                        <!-- Trending Product 4 -->
                        <div class="trending-card flex-shrink-0 w-full md:w-1/2 lg:w-1/4">
                            <div
                                class="bg-white rounded-[16px] border border-[#e0e3e5] overflow-hidden hover:shadow-lg transition-all">
                                <div class="aspect-square bg-gray-200 flex items-center justify-center">
                                    <img src="{{ asset('images/Pottery.png') }}" alt="Organic Clay Bowls"
                                        class="w-full h-full object-cover">
                                </div>
                                <div class="p-4">
                                    <span
                                        class="text-xs font-bold text-[#b51822] uppercase tracking-widest">Pottery</span>
                                    <h3 class="font-bold text-[16px] text-[#181c1e] mb-2 font-['Plus_Jakarta_Sans']">
                                        Organic Clay Bowls</h3>
                                    <p class="text-[22px] font-bold text-[#181c1e] font-['Plus_Jakarta_Sans']">Rs.
                                        4,500</p>
                                </div>
                            </div>
                        </div>

                        <!-- Trending Product 5 -->
                        <div class="trending-card flex-shrink-0 w-full md:w-1/2 lg:w-1/4">
                            <div
                                class="bg-white rounded-[16px] border border-[#e0e3e5] overflow-hidden hover:shadow-lg transition-all">
                                <div class="aspect-square bg-gray-200 flex items-center justify-center">
                                    <img src="{{ asset('images/Pottery.png') }}" alt="Lokta Paper Journal"
                                        class="w-full h-full object-cover">
                                </div>
                                <div class="p-4">
                                    <span
                                        class="text-xs font-bold text-[#b51822] uppercase tracking-widest">Stationary</span>
                                    <h3 class="font-bold text-[16px] text-[#181c1e] mb-2 font-['Plus_Jakarta_Sans']">
                                        Lokta Paper Journal</h3>
                                    <p class="text-[22px] font-bold text-[#181c1e] font-['Plus_Jakarta_Sans']">Rs.
                                        5,800</p>
                                </div>
                            </div>
                        </div>

                        <!-- Trending Product 6 -->
                        <div class="trending-card flex-shrink-0 w-full md:w-1/2 lg:w-1/4">
                            <div
                                class="bg-white rounded-[16px] border border-[#e0e3e5] overflow-hidden hover:shadow-lg transition-all">
                                <div class="aspect-square bg-gray-200 flex items-center justify-center">
                                    <img src="{{ asset('images/Pottery.png') }}" alt="Traditional Dhaka Textile"
                                        class="w-full h-full object-cover">
                                </div>
                                <div class="p-4">
                                    <span
                                        class="text-xs font-bold text-[#b51822] uppercase tracking-widest">Textiles</span>
                                    <h3 class="font-bold text-[16px] text-[#181c1e] mb-2 font-['Plus_Jakarta_Sans']">
                                        Traditional Dhaka Textile</h3>
                                    <p class="text-[22px] font-bold text-[#181c1e] font-['Plus_Jakarta_Sans']">Rs.
                                        12,400</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- Product Details Modal -->
    <div id="product-details-modal"
        class="fixed inset-0 z-[99999] hidden bg-black/60 backdrop-blur-sm overflow-y-auto p-4 opacity-0 transition-opacity duration-300">
        <div class="relative bg-white max-w-3xl mx-auto rounded-2xl overflow-hidden shadow-2xl transform scale-95 opacity-0 transition-all duration-300"
            id="product-details-container">
            <button id="close-product-details"
                class="absolute top-4 right-4 z-50 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-full w-10 h-10 flex items-center justify-center transition">
                <i class="fas fa-times text-lg"></i>
            </button>

            <div class="p-8 space-y-6">
                <div class="grid md:grid-cols-2 gap-8">
                    <div>
                        <img src="" id="modal-main-image" alt="" class="w-full rounded-lg">
                    </div>

                    <div>
                        <h2 id="modal-product-name"
                            class="text-2xl font-bold text-[#181c1e] mb-2 font-['Plus_Jakarta_Sans']">Product Name</h2>
                        <div class="flex items-center gap-2 mb-4">
                            <div id="modal-stars-container" class="flex gap-1 text-yellow-400"></div>
                            <span class="text-sm text-[#5b403e]">(<span id="modal-reviews-count">0</span>
                                Reviews)</span>
                        </div>

                        <div class="bg-[#ebeef0] rounded-lg p-4 mb-4">
                            <p class="text-[28px] font-bold text-[#b51822] font-['Plus_Jakarta_Sans']"
                                id="modal-product-price">Rs. 0</p>
                            <p class="text-sm text-[#5b403e] line-through hidden" id="modal-product-original-price">
                                Rs. 0</p>
                        </div>

                        <p id="modal-product-desc" class="text-[#5b403e] text-sm mb-6">Product description</p>

                        <div class="flex gap-4 mb-6">
                            <button id="modal-add-to-cart-btn"
                                class="flex-1 bg-[#b51822] text-white font-bold py-3 rounded-lg hover:bg-[#930013] transition">
                                Add to Cart
                            </button>
                            <button id="modal-buy-now-btn"
                                class="flex-1 border-2 border-[#b51822] text-[#b51822] font-bold py-3 rounded-lg hover:bg-[#ebeef0] transition">
                                Buy Now
                            </button>
                        </div>

                        <div class="text-sm text-[#5b403e] space-y-2">
                            <p>✓ Free shipping on orders over Rs. 5,000</p>
                            <p>✓ 30-day returns</p>
                            <p>✓ Authentic product from Nepal</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // ==================== REAL COUNTDOWN TO MIDNIGHT ====================
            function updateCountdown() {
                const now = new Date();
                const endOfDay = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 23, 59, 59);
                const diff = Math.max(0, (endOfDay - now) / 1000);

                const hours = Math.floor(diff / 3600);
                const mins = Math.floor((diff % 3600) / 60);
                const secs = Math.floor(diff % 60);

                document.getElementById('countdown-hours').textContent = String(hours).padStart(2, '0');
                document.getElementById('countdown-minutes').textContent = String(mins).padStart(2, '0');
                document.getElementById('countdown-seconds').textContent = String(secs).padStart(2, '0');
            }
            updateCountdown();
            setInterval(updateCountdown, 1000);

            // ==================== CAROUSEL LOGIC ====================
            // 1. Featured Star Deals Carousel (1 slide at a time)
            const featuredCarousel = document.getElementById('featured-carousel');
            const featuredPrev = document.getElementById('featured-prev');
            const featuredNext = document.getElementById('featured-next');
            if (featuredCarousel && featuredPrev && featuredNext) {
                const cards = featuredCarousel.querySelectorAll('.featured-card');
                let currentIndex = 0;

                function updateFeaturedCarousel() {
                    if (cards.length === 0) return;
                    const cardWidth = cards[0].getBoundingClientRect().width;
                    featuredCarousel.style.transform = `translateX(-${currentIndex * (cardWidth + 24)}px)`;
                }

                featuredNext.addEventListener('click', () => {
                    currentIndex = currentIndex < cards.length - 1 ? currentIndex + 1 : 0;
                    updateFeaturedCarousel();
                });

                featuredPrev.addEventListener('click', () => {
                    currentIndex = currentIndex > 0 ? currentIndex - 1 : cards.length - 1;
                    updateFeaturedCarousel();
                });

                window.addEventListener('resize', updateFeaturedCarousel);
            }

            // 2. Trending Now Carousel
            const trendingCarousel = document.getElementById('trending-carousel');
            const trendingPrev = document.getElementById('trending-prev');
            const trendingNext = document.getElementById('trending-next');
            if (trendingCarousel && trendingPrev && trendingNext) {
                const cards = trendingCarousel.querySelectorAll('.trending-card');
                let currentIndex = 0;

                function visibleCount() {
                    if (window.innerWidth >= 1024) return 4;
                    if (window.innerWidth >= 768) return 2;
                    return 1;
                }

                function updateTrendingCarousel() {
                    if (cards.length === 0) return;
                    const cardWidth = cards[0].getBoundingClientRect().width;
                    trendingCarousel.style.transform = `translateX(-${currentIndex * (cardWidth + 24)}px)`;
                }

                trendingNext.addEventListener('click', () => {
                    const maxIndex = Math.max(0, cards.length - visibleCount());
                    currentIndex = currentIndex < maxIndex ? currentIndex + 1 : 0;
                    updateTrendingCarousel();
                });

                trendingPrev.addEventListener('click', () => {
                    const maxIndex = Math.max(0, cards.length - visibleCount());
                    currentIndex = currentIndex > 0 ? currentIndex - 1 : maxIndex;
                    updateTrendingCarousel();
                });

                window.addEventListener('resize', updateTrendingCarousel);
            }
        });
    </script>
</x-frontend-layout>
