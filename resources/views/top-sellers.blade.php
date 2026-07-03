<x-frontend-layout>

<div class="bg-[#F4EAE1] text-[#3A2A1F] min-h-screen py-8 sm:py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl md:text-4xl font-bold text-[#1F3D2E] tracking-tight">🏆 Top Selling Creations</h1>
        </div>

        <!-- Filter Controls -->
        <div class="bg-[#FFF7EF] rounded-3xl p-6 sm:p-8 border border-[#ebd7be]/40 shadow-sm mb-10">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-[#3A2A1F]/60 block mb-3">Filter by Category</span>
                    <div class="flex flex-wrap gap-2.5" id="category-filters">
                        <button data-category="all" class="filter-pill active px-4 py-2 border border-[#C65A3A]/30 text-[#1F3D2E] text-xs font-bold rounded-full hover:bg-[#C65A3A]/10 transition cursor-pointer">
                            All Categories
                        </button>
                        @php
                            $categories = $products->pluck('category.cat_name')->unique()->filter()->values();
                        @endphp
                        @foreach($categories as $cat)
                            <button data-category="{{ strtolower($cat) }}" class="filter-pill px-4 py-2 border border-[#C65A3A]/30 text-[#1F3D2E] text-xs font-bold rounded-full hover:bg-[#C65A3A]/10 transition cursor-pointer">
                                {{ $cat }}
                            </button>
                        @endforeach
                    </div>
                </div>

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
                    $rankBg = match(true) {
                        $rank === 1 => 'bg-yellow-400 text-yellow-900',
                        $rank === 2 => 'bg-slate-300 text-slate-800',
                        $rank === 3 => 'bg-amber-600 text-white',
                        default     => 'bg-[#1F3D2E] text-white',
                    };

                    $imageUrl = method_exists($product, 'primaryImageUrl')
                        ? $product->primaryImageUrl()
                        : asset($product->image ?? 'images/placeholder.png');

                    $price         = (float) $product->price;
                    $discountPrice = method_exists($product, 'resolvedDiscountPrice')
                        ? $product->resolvedDiscountPrice()
                        : ($product->discount_price ?? null);
                    $hasDiscount  = !is_null($discountPrice) && $discountPrice < $price;
                    $displayPrice = $hasDiscount ? $discountPrice : $price;

                    $catName    = $product->category->cat_name ?? 'Crafts';
                    $vendorName = $product->vendor->vendor_name ?? 'Local Artisan';
                    $rating     = $product->rating ?? 5;
                    $reviews    = $product->reviews_count ?? 0;
                    $stock      = $product->stock ?? 10;
                @endphp

                <div class="product-card bg-white rounded-3xl overflow-hidden border border-[#ebd7be]/40 shadow-sm flex flex-col group"
                     data-id="{{ $product->id }}"
                     data-name="{{ $product->name }}"
                     data-price="{{ $displayPrice }}"
                     data-category="{{ strtolower($catName) }}"
                     data-rank="{{ $rank }}">

                    <div class="relative w-full aspect-[4/5] overflow-hidden rounded-t-3xl bg-slate-100">
                        <img src="{{ $imageUrl }}"
                             alt="{{ $product->name }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                             onerror="this.src='{{ asset('images/placeholder.png') }}'">

                        <span class="absolute top-4 left-4 {{ $rankBg }} text-[10px] font-extrabold uppercase tracking-wider px-3 py-1.5 rounded-full z-10 shadow">
                            #{{ $rank }} {{ $rank <= 3 ? 'Best Seller' : 'Seller' }}
                        </span>

                        <button class="wishlist-btn absolute top-4 right-4 bg-white/95 hover:bg-white text-[#C65A3A] transition duration-300 w-10 h-10 rounded-full flex items-center justify-center shadow-md focus:outline-none cursor-pointer"
                                data-product-id="{{ $product->id }}"
                                data-product-name="{{ $product->name }}"
                                data-product-price="{{ $displayPrice }}"
                                data-product-image="{{ $imageUrl }}"
                                data-product-desc="{{ $product->description }}"
                                data-product-category="{{ $catName }}"
                                data-product-tag="{{ $product->tag ?? '' }}">
                            <i class="far fa-heart text-lg"></i>
                        </button>
                    </div>

                    <div class="p-5 flex-grow flex flex-col justify-between">
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-[#3A2A1F]/50 block mb-1">{{ $catName }}</span>
                            <h3 class="text-base font-bold text-[#1F3D2E] mb-1 leading-tight group-hover:text-[#C65A3A] transition-colors line-clamp-2">
                                {{ $product->name }}
                            </h3>
                            <p class="text-xs text-[#3A2A1F]/60 font-semibold mb-3">
                                by <span class="text-[#1F3D2E]">{{ $vendorName }}</span>
                            </p>
                            <div class="flex items-center gap-1.5 mb-3">
                                <div class="flex text-amber-500 gap-0.5">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= floor($rating))
                                            <i class="fas fa-star text-[10px]"></i>
                                        @elseif ($rating - floor($rating) >= 0.5 && $i == ceil($rating))
                                            <i class="fas fa-star-half-alt text-[10px]"></i>
                                        @else
                                            <i class="far fa-star text-[10px]"></i>
                                        @endif
                                    @endfor
                                </div>
                                <span class="text-[10px] text-[#3A2A1F]/60 font-bold">({{ $reviews }})</span>
                            </div>
                        </div>

                        <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
                            <div class="flex flex-col">
                                <span class="text-[#C65A3A] font-extrabold text-base leading-none">Rs. {{ number_format($displayPrice) }}</span>
                                @if($hasDiscount)
                                    <span class="text-slate-400 text-xs line-through mt-0.5">Rs. {{ number_format($price) }}</span>
                                @endif
                            </div>
                            <!-- View Details triggers modal -->
                                                <div class="flex gap-2 mt-auto">
                        <a href="{{ route('viewdetails', $product->id) }}"
                           class="view-details-btn flex-1 flex items-center justify-center gap-2 bg-[#1F3D2E] hover:bg-[#16301f] text-white text-sm font-semibold py-3 px-3 rounded-xl shadow-sm hover:shadow transition duration-300"
                           data-id="{{ $product->id }}"
                           data-name="{{ $product->name }}"
                           data-price="{{ $product->effectivePrice() }}"
                           data-original-price="{{ $product->originalPrice() }}"
                           data-discount="{{ $product->hasDiscount() ? 'true' : 'false' }}"
                           data-discount-price="{{ $product->resolvedDiscountPrice() ?? '' }}"
                           data-image="{{ $product->primaryImageUrl() }}"
                           data-category="{{ $product->category?->cat_name ?? 'Crafts' }}"
                           data-vendor="{{ $product->vendor->business_name ?? $product->vendor->name ?? 'Local Artisan' }}"
                           data-desc="{{ $product->description }}"
                           data-rating="{{ $product->rating ?? 5 }}"
                           data-reviews="{{ $product->reviews_count ?? 24 }}"
                           data-stock="{{ $product->stock ?? 10 }}">
                            <i class="fa-solid fa-circle-info text-xs"></i>
                            Details
                        </a>

                        <button
                            type="button"
                            class="add-to-cart-btn flex-1 flex items-center justify-center gap-2 bg-[#C65A3A] hover:bg-[#b04a2c] text-white text-sm font-semibold py-3 px-3 rounded-xl shadow-sm hover:shadow transition duration-300 disabled:opacity-60 disabled:cursor-not-allowed"
                            data-product-id="{{ $product->id }}"
                            data-product-name="{{ $product->name }}"
                            {{ ($product->stock ?? 0) < 1 ? 'disabled' : '' }}>
                            <i class="fa-solid fa-cart-plus text-xs"></i>
                            {{ ($product->stock ?? 0) < 1 ? 'Sold Out' : 'Add' }}
                        </button>
                    </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
                            </div>
                            <!-- View Details triggers modal -->
                                                <div class="flex gap-2 mt-auto">
                        <a href="{{ route('viewdetails', $product->id) }}"
                           class="view-details-btn flex-1 flex items-center justify-center gap-2 bg-[#1F3D2E] hover:bg-[#16301f] text-white text-sm font-semibold py-3 px-3 rounded-xl shadow-sm hover:shadow transition duration-300"
                           data-id="{{ $product->id }}"
                           data-name="{{ $product->name }}"
                           data-price="{{ $product->effectivePrice() }}"
                           data-original-price="{{ $product->originalPrice() }}"
                           data-discount="{{ $product->hasDiscount() ? 'true' : 'false' }}"
                           data-discount-price="{{ $product->resolvedDiscountPrice() ?? '' }}"
                           data-image="{{ $product->primaryImageUrl() }}"
                           data-category="{{ $product->category?->cat_name ?? 'Crafts' }}"
                           data-vendor="{{ $product->vendor->business_name ?? $product->vendor->name ?? 'Local Artisan' }}"
                           data-desc="{{ $product->description }}"
                           data-rating="{{ $product->rating ?? 5 }}"
                           data-reviews="{{ $product->reviews_count ?? 24 }}"
                           data-stock="{{ $product->stock ?? 10 }}">
                            <i class="fa-solid fa-circle-info text-xs"></i>
                            Details
                        </a>

                        <button
                            type="button"
                            class="add-to-cart-btn flex-1 flex items-center justify-center gap-2 bg-[#C65A3A] hover:bg-[#b04a2c] text-white text-sm font-semibold py-3 px-3 rounded-xl shadow-sm hover:shadow transition duration-300 disabled:opacity-60 disabled:cursor-not-allowed"
                            data-product-id="{{ $product->id }}"
                            data-product-name="{{ $product->name }}"
                            {{ ($product->stock ?? 0) < 1 ? 'disabled' : '' }}>
                            <i class="fa-solid fa-cart-plus text-xs"></i>
                            {{ ($product->stock ?? 0) < 1 ? 'Sold Out' : 'Add' }}
                        </button>
                    </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- ==================== PRODUCT DETAIL MODAL ==================== -->
<div id="product-modal" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
    <!-- Backdrop -->
    <div id="modal-backdrop" class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>

    <!-- Modal Box -->
    <div class="relative bg-white rounded-3xl shadow-2xl w-full max-w-3xl max-h-[90vh] overflow-y-auto z-10">

        <!-- Close Button -->
        <button id="modal-close" class="absolute top-4 right-4 z-20 bg-[#F4EAE1] hover:bg-[#ebd7be] text-[#3A2A1F] w-9 h-9 rounded-full flex items-center justify-center transition cursor-pointer">
            <i class="fas fa-times"></i>
        </button>

        <div class="flex flex-col md:flex-row">
            <!-- Image -->
            <div class="md:w-2/5 bg-slate-100 rounded-t-3xl md:rounded-l-3xl md:rounded-tr-none overflow-hidden flex-shrink-0">
                <img id="modal-image" src="" alt="" class="w-full h-64 md:h-full object-cover">
            </div>

            <!-- Info -->
            <div class="md:w-3/5 p-6 sm:p-8 flex flex-col justify-between">
                <div>
                    <span id="modal-category" class="text-[10px] font-bold uppercase tracking-wider text-[#3A2A1F]/50 block mb-1"></span>
                    <h2 id="modal-name" class="text-xl sm:text-2xl font-bold text-[#1F3D2E] mb-1 leading-tight"></h2>
                    <p id="modal-vendor" class="text-xs text-[#3A2A1F]/60 font-semibold mb-4"></p>

                    <!-- Stars -->
                    <div class="flex items-center gap-2 mb-4">
                        <div id="modal-stars" class="flex text-amber-500 gap-0.5 text-sm"></div>
                        <span id="modal-reviews" class="text-xs text-[#3A2A1F]/60 font-bold"></span>
                    </div>

                    <p id="modal-desc" class="text-sm text-[#3A2A1F]/70 leading-relaxed mb-6"></p>

                    <!-- Stock -->
                    <p id="modal-stock" class="text-xs font-bold mb-4"></p>
                </div>

                <!-- Price + Actions -->
                <div class="border-t border-slate-100 pt-5">
                    <div class="flex items-end gap-3 mb-5">
                        <span id="modal-price" class="text-2xl font-extrabold text-[#C65A3A]"></span>
                        <span id="modal-original-price" class="text-sm text-slate-400 line-through hidden"></span>
                        <span id="modal-discount-badge" class="hidden bg-red-100 text-red-600 text-xs font-bold px-2 py-0.5 rounded-full"></span>
                    </div>
                    <div class="flex gap-3">
                        <button id="modal-wishlist-btn"
                                class="wishlist-btn flex-1 border-2 border-[#C65A3A] text-[#C65A3A] hover:bg-[#C65A3A] hover:text-white font-bold py-3 rounded-xl transition text-sm cursor-pointer"
                                data-product-id="" data-product-name="" data-product-price=""
                                data-product-image="" data-product-desc="" data-product-category="">
                            <i class="far fa-heart mr-1"></i> Wishlist
                        </button>
                        <a id="modal-full-link" href="#"
                           class="flex-1 bg-[#1F3D2E] hover:bg-[#163020] text-white font-bold py-3 rounded-xl transition text-sm text-center cursor-pointer">
                            View Full Page
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Product Details Modal Overlay -->
    <div id="product-details-modal" class="fixed inset-0 z-[99999] hidden bg-black/60 backdrop-blur-sm overflow-y-auto p-4 sm:p-6 md:p-10 transition-opacity duration-300 opacity-0">
        
        <!-- Modal Content Container -->
        <div class="relative bg-[#F4EAE1] max-w-5xl mx-auto rounded-3xl overflow-hidden shadow-2xl border border-[#ebd7be]/50 transform scale-95 opacity-0 transition-all duration-300 ease-out" id="product-details-container">
            
            <!-- Close Button -->
            <button id="close-product-details" class="absolute top-4 right-4 z-50 bg-white/80 hover:bg-white text-slate-800 rounded-full w-10 h-10 flex items-center justify-center shadow-md transition hover:scale-105 active:scale-95 cursor-pointer focus:outline-none">
                <i class="fas fa-times text-lg"></i>
            </button>

            <div class="p-6 sm:p-8 md:p-10 lg:p-12 space-y-8">
                
                <!-- Breadcrumbs -->
                <div class="text-[#3A2A1F]/60 text-xs font-semibold">
                    Home &nbsp;&rsaquo;&nbsp; Top Sellers &nbsp;&rsaquo;&nbsp; <span class="text-[#C65A3A]" id="modal-breadcrumb-cat">Category</span>
                </div>

                <!-- Two Column Layout -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    
                    <!-- Left: Images -->
                    <div class="lg:col-span-6 space-y-6">
                        <div class="flex gap-4">
                            <!-- Main image -->
                            <div class="flex-grow aspect-[4/3] rounded-3xl overflow-hidden border border-[#ebd7be]/30 shadow-md bg-white">
                                <img src="" id="modal-main-image" alt="" class="w-full h-full object-cover">
                            </div>
                        </div>

                        <!-- Shipping and Returns Badges -->
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
                    </div>
                    
                    <!-- Right: Info -->
                    <div class="lg:col-span-6 space-y-6">
                        <div class="space-y-3">
                            <span class="inline-flex items-center gap-1.5 bg-[#E5DCD0]/70 text-[#1F3D2E] text-[10px] font-bold tracking-wider uppercase px-3 py-1 rounded-full">
                                Authentic Handmade
                            </span>
                            
                            <div class="flex items-center gap-2 text-xs">
                                <div class="flex text-yellow-500 gap-0.5" id="modal-stars-container">
                                    <!-- Stars dynamically loaded -->
                                </div>
                                <span class="text-[#3A2A1F]/60 font-semibold">(<span id="modal-reviews-count">0</span> Reviews)</span>
                            </div>
                            
                            <h1 class="text-2xl sm:text-3xl font-bold text-[#1F3D2E] leading-tight font-serif" id="modal-product-name">Product Name</h1>
                            
                            <div class="flex items-baseline gap-2">
                                <span class="text-[#C65A3A] font-extrabold text-2xl" id="modal-product-price">Rs 0</span>
                                <span class="text-slate-400 text-sm line-through hidden" id="modal-product-original-price">Rs 0</span>
                            </div>
                        </div>
                        
                        <p class="text-[#3A2A1F]/80 text-sm leading-relaxed font-medium" id="modal-product-desc">
                            Product description goes here...
                        </p>
                        
                        <!-- Vendor/Artist Card -->
                        <div class="bg-[#FFF7EF] border border-[#ebd7be]/40 rounded-2xl p-4 flex items-center justify-between shadow-sm">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-[#1F3D2E] text-white flex items-center justify-center font-bold text-lg border border-[#ebd7be]">
                                    A
                                </div>
                                <div>
                                    <h3 class="text-xs font-bold text-[#C65A3A] leading-tight" id="modal-vendor-name">Artist/Store Name</h3>
                                    <p class="text-[10px] text-[#3A2A1F]/60 font-semibold mt-0.5">Master Artisan from Nepal</p>
                                </div>
                            </div>
                            <span class="text-[11px] font-bold text-[#C65A3A] border border-[#C65A3A]/40 px-3 py-1 rounded-full bg-white/60 font-sans">
                                Verified Studio
                            </span>
                        </div>

                        <!-- Quantity Selector -->
                        <div class="flex items-center gap-4">
                            <span class="text-sm font-bold text-[#1F3D2E]">Quantity</span>
                            <div class="flex items-center border border-[#ebd7be] rounded-full bg-white px-3 py-1.5 gap-4 shadow-sm">
                                <button type="button" class="qty-minus-btn text-[#3A2A1F] hover:text-[#C65A3A] font-bold text-sm w-5 h-5 flex items-center justify-center focus:outline-none transition cursor-pointer">−</button>
                                <input type="number" class="qty-val-input text-sm font-bold text-[#1F3D2E] w-10 text-center bg-transparent border-none outline-none" value="1" min="1" max="999">
                                <button type="button" class="qty-plus-btn text-[#3A2A1F] hover:text-[#C65A3A] font-bold text-sm w-5 h-5 flex items-center justify-center focus:outline-none transition cursor-pointer">+</button>
                            </div>
                            <span class="text-xs text-emerald-700 font-bold" id="modal-stock-status">In Stock</span>
                        </div>

                        <!-- Buy Action Buttons -->
                        <div class="flex gap-3 pt-2">
                            <button id="modal-add-to-cart-btn" class="bg-[#C65A3A] hover:bg-[#b04a2c] text-white font-bold py-3 px-5 rounded-2xl flex-1 text-center shadow-md active:scale-[0.98] transition text-sm cursor-pointer">
                                Add to Cart
                            </button>
                            <button id="modal-buy-now-btn" class="border-2 border-[#C65A3A] text-[#C65A3A] hover:bg-[#C65A3A]/10 font-bold py-3 px-5 rounded-2xl flex-1 text-center active:scale-[0.98] transition text-sm cursor-pointer">
                                Buy Now
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Tabs Section -->
                <div class="pt-8 border-t border-[#ebd7be]/40 space-y-6">
                    <div class="flex border-b border-[#ebd7be]/40 gap-6">
                        <button class="tab-btn pb-3 text-sm font-bold text-[#C65A3A] border-b-2 border-[#C65A3A] focus:outline-none transition cursor-pointer" data-tab="details">
                            Product Specifications
                        </button>
                        <button class="tab-btn pb-3 text-sm font-semibold text-[#3A2A1F]/60 hover:text-[#3A2A1F] focus:outline-none transition cursor-pointer" data-tab="story">
                            Craftsmanship Story
                        </button>
                    </div>

                    <div class="tab-panel text-sm text-[#3A2A1F]/80 leading-relaxed font-medium space-y-3" data-panel="details">
                        <p>Detailed material specifications and sizes for this hand-crafted masterpiece. Locally sourced materials, eco-friendly processing, and traditional furnace/kiln techniques.</p>
                        <ul class="list-disc pl-5 space-y-1.5 text-xs text-[#3A2A1F]/70">
                            <li><strong>Material:</strong> 100% Authentic Nepalese sourced raw materials</li>
                            <li><strong>Origin:</strong> Hand-crafted by local families under fair trade standards</li>
                            <li><strong>Certification:</strong> Handcrafted Artisan Registry Certified</li>
                        </ul>
                    </div>

                    <div class="tab-panel text-sm text-[#3A2A1F]/80 leading-relaxed font-medium hidden" data-panel="story">
                        <p>This product represents decades of cultural heritage, handed down through generations of craftspeople in Nepal. By purchasing this item, you directly support local artisan households, preservation of ancestral heritage, and micro-entrepreneurship in rural communities.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

<style>
    .filter-pill.active { background-color: rgba(198,90,58,0.12); border-color: #C65A3A; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // ── Filter ──────────────────────────────────────────────
    const pills = document.querySelectorAll('.filter-pill');
    const cards = document.querySelectorAll('.product-card');
    const grid  = document.getElementById('product-grid');

    pills.forEach(pill => {
        pill.addEventListener('click', function () {
            pills.forEach(p => p.classList.remove('active'));
            this.classList.add('active');
            const cat = this.dataset.category;
            cards.forEach(card => {
                card.style.display = (cat === 'all' || card.dataset.category === cat) ? '' : 'none';
            });
        });
    });

    // ── Sort ────────────────────────────────────────────────
    document.getElementById('sort-select').addEventListener('change', function () {
        const criteria = this.value;
        Array.from(cards)
            .sort((a, b) => {
                if (criteria === 'rank')       return +a.dataset.rank  - +b.dataset.rank;
                if (criteria === 'price-asc')  return +a.dataset.price - +b.dataset.price;
                if (criteria === 'price-desc') return +b.dataset.price - +a.dataset.price;
                return 0;
            })
            .forEach(card => grid.appendChild(card));
    });

    // ── Modal ───────────────────────────────────────────────
    const modal        = document.getElementById('product-modal');
    const backdrop     = document.getElementById('modal-backdrop');
    const closeBtn     = document.getElementById('modal-close');

    function openModal(btn) {
        const d = btn.dataset;

        document.getElementById('modal-image').src          = d.image;
        document.getElementById('modal-image').alt          = d.name;
        document.getElementById('modal-name').textContent   = d.name;
        document.getElementById('modal-category').textContent = d.category;
        document.getElementById('modal-vendor').textContent = 'by ' + d.vendor;
        document.getElementById('modal-desc').textContent   = d.desc;

        // Stars
        const rating = parseFloat(d.rating) || 5;
        let stars = '';
        for (let i = 1; i <= 5; i++) {
            if (i <= Math.floor(rating))            stars += '<i class="fas fa-star"></i>';
            else if (rating % 1 >= 0.5 && i === Math.ceil(rating)) stars += '<i class="fas fa-star-half-alt"></i>';
            else                                    stars += '<i class="far fa-star"></i>';
        }
        document.getElementById('modal-stars').innerHTML   = stars;
        document.getElementById('modal-reviews').textContent = '(' + (d.reviews || 0) + ' reviews)';

        // Price
        document.getElementById('modal-price').textContent = 'Rs. ' + Number(d.price).toLocaleString();
        const origEl   = document.getElementById('modal-original-price');
        const badgeEl  = document.getElementById('modal-discount-badge');
        if (d.discount === 'true') {
            const orig    = parseFloat(d.originalPrice);
            const pct     = Math.round(((orig - parseFloat(d.price)) / orig) * 100);
            origEl.textContent  = 'Rs. ' + orig.toLocaleString();
            badgeEl.textContent = '-' + pct + '%';
            origEl.classList.remove('hidden');
            badgeEl.classList.remove('hidden');
        } else {
            origEl.classList.add('hidden');
            badgeEl.classList.add('hidden');
        }

        // Stock
        const stockEl = document.getElementById('modal-stock');
        const stock   = parseInt(d.stock) || 0;
        if (stock === 0)      { stockEl.textContent = 'Out of Stock';       stockEl.className = 'text-xs font-bold mb-4 text-red-500'; }
        else if (stock <= 5)  { stockEl.textContent = 'Only ' + stock + ' left!'; stockEl.className = 'text-xs font-bold mb-4 text-orange-500'; }
        else                  { stockEl.textContent = 'In Stock';           stockEl.className = 'text-xs font-bold mb-4 text-green-600'; }

        // Wishlist btn inside modal
        const wb = document.getElementById('modal-wishlist-btn');
        wb.dataset.productId       = d.id;
        wb.dataset.productName     = d.name;
        wb.dataset.productPrice    = d.price;
        wb.dataset.productImage    = d.image;
        wb.dataset.productDesc     = d.desc;
        wb.dataset.productCategory = d.category;

        // Full page link
        document.getElementById('modal-full-link').href = '/viewdetails/' + d.id;

        // Show modal
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = '';
    }

    document.querySelectorAll('.view-details-btn').forEach(btn => {
        btn.addEventListener('click', () => openModal(btn));
    });

    closeBtn.addEventListener('click', closeModal);
    backdrop.addEventListener('click', closeModal);
    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });
});
</script>

   {{-- ==================== ADD TO CART (AJAX) ==================== --}}
    <script>
    (function () {
        // ── Toast helper ────────────────────────────────────────────────────
        function showToast(message, type = 'success') {
            const existing = document.getElementById('shop-cart-toast');
            if (existing) existing.remove();

            const colours = {
                success : 'bg-[#1F3D2E] text-white',
                error   : 'bg-red-600 text-white',
                warning : 'bg-amber-500 text-white',
                info    : 'bg-[#C65A3A] text-white',
            };

            const icons = {
                success : 'fa-circle-check',
                error   : 'fa-circle-xmark',
                warning : 'fa-triangle-exclamation',
                info    : 'fa-circle-info',
            };

            const toast = document.createElement('div');
            toast.id = 'shop-cart-toast';
            toast.className = [
                'fixed bottom-6 right-6 z-[9999] flex items-center gap-3',
                'px-5 py-3.5 rounded-2xl shadow-xl text-sm font-semibold',
                'translate-y-4 opacity-0 transition-all duration-300',
                colours[type] ?? colours.success,
            ].join(' ');

            toast.innerHTML = `
                <i class="fas ${icons[type] ?? icons.success} text-base"></i>
                <span>${message}</span>
            `;

            document.body.appendChild(toast);

            // Animate in
            requestAnimationFrame(() => {
                requestAnimationFrame(() => {
                    toast.classList.remove('translate-y-4', 'opacity-0');
                    toast.classList.add('translate-y-0', 'opacity-100');
                });
            });

            // Animate out after 3 s
            setTimeout(() => {
                toast.classList.remove('translate-y-0', 'opacity-100');
                toast.classList.add('translate-y-4', 'opacity-0');
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // ── Update cart badge in the navbar (if one exists) ─────────────────
        function updateCartBadge(count) {
            document.querySelectorAll('[data-cart-count]').forEach(el => {
                el.textContent = count;
                el.classList.toggle('hidden', count === 0);
            });
        }

            // ── Wire up every "Add to Cart" button ──────────────────────────────
            document.querySelectorAll('.add-to-cart-btn').forEach(function (btn) {
                btn.addEventListener('click', async function () {
                    const productId   = btn.dataset.productId;
                    const productName = btn.dataset.productName;

                    // Prevent double-clicks while the request is in flight
                    btn.disabled = true;
                    const originalHtml = btn.innerHTML;
                    btn.innerHTML = '<i class="fas fa-spinner fa-spin text-xs"></i> Adding…';

                    try {
                        const response = await fetch('{{ route('cart.add') }}', {
                            method  : 'POST',
                            headers : {
                                'Content-Type' : 'application/json',
                                'Accept'       : 'application/json',
                                'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]')?.content ?? '',
                            },
                            body: JSON.stringify({
                                product_id : productId,
                                quantity   : 1,
                            }),
                        });

                        const json = await response.json();

                        if (response.status === 401) {
                            showToast('Please log in to add items to your cart.', 'warning');
                            setTimeout(() => {
                                window.location.href = '{{ route('userlogin') }}';
                            }, 1500);
                            return;
                        }

                        if (json.success) {
                            showToast(`${productName} added to cart!`, 'success');
                            updateCartBadge(json.cart_count ?? 0);

                            btn.innerHTML = '<i class="fas fa-check text-xs"></i> Added!';
                            setTimeout(() => {
                                btn.innerHTML = originalHtml;
                                btn.disabled  = false;
                            }, 1500);
                        } else {
                            showToast(json.message ?? 'Could not add to cart.', 'error');
                            btn.innerHTML = originalHtml;
                            btn.disabled  = false;
                        }

                    } catch (err) {
                        console.error('Add-to-cart error:', err);
                        showToast('Something went wrong. Please try again.', 'error');
                        btn.innerHTML = originalHtml;
                        btn.disabled  = false;
                    }
                });
            });

            // ==================== PRODUCT DETAILS MODAL LOGIC ====================
            const modal = document.getElementById('product-details-modal');
            const container = document.getElementById('product-details-container');
            const closeBtn = document.getElementById('close-product-details');
            const qtyInput = modal.querySelector('.qty-val-input');

            // Dynamic Modal Fields
            const modalMainImage = document.getElementById('modal-main-image');
            const modalBreadcrumbCat = document.getElementById('modal-breadcrumb-cat');
            const modalProductName = document.getElementById('modal-product-name');
            const modalProductPrice = document.getElementById('modal-product-price');
            const modalProductOriginalPrice = document.getElementById('modal-product-original-price');
            const modalProductDesc = document.getElementById('modal-product-desc');
            const modalVendorName = document.getElementById('modal-vendor-name');
            const modalStarsContainer = document.getElementById('modal-stars-container');
            const modalReviewsCount = document.getElementById('modal-reviews-count');
            const modalStockStatus = document.getElementById('modal-stock-status');

            // Add Click Handlers on Product Cards "View Details"
            document.querySelectorAll('.view-details-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Read details
                    const name = btn.getAttribute('data-name');
                    const price = parseFloat(btn.getAttribute('data-price'));
                    const originalPrice = parseFloat(btn.getAttribute('data-original-price'));
                    const hasDiscount = btn.getAttribute('data-discount') === 'true';
                    const image = btn.getAttribute('data-image');
                    const category = btn.getAttribute('data-category');
                    const vendor = btn.getAttribute('data-vendor');
                    const desc = btn.getAttribute('data-desc');
                    const rating = parseFloat(btn.getAttribute('data-rating') || '5');
                    const reviews = btn.getAttribute('data-reviews');
                    const stock = parseInt(btn.getAttribute('data-stock') || '10');

                    // Set modal fields
                    modalProductName.textContent = name;
                    modalMainImage.src = image;
                    modalMainImage.alt = name;
                    modalBreadcrumbCat.textContent = category;
                    modalProductDesc.textContent = desc;
                    modalVendorName.textContent = vendor;
                    modalReviewsCount.textContent = reviews;

                    // Pricing
                    modalProductPrice.textContent = `Rs. ${price.toLocaleString()}`;
                    if (hasDiscount) {
                        modalProductOriginalPrice.textContent = `Rs. ${originalPrice.toLocaleString()}`;
                        modalProductOriginalPrice.classList.remove('hidden');
                    } else {
                        modalProductOriginalPrice.classList.add('hidden');
                    }

                    // Stock status
                    if (stock > 0) {
                        modalStockStatus.textContent = 'In Stock';
                        modalStockStatus.className = 'text-xs text-emerald-700 font-bold';
                    } else {
                        modalStockStatus.textContent = 'Out of Stock';
                        modalStockStatus.className = 'text-xs text-red-500 font-bold';
                    }

                    // Stars
                    modalStarsContainer.innerHTML = '';
                    for (let i = 1; i <= 5; i++) {
                        const star = document.createElement('i');
                        star.style.marginRight = '2px';
                        if (i <= rating) {
                            star.className = 'fas fa-star text-yellow-500';
                        } else if (i - rating < 1) {
                            star.className = 'fas fa-star-half-alt text-yellow-500';
                        } else {
                            star.className = 'far fa-star text-yellow-500';
                        }
                        modalStarsContainer.appendChild(star);
                    }

                    // Reset quantity
                    qtyInput.value = 1;

                    // Open animation
                    modal.classList.remove('hidden');
                    modal.classList.add('block');
                    setTimeout(() => {
                        modal.classList.remove('opacity-0');
                        modal.classList.add('opacity-100');
                        container.classList.remove('scale-95', 'opacity-0');
                        container.classList.add('scale-100', 'opacity-100');
                    }, 10);
                    document.body.style.overflow = 'hidden';
                });
            });

            function closeModal() {
                modal.classList.remove('opacity-100');
                modal.classList.add('opacity-0');
                container.classList.remove('scale-100', 'opacity-100');
                container.classList.add('scale-95', 'opacity-0');
                setTimeout(() => {
                    modal.classList.remove('block');
                    modal.classList.add('hidden');
                }, 300);
                document.body.style.overflow = '';
            }

            if (closeBtn) closeBtn.addEventListener('click', closeModal);
            modal.addEventListener('click', function(e) {
                if (e.target === modal) closeModal();
            });
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') closeModal();
            });

            // Quantity buttons inside Modal
            const qtyPlus = modal.querySelector('.qty-plus-btn');
            const qtyMinus = modal.querySelector('.qty-minus-btn');

            qtyPlus.addEventListener('click', function() {
                qtyInput.value = parseInt(qtyInput.value) + 1;
            });
            qtyMinus.addEventListener('click', function() {
                const val = parseInt(qtyInput.value);
                if (val > 1) qtyInput.value = val - 1;
            });
            qtyInput.addEventListener('change', function() {
                let val = parseInt(this.value) || 1;
                if (val < 1) val = 1;
                this.value = val;
            });

            // Tab toggling inside Modal
            const tabBtns = modal.querySelectorAll('.tab-btn');
            const tabPanels = modal.querySelectorAll('.tab-panel');

            tabBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const target = btn.getAttribute('data-tab');
                    tabBtns.forEach(b => {
                        b.classList.remove('text-[#C65A3A]', 'border-b-2', 'border-[#C65A3A]', 'font-bold');
                        b.classList.add('text-[#3A2A1F]/60', 'font-semibold');
                    });
                    btn.classList.add('text-[#C65A3A]', 'border-b-2', 'border-[#C65A3A]', 'font-bold');
                    btn.classList.remove('text-[#3A2A1F]/60', 'font-semibold');

                    tabPanels.forEach(panel => {
                        if (panel.getAttribute('data-panel') === target) {
                            panel.classList.remove('hidden');
                        } else {
                            panel.classList.add('hidden');
                        }
                    });
                });
            });

            // Add to Cart / Buy Now actions
            document.getElementById('modal-add-to-cart-btn').addEventListener('click', function() {
                const name = modalProductName.textContent;
                const qty = qtyInput.value;
                
                // Try sending custom event to update top-level toast / logic if needed
                let event = new CustomEvent('toast-message', {
                    detail: { message: `${name} (${qty}) added to cart!`, type: 'success' }
                });
                document.dispatchEvent(event);
                
                // Direct call fallback
                const toastContainer = document.getElementById('toast-container');
                if (toastContainer) {
                    const toast = document.createElement('div');
                    toast.className = 'toast-item';
                    toast.innerHTML = `<i class="fa-regular fa-circle-check text-emerald-500"></i><span>${name} (${qty}) added to cart!</span>`;
                    toastContainer.appendChild(toast);
                    setTimeout(() => toast.classList.add('show'), 50);
                    setTimeout(() => {
                        toast.classList.remove('show');
                        toast.classList.add('hide');
                        setTimeout(() => toast.remove(), 400);
                    }, 3000);
                } else {
                    alert(`${name} (${qty}) added to cart!`);
                }
            });

            document.getElementById('modal-buy-now-btn').addEventListener('click', function() {
                const name = modalProductName.textContent;
                const qty = qtyInput.value;
                alert(`Proceeding to checkout with ${qty}x ${name}!`);
            });
        });
    })();
    </script>

</x-frontend-layout>