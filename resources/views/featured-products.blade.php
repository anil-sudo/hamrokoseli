<x-frontend-layout>
    <!-- ==================== MAIN CONTENT ==================== -->
    <div class="bg-[#FFF7EF] text-[#3A2A1F] min-h-screen py-8 sm:py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">

            <!-- Section Title -->
            <div class="text-center mb-10">
                <h1 class="text-4xl md:text-5xl font-serif font-extrabold text-[#1F3D2E] tracking-tight mb-4">
                    Discover Our Featured Products
                </h1>
                <p class="text-[#3A2A1F]/70 text-sm md:text-base leading-relaxed max-w-2xl mx-auto">
                    Explore the soul of Nepal through our curated collection of masterfully crafted
                    artifacts, each telling a story of ancient traditions and skilled hands.
                </p>
                <div class="mt-8 max-w-xl mx-auto relative">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-[#3A2A1F]/50">
                        <i class="fas fa-search text-sm"></i>
                    </span>
                    <input type="text" id="category-search" placeholder="Search for products..."
                        class="w-full bg-white border border-[#ebd7be]/80 rounded-full py-4 pl-12 pr-6 text-sm focus:outline-none focus:ring-2 focus:ring-[#C65A3A]/25 text-[#1F3D2E] placeholder-[#3A2A1F]/40 shadow-sm transition-all duration-300">
                </div>
            </div>

            <!-- Product Categories Grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                <!-- Category Card -->
                <a href="#" class="group">
                    <div
                        class="bg-[#FDFBF7] rounded-xl sm:rounded-2xl border border-amber-900/5 overflow-hidden shadow-sm hover:shadow-md transition-all duration-300">
                        <div class="aspect-square overflow-hidden">
                            <img src="{{ asset('images/Pottery and Ceramics.png') }}" alt="Pottery & Ceramics"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        </div>
                        <div class="p-4 text-center bg-white">
                            <h3 class="font-medium text-gray-800">Pottery & Ceramics</h3>
                        </div>
                    </div>
                </a>

                <!-- Repeat for other categories -->
                <a href="#" class="group">
                    <div
                        class="bg-[#FDFBF7] rounded-xl sm:rounded-2xl border border-amber-900/5 overflow-hidden shadow-sm hover:shadow-md transition-all duration-300">
                        <div class="aspect-square overflow-hidden">
                            <img src="{{ asset('images/Textile and Fabrics.png') }}" alt="Textile & Fabric"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        </div>
                        <div class="p-4 text-center bg-white">
                            <h3 class="font-medium text-gray-800">Textile & Fabric</h3>
                        </div>
                    </div>
                </a>

                <a href="#" class="group">
                    <div
                        class="bg-[#FDFBF7] rounded-xl sm:rounded-2xl border border-amber-900/5 overflow-hidden shadow-sm hover:shadow-md transition-all duration-300">
                        <div class="aspect-square overflow-hidden">
                            <img src="{{ asset('images/Jewlery and Accessory.png') }}" alt="Jewelry & Accessories"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        </div>
                        <div class="p-4 text-center bg-white">
                            <h3 class="font-medium text-gray-800">Jewelry & Accessories</h3>
                        </div>
                    </div>
                </a>

                <a href="#" class="group">
                    <div
                        class="bg-[#FDFBF7] rounded-xl sm:rounded-2xl border border-amber-900/5 overflow-hidden shadow-sm hover:shadow-md transition-all duration-300">
                        <div class="aspect-square overflow-hidden">
                            <img src="{{ asset('images/Home Decor.png') }}" alt="Home Decor"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        </div>
                        <div class="p-4 text-center bg-white">
                            <h3 class="font-medium text-gray-800">Home Decor</h3>
                        </div>
                    </div>
                </a>


            </div>
        </div>
    </div>
</x-frontend-layout>
