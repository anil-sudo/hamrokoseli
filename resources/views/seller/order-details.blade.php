<x-seller_layout title="Order Management" searchPlaceholder="Search by Order ID or Customer...">

    <a href="{{ route('order') }}"
        class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-(--text-dark) bg-(--text-light) border border-(--text-color)/20 rounded-2xl">
        <i data-lucide="arrow-left" class="w-5 h-5"></i>
        Back to Orders
    </a>

    <div class="mb-8 mt-4">
        <h1 class="text-2xl font-semibold text-(--text-color)">Order Details</h1>
        <div class="flex items-center gap-3 text-sm mt-1">
            <span class="font-semibold text-(--secondary-color)/70">#HK-89234</span>
            <span class="text-(--text-color)/50">•</span>
            <span class="text-(--text-dark)/50">Placed on june 1, 2026 at 10:30 AM</span>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-12 gap-6">

        <!-- Order Summary -->
        <div class="xl:col-span-5 bg-(--card-dark) rounded-3xl shadow-sm hover:shadow-md border border-(--text-color)/20 p-6 lg:p-8 transition-all duration-300">
            <h2 class="text-xl font-semibold mb-6 flex items-center gap-2">
                <i data-lucide="package" class="w-6 h-6 text-(--primary-color)"></i>
                Order Summary
            </h2>

            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Order Status -->
                    <div>
                        <label class="block text-sm font-medium text-(--text-color) mb-2">Order Status</label>
                        <div class="relative">
                            <select id="orderStatus"
                                class="w-full bg-(--text-light) border border-(--bg-color)/30 focus:outline-none focus:border-(--secondary-color) rounded-2xl px-5 py-4 text-base appearance-none transition-all">
                                <option value="new">New</option>
                                <option value="processing">Processing</option>
                                <option value="shipped" selected>Shipped</option>
                                <option value="delivered">Delivered</option>
                                <option value="cancelled">Cancelled</option>
                                <option value="refunded">Refunded</option>
                            </select>
                            <div class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-(--text-color)">
                                <i data-lucide="chevron-down" class="w-5 h-5"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Status -->
                    <div>
                        <label class="block text-sm font-medium text-(--text-color) mb-2">Payment Status</label>
                        <div class="relative">
                            <select id="paymentStatus"
                                class="w-full bg-(--text-light) border border-(--bg-color)/30 focus:outline-none focus:border-(--secondary-color) rounded-2xl px-5 py-4 text-base appearance-none transition-all">
                                <option value="paid" selected>
                                    Paid
                                </option>
                                <option value="unpaid">Unpaid</option>
                                <option value="refunded">Refunded</option>
                            </select>
                            <div class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-(--text-color)">
                                <i data-lucide="chevron-down" class="w-5 h-5"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-6 text-sm">
                    <div>
                        <p class="text-(--text-dark)">Transaction ID</p>
                        <p class="font-semibold mt-1">KHL-8F4D92A7B1</p>
                    </div>
                    <div>
                        <p class="text-(--text-dark)">Payment Date</p>
                        <p class="font-semibold mt-1 flex gap-2"><span>2026-06-1</span> <span>10:30 AM</span></p>
                    </div>
                    <div>
                        <p class="text-(--text-dark)">Payment Method</p>
                        <p class="font-semibold mt-1">Khalti</p>
                    </div>
                    <div>
                        <p class="text-(--text-dark)">Shipping Method</p>
                        <p class="font-semibold mt-1">Standard Delivery</p>
                    </div>
                    <div>
                        <p class="text-(--text-dark)">Tracking Number</p>
                        <p class="font-semibold mt-1">HKTRK89234</p>
                    </div>
                </div>

                <div class="bg-(--primary-color)/70 border border-(--bg-color)/30 rounded-2xl p-5 text-sm flex gap-3">
                    <i data-lucide="info" class="w-5 h-5 text-(--text-light) mt-0.5 shrink-0"></i>
                    <p class="text-(--text-light)">Update the order status, payment status and click Save to notify the customer.</p>
                </div>

                <div class="flex gap-3 pt-4">
                    <button type="submit"
                        class="flex-1 py-4 border border-(--secondary-color) hover:bg-(--card-bg) bg-(--text-light)/70 rounded-2xl font-medium transition-all duration-200">
                        Cancel
                    </button>
                    <button type="submit"
                        class="flex-1 py-4 bg-(--secondary-color)/95 hover:bg-(--secondary-color) text-(--text-light) rounded-2xl font-medium transition-all duration-200">
                        Save Changes
                    </button>
                </div>
            </div>
        </div>

        <!-- Customer & Shipping -->
        <div class="xl:col-span-7 grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Customer Info -->
            <div class="bg-(--card-dark) rounded-3xl shadow-sm hover:shadow-md border border-(--text-color)/20 p-6 lg:p-8 transition-all duration-200">
                <h2 class="text-xl font-semibold mb-6">Customer Information</h2>
                <div class="flex items-start gap-4">
                    <div
                        class="w-12 h-12 bg-(--card-bg) text-(--text-color) rounded-2xl flex items-center justify-center text-lg font-semibold shrink-0">
                        RP
                    </div>
                    <div class="space-y-4">
                        <p class="text-lg font-semibold">Ram Poudel</p>
                        <div class="space-y-3">
                            <div class="flex items-center gap-3">
                                <i data-lucide="mail" class="w-5 h-5 text-(--text-color)/60"></i>
                                <a href="mailto:rampoudel@example.com"
                                    class="hover:text-(--text-color) text-(--text-color)/90 transition">rampoudel@example.com</a>
                            </div>
                            <div class="flex items-center gap-3">
                                <i data-lucide="phone" class="w-5 h-5 text-(--text-color)/60"></i>
                                <a href="tel:9801234567" class="hover:text-(--text-color) text-(--text-color)/90 transition">980-1234567</a>
                            </div>
                            <div class="flex items-center gap-3">
                                <i data-lucide="map-pin" class="w-5 h-5 text-(--text-color)/60"></i>
                                <span>Kathmandu, Nepal</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Shipping Address -->
            <div class="bg-(--card-dark) rounded-3xl shadow-sm hover:shadoew-md border border-(--text-color)/20 p-6 lg:p-8 transition-all duration-200">
                <h2 class="text-xl font-semibold mb-6">Shipping Address</h2>
                <div class="space-y-2 text-lg leading-relaxed">
                    <p>New Baneshwor, Ward No. 31</p>
                    <p>Kathmandu, Bagmati Province</p>
                    <p>Nepal</p>
                    <p class="pt-3 font-medium">9801234567</p>
                </div>
            </div>
        </div>

        <!-- Order Items -->
        <div class="xl:col-span-12 bg-(--card-dark) rounded-3xl shadow-sm hover:shadow-md border border-(--text-color)/20 overflow-hidden transition-all duration-300">
            <div class="px-6 lg:px-8 py-5 border-b bg-(--card-bg)">
                <h2 class="text-xl font-semibold">Order Items</h2>
            </div>
            <div class="divide-y">
                <!-- Item 1 -->
                <div class="p-6 lg:p-8 flex flex-col sm:flex-row sm:items-center gap-5">
                    <img src="{{ asset('images/pottery.png') }}" class="w-20 h-20 object-cover rounded-2xl"
                        alt="product">
                    <div class="flex-1 min-w-0">
                        <p class="font-semibold text-lg">Pottery</p>
                        <p class="text-(--text-dark)/70 text-sm">SKU: POT-001</p>
                    </div>
                    <div class="text-right sm:text-center">
                        <p class="font-semibold">Rs. 4,500</p>
                        <p class="text-sm text-(--text-dark)/70">Qty: 1</p>
                    </div>
                    <div class="text-right font-semibold text-lg sm:w-28">Rs. 4,500</div>
                </div>

                <!-- Item 2 -->
                <div class="p-6 lg:p-8 flex flex-col sm:flex-row sm:items-center gap-5">
                    <img src="{{ asset('images/Table.png') }}" class="w-20 h-20 object-cover rounded-2xl"
                        alt="product">
                    <div class="flex-1 min-w-0">
                        <p class="font-semibold text-lg">Table</p>
                        <p class="text-(--text-dark)/70 text-sm">SKU: TAB-002</p>
                    </div>
                    <div class="text-right sm:text-center">
                        <p class="font-semibold">Rs. 2,800</p>
                        <p class="text-sm text-(--text-dark)/70">Qty: 1</p>
                    </div>
                    <div class="text-right font-semibold text-lg sm:w-28">Rs. 2,800</div>
                </div>
            </div>
        </div>

        <!-- Totals -->
        <div class="xl:col-span-5">
            <div class="bg-(--card-dark) rounded-3xl shadow-sm border border-(--text-color)/20 p-6 lg:p-8">
                <h2 class="text-xl font-semibold mb-6">Order Totals</h2>
                <div class="space-y-4 text-[15px]">
                    <div class="flex justify-between">
                        <span class="text-(--text-dark)/70">Subtotal</span>
                        <span class="font-medium">Rs. 7,300</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-(--text-dark)/70">Shipping Charge</span>
                        <span class="font-medium">Rs. 150</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-(--text-dark)/70">Discount</span>
                        <span class="text-(--secondary-color) font-medium">- Rs. 0</span>
                    </div>
                    <div class="h-px bg-(--text-color) my-2"></div>
                    <div class="flex justify-between text-lg font-semibold">
                        <span>Total Amount</span>
                        <span>Rs. 7,450</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-seller_layout>
