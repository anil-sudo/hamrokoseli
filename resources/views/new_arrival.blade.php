<x-frontend-layout>
    <div class="bg-[#FFF7EF] text-[#3A2A1F] min-h-screen py-8 sm:py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">

            <!-- Section Header -->
            <div class="mb-10">
                <h1 class="text-4xl md:text-5xl font-serif font-extrabold text-[#1F3D2E] tracking-tight mb-4">
                    New Arrivals
                </h1>
                <p class="text-[#3A2A1F]/70 text-sm md:text-base leading-relaxed">
                    Check Out What's New ???
                </p>
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

                <!-- Product Card 1 -->
                <div
                    class="bg-[#FDFBF7] rounded-xl sm:rounded-2xl border border-amber-900/5 overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 group">
                    <div class="relative">
                        <img src="{{ asset('images/pot.png') }}" alt="Patan Bronze Bowl"
                            class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300">
                        <span
                            class="absolute top-3 left-3 bg- bg-[#e5b842] text-black text-xs font-bold px-3 py-1 rounded-full">
                            New !!!
                        </span>
                    </div>
                    <div class="p-5">
                        <h3 class="font-semibold text-lg mb-1">Patan Bronze Bowl</h3>
                        <p class="text-sm text-gray-600 mb-3 line-clamp-2">
                            Hand-hammered ritual vessel by local metalsmiths.
                        </p>
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-2xl font-bold text-[#1a3c34]">Rs. 4,500</span>
                        </div>
                        <a href="#"
                            class="add-to-cart-btn w-full bg-[#C65A3A] hover:bg-[#b04a2c] text-white font-medium py-3 rounded-xl flex items-center justify-center gap-2 transition-colors"
                            data-product-id="new-arrival-1"
                            data-product-name="Patan Bronze Bowl"
                            data-product-price="4500"
                            data-product-image="/images/pot.png"
                            data-product-desc="Hand-hammered ritual vessel by local metalsmiths."
                            data-product-category="Metalware"
                            data-product-tag="Authentic"
                            data-product-specs="Type: Bronze Alloy | Origin: Patan Industrial Estate">
                            <span> <i class="fas fa-shopping-cart"></i>
                            </span> Add to Cart
                        </a>
                    </div>
                </div>

                <!-- Product Card 2 -->
                <div
                    class="bg-[#FDFBF7] rounded-xl sm:rounded-2xl border border-amber-900/5 overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 group">
                    <div class="relative">
                        <img src="{{ asset('images/Sweaters.png') }}" alt="Yak Wool Scarf"
                            class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300">
                        <span
                            class="absolute top-3 left-3 bg- bg-[#e5b842] text-black text-xs font-bold px-3 py-1 rounded-full">
                            New !!!
                        </span>
                    </div>
                    <div class="p-5">
                        <h3 class="font-semibold text-lg mb-1">Yak Wool Scarf</h3>
                        <p class="text-sm text-gray-600 mb-3 line-clamp-2">
                            100% pure Himalayan wool, naturally dyed.
                        </p>
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-2xl font-bold text-[#1a3c34]">Rs. 3,200</span>
                        </div>
                        <a href="#"
                            class="add-to-cart-btn w-full bg-[#C65A3A] hover:bg-[#b04a2c] text-white font-medium py-3 rounded-xl flex items-center justify-center gap-2 transition-colors"
                            data-product-id="new-arrival-2"
                            data-product-name="Yak Wool Scarf"
                            data-product-price="3200"
                            data-product-image="/images/Sweaters.png"
                            data-product-desc="100% pure Himalayan wool, naturally dyed."
                            data-product-category="Textiles"
                            data-product-tag="Artisan Made"
                            data-product-specs="Material: 100% Yak Wool | Style: Hand-woven Pattern">
                            <span> <i class="fas fa-shopping-cart"></i>
                            </span> Add to Cart
                        </a>
                    </div>
                </div>

                <!-- Product Card 3 -->
                <div
                    class="bg-[#FDFBF7] rounded-xl sm:rounded-2xl border border-amber-900/5 overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 group">
                    <div class="relative">
                        <img src="{{ asset('images/topi.png') }}" alt="Traditional Dhaka Topi"
                            class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300">
                        <span
                            class="absolute top-3 left-3 bg- bg-[#e5b842] text-black text-xs font-bold px-3 py-1 rounded-full">
                            New !!!
                        </span>
                    </div>
                    <div class="p-5">
                        <h3 class="font-semibold text-lg mb-1">Traditional Dhaka Topi</h3>
                        <p class="text-sm text-gray-600 mb-3 line-clamp-2">
                            Hand-woven patterns from the Palpa region.
                        </p>
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-2xl font-bold text-[#1a3c34]">Rs. 1,800</span>
                        </div>
                        <a href="#"
                            class="add-to-cart-btn w-full bg-[#C65A3A] hover:bg-[#b04a2c] text-white font-medium py-3 rounded-xl flex items-center justify-center gap-2 transition-colors"
                            data-product-id="new-arrival-3"
                            data-product-name="Traditional Dhaka Topi"
                            data-product-price="1800"
                            data-product-image="/images/topi.png"
                            data-product-desc="Hand-woven patterns from the Palpa region."
                            data-product-category="Textiles"
                            data-product-tag="Dhaka"
                            data-product-specs="Pattern: Palpali Dhaka | Material: Pure Cotton">
                            <span> <i class="fas fa-shopping-cart"></i>
                            </span> Add to Cart
                        </a>
                    </div>
                </div>

                <!-- Product Card 4 -->
                <div
                    class="bg-[#FDFBF7] rounded-xl sm:rounded-2xl border border-amber-900/5 overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 group">
                    <div class="relative">
                        <img src="{{ asset('images/backpack.png') }}" alt="Wild Hemp Backpack"
                            class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300">
                        <span
                            class="absolute top-3 left-3 bg- bg-[#e5b842] text-black text-xs font-bold px-3 py-1 rounded-full">
                            New !!!
                        </span>
                    </div>
                    <div class="p-5">
                        <h3 class="font-semibold text-lg mb-1">Wild Hemp Backpack</h3>
                        <p class="text-sm text-gray-600 mb-3 line-clamp-2">
                            Durable, sustainable, and 100% biodegradable.
                        </p>
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-2xl font-bold text-[#1a3c34]">Rs. 5,600</span>
                        </div>
                        <a href="#"
                            class="add-to-cart-btn w-full bg-[#C65A3A] hover:bg-[#b04a2c] text-white font-medium py-3 rounded-xl flex items-center justify-center gap-2 transition-colors"
                            data-product-id="new-arrival-4"
                            data-product-name="Wild Hemp Backpack"
                            data-product-price="5600"
                            data-product-image="/images/backpack.png"
                            data-product-desc="Durable, sustainable, and 100% biodegradable."
                            data-product-category="Accessories"
                            data-product-tag="Eco-friendly"
                            data-product-specs="Material: 100% Himalayan Hemp | Pockets: 3 Utility Compartments">
                            <span> <i class="fas fa-shopping-cart"></i>
                            </span> Add to Cart
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-frontend-layout>
