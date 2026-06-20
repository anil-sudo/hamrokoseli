<x-frontend-layout>

    <div class="bg-[#F4EAE1] text-[#3A2A1F] min-h-screen py-8 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Page Header -->
            <div class="mb-8">
                <h1 class="text-3xl md:text-4xl font-bold text-[#1F3D2E] tracking-tight">Today's Deals</h1>
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
                                <option value="discount">Biggest Discount</option>
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
                @foreach($products as $product)
                    @php
                        $price = $product->price;
                        $discountPrice = $product->discount_price ?? null;
                        $hasDiscount = !is_null($discountPrice) && $discountPrice < $price;
                        $displayPrice = $hasDiscount ? $discountPrice : $price;
                        
                        $discountPercentage = $hasDiscount ? round((($price - $discountPrice) / $price) * 100) : 0;
                        $savings = $hasDiscount ? ($price - $discountPrice) : 0;
                    @endphp
                    <!-- Product Card -->
                    <div class="product-card bg-white rounded-3xl overflow-hidden border border-[#ebd7be]/40 shadow-sm flex flex-col group"
                         data-id="{{ $product->id }}"
                         data-name="{{ $product->name }}"
                         data-price="{{ $displayPrice }}"
                         data-category="{{ strtolower($product->category->cat_name ?? '') }}"
                         data-discount="{{ $discountPercentage }}">
                         
                        <div class="relative w-full aspect-[4/5] overflow-hidden rounded-t-3xl bg-slate-100">
                            <!-- Image Zoom on Hover -->
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            
                            @if ($hasDiscount)
                                <!-- Discount Badge -->
                                <span class="absolute top-4 left-4 discount-badge text-[10px] font-extrabold uppercase tracking-wider px-3 py-1.5 rounded-full z-10">
                                    -{{ $discountPercentage }}% OFF
                                </span>
                            @endif
                            
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
                                <a href="#" class="view-details-btn inline-flex items-center justify-center gap-1.5 bg-[#C65A3A] hover:bg-[#b04a2c] text-white text-xs font-bold px-4 py-2.5 rounded-xl shadow-sm hover:shadow transition duration-300 active:scale-95 cursor-pointer"
                                   data-id="{{ $product->id }}"
                                   data-name="{{ $product->name }}"
                                   data-price="{{ $displayPrice }}"
                                   data-original-price="{{ $price }}"
                                   data-discount="{{ $hasDiscount ? 'true' : 'false' }}"
                                   data-discount-percentage="{{ $discountPercentage }}"
                                   data-savings="{{ $savings }}"
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
                    Home &nbsp;&rsaquo;&nbsp; Today's Deals &nbsp;&rsaquo;&nbsp; <span class="text-[#C65A3A]" id="modal-breadcrumb-cat">Category</span>
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
                            <div class="flex items-center gap-2">
                                <span class="inline-flex items-center gap-1.5 bg-[#E5DCD0]/70 text-[#1F3D2E] text-[10px] font-bold tracking-wider uppercase px-3 py-1 rounded-full">
                                    Authentic Handmade
                                </span>
                                <span id="modal-discount-tag" class="inline-flex items-center gap-1.5 bg-amber-500 text-[#1A2A20] text-[10px] font-extrabold tracking-wider uppercase px-3 py-1 rounded-full shadow-sm">
                                    -0% OFF
                                </span>
                            </div>
                            
                            <div class="flex items-center gap-2 text-xs">
                                <div class="flex text-yellow-500 gap-0.5" id="modal-stars-container">
                                    <!-- Stars dynamically loaded -->
                                </div>
                                <span class="text-[#3A2A1F]/60 font-semibold">(<span id="modal-reviews-count">0</span> Reviews)</span>
                            </div>
                            
                            <h1 class="text-2xl sm:text-3xl font-bold text-[#1F3D2E] leading-tight font-serif" id="modal-product-name">Product Name</h1>
                            
                            <div class="flex items-baseline gap-3">
                                <span class="text-[#C65A3A] font-extrabold text-2xl" id="modal-product-price">Rs 0</span>
                                <span class="text-slate-400 text-sm line-through hidden" id="modal-product-original-price">Rs 0</span>
                                <span class="text-xs text-emerald-700 font-bold hidden" id="modal-savings-tag">Save Rs 0</span>
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
                    if (criteria === 'discount') {
                        return parseInt(b.getAttribute('data-discount')) - parseInt(a.getAttribute('data-discount'));
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

            // Sort products by discount on load
            sortProducts('discount');

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
            const modalDiscountTag = document.getElementById('modal-discount-tag');
            const modalSavingsTag = document.getElementById('modal-savings-tag');

            // Add Click Handlers on Product Cards "View Details"
            document.querySelectorAll('.view-details-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Read details
                    const name = btn.getAttribute('data-name');
                    const price = parseFloat(btn.getAttribute('data-price'));
                    const originalPrice = parseFloat(btn.getAttribute('data-original-price'));
                    const hasDiscount = btn.getAttribute('data-discount') === 'true';
                    const discountPercentage = parseInt(btn.getAttribute('data-discount-percentage') || '0');
                    const savings = parseFloat(btn.getAttribute('data-savings') || '0');
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
                        
                        modalDiscountTag.textContent = `-${discountPercentage}% OFF`;
                        modalDiscountTag.classList.remove('hidden');
                        
                        modalSavingsTag.textContent = `Save Rs. ${savings.toLocaleString()}`;
                        modalSavingsTag.classList.remove('hidden');
                    } else {
                        modalProductOriginalPrice.classList.add('hidden');
                        modalDiscountTag.classList.add('hidden');
                        modalSavingsTag.classList.add('hidden');
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
    </script>
</x-frontend-layout>
