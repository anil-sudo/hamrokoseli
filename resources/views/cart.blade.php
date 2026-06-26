<x-frontend-layout>
    <div class="bg-[#F4EAE1] text-[#3A2A1F] min-h-screen py-10 sm:py-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            
            <!-- Page Title Section -->
            <div class="mb-10 sm:mb-12">
                <h1 class="text-3.5xl sm:text-4xl md:text-5xl font-extrabold text-[#1F3D2E] tracking-tight mb-2 sm:mb-3">
                    Your Handpicked Pieces
                </h1>
                <p class="text-[#3A2A1F]/70 text-sm sm:text-base font-semibold max-w-xl">
                    Review your artisanal selections before checkout.
                </p>
            </div>

            <!-- Two-column Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- LEFT COLUMN: Cart Items (8/12 width on large screens) -->
                <div class="lg:col-span-8 space-y-6">
                    <div id="cart-items-container" class="space-y-6">
                        <!-- Dynamic items are rendered here by JavaScript -->
                        <div class="flex items-center justify-center py-20">
                            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-[#C65A3A]"></div>
                        </div>
                    </div>

                    <!-- Bottom navigation link -->
                    <div>
                        <a href="{{ route('shop') }}" class="inline-flex items-center gap-2 text-[#C65A3A] hover:text-[#b04a2c] font-bold text-sm transition duration-300">
                            <i class="fas fa-arrow-left"></i> Explore More Treasures
                        </a>
                    </div>
                </div>

                <!-- RIGHT COLUMN: Order Summary & Impact Spotlight (4/12 width) -->
                <div class="lg:col-span-4 space-y-6">
                    
                    <!-- Order Summary Box -->
                    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-[#ebd7be]/40 shadow-sm space-y-6">
                        <h2 class="text-xl font-bold text-[#1F3D2E]">Order Summary</h2>
                        
                        <div class="space-y-4">
                            <div class="flex items-center justify-between text-sm font-semibold text-[#3A2A1F]/80">
                                <span>Subtotal</span>
                                <span id="cart-subtotal" class="text-[#1F3D2E] font-bold">रू 0</span>
                            </div>
                            <div class="flex items-center justify-between text-sm font-semibold text-[#3A2A1F]/80">
                                <span>Heritage Shipping</span>
                                <span class="text-[#C65A3A] font-bold uppercase tracking-wider text-xs">FREE</span>
                            </div>
                            <div class="flex items-center justify-between text-sm font-semibold text-[#3A2A1F]/80">
                                <span>Estimated Taxes</span>
                                <span id="cart-tax" class="text-[#1F3D2E] font-bold">रू 0</span>
                            </div>
                        </div>

                        <div class="border-t border-[#ebd7be]/40 pt-4 flex items-center justify-between">
                            <span class="text-base font-extrabold text-[#1F3D2E]">Total</span>
                            <span id="cart-total" class="text-[#C65A3A] font-extrabold text-xl">रू 0</span>
                        </div>

                        <div class="pt-2">
                            <button type="button" onclick="alert('Proceeding to secure checkout...');" class="w-full flex items-center justify-center gap-2 bg-[#C65A3A] hover:bg-[#b04a2c] text-white text-sm font-bold py-3.5 px-4 rounded-xl shadow-md hover:shadow transition duration-300 cursor-pointer">
                                Proceed to Checkout <i class="fas fa-arrow-right text-xs"></i>
                            </button>
                            <div class="flex items-center justify-center gap-1.5 mt-4 text-[#3A2A1F]/40 text-xs font-semibold">
                                <i class="fas fa-lock text-[10px]"></i> Secure SSL Encryption
                            </div>
                        </div>
                    </div>

                    <!-- Impact Spotlight Box -->
                    <div class="bg-[#FFF7EF] rounded-3xl p-6 border border-[#ebd7be]/40 shadow-sm flex items-start gap-4">
                        <div class="shrink-0 w-12 h-12 rounded-full overflow-hidden border border-[#ebd7be]">
                            <img src="{{ asset('images/logo.jpeg') }}" alt="Artisan Spotlight" class="w-full h-full object-cover">
                        </div>
                        <div class="space-y-1">
                            <h3 class="text-xs font-extrabold text-[#1F3D2E] uppercase tracking-wider">Impact Spotlight</h3>
                            <p class="text-sm font-semibold text-[#C65A3A] italic leading-relaxed">
                                "This purchase directly supports Kanchi Maya's weaver collective in Lalitpur."
                            </p>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>

    <!-- Template for rendering Cart Items dynamically -->
    <template id="cart-item-template">
        <div class="bg-white rounded-3xl p-4 sm:p-5 border border-[#ebd7be]/40 shadow-xs flex flex-row gap-4 items-start relative hover:shadow-md transition duration-300">
            
            <!-- Product Image -->
            <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-2xl overflow-hidden border border-[#ebd7be]/30 shadow-xs shrink-0 bg-white">
                <img src="" alt="" class="cart-item-img w-full h-full object-cover">
            </div>

            <!-- Product Details -->
            <div class="flex-grow space-y-1 w-full pr-16 sm:pr-24">
                <h3 class="cart-item-title text-sm sm:text-base font-bold text-[#1F3D2E] leading-tight line-clamp-1">
                    Product Name
                </h3>
                
                <p class="cart-item-specs text-[10px] sm:text-xs text-[#3A2A1F]/70 font-semibold leading-relaxed line-clamp-1">
                    Specifications (size, material, details)
                </p>

                <!-- Tag & Wishlist Action -->
                <div class="flex flex-wrap items-center gap-x-3 gap-y-1 pt-0.5">
                    <div class="cart-item-tag inline-flex items-center gap-1.5 bg-[#F5E8D6]/70 text-[#C65A3A] text-[9px] sm:text-[10px] font-extrabold px-2.5 py-0.5 rounded-full shadow-xs">
                        <i class="fas fa-check-circle text-[8px] sm:text-[9px]"></i>
                        <span class="cart-item-tag-text">Authentic</span>
                    </div>

                    <button type="button" class="cart-move-wishlist text-[10px] sm:text-xs font-bold text-[#3A2A1F]/50 hover:text-[#C65A3A] flex items-center gap-1 transition cursor-pointer">
                        <i class="far fa-heart"></i> Move to Wishlist
                    </button>
                </div>

                <!-- Quantity Adjuster -->
                <div class="pt-2">
                    <div class="flex items-center border border-[#ebd7be] rounded-full bg-white px-2 py-0.5 gap-2.5 shadow-xs inline-flex">
                        <button type="button" class="qty-minus text-[#3A2A1F] hover:text-[#C65A3A] font-bold text-xs w-4.5 h-4.5 flex items-center justify-center focus:outline-none transition cursor-pointer">−</button>
                        <span class="qty-val text-xs font-bold text-[#1F3D2E] w-5 text-center select-none">1</span>
                        <button type="button" class="qty-plus text-[#3A2A1F] hover:text-[#C65A3A] font-bold text-xs w-4.5 h-4.5 flex items-center justify-center focus:outline-none transition cursor-pointer">+</button>
                    </div>
                </div>
            </div>

            <!-- Price and Delete Area (Aligned absolute on the right) -->
            <div class="absolute top-4 right-4 bottom-4 flex flex-col justify-between items-end pl-2">
                <span class="cart-item-price text-[#C65A3A] font-extrabold text-sm sm:text-base">रू Price</span>
                <button type="button" class="cart-delete-btn text-[#C65A3A]/75 hover:text-red-600 rounded-full w-8 h-8 flex items-center justify-center hover:bg-red-50 transition cursor-pointer" title="Remove item">
                    <i class="fa-regular fa-trash-can text-sm sm:text-base"></i>
                </button>
            </div>
        </div>
    </template>

    <!-- Template for Empty State -->
    <template id="cart-empty-template">
        <div class="text-center py-20 bg-white/40 rounded-3xl border border-[#ebd7be]/20 shadow-sm max-w-xl mx-auto px-6">
            <div class="w-16 h-16 bg-[#ebd7be]/30 rounded-full flex items-center justify-center mx-auto mb-5 text-[#C65A3A]">
                <i class="fas fa-shopping-cart text-2xl"></i>
            </div>
            <h2 class="text-xl font-bold text-[#1F3D2E] mb-2">Your cart is empty</h2>
            <p class="text-sm text-[#3A2A1F]/70 max-w-sm mx-auto mb-8 font-semibold">
                Looks like you haven't added any beautiful Nepalese handicrafts yet.
            </p>
            <a href="{{ route('shop') }}" class="inline-flex items-center gap-2 bg-[#C65A3A] hover:bg-[#b04a2c] text-white font-bold px-8 py-3.5 rounded-full shadow-md hover:shadow transition duration-300 text-sm">
                Start Exploring
            </a>
        </div>
    </template>
</x-frontend-layout>
