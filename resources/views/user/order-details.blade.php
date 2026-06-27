<x-user-layout title="Orders">
    <!-- MAIN CONTENT AREA -->
    <div class="space-y-10">

        <a href="{{ route('User-orders') }}"
            class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-(--text-dark) bg-(--text-light) border border-(--text-color)/20 rounded-2xl">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
            Back to Orders
        </a>

        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-semibold text-(--text-color) inline-flex items-center">
                    Order Details
                    <span class="ml-3 px-4 py-1 text-sm font-medium bg-(--hover-color)/80 text-white rounded-full">
                        Shipped
                    </span>
                </h1>
                <div class="flex items-center gap-3 text-sm mt-1">
                    <span class="font-semibold text-(--secondary-color)/70">#HK-89234</span>
                    <span class="text-(--text-color)/50">•</span>
                    <span class="text-(--text-dark)/50">Placed on june 1, 2026 at 10:30 AM</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Left Side -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Order Tracking -->
                <div class="bg-(--card-bg) rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-200">
                    <h2 class="text-xl font-semibold mb-6">Order Tracking</h2>

                    <div class="flex flex-col lg:flex-row lg:items-start">

                        <!-- Step 1 -->
                        <div class="flex lg:flex-col items-center text-center">
                            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                <i data-lucide="shopping-bag" class="w-5 h-5 text-green-600"></i>

                            </div>

                            <div class="ml-4 lg:ml-0 lg:mt-2">
                                <p class="text-sm font-medium">Order Placed</p>
                                <p class="text-xs text-(--text-dark)/55">June 1, 2026<br>10:30 AM</p>
                            </div>
                        </div>

                        <!-- Line -->
                        <div class="w-0.5 h-10 bg-green-500 ml-6 my-2 lg:hidden"></div>
                        <div class="hidden lg:block flex-1 h-0.5 bg-green-500 mt-6 mx-4"></div>

                        <!-- Step 2 -->
                        <div class="flex lg:flex-col items-center text-center">
                            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                <i data-lucide="package" class="w-5 h-5 text-green-600"></i>

                            </div>

                            <div class="ml-4 lg:ml-0 lg:mt-2">
                                <p class="text-sm font-medium">Processing</p>
                                <p class="text-xs text-(--text-dark)/55">June 1, 2026<br>02:00 PM</p>
                            </div>
                        </div>

                        <!-- Line -->
                        <div class="w-0.5 h-10 bg-green-500 ml-6 my-2 lg:hidden"></div>
                        <div class="hidden lg:block flex-1 h-0.5 bg-green-500 mt-6 mx-4"></div>

                        <!-- Step 3 -->
                        <div class="flex lg:flex-col items-center text-center">
                            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                <i data-lucide="truck" class="w-5 h-5 text-green-600"></i>

                            </div>

                            <div class="ml-4 lg:ml-0 lg:mt-2">
                                <p class="text-sm font-medium">Shipped</p>
                                <p class="text-xs text-(--text-dark)/55">June 2, 2026<br>09:15 AM</p>
                            </div>
                        </div>

                        <!-- Line -->
                        <div class="w-0.5 h-10 bg-gray-300 ml-6 my-2 lg:hidden"></div>
                        <div class="hidden lg:block flex-1 h-0.5 bg-gray-300 mt-6 mx-4"></div>

                        <!-- Step 4 -->
                        <div class="flex lg:flex-col items-center text-center">
                            <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center">
                                <i data-lucide="house" class="w-5 h-5 text-gray-400"></i>
                            </div>

                            <div class="ml-4 lg:ml-0 lg:mt-2">
                                <p class="text-sm font-medium text-gray-400">Delivered</p>
                            </div>
                        </div>

                    </div>
                    <div class="mt-6 bg-green-50 border border-green-200 rounded-xl p-4 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
                            <i data-lucide="truck" class="w-5 h-5 text-green-600"></i>
                        </div>

                        <p class="text-green-700">
                            Your order is on the way! It has been shipped and will be delivered soon.
                        </p>
                    </div>
                </div>

                <!-- Product Details -->
                <div class="bg-(--card-bg) rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-200">
                    <h2 class="text-xl font-semibold mb-4">Product Details</h2>
                    <div class="flex gap-6">
                        <img src="{{ asset('images/backpack.png') }}" alt="Handcrafted Leather Bag"
                        class="w-35 h-35 object-cover rounded-xl">
                        <div class="flex-1">
                            <h3 class="font-semibold text-lg">Handcrafted Leather Bag</h3>
                            <p class="text-gray-600 mt-1">Beautiful handcrafted leather bag, perfect for everyday elegance.</p>
                            <p class="text-(--secondary-color) font-semibold mt-3">Rs. 7550</p>
                            <p class="text-sm text-gray-500">Qty: 1</p>
                        </div>
                    </div>
                </div>

                <!-- Delivery Address -->
                <div class="bg-(--card-bg) rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-200">
                    <h2 class="font-semibold text-xl mb-4">Delivery Address</h2>

                    <div class="flex gap-4">
                        <div
                            class="w-12 h-12 rounded-full bg-orange-100 flex items-center justify-center shrink-0">
                            <i data-lucide="map-pin" class="w-5 h-5 text-(--secondary-color)"></i>
                        </div>

                        <div>
                            <p class="font-medium">Babisa Katwal</p>
                            <p class="text-gray-600">Roadcess, Biratnagar</p>
                            <p class="text-gray-600">koshi Province</p>

                            <div class="flex items-center gap-2 mt-3 text-gray-600">
                                <i data-lucide="phone" class="w-4 h-4 text-(--text-dark)"></i>
                                <span>+977-9834567892</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Right Sidebar -->
            <div class="space-y-6">

                <!-- Order Summary -->
                <div class="bg-(--card-bg) rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-200">
                    <h2 class="text-xl font-semibold mb-4">Order Summary</h2>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Item Total</span>
                            <span>Rs.7500</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Shipping Fee</span>
                            <span>Rs.50</span>
                        </div>
                        <hr>
                        <div class="flex justify-between font-semibold text-lg">
                            <span>Total</span>
                            <span class="text-(--secondary-color)">Rs. 7550</span>
                        </div>
                    </div>
                </div>

                <!-- Payment Details -->
                <div class="bg-(--card-bg) rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-200">
                    <h2 class="text-lg font-semibold mb-4">Payment Details</h2>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Payment Method</span>
                            <span>eSewa</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Payment Status</span>
                            <span class="bg-green-100 text-green-700 px-3 py-0.5 rounded-full text-xs font-medium">Paid
                                ✓</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Transaction ID</span>
                            <span class="font-mono text-xs">EP241024103015</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Paid On</span>
                            <span>Oct 24, 2023<br>10:35 AM</span>
                        </div>
                    </div>
                </div>

                <!-- Request Return Section (Replaced Sold By) -->
                <div class="bg-(--card-bg) rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-200">
                    <h2 class="text-lg font-semibold mb-3">Request Return</h2>
                    <p class="text-gray-600 text-sm mb-5">
                        You can request a return within 7 days of delivery.
                    </p>
                    <a href="{{ route('return-product') }}"
                        class="w-full bg-(--secondary-color) hover:bg-[#B94E31] text-white py-3.5 rounded-xl font-medium flex items-center justify-center gap-2">
                        Initiate Return
                    </a>
                </div>
            </div>
        </div>
    </div>

</x-user-layout>
