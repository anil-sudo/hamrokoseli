<x-frontend-layout>

    <div class="bg-[#F4EAE1] text-[#3A2A1F] min-h-screen py-8 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Page Header -->
            <div class="mb-8">
                <h1 class="text-3xl md:text-4xl font-bold text-[#1F3D2E] tracking-tight">Top Selling Creations</h1>
            </div>

            <!-- Filter Controls -->
            <div class="bg-[#FFF7EF] rounded-3xl p-6 sm:p-8 border border-[#ebd7be]/40 shadow-sm mb-10">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                    <!-- Category Pills -->
                    <div>
                        <span class="text-xs font-bold uppercase tracking-wider text-[#3A2A1F]/60 block mb-3">Filter by Category</span>
                        <div class="flex flex-wrap gap-2.5" id="category-filters">
                            <button data-category="all" class="filter-pill px-4 py-2 border border-[#C65A3A]/30 text-[#1F3D2E] text-xs font-bold rounded-full hover:bg-[#C65A3A]/10 active:scale-95 transition cursor-pointer active">
                                All Categories
                            </button>
                            @php
                                // Unique list of categories in the products
                                $categories = $products->pluck('category.cat_name')->unique()->filter()->values();
                            @endphp
                            @foreach($categories as $cat)
                                <button data-category="{{ strtolower($cat) }}" class="filter-pill px-4 py-2 border border-[#C65A3A]/30 text-[#1F3D2E] text-xs font-bold rounded-full hover:bg-[#C65A3A]/10 active:scale-95 transition cursor-pointer">
                                    {{ $cat }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Sorting -->
                    <div class="flex items-center gap-3 self-start lg:self-auto shrink-0">
                        <span class="text-xs font-bold uppercase tracking-wider text-[#3A2A1F]/60">Sort By:</span>
                        <div class="relative">
                            <select id="sort-select" class="appearance-none bg-[#FFF7EF] border border-[#ebd7be] rounded-full px-5 py-2.5 pr-10 text-sm font-semibold focus:outline-none focus:ring-2 focus:ring-[#1F3D2E]/25 text-[#1F3D2E] cursor-pointer shadow-sm">
                                <option value="rank">Popularity (Rank)</option>
                                <option value="price-asc">Price: Low to High</option>
                                <option value="price-desc">Price: High to Low</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-[#1F3D2E]/70">
                                <i class="fas fa-chevron-down text-xs"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 sm:gap-8" id="product-grid">
                @foreach($products as $index => $product)
                    @php
                        $rank = $index + 1;
                        $rankClass = 'rank-default';
                        if ($rank === 1) $rankClass = 'rank-1';
                        elseif ($rank === 2) $rankClass = 'rank-2';
                        elseif ($rank === 3) $rankClass = 'rank-3';
                        
                        $price = $product->price;
                        // For Eloquent Product models use resolvedDiscountPrice() which handles variants;
                        // plain stdClass objects (static data) fall back to ->discount_price directly.
                        $discountPrice = method_exists($product, 'resolvedDiscountPrice')
                            ? $product->resolvedDiscountPrice()
                            : ($product->discount_price ?? null);
                        $hasDiscount = !is_null($discountPrice) && $discountPrice < $price;
                        $displayPrice = $hasDiscount ? $discountPrice : $price;
                    @endphp
                    <!-- Product Card -->
                    <div class="product-card bg-white rounded-3xl overflow-hidden border border-[#ebd7be]/40 shadow-sm flex flex-col group"
                         data-id="{{ $product->id }}"
                         data-name="{{ $product->name }}"
                         data-price="{{ $displayPrice }}"
                         data-category="{{ strtolower($product->category->cat_name ?? '') }}"
                         data-rank="{{ $rank }}">
                         
                        <div class="relative w-full aspect-[4/5] overflow-hidden rounded-t-3xl bg-slate-100">
                            <!-- Image Zoom on Hover -->
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            
                            <!-- Rank Badge -->
                            <span class="absolute top-4 left-4 {{ $rankClass }} text-[10px] font-extrabold uppercase tracking-wider px-3 py-1.5 rounded-full z-10 shadow">
                                #{{ $rank }} {{ $rank <= 3 ? 'Best Seller' : 'Seller' }}
                            </span>
                            
                            <!-- Wishlist button (integrated with app.js local storage logic) -->
                            <button class="wishlist-btn absolute top-4 right-4 bg-white/95 hover:bg-white text-[#C65A3A] transition duration-300 w-10 h-10 rounded-full flex items-center justify-center shadow-md focus:outline-none cursor-pointer"
                                    data-product-id="{{ $product->id }}"
                                    data-product-name="{{ $product->name }}"
                                    data-product-price="{{ $displayPrice }}"
                                    data-product-image="{{ asset($product->image) }}"
                                    data-product-desc="{{ $product->description }}"
                                    data-product-category="{{ $product->category->cat_name ?? '' }}"
                                    data-product-tag="{{ $product->tag ?? '' }}">
                                <i class="far fa-heart text-lg"></i>
                            </button>
                        </div>
                        
                        <div class="p-5 flex-grow flex flex-col justify-between">
                            <div>
                                <span class="text-[10px] font-bold uppercase tracking-wider text-[#3A2A1F]/50 block mb-1">
                                    {{ $product->category->cat_name ?? 'Crafts' }}
                                </span>
                                <h3 class="text-base font-bold text-[#1F3D2E] mb-1.5 leading-tight group-hover:text-[#C65A3A] transition-colors line-clamp-1">
                                    {{ $product->name }}
                                </h3>
                                <p class="text-xs text-[#3A2A1F]/60 font-semibold mb-3">
                                    by <span class="text-[#1F3D2E]">{{ $product->vendor->vendor_name ?? 'Local Artisan' }}</span>
                                </p>
                                
                                <div class="flex items-center gap-1.5 mb-4">
                                    <div class="flex text-amber-500 gap-0.5 text-xs">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= ($product->rating ?? 5))
                                                <i class="fas fa-star text-[10px] sm:text-xs"></i>
                                            @elseif ($i - ($product->rating ?? 5) < 1)
                                                <i class="fas fa-star-half-alt text-[10px] sm:text-xs"></i>
                                            @else
                                                <i class="far fa-star text-[10px] sm:text-xs"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <span class="text-[10px] text-[#3A2A1F]/60 font-bold">({{ $product->reviews_count ?? 24 }})</span>
                                </div>
                            </div>
                            
                            <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
                                <div class="flex flex-col">
                                    @if ($hasDiscount)
                                        <span class="text-[#C65A3A] font-extrabold text-base leading-none">Rs. {{ number_format($discountPrice) }}</span>
                                        <span class="text-slate-400 text-xs line-through mt-1">Rs. {{ number_format($price) }}</span>
                                    @else
                                        <span class="text-[#C65A3A] font-extrabold text-base leading-none">Rs. {{ number_format($price) }}</span>
                                    @endif
                                </div>
                                <a href="{{ route('viewdetails', $product->id) }}" class="view-details-btn inline-flex items-center justify-center gap-1.5 bg-[#C65A3A] hover:bg-[#b04a2c] text-white text-xs font-bold px-4 py-2.5 rounded-xl shadow-sm hover:shadow transition duration-300 active:scale-95 cursor-pointer"
                                   data-id="{{ $product->id }}"
                                   data-name="{{ $product->name }}"
                                   data-price="{{ $displayPrice }}"
                                   data-original-price="{{ $price }}"
                                   data-discount="{{ $hasDiscount ? 'true' : 'false' }}"
                                   data-image="{{ asset($product->image) }}"
                                   data-category="{{ $product->category->cat_name ?? '' }}"
                                   data-vendor="{{ $product->vendor->vendor_name ?? '' }}"
                                   data-desc="{{ $product->description }}"
                                   data-rating="{{ $product->rating ?? 5 }}"
                                   data-reviews="{{ $product->reviews_count ?? 24 }}"
                                   data-stock="{{ $product->stock ?? 10 }}">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>



    <!-- Client-Side Filter, Sort and Modal Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ==================== FILTER LOGIC ====================
            const categoryPills = document.querySelectorAll('.filter-pill');
            const productCards = document.querySelectorAll('.product-card');
            const gridContainer = document.getElementById('product-grid');

            function filterProducts(category) {
                productCards.forEach(card => {
                    const cardCategory = card.getAttribute('data-category');
                    if (category === 'all' || cardCategory === category) {
                        card.style.display = '';
                    } else {
                        card.style.display = 'none';
                    }
                });
            }

            categoryPills.forEach(pill => {
                pill.addEventListener('click', function() {
                    categoryPills.forEach(p => p.classList.remove('active'));
                    pill.classList.add('active');
                    filterProducts(pill.getAttribute('data-category'));
                });
            });

            // ==================== SORT LOGIC ====================
            const sortSelect = document.getElementById('sort-select');

            function sortProducts(criteria) {
                const cardsArray = Array.from(productCards);
                
                cardsArray.sort((a, b) => {
                    if (criteria === 'rank') {
                        return parseInt(a.getAttribute('data-rank')) - parseInt(b.getAttribute('data-rank'));
                    } else if (criteria === 'price-asc') {
                        return parseFloat(a.getAttribute('data-price')) - parseFloat(b.getAttribute('data-price'));
                    } else if (criteria === 'price-desc') {
                        return parseFloat(b.getAttribute('data-price')) - parseFloat(a.getAttribute('data-price'));
                    }
                    return 0;
                });

                // Clear and re-append sorted items (non-destructive)
                cardsArray.forEach(card => gridContainer.appendChild(card));
            }

            sortSelect.addEventListener('change', function() {
                sortProducts(sortSelect.value);
            });


        });
    </script>
</x-frontend-layout>