{{-- <x-frontend-layout>
  <main class="bg-[#f7fafc] min-h-screen py-12 px-4 md:px-8 lg:px-16">
    <div class="max-w-7xl mx-auto">
      <!-- Breadcrumb -->
      <div class="flex items-center gap-2 text-sm text-[#5b403e] mb-8">
        <a href="/" class="hover:text-[#b51822]">Home</a>
        <span>/</span>
        <a href="/deals" class="hover:text-[#b51822]">Deals</a>
        <span>/</span>
        <span class="text-[#181c1e] font-semibold">Product Details</span>
      </div>

      <!-- Product Grid -->
      <div class="grid lg:grid-cols-3 gap-12 mb-16">
        <!-- Product Images -->
        <div class="lg:col-span-1">
          <div class="relative bg-white rounded-lg border border-[#e0e3e5] overflow-hidden">
            <img src="{{ asset('images/Pottery.png') }}" alt="Product" class="w-full">
            <span class="absolute top-4 left-4 bg-[#b51822] text-white px-3 py-1 rounded-full text-xs font-bold">-25% OFF</span>
          </div>
        </div>

        <!-- Product Info -->
        <div class="lg:col-span-2">
          <h1 class="text-[30px] font-bold text-[#181c1e] mb-2 font-['Plus_Jakarta_Sans']">Handcrafted Clay Pottery Set</h1>

          <div class="flex items-center gap-3 mb-6">
            <div class="flex gap-1">
              <span class="text-yellow-400">★</span>
              <span class="text-yellow-400">★</span>
              <span class="text-yellow-400">★</span>
              <span class="text-yellow-400">★</span>
              <span class="text-yellow-400">★</span>
            </div>
            <span class="text-[#5b403e]">(58 Reviews)</span>
          </div>

          <div class="bg-[#ebeef0] rounded-lg p-6 mb-6">
            <p class="text-[#5b403e] text-sm mb-2">Price</p>
            <div class="flex items-baseline gap-3">
              <p class="text-[40px] font-bold text-[#b51822] font-['Plus_Jakarta_Sans']">Rs. 2,450</p>
              <p class="text-xl text-[#5b403e] line-through">Rs. 3,280</p>
              <span class="text-sm font-bold text-[#b51822] bg-white px-3 py-1 rounded">25% off</span>
            </div>
          </div>

          <div class="space-y-4 mb-8">
            <div>
              <label class="block text-sm font-semibold text-[#181c1e] mb-2">Quantity</label>
              <div class="flex items-center border border-[#e0e3e5] rounded-lg w-fit">
                <button class="px-4 py-2 text-[#b51822] font-bold hover:bg-[#ebeef0]">−</button>
                <span class="px-6 py-2 font-semibold">1</span>
                <button class="px-4 py-2 text-[#b51822] font-bold hover:bg-[#ebeef0]">+</button>
              </div>
            </div>
          </div>

          <div class="flex gap-4 mb-8">
            <button class="flex-1 bg-[#b51822] text-white font-bold py-3 rounded-lg hover:bg-[#930013] transition text-lg font-['Plus_Jakarta_Sans']">Add to Cart</button>
            <button class="px-6 py-3 border-2 border-[#b51822] text-[#b51822] font-bold rounded-lg hover:bg-[#ebeef0] transition">❤️ Save</button>
          </div>

          <div class="text-sm text-[#5b403e] space-y-2">
            <p>✓ Free shipping on orders over Rs. 5,000</p>
            <p>✓ 30-day returns</p>
            <p>✓ Authentic product from Nepal</p>
          </div>
        </div>
      </div>

      <!-- Product Description -->
      <div class="bg-white rounded-lg border border-[#e0e3e5] p-8 mb-12">
        <h2 class="text-2xl font-bold text-[#181c1e] mb-4 font-['Plus_Jakarta_Sans']">About This Product</h2>
        <p class="text-[#5b403e] leading-relaxed mb-4">
          This exquisite clay pottery set showcases the finest craftsmanship from Bhaktapur, Nepal. Each piece is hand-thrown and hand-painted by master potters using traditional techniques passed down through generations.
        </p>
        <p class="text-[#5b403e] leading-relaxed">
          Perfect for home décor, gifting, or daily use, this set combines functionality with artistic beauty. The natural clay composition makes each piece unique and durable for years to come.
        </p>
      </div>

      <!-- Related Products -->
      <div>
        <h2 class="text-2xl font-bold text-[#181c1e] mb-8 font-['Plus_Jakarta_Sans']">Related Products</h2>
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
          <div class="bg-white rounded-[16px] border border-[#e0e3e5] overflow-hidden hover:shadow-lg transition-all">
            <div class="relative aspect-square bg-gray-200">
              <img src="{{ asset('images/Pottery.png') }}" alt="Related Product" class="w-full h-full object-cover">
            </div>
            <div class="p-4">
              <h3 class="font-bold text-[16px] text-[#181c1e] mb-2 font-['Plus_Jakarta_Sans']">Traditional Dhaka Textile</h3>
              <p class="text-[22px] font-bold text-[#b51822] font-['Plus_Jakarta_Sans']">Rs. 12,400</p>
            </div>
          </div>

          <div class="bg-white rounded-[16px] border border-[#e0e3e5] overflow-hidden hover:shadow-lg transition-all">
            <div class="relative aspect-square bg-gray-200">
              <img src="{{ asset('images/Pottery.png') }}" alt="Related Product" class="w-full h-full object-cover">
            </div>
            <div class="p-4">
              <h3 class="font-bold text-[16px] text-[#181c1e] mb-2 font-['Plus_Jakarta_Sans']">Lokta Paper Journal</h3>
              <p class="text-[22px] font-bold text-[#b51822] font-['Plus_Jakarta_Sans']">Rs. 5,800</p>
            </div>
          </div>

          <div class="bg-white rounded-[16px] border border-[#e0e3e5] overflow-hidden hover:shadow-lg transition-all">
            <div class="relative aspect-square bg-gray-200">
              <img src="{{ asset('images/Pottery.png') }}" alt="Related Product" class="w-full h-full object-cover">
            </div>
            <div class="p-4">
              <h3 class="font-bold text-[16px] text-[#181c1e] mb-2 font-['Plus_Jakarta_Sans']">Himalayan Salt Lamp</h3>
              <p class="text-[22px] font-bold text-[#b51822] font-['Plus_Jakarta_Sans']">Rs. 1,850</p>
            </div>
          </div>

          <div class="bg-white rounded-[16px] border border-[#e0e3e5] overflow-hidden hover:shadow-lg transition-all">
            <div class="relative aspect-square bg-gray-200">
              <img src="{{ asset('images/Pottery.png') }}" alt="Related Product" class="w-full h-full object-cover">
            </div>
            <div class="p-4">
              <h3 class="font-bold text-[16px] text-[#181c1e] mb-2 font-['Plus_Jakarta_Sans']">Silver Filigree Jewelry</h3>
              <p class="text-[22px] font-bold text-[#b51822] font-['Plus_Jakarta_Sans']">Rs. 3,200</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</x-frontend-layout> --}}
