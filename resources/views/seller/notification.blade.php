<x-seller_layout title="Seller Notification">
    <div class="space-y-10">
        <!-- Notifications Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between items-start gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-bold text-(--text-color)">Notifications</h1>
                <p class="text-sm text-(--text-color)/70 mt-1">Stay updated with your orders, payouts, and store
                    activities.</p>
            </div>
            <button onclick="markAllAsRead()"
                class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-(--text-dark) bg-(--text-light) border border-(--text-color)/20 rounded-2xl">
                <i data-lucide="check" class="w-5 h-5"></i>
                Mark all as read
            </button>
        </div>

        <!-- Tabs -->
        <div class="flex flex-wrap border-b border-(--secondary-color)/20 mb-8">
            <button onclick="switchTab(0)"
                class="tab-button active flex-1 sm:flex-none px-4 sm:px-8 py-3 sm:py-4 text-sm font-semibold  text-(--secondary-color) border-b-2 border-(--secondary-color)">
                All
            </button>

            <button onclick="switchTab(1)"
                class="tab-button flex-1 sm:flex-none px-4 sm:px-8 py-3 sm:py-4 text-sm font-semibold text-(--text-color) border-b-2 border-transparent">
                Orders
            </button>

            <button onclick="switchTab(2)"
                class="tab-button flex-1 sm:flex-none px-4 sm:px-8 py-3 sm:py-4 text-sm font-semibold text-(--text-color) border-b-2 border-transparent">
                Payouts
            </button>

            <button onclick="switchTab(3)"
                class="tab-button flex-1 sm:flex-none px-4 sm:px-8 py-3 sm:py-4 text-sm font-semibold text-(--text-color) border-b-2 border-transparent">
                Store
            </button>
        </div>

        <!-- Recent Notifications -->
        <div class="space-y-6">
            <!-- New Order -->
            <div
                class="bg-(--card-bg) rounded-2xl p-6 shadow-sm hover:shadow-md border border-(--text-color)/20 flex gap-5 transition-all duration-300">
                <div class="w-12 h-12 bg-(--hover-color)/10 rounded-2xl flex items-center justify-center flex-shrink-0">
                    <span class="text-3xl"><i data-lucide="archive" class="text-(--hover-color)"></i></span>
                </div>
                <div class="flex-1">
                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-2">
                        <h3 class="font-semibold text-lg text-(--text-color)">New Order Received</h3>
                        <span
                            class="text-xs text-(--primary-color) font-medium bg-(--primary-color)/20 px-3 py-1.5 rounded-2xl rounded-full w-fit">Just
                            now</span>
                    </div>
                    <p class="text-(--text-color)/90 mt-1 text-base">Order <strong>#HK-9945</strong> from Sujata Sharma
                        • Rs. 2,850</p>
                    <p class="text-sm text-(--text-color)/60 mt-2">Gift Basket "Festive Delight" for delivery in
                        Kathmandu</p>
                    <div class="flex gap-3 mt-5">
                        <a href="{{ route('order') }}"
                            class="px-6 py-2.5 bg-(--secondary-color) hover:bg-[#B94E31] text-white rounded-xl text-sm font-medium transition-colors">
                            View Order
                        </a>
                    </div>
                </div>
            </div>

            <!-- Order Shipped -->
            <div
                class="bg-(--card-bg) rounded-2xl p-6 shadow-sm hover:shadow-md border border-(--text-color)/20 flex gap-5 transition-all duration-300">
                <div
                    class="w-12 h-12 bg-(--primary-color)/20 rounded-2xl flex items-center justify-center flex-shrink-0">
                    <span class="text-3xl"><i data-lucide="truck" class="text-(--primary-color)"></i></span>
                </div>
                <div class="flex-1">
                    <div class="flex justify-between">
                        <h3 class="font-semibold text-lg text-(--text-color)">Order Shipped</h3>
                        <span class="text-xs text-(--text-color)/60">2 hours ago</span>
                    </div>
                    <p class="text-(--text-color)/90 mt-1 text-base">You shipped Order <strong>#HK-9921</strong> for
                        customer
                        Ramesh Thapa
                    </p>
                    <div class="mt-4 flex items-center gap-2 text-sm text-(--text-color)/60">
                        <span class="px-3 py-1 bg-(--primary-color)/10 rounded-lg">Tracking ID: NP98765432</span>
                    </div>
                </div>
            </div>

            <!-- Payout Processed -->
            <div
                class="bg-(--card-bg) rounded-2xl p-6 shadow-sm hover:shadow-md border border-(--text-color)/20 flex gap-5 transition-all duration-300">
                <div class="w-12 h-12 bg-(--text-color)/20 rounded-2xl flex items-center justify-center flex-shrink-0">
                    <span class="text-3xl"><i data-lucide="wallet-cards" class="text-(--text-color)"></i></span>
                </div>
                <div class="flex-1">
                    <div class="flex justify-between">
                        <h3 class="font-semibold text-lg text-(--text-color)">Payout Processed</h3>
                        <span class="text-xs text-(--text-color)/60 ">Yesterday</span>
                    </div>
                    <p class="text-(--text-color)/90 mt-1 text-base">Your weekly payout of <strong>Rs. 48,750</strong>
                        has been
                        transferred
                        to your account ending ****6742</p>
                    <a href="{{ route('seller.payment') }}"
                        class="text-(--secondary-color) text-sm font-medium mt-4 inline-flex items-center gap-1 hover:underline">
                        View Transaction Receipt
                        <i data-lucide="arrow-right" class="w-3 h-3"></i>
                    </a>
                </div>
            </div>

            <!-- Low Stock Alert -->
            <div
                class="bg-(--card-bg) rounded-2xl p-6 shadow-sm hover:shadow-md border border-(--text-color)/20 flex gap-5 transition-all duration-300">
                <div
                    class="w-12 h-12 bg-(--secondary-color)/20 rounded-2xl flex items-center justify-center flex-shrink-0">
                    <span class="text-3xl"><i data-lucide="alert-triangle" class="text-(--secondary-color)"></i></span>
                </div>
                <div class="flex-1">
                    <div class="flex justify-between">
                        <h3 class="font-semibold text-lg text-(--secondary-color)">Low Stock Alert</h3>
                        <span class="text-xs text-(--text-color)/60">3 days ago</span>
                    </div>
                    <p class="text-(--text-color)/90 mt-1 text-base">"Premium Dry Fruit Basket" is running low (only 7
                        left in
                        stock)</p>
                    <a href="{{ route('product-management') }}"
                        class="mt-4 inline-flex items-center justify-center px-5 py-2 bg-(--secondary-color) text-white text-sm rounded-xl hover:bg-[#B94E31] transition-colors">
                        Restock Now
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function switchTab(tabIndex) {
            document.querySelectorAll('.tab-button').forEach((btn, i) => {

                if (i === tabIndex) {
                    btn.classList.add(
                        'text-(--secondary-color)',
                        'border-(--secondary-color)',
                        'border-b-2'
                    );

                    btn.classList.remove(
                        'text-(--text-color)',
                        'border-transparent'
                    );

                } else {
                    btn.classList.remove(
                        'text-(--secondary-color)',
                        'border-(--secondary-color)'
                    );

                    btn.classList.add(
                        'text-(--text-color)',
                        'border-transparent'
                    );
                }
            });
        }
    </script>
</x-seller_layout>
