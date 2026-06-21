{{-- <x-frontend-layout>
  <main class="bg-[#f7fafc] min-h-screen">
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-[#d93537] to-[#ff6b5b] text-white py-16 px-4 md:px-8 lg:px-16">
      <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-12 items-center">
        <div>
          <span class="inline-block bg-white bg-opacity-20 text-white text-xs font-bold px-3 py-1 rounded-full mb-4">LIMITED TIME OFFER</span>
          <h1 class="text-[30px] md:text-[24px] font-bold leading-[38px] md:leading-[30px] tracking-[-0.02em] mb-4 font-['Plus_Jakarta_Sans']">Authentic Nepali Heritage</h1>
          <p class="text-white text-opacity-90 text-base leading-6 mb-6">Experience the pinnacle of Nepalese craftsmanship with our exclusive artisanal collection. Up to 60% off for the next 24 hours.</p>

          <!-- Countdown Timer -->
          <div class="flex gap-6 mb-8 font-['Plus_Jakarta_Sans']">
            <div class="text-center">
              <div class="text-3xl font-bold">08</div>
              <div class="text-xs font-semibold text-white text-opacity-80 uppercase">Hours</div>
            </div>
            <span class="text-2xl font-bold">:</span>
            <div class="text-center">
              <div class="text-3xl font-bold">42</div>
              <div class="text-xs font-semibold text-white text-opacity-80 uppercase">Mins</div>
            </div>
            <span class="text-2xl font-bold">:</span>
            <div class="text-center">
              <div class="text-3xl font-bold">13</div>
              <div class="text-xs font-semibold text-white text-opacity-80 uppercase">Secs</div>
            </div>
          </div>

          <button class="bg-white text-[#d93537] font-bold px-8 py-3 rounded-full hover:bg-opacity-90 transition font-['Plus_Jakarta_Sans']">Shop The Drop</button>
        </div>

        <div class="flex justify-center">
          <img src="{{ asset('images/Pottery.png') }}" alt="Authentic Nepali Heritage" class="max-w-md rounded-2xl shadow-lg">
        </div>
      </div>
    </section>

    <!-- Lightning Deals Section -->
    <section class="py-12 px-4 md:px-8 lg:px-16">
      <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-8">
          <div class="flex items-center gap-3">
            <span class="text-2xl">⚡</span>
            <h2 class="text-2xl font-bold text-[#181c1e] font-['Plus_Jakarta_Sans']">Lightning Deals</h2>
          </div>
          <a href="#" class="text-[#b51822] font-semibold hover:underline">View All</a>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
          <!-- Product Card 1 -->
          <div class="bg-white rounded-[16px] border border-[#e0e3e5] overflow-hidden hover:shadow-lg transition-all">
            <div class="relative aspect-square bg-gray-200">
              <img src="{{ asset('images/Pottery.png') }}" alt="Handcrafted Clay Pottery Set" class="w-full h-full object-cover">
              <span class="absolute top-3 left-3 bg-[#b51822] text-white text-xs font-bold px-3 py-1 rounded-full">-25% OFF</span>
            </div>
            <div class="p-4">
              <h3 class="font-bold text-[16px] leading-6 text-[#181c1e] mb-2 font-['Plus_Jakarta_Sans']">Handcrafted Clay Pottery Set</h3>
              <p class="text-[22px] font-bold text-[#b51822] mb-1 font-['Plus_Jakarta_Sans']">Rs. 2,450</p>
              <p class="text-sm text-[#5b403e] line-through mb-2">Rs. 3,280</p>
              <div class="flex items-center gap-1 mb-4">
                <span class="text-yellow-400">★★★★★</span>
                <span class="text-xs text-[#5b403e]">(58 Reviews)</span>
              </div>
              <div class="flex gap-2">
                <button class="flex-1 bg-[#b51822] text-white py-2 rounded-lg font-semibold hover:bg-[#930013] transition text-sm">Add to Cart</button>
                <button class="px-3 py-2 border border-[#e0e3e5] rounded-lg hover:bg-[#ebeef0] transition">👁️</button>
              </div>
            </div>
          </div>

          <!-- Product Card 2 -->
          <div class="bg-white rounded-[16px] border border-[#e0e3e5] overflow-hidden hover:shadow-lg transition-all">
            <div class="relative aspect-square bg-gray-200">
              <img src="{{ asset('images/Pottery.png') }}" alt="Lokta Paper Journal Set" class="w-full h-full object-cover">
              <span class="absolute top-3 left-3 bg-[#b51822] text-white text-xs font-bold px-3 py-1 rounded-full">-18% OFF</span>
            </div>
            <div class="p-4">
              <h3 class="font-bold text-[16px] leading-6 text-[#181c1e] mb-2 font-['Plus_Jakarta_Sans']">Lokta Paper Journal Set</h3>
              <p class="text-[22px] font-bold text-[#b51822] mb-1 font-['Plus_Jakarta_Sans']">Rs. 5,800</p>
              <p class="text-sm text-[#5b403e] line-through mb-2">Rs. 6,920</p>
              <div class="flex items-center gap-1 mb-4">
                <span class="text-yellow-400">★★★★☆</span>
                <span class="text-xs text-[#5b403e]">(124 Reviews)</span>
              </div>
              <div class="flex gap-2">
                <button class="flex-1 bg-[#b51822] text-white py-2 rounded-lg font-semibold hover:bg-[#930013] transition text-sm">Add to Cart</button>
                <button class="px-3 py-2 border border-[#e0e3e5] rounded-lg hover:bg-[#ebeef0] transition">👁️</button>
              </div>
            </div>
          </div>

          <!-- Product Card 3 -->
          <div class="bg-white rounded-[16px] border border-[#e0e3e5] overflow-hidden hover:shadow-lg transition-all">
            <div class="relative aspect-square bg-gray-200">
              <img src="{{ asset('images/Pottery.png') }}" alt="Traditional Dhaka Textile" class="w-full h-full object-cover">
              <span class="absolute top-3 left-3 bg-[#b51822] text-white text-xs font-bold px-3 py-1 rounded-full">-40% OFF</span>
            </div>
            <div class="p-4">
              <h3 class="font-bold text-[16px] leading-6 text-[#181c1e] mb-2 font-['Plus_Jakarta_Sans']">Traditional Dhaka Textile</h3>
              <p class="text-[22px] font-bold text-[#b51822] mb-1 font-['Plus_Jakarta_Sans']">Rs. 12,400</p>
              <p class="text-sm text-[#5b403e] line-through mb-2">Rs. 20,600</p>
              <div class="flex items-center gap-1 mb-4">
                <span class="text-yellow-400">★★★★★</span>
                <span class="text-xs text-[#5b403e]">(89 Reviews)</span>
              </div>
              <div class="flex gap-2">
                <button class="flex-1 bg-[#b51822] text-white py-2 rounded-lg font-semibold hover:bg-[#930013] transition text-sm">Add to Cart</button>
                <button class="px-3 py-2 border border-[#e0e3e5] rounded-lg hover:bg-[#ebeef0] transition">👁️</button>
              </div>
            </div>
          </div>

          <!-- Product Card 4 -->
          <div class="bg-white rounded-[16px] border border-[#e0e3e5] overflow-hidden hover:shadow-lg transition-all">
            <div class="relative aspect-square bg-gray-200">
              <img src="{{ asset('images/Pottery.png') }}" alt="Himalayan Salt Lamp" class="w-full h-full object-cover">
              <span class="absolute top-3 left-3 bg-[#005ea1] text-white text-xs font-bold px-3 py-1 rounded-full">NEW DEAL</span>
            </div>
            <div class="p-4">
              <h3 class="font-bold text-[16px] leading-6 text-[#181c1e] mb-2 font-['Plus_Jakarta_Sans']">Himalayan Salt Lamp</h3>
              <p class="text-[22px] font-bold text-[#b51822] mb-1 font-['Plus_Jakarta_Sans']">Rs. 1,850</p>
              <p class="text-sm text-[#5b403e] line-through mb-2">Rs. 2,300</p>
              <div class="flex items-center gap-1 mb-4">
                <span class="text-yellow-400">★★★★★</span>
                <span class="text-xs text-[#5b403e]">(215 Reviews)</span>
              </div>
              <div class="flex gap-2">
                <button class="flex-1 bg-[#b51822] text-white py-2 rounded-lg font-semibold hover:bg-[#930013] transition text-sm">Add to Cart</button>
                <button class="px-3 py-2 border border-[#e0e3e5] rounded-lg hover:bg-[#ebeef0] transition">👁️</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Featured Star Deal Section -->
    <section class="bg-[#2d3133] text-white py-16 px-4 md:px-8 lg:px-16">
      <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-12 items-center">
        <div>
          <span class="inline-flex items-center gap-2 text-xs font-bold text-white mb-4 uppercase tracking-widest">
            <span class="text-xl">⭐</span> Featured Star Deal
          </span>
          <h2 class="text-[30px] font-bold leading-[38px] tracking-[-0.02em] mb-4 font-['Plus_Jakarta_Sans']">Hand-Knotted Wool Mandala Rug</h2>
          <p class="text-white text-opacity-80 text-base leading-6 mb-8">Exquisite hand-knotted wool rug featuring traditional mandala patterns. A masterpiece of Nepalese weaving heritage that brings warmth and spiritual elegance to any space.</p>

          <p class="text-sm text-white text-opacity-70 mb-2">Regularly Rs. 65,000</p>
          <p class="text-5xl font-bold mb-8 font-['Plus_Jakarta_Sans']">Rs. 45,000</p>

          <div class="flex gap-4">
            <button class="bg-[#d4a017] hover:bg-[#b38a0a] text-black font-bold px-8 py-3 rounded-full transition flex items-center gap-2 font-['Plus_Jakarta_Sans']">
              Buy Now <span>→</span>
            </button>
            <button class="border-2 border-white text-white font-bold px-8 py-3 rounded-full hover:bg-white hover:text-[#2d3133] transition font-['Plus_Jakarta_Sans']">Details</button>
          </div>
        </div>

        <div class="flex justify-center">
          <img src="{{ asset('images/Pottery.png') }}" alt="Hand-Knotted Wool Mandala Rug" class="w-full max-w-md rounded-lg">
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
          <div class="flex gap-2">
            <button class="p-2 border border-[#e0e3e5] rounded-lg hover:bg-[#ebeef0] transition">←</button>
            <button class="p-2 border border-[#e0e3e5] rounded-lg hover:bg-[#ebeef0] transition">→</button>
          </div>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
          <!-- Trending Product 1 -->
          <div class="bg-white rounded-[16px] border border-[#e0e3e5] overflow-hidden hover:shadow-lg transition-all">
            <div class="aspect-square bg-gradient-to-br from-[#1a1d29] to-[#2d3a4f] flex items-center justify-center">
              <img src="{{ asset('images/Pottery.png') }}" alt="Silver Filigree Jewelry Set" class="w-full h-full object-cover">
            </div>
            <div class="p-4">
              <span class="text-xs font-bold text-[#b51822] uppercase tracking-widest">Accessories</span>
              <h3 class="font-bold text-[16px] text-[#181c1e] mb-2 font-['Plus_Jakarta_Sans']">Silver Filigree Jewelry Set</h3>
              <p class="text-[22px] font-bold text-[#181c1e] font-['Plus_Jakarta_Sans']">Rs. 3,200</p>
            </div>
          </div>

          <!-- Trending Product 2 -->
          <div class="bg-white rounded-[16px] border border-[#e0e3e5] overflow-hidden hover:shadow-lg transition-all">
            <div class="aspect-square bg-gradient-to-br from-[#2d1810] to-[#4a2c1a] flex items-center justify-center">
              <img src="{{ asset('images/Pottery.png') }}" alt="Botanical Brass Candle" class="w-full h-full object-cover">
            </div>
            <div class="p-4">
              <span class="text-xs font-bold text-[#b51822] uppercase tracking-widest">Home Decor</span>
              <h3 class="font-bold text-[16px] text-[#181c1e] mb-2 font-['Plus_Jakarta_Sans']">Botanical Brass Candle</h3>
              <p class="text-[22px] font-bold text-[#181c1e] font-['Plus_Jakarta_Sans']">Rs. 950</p>
            </div>
          </div>

          <!-- Trending Product 3 -->
          <div class="bg-white rounded-[16px] border border-[#e0e3e5] overflow-hidden hover:shadow-lg transition-all">
            <div class="aspect-square bg-gradient-to-br from-[#1a1212] to-[#3d2a2a] flex items-center justify-center">
              <img src="{{ asset('images/Pottery.png') }}" alt="Carved Wooden Deity Mask" class="w-full h-full object-cover">
            </div>
            <div class="p-4">
              <span class="text-xs font-bold text-[#b51822] uppercase tracking-widest">Art</span>
              <h3 class="font-bold text-[16px] text-[#181c1e] mb-2 font-['Plus_Jakarta_Sans']">Carved Wooden Deity Mask</h3>
              <p class="text-[22px] font-bold text-[#181c1e] font-['Plus_Jakarta_Sans']">Rs. 1,600</p>
            </div>
          </div>

          <!-- Trending Product 4 -->
          <div class="bg-white rounded-[16px] border border-[#e0e3e5] overflow-hidden hover:shadow-lg transition-all">
            <div class="aspect-square bg-gradient-to-br from-[#2a1810] to-[#4a3a2a] flex items-center justify-center">
              <img src="{{ asset('images/Pottery.png') }}" alt="Organic Clay Bowls" class="w-full h-full object-cover">
            </div>
            <div class="p-4">
              <span class="text-xs font-bold text-[#b51822] uppercase tracking-widest">Pottery</span>
              <h3 class="font-bold text-[16px] text-[#181c1e] mb-2 font-['Plus_Jakarta_Sans']">Organic Clay Bowls</h3>
              <p class="text-[22px] font-bold text-[#181c1e] font-['Plus_Jakarta_Sans']">Rs. 4,500</p>
            </div>
          </div>
        </div>
      </div>
    </section>

  </main>
</x-frontend-layout> --}}
