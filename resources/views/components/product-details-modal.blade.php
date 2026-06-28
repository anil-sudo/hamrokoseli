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
                Home &nbsp;&rsaquo;&nbsp; Shop &nbsp;&rsaquo;&nbsp; <span class="text-[#C65A3A]" id="modal-breadcrumb-cat">Category</span>
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
                        
                        <h1 class="text-2xl sm:text-3xl font-bold text-[#1F3D2E] leading-tight font-serif modal-product-title" id="modal-product-name">Product Name</h1>
                        
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="text-[#C65A3A] font-extrabold text-2xl modal-product-price" id="modal-product-price">Rs 0</span>
                            <span class="text-slate-400 text-sm line-through hidden" id="modal-product-original-price">Rs 0</span>
                            <span id="modal-discount-tag" class="bg-red-100 text-red-700 text-xs font-bold px-2 py-0.5 rounded-md hidden"></span>
                            <span id="modal-savings-tag" class="text-emerald-700 text-xs font-bold hidden"></span>
                        </div>
                    </div>
                    
                    <p class="text-[#3A2A1F]/80 text-sm leading-relaxed font-medium modal-product-desc" id="modal-product-desc">
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
                        <button id="modal-add-to-cart-btn" class="modal-add-to-cart-btn bg-[#C65A3A] hover:bg-[#b04a2c] text-white font-bold py-3 px-5 rounded-2xl flex-1 text-center shadow-md active:scale-[0.98] transition text-sm cursor-pointer">
                            Add to Cart
                        </button>
                        <button id="modal-buy-now-btn" class="modal-buy-now-btn border-2 border-[#C65A3A] text-[#C65A3A] hover:bg-[#C65A3A]/10 font-bold py-3 px-5 rounded-2xl flex-1 text-center active:scale-[0.98] transition text-sm cursor-pointer">
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

@if(isset($activeProduct))
    <script>
        window.activeProductOnLoad = @json($activeProduct);
    </script>
@endif
