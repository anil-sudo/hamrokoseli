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
        document.addEventListener('DOMContentLoaded', function () {

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
                                // Laravel CSRF token -must be present in the page meta tag
                                'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]')?.content ?? '',
                            },
                            body: JSON.stringify({
                                product_id : productId,
                                quantity   : 1,
                            }),
                        });

                        const json = await response.json();

                        if (response.status === 401) {
                            // Not logged in -send to login page
                            showToast('Please log in to add items to your cart.', 'warning');
                            setTimeout(() => {
                                window.location.href = '{{ route('userlogin') }}';
                            }, 1500);
                            return;
                        }

                        if (json.success) {
                            showToast(`${productName} added to cart!`, 'success');
                            updateCartBadge(json.cart_count ?? 0);

                            // Brief visual feedback on the button
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

        });
    })();
    </script>

</x-frontend-layout>