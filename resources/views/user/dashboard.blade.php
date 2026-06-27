<x-user-layout>
    <div class="space-y-10">

        <!-- Greeting -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-(--text-color) flex items-center gap-3">
                Welcome back, User!
            </h1>
            <p class="text-sm text-(--text-color) mt-1">Manage your orders and account in one place.</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <!-- Total Orders -->
            <div
                class="bg-(--card-bg) rounded-2xl p-6 shadow-sm hover:shadow-lg transition-all duration-300 border border-(--text-color)/20">
                <div class="flex items-center justify-between">
                    <div class="bg-(--primary-color)/10 p-3 rounded-xl">
                        <i data-lucide="shopping-cart" class="text-[#0A1410]"></i>
                    </div>
                    <span
                        class="text-xs font-medium px-3 py-1 bg-(--primary-color)/20 text-[#0A1410] rounded-full">Total</span>
                </div>
                <div class="mt-6">
                    <p class="text-3xl font-extrabold text-(--text-dark) font-sans!">12</p>
                    <p class="text-sm font-medium text-(--text-color) uppercase tracking-widest mt-2">Total Orders</p>
                </div>
            </div>

            <!-- Pending Orders -->
            <div
                class="bg-(--card-bg) rounded-2xl p-6 shadow-sm hover:shadow-lg transition-all duration-300 border border-(--text-color)/20">
                <div class="flex items-center justify-between">
                    <div class="bg-(--hover-color)/10 p-3 rounded-xl">
                        <i data-lucide="clock" class="text-(--hover-color)"></i>
                    </div>
                    <span
                        class="text-xs font-medium px-3 py-1 bg-(--hover-color)/20 text-amber-700 rounded-full">Pending</span>
                </div>
                <div class="mt-6">
                    <p class="text-3xl font-extrabold text-(--text-dark) font-sans!">2</p>
                    <p class="text-sm font-medium text-(--text-color) uppercase tracking-widest mt-2">Pending Orders</p>
                </div>
            </div>

            <!-- Delivered Orders -->
            <div
                class="bg-(--card-bg) rounded-2xl p-6 shadow-sm hover:shadow-lg transition-all duration-300 border border-(--text-color)/20">
                <div class="flex items-center justify-between">
                    <div class="bg-[#E8EEEB] p-3 rounded-xl">
                        <i data-lucide="check" class="text-[#1F3D2E]"></i>

                    </div>
                    <span
                        class="text-xs font-medium px-3 py-1 bg-[#E8EEEB] text-[#1F3D2E] rounded-full">Delivered</span>
                </div>
                <div class="mt-6">
                    <p class="text-3xl font-extrabold text-(--text-dark) font-sans!">10</p>
                    <p class="text-sm font-medium text-(--text-color) uppercase tracking-widest mt-2">Delivered Orders
                    </p>
                </div>
            </div>

            <!-- Cancelled Orders -->
            <div
                class="bg-(--card-bg) rounded-2xl p-6 shadow-sm hover:shadow-lg transition-all duration-300 border border-(--text-color)/20">
                <div class="flex items-center justify-between">
                    <div class="bg-(--secondary-color)/10 p-3 rounded-xl">
                        <i data-lucide="square-slash" class="text-(--secondary-color)"></i>

                    </div>
                    <span
                        class="text-xs font-medium px-3 py-1 bg-(--secondary-color)/20 text-rose-800 rounded-full">Canceled</span>
                </div>
                <div class="mt-6">
                    <p class="text-3xl font-extrabold text-(--text-dark) font-sans!">1</p>
                    <p class="text-sm font-medium text-(--text-color) uppercase tracking-widest mt-2">Canceled Orders
                    </p>
                </div>

            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Recent Orders -->
            <div class="lg:col-span-2">
                <div class="flex justify-between items-center mb-5">
                    <h3 class="text-xl font-semibold text-(--text-color)">Recent Orders</h3>
                    <a href="{{ route('User-orders') }}" class="text-sm text-center text-(--secondary-color) flex items-center gap-1.5 transition">
                        <span class="hover:underline">View All Orders</span>
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                </div>

                <div class="space-y-4 bg-(--card-bg) rounded-3xl p-6 shadow-sm hover:shadow-lg transition-all duration-300">
                    <!-- Order 1 -->
                    <div class="group flex items-center gap-4 p-4 hover:bg-(--card-dark)/10 rounded-2xl transition">
                        <img src="{{ asset('images/backpack.png') }}" alt="Leather Bag"
                            class="w-16 h-16 object-cover group-hover:scale-105 transition-transform duration-500 rounded-xl ">
                        <div class="flex-1">
                            <p class="font-medium text-(--text-color)">Handcrafted Leather Bag</p>
                            <p class="text-sm text-(--text-color)/80">Order ID: #HK-29401 • Oct 24, 2024</p>
                        </div>
                        <div class="text-right">
                            <span
                                class="px-4 py-1 text-xs font-medium bg-(--hover-color)/20 text-amber-700 rounded-full">Pending</span>
                            <p class="font-semibold mt-2">Rs. 12,450</p>
                        </div>
                    </div>

                    <!-- Order 2 -->
                    <div class="group flex items-center gap-4 p-4 hover:bg-(--card-dark)/10 rounded-2xl transition">
                        <img src="{{ asset('images/pottery.png') }}" alt="Ceramic Mug"
                            class="w-16 h-16 object-cover group-hover:scale-105 transition-transform duration-500 rounded-xl">
                        <div class="flex-1">
                            <p class="font-medium text-(--text-color)">Handmade Ceramic Mug</p>
                            <p class="text-sm text-(--text-color)/80">Order ID: #HK-29395 • Oct 20, 2024</p>
                        </div>
                        <div class="text-right">
                            <span
                                class="px-4 py-1 text-xs font-medium bg-blue-100 text-blue-700 rounded-full">Shipped</span>
                            <p class="font-semibold mt-2">Rs. 1,250</p>
                        </div>
                    </div>

                    <!-- Order 3 -->
                    <div class="group flex items-center gap-4 p-4 hover:bg-(--card-dark)/10 rounded-2xl transition">
                        <img src="{{ asset('images/table.png') }}" alt="Scented Candle"
                            class="w-16 h-16 object-cover group-hover:scale-105 transition-transform duration-500 rounded-xl">
                        <div class="flex-1">
                            <p class="font-medium text-(--text-color)">Aura Scented Candle</p>
                            <p class="text-sm text-(--text-color)/80">Order ID: #HK-29398 • Oct 23, 2024</p>
                        </div>
                        <div class="text-right">
                            <span
                                class="px-4 py-1 text-xs font-medium bg-[#E8EEEB] text-[#1F3D2E] rounded-full">Delivered</span>
                            <p class="font-semibold mt-2">Rs. 8,200</p>
                        </div>
                    </div>

                    <!-- Order 4 -->
                    <div
                        class="group flex items-center gap-4 p-4 hover:bg-(--card-dark)/10 overflow-hidden rounded-2xl transition">
                        <img src="{{ asset('images/craft.png') }}" alt="Wall Art"
                            class="w-16 h-16 object-cover group-hover:scale-105 transition-transform duration-500 rounded-xl">
                        <div class="flex-1">
                            <p class="font-medium text-(--text-color)">Boho Wall Art Frame</p>
                            <p class="text-sm text-(--text-color)/80">Order ID: #HK-29392 • Oct 18, 2024</p>
                        </div>
                        <div class="text-right">
                            <span
                                class="px-4 py-1 text-xs font-medium bg-[#E8EEEB] text-[#1F3D2E] rounded-full">Delivered</span>
                            <p class="font-semibold mt-2">Rs. 2,800</p>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Top Discounts Section -->
            <div>
                <div class="flex justify-center items-center mb-5">
                    <h2 class="text-xl font-semibold text-(--text-color) flex items-center gap-1.5"><i data-lucide="flame" class="w-6 h-6 text-orange-500 fill-orange-500"></i> Top Discounts</h2>
                </div>

                <div
                    class="bg-(--card-bg) rounded-3xl p-6 shadow-sm hover:shadow-lg transition-all duration-300  max-h-120 overflow-y-auto">
                    <div class="space-y-5">

                        <!-- Discount Item 1 -->
                        <div
                            class="flex flex-col items-start gap-5 p-4 hover:bg-(--card-dark)/7 rounded-2xl transition-all group">
                            <div class="flex flex-row lg:flex-col gap-7">
                                <div class="relative overflow-hidden rounded-2xl">
                                    <img src="{{ asset('images/sweaters.png') }}"
                                        class="w-full h-32 object-cover group-hover:scale-105 transition duration-500"
                                        alt="Product">
                                    <div
                                        class="absolute top-2 right-2 bg-red-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-xl">
                                        30% OFF
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <p class="font-medium text-(--text-dark) group-hover:text-(--primary-color) transition">
                                        Pashmina
                                        Shawl</p>
                                    <p class="text-sm text-(--text-color)/80">Best Seller • Free Shipping</p>
                                    <div class="flex items-center gap-3 mt-2">
                                        <span class="text-lg font-bold text-[#1F3D2E]">Rs. 2,793</span>
                                        <span class="text-sm text-gray-400 line-through">Rs. 3,990</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button
                                    class="bg-(--primary-color)/90 text-white w-full px-6 py-3 rounded-2xl text-sm font-medium hover:bg-(--primary-color) transition">
                                    Grab Deal
                                </button>
                            </div>
                        </div>

                        <!-- Discount Item 2 -->
                        <div
                            class="flex flex-col items-start gap-5 p-4 hover:bg-(--card-dark)/7 rounded-2xl transition-all group">
                            <div class="flex flex-row lg:flex-col gap-7">
                                <div class="relative overflow-hidden rounded-2xl">
                                    <img src="{{ asset('images/Backpack.png') }}"
                                        class="w-full h-32 object-cover group-hover:scale-105 transition duration-500"
                                        alt="Product">
                                    <div
                                        class="absolute top-2 right-2 bg-red-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-xl">
                                        25% OFF
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <p class="font-medium text-(--text-dark) group-hover:text-(--primary-color) transition">
                                        BackPack</p>
                                    <p class="text-sm text-(--text-color)/80">Limited Stock • Ends in 3 days</p>
                                    <div class="flex items-center gap-3 mt-2">
                                        <span class="text-lg font-bold text-(--primary-color)">Rs. 2,168</span>
                                        <span class="text-sm text-gray-400 line-through">Rs. 2,890</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button
                                    class="bg-(--primary-color)/90 text-white w-full px-6 py-3 rounded-2xl text-sm font-medium hover:bg-(--primary-color) transition">
                                    Grab Deal
                                </button>
                            </div>
                        </div>

                        <!-- Discount Item 3 -->
                        <div
                            class="flex flex-col items-start gap-5 p-4 hover:bg-(--card-dark)/7 rounded-2xl transition-all group">
                            <div class="flex flex-row lg:flex-col gap-7">
                                <div class="relative overflow-hidden rounded-2xl">
                                    <img src="{{ asset('images/2nd-image.png') }}"
                                        class="w-full h-32 object-cover group-hover:scale-105 transition duration-500"
                                        alt="Product">
                                    <div
                                        class="absolute top-2 right-2 bg-red-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-xl">
                                        20% OFF
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <p class="font-medium text-(--text-dark) group-hover:text-(--primary-color) transition">
                                        Traditional Thangka Art</p>
                                    <p class="text-sm text-(--text-color)/80">Handcrafted • Festival Special</p>
                                    <div class="flex items-center gap-3 mt-2">
                                        <span class="text-lg font-bold text-(--primary-color)">Rs. 3,600</span>
                                        <span class="text-sm text-gray-400 line-through">Rs. 4,500</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button
                                    class="bg-(--primary-color)/90 text-white w-full px-6 py-3 rounded-2xl text-sm font-medium hover:bg-(--primary-color) transition">
                                    Grab Deal
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Recommended For You -->
        <div class="mt-12">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-semibold text-(--text-color)">Recommended For You</h2>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <!-- Product Cards -->
                <div
                    class="bg-(--card-bg) rounded-3xl overflow-hidden group shadow-sm hover:shadow-lg transition-all duration-300">
                    <div class="relative overflow-hidden">
                        <img src="{{ asset('images/SunGlass.png') }}"
                            class="w-full h-48 object-cover group-hover:scale-105 transition duration-500"
                            alt="Salt Lamp">
                        <button
                            class="absolute top-3 right-3 text-[#C65A3A] hover:text-[#b04a2c] transition-colors text-lg sm:text-xl drop-shadow focus:outline-none">
                            <i data-lucide="heart" class="w-5 h-5"></i>
                        </button>
                    </div>
                    <div class="p-4">
                        <p class="font-medium text-sm line-clamp-2">SunGlass</p>
                        <p class="text-(--primary-color) font-semibold mt-2">Rs. 2,890</p>
                    </div>
                </div>

                <div
                    class="bg-(--card-bg) rounded-3xl overflow-hidden group shadow-sm hover:shadow-lg transition-all duration-300">
                    <div class="relative overflow-hidden">
                        <img src="{{ asset('images/table.png') }}"
                            class="w-full h-48 object-cover group-hover:scale-105 transition duration-500"
                            alt="Desk Organizer">
                        <button
                            class="absolute top-3 right-3 text-[#C65A3A] hover:text-[#b04a2c] transition-colors text-lg sm:text-xl drop-shadow focus:outline-none">
                            <i data-lucide="heart" class="w-5 h-5"></i>
                        </button>
                    </div>
                    <div class="p-4">
                        <p class="font-medium text-sm line-clamp-2">Wooden Table</p>
                        <p class="text-(--primary-color) font-semibold mt-2">Rs. 1,750</p>
                    </div>
                </div>

                <div
                    class="bg-(--card-bg) rounded-3xl overflow-hidden group shadow-sm hover:shadow-lg transition-all duration-300">
                    <div class="relative overflow-hidden">
                        <img src="{{ asset('images/sweaters.png') }}"
                            class="w-full h-48 object-cover group-hover:scale-105 transition duration-500"
                            alt="Pashmina">
                        <button
                            class="absolute top-3 right-3 text-[#C65A3A] hover:text-[#b04a2c] transition-colors text-lg sm:text-xl drop-shadow focus:outline-none">
                            <i data-lucide="heart" class="w-5 h-5"></i>
                        </button>
                    </div>
                    <div class="p-4">
                        <p class="font-medium text-sm line-clamp-2">Pashmina Shawl</p>
                        <p class="text-(--primary-color) font-semibold mt-2">Rs. 3,990</p>
                    </div>
                </div>

                <div
                    class="bg-(--card-bg) rounded-3xl overflow-hidden group shadow-sm hover:shadow-lg transition-all duration-300">
                    <div class="relative overflow-hidden">
                        <img src="{{ asset('images/2nd-image.png') }}"
                            class="w-full h-48 object-cover group-hover:scale-105 transition duration-500"
                            alt="Thangka Art">
                        <button
                            class="absolute top-3 right-3 text-[#C65A3A] hover:text-[#b04a2c] transition-colors text-lg sm:text-xl drop-shadow focus:outline-none">
                            <i data-lucide="heart" class="w-5 h-5"></i>
                        </button>
                    </div>
                    <div class="p-4">
                        <p class="font-medium text-sm line-clamp-2">Traditional Thangka Art</p>
                        <p class="text-(--primary-color) font-semibold mt-2">Rs. 4,500</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-user-layout>
