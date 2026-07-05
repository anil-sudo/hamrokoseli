<x-frontend-layout title="Today's Deals - Hamro Koseli">

  <main class="bg-[#f7fafc] min-h-screen">
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-[#d93537] to-[#ff6b5b] text-white py-16 px-4 md:px-8 lg:px-16">
      <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-12 items-center">
        <div>
          <span class="inline-block bg-white bg-opacity-20 text-white text-xs font-bold px-3 py-1 rounded-full mb-4">LIMITED TIME OFFER</span>
          <h1 class="text-[30px] md:text-[24px] font-bold leading-[38px] md:leading-[30px] tracking-[-0.02em] mb-4 font-['Plus_Jakarta_Sans']">Authentic Nepali Heritage</h1>
          <p class="text-white text-opacity-90 text-base leading-6 mb-6">Experience the pinnacle of Nepalese craftsmanship with our exclusive artisanal collection. Today's deals refresh at midnight.</p>

          <!-- Countdown Timer (real — counts down to midnight) -->
          <div class="flex gap-6 mb-8 font-['Plus_Jakarta_Sans']">
            <div class="text-center">
              <div id="countdown-hours" class="text-3xl font-bold">--</div>
              <div class="text-xs font-semibold text-white text-opacity-80 uppercase">Hours</div>
            </div>
            <span class="text-2xl font-bold">:</span>
            <div class="text-center">
              <div id="countdown-mins" class="text-3xl font-bold">--</div>
              <div class="text-xs font-semibold text-white text-opacity-80 uppercase">Mins</div>
            </div>
            <span class="text-2xl font-bold">:</span>
            <div class="text-center">
              <div id="countdown-secs" class="text-3xl font-bold">--</div>
              <div class="text-xs font-semibold text-white text-opacity-80 uppercase">Secs</div>
            </div>
          </div>

          <a href="#deals-grid" class="bg-white text-[#d93537] font-bold px-8 py-3 rounded-full hover:bg-opacity-90 transition font-['Plus_Jakarta_Sans'] inline-block">Shop The Drop</a>
        </div>

        <div class="flex justify-center">
          <img src="{{ asset('images/Pottery.png') }}" alt="Authentic Nepali Heritage" class="max-w-md rounded-2xl shadow-lg">
        </div>
      </div>
    </section>

    <!-- Lightning Deals Section -->
    <section id="deals-grid" class="py-12 px-4 md:px-8 lg:px-16">
      <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-8">
          <div class="flex items-center gap-3">
            <span class="text-2xl">⚡</span>
            <h2 class="text-2xl font-bold text-[#181c1e] font-['Plus_Jakarta_Sans']">Today's Deals</h2>
          </div>
        </div>

        <form id="deals-filter-form" method="GET" action="{{ route('todays-deals') }}">

          <!-- Filter Controls -->
          <div class="bg-white rounded-lg border border-[#e0e3e5] p-6 mb-8">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
              <!-- Category Filter -->
              <div>
                <span class="text-xs font-bold uppercase tracking-wider text-[#181c1e] block mb-3">Filter by Category</span>
                <div class="flex flex-wrap gap-2" id="category-filters">
                  <button type="submit" name="category" value="all"
                    class="filter-pill px-4 py-2 border text-xs font-bold rounded-full transition
                    {{ request('category', 'all') === 'all' ? 'bg-[#b51822] text-white border-[#b51822]' : 'border-[#e0e3e5] text-[#181c1e] hover:border-[#b51822]' }}">
                    All Categories
                  </button>
                  @foreach($categories as $cat)
                    <button type="submit" name="category" value="{{ $cat->slug }}"
                      class="filter-pill px-4 py-2 border text-xs font-bold rounded-full transition
                      {{ request('category') === $cat->slug ? 'bg-[#b51822] text-white border-[#b51822]' : 'border-[#e0e3e5] text-[#181c1e] hover:border-[#b51822]' }}">
                      {{ $cat->cat_name }}
                    </button>
                  @endforeach
                </div>
              </div>

              <!-- Sort -->
              <div class="flex items-center gap-3">
                <span class="text-xs font-bold uppercase tracking-wider text-[#181c1e]">Sort By:</span>
                <select id="sort-select" name="sort" class="border border-[#e0e3e5] rounded-lg px-4 py-2 text-sm font-semibold text-[#181c1e] focus:outline-none focus:ring-2 focus:ring-[#b51822]">
                  <option value="discount" {{ request('sort', 'discount') === 'discount' ? 'selected' : '' }}>Biggest Discount</option>
                  <option value="price-asc" {{ request('sort') === 'price-asc' ? 'selected' : '' }}>Price: Low to High</option>
                  <option value="price-desc" {{ request('sort') === 'price-desc' ? 'selected' : '' }}>Price: High to Low</option>
                </select>
              </div>
            </div>
          </div>

          <!-- Product Grid -->
          <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6" id="product-grid">
            @forelse($products as $product)
              @php
                $price = (float) $product->price;
                $discountPrice = $product->resolvedDiscountPrice();
                $hasDiscount = !is_null($discountPrice) && $discountPrice > 0 && $discountPrice < $price;
                $displayPrice = $hasDiscount ? $discountPrice : $price;
                $discountPercentage = ($price > 0 && $hasDiscount) ? round((($price - $discountPrice) / $price) * 100) : 0;
                $avgRating = $product->reviews_avg_rating ? round($product->reviews_avg_rating, 1) : null;
                $reviewCount = $product->reviews_count ?? 0;
              @endphp
              <div class="product-card bg-white rounded-3xl overflow-hidden border border-[#ebd7be]/40 shadow-sm hover:shadow-md transition duration-300 flex flex-col group">
                <div class="relative w-full aspect-[4/5] overflow-hidden rounded-t-3xl bg-slate-100">
                  <img src="{{ $product->primaryImageUrl() }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                  @if($hasDiscount)
                    <span class="absolute top-4 left-4 bg-[#b51822] text-white text-[10px] font-bold px-3 py-1.5 rounded-full z-10 shadow">-{{ $discountPercentage }}% OFF</span>
                  @endif
                  @if($product->vendor)
                    <div class="absolute top-4 right-4 bg-white/95 text-[#1F3D2E] text-[10px] font-bold tracking-wider uppercase px-3 py-1.5 rounded-full shadow-sm z-10">
                      {{ $product->vendor->business_name ?? $product->vendor->name }}
                    </div>
                  @endif
                  <button
                    class="wishlist-btn absolute bottom-4 right-4 text-[#C65A3A] hover:text-[#b04a2c] transition-colors text-xl drop-shadow z-10"
                    data-product-id="{{ $product->id }}"
                    data-product-name="{{ $product->name }}"
                    data-product-price="{{ $displayPrice }}"
                    data-product-image="{{ $product->primaryImageUrl() }}"
                    data-product-desc="{{ $product->description }}"
                    data-product-category="{{ $product->category?->cat_name }}">
                    <i class="far fa-heart"></i>
                  </button>
                </div>
                <div class="p-5 flex-grow flex flex-col justify-between">
                  <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-[#3A2A1F]/50 block mb-1">
                      {{ $product->category?->cat_name ?? 'General' }}
                    </span>
                    <h3 class="text-lg font-bold text-[#1F3D2E] mb-2 leading-tight group-hover:text-[#C65A3A] transition-colors line-clamp-1">
                      {{ $product->name }}
                    </h3>
                    <div class="flex items-baseline gap-2 mb-4">
                      <span class="text-[#C65A3A] font-bold text-base">
                        {{ number_format($price, 2) }}
                      </span>
                      @if($hasDiscount)
                        <span class="text-slate-400 text-xs line-through font-semibold">
                          Rs {{ number_format($price, 2) }}
                        </span>
                      @endif
                    </div>
                  </div>
                  <div class="flex gap-2 mt-auto">
                    <a href="{{ route('viewdetails', $product->slug) }}"
                       class="view-details-btn flex-1 flex items-center justify-center gap-2 bg-[#1F3D2E] hover:bg-[#16301f] text-white text-sm font-semibold py-3 px-3 rounded-xl shadow-sm hover:shadow transition duration-300"
                       data-id="{{ $product->id }}"
                       data-slug="{{ $product->slug }}"
                       data-name="{{ $product->name }}"
                       data-price="{{ $displayPrice }}"
                       data-original-price="{{ $price }}"
                       data-discount="{{ $hasDiscount ? 'true' : 'false' }}"
                       data-discount-price="{{ $discountPrice ?? '' }}"
                       data-image="{{ $product->primaryImageUrl() }}"
                       data-category="{{ $product->category?->cat_name ?? 'Crafts' }}"
                       data-vendor="{{ $product->vendor->business_name ?? $product->vendor->name ?? 'Local Artisan' }}"
                       data-desc="{{ $product->description }}"
                       data-rating="{{ $avgRating ?? 5 }}"
                       data-reviews="{{ $reviewCount ?? 24 }}"
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
            @empty
              <div class="col-span-full text-center py-12">
                <p class="text-[#5b403e] text-lg">No deals available right now — check back soon.</p>
              </div>
            @endforelse
          </div>

          {{-- Pagination --}}
          @if($products->hasPages())
            <div class="flex items-center justify-center gap-3 mt-10">
              @if($products->onFirstPage())
                <span class="w-10 h-10 rounded-full border border-[#e0e3e5] flex items-center justify-center text-[#181c1e]/30 cursor-not-allowed">
                  <i class="fas fa-chevron-left text-xs"></i>
                </span>
              @else
                <a href="{{ $products->previousPageUrl() }}" class="w-10 h-10 rounded-full border border-[#e0e3e5] flex items-center justify-center text-[#181c1e] hover:bg-[#ebeef0] transition">
                  <i class="fas fa-chevron-left text-xs"></i>
                </a>
              @endif

              <div class="flex items-center gap-1">
                @php
                  $start = max(1, $products->currentPage() - 2);
                  $end = min($products->lastPage(), $products->currentPage() + 2);
                @endphp

                @if($start > 1)
                  <a href="{{ $products->url(1) }}" class="w-10 h-10 flex items-center justify-center text-sm font-semibold text-[#181c1e]/60 hover:text-[#181c1e] transition-colors">1</a>
                  @if($start > 2)<span class="text-sm font-semibold text-[#181c1e]/40 px-2">...</span>@endif
                @endif

                @for($page = $start; $page <= $end; $page++)
                  @if($page == $products->currentPage())
                    <a href="{{ $products->url($page) }}" class="w-10 h-10 flex flex-col items-center justify-center text-sm font-bold text-[#b51822] relative">
                      <span>{{ $page }}</span>
                      <span class="absolute bottom-1 w-5 h-0.5 bg-[#b51822] rounded-full"></span>
                    </a>
                  @else
                    <a href="{{ $products->url($page) }}" class="w-10 h-10 flex items-center justify-center text-sm font-semibold text-[#181c1e]/60 hover:text-[#181c1e] transition-colors">{{ $page }}</a>
                  @endif
                @endfor

                @if($end < $products->lastPage())
                  @if($end < $products->lastPage() - 1)<span class="text-sm font-semibold text-[#181c1e]/40 px-2">...</span>@endif
                  <a href="{{ $products->url($products->lastPage()) }}" class="w-10 h-10 flex items-center justify-center text-sm font-semibold text-[#181c1e]/60 hover:text-[#181c1e] transition-colors">{{ $products->lastPage() }}</a>
                @endif
              </div>

              @if($products->hasMorePages())
                <a href="{{ $products->nextPageUrl() }}" class="w-10 h-10 rounded-full border border-[#e0e3e5] flex items-center justify-center text-[#181c1e] hover:bg-[#ebeef0] transition">
                  <i class="fas fa-chevron-right text-xs"></i>
                </a>
              @else
                <span class="w-10 h-10 rounded-full border border-[#e0e3e5] flex items-center justify-center text-[#181c1e]/30 cursor-not-allowed">
                  <i class="fas fa-chevron-right text-xs"></i>
                </span>
              @endif
            </div>
          @endif

        </form>
      </div>
    </section>

    @if($featuredDeals->isNotEmpty())
    <!-- Featured Star Deal Carousel Section -->
    <section class="bg-[#2d3133] text-white py-16 px-4 md:px-8 lg:px-16">
      <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-8">
          <div class="flex items-center gap-2">
            <span class="text-xl">⭐</span>
            <h2 class="text-2xl font-bold font-['Plus_Jakarta_Sans']">Featured Star Deals</h2>
          </div>
          <div class="flex gap-3">
            <button id="featured-prev" type="button" class="p-2 border border-white rounded-lg hover:bg-white hover:text-[#2d3133] transition">
              <i class="fas fa-chevron-left"></i>
            </button>
            <button id="featured-next" type="button" class="p-2 border border-white rounded-lg hover:bg-white hover:text-[#2d3133] transition">
              <i class="fas fa-chevron-right"></i>
            </button>
          </div>
        </div>

        <!-- Carousel Container -->
        <div class="relative overflow-hidden">
          <div id="featured-carousel" class="flex gap-6 transition-transform duration-500 ease-out">
            @foreach($featuredDeals as $deal)
              @php
                $dPrice = (float) $deal->price;
                $dDiscount = $deal->resolvedDiscountPrice();
                $dHasDiscount = !is_null($dDiscount) && $dDiscount > 0 && $dDiscount < $dPrice;
                $dDisplayPrice = $dHasDiscount ? $dDiscount : $dPrice;
              @endphp
              <div class="featured-card flex-shrink-0 w-full">
                <div class="grid md:grid-cols-2 gap-6 items-center bg-[#1a1a1a] rounded-2xl p-6">
                  <div class="flex justify-center">
                    <img src="{{ $deal->primaryImageUrl() }}" alt="{{ $deal->name }}" class="w-full max-w-xs rounded-lg">
                  </div>
                  <div>
                    <span class="inline-block bg-white bg-opacity-20 text-white text-xs font-bold px-3 py-1 rounded-full mb-3">FEATURED</span>
                    <h3 class="text-2xl font-bold mb-3 font-['Plus_Jakarta_Sans']">{{ $deal->name }}</h3>
                    <p class="text-white text-opacity-80 text-sm leading-6 mb-4 line-clamp-3">{{ $deal->description }}</p>
                    @if($dHasDiscount)
                      <p class="text-sm text-white text-opacity-70 mb-1">Regularly Rs. {{ number_format($dPrice) }}</p>
                    @endif
                    <p class="text-4xl font-bold mb-4 font-['Plus_Jakarta_Sans']">Rs. {{ number_format($dDisplayPrice) }}</p>
                    <div class="flex gap-3">
                      <a href="{{ route('viewdetails', $deal->slug) }}" class="bg-[#d4a017] hover:bg-[#b38a0a] text-black font-bold px-6 py-2 rounded-full transition flex items-center gap-2 font-['Plus_Jakarta_Sans'] text-sm">
                        Buy Now <span>→</span>
                      </a>
                      <a href="{{ route('viewdetails', $deal->slug) }}" class="border border-white text-white font-bold px-6 py-2 rounded-full hover:bg-white hover:text-[#2d3133] transition text-sm">Details</a>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </section>
    @endif

    @if($trendingProducts->isNotEmpty())
    <!-- Trending Now Section -->
    <section class="py-16 px-4 md:px-8 lg:px-16">
      <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-8">
          <h2 class="text-2xl font-bold text-[#181c1e] flex items-center gap-2 font-['Plus_Jakarta_Sans']">
            <span class="text-2xl">📈</span> Trending Now
          </h2>
          <div class="flex gap-3">
            <button id="trending-prev" type="button" class="p-2 border border-[#e0e3e5] rounded-lg hover:bg-[#ebeef0] transition">
              <i class="fas fa-chevron-left text-[#181c1e]"></i>
            </button>
            <button id="trending-next" type="button" class="p-2 border border-[#e0e3e5] rounded-lg hover:bg-[#ebeef0] transition">
              <i class="fas fa-chevron-right text-[#181c1e]"></i>
            </button>
          </div>
        </div>

        <!-- Trending Carousel -->
        <div class="relative overflow-hidden">
          <div id="trending-carousel" class="flex gap-6 transition-transform duration-500 ease-out">
            @foreach($trendingProducts as $trend)
              <div class="trending-card flex-shrink-0 w-full md:w-1/2 lg:w-1/4">
                <a href="{{ route('viewdetails', $trend->slug) }}" class="block bg-white rounded-[16px] border border-[#e0e3e5] overflow-hidden hover:shadow-lg transition-all">
                  <div class="aspect-square bg-gray-200 flex items-center justify-center">
                    <img src="{{ $trend->primaryImageUrl() }}" alt="{{ $trend->name }}" class="w-full h-full object-cover">
                  </div>
                  <div class="p-4">
                    <span class="text-xs font-bold text-[#b51822] uppercase tracking-widest">{{ $trend->category?->cat_name ?? 'Crafts' }}</span>
                    <h3 class="font-bold text-[16px] text-[#181c1e] mb-2 font-['Plus_Jakarta_Sans'] line-clamp-1">{{ $trend->name }}</h3>
                    <p class="text-[22px] font-bold text-[#181c1e] font-['Plus_Jakarta_Sans']">Rs. {{ number_format($trend->effectivePrice()) }}</p>
                  </div>
                </a>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </section>
    @endif

  </main>

  <!-- Countdown + Sort Auto-Submit + Carousel Script -->
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
              document.getElementById('countdown-mins').textContent = String(mins).padStart(2, '0');
              document.getElementById('countdown-secs').textContent = String(secs).padStart(2, '0');
          }
          updateCountdown();
          setInterval(updateCountdown, 1000);

          // ==================== SORT AUTO-SUBMIT ====================
          const dealsForm = document.getElementById('deals-filter-form');
          const sortSelect = document.getElementById('sort-select');
          if (sortSelect && dealsForm) {
              sortSelect.addEventListener('change', () => dealsForm.submit());
          }

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