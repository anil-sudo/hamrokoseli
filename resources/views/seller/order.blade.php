<x-seller_layout title="Order Management" searchPlaceholder="Search by Order ID or Customer...">
    <div class="space-y-10">
        <!-- Header Section with fade-in -->
        <div class="mb-6 animate-fadeIn">
            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-(--text-color)">Manage Orders</h1>
                    <p class="text-sm text-(--text-color)/70 mt-1">Review and update processing for your customer
                        transactions.</p>
                </div>

                <!-- Action Buttons with hover effects -->
                <div class="flex flex-wrap gap-3">
                    <button onclick="exportCSV()"
                        class="group flex items-center gap-2 px-4 py-2.5 sm:px-5 sm:py-3 bg-(--card-bg) border border-(--text-color)/10 rounded-2xl text-sm font-medium hover:border-(--secondary-color) hover:shadow-md active:scale-95 transition-all duration-200">
                        <i data-lucide="hard-drive-download"
                            class="w-5 h-5 group-hover:-translate-y-0.5 transition-transform duration-200"></i>
                        <span>Export CSV</span>
                    </button>
                    <button onclick="bulkPrint()"
                        class="group flex items-center gap-2 px-4 py-2.5 sm:px-5 sm:py-3 bg-(--secondary-color) text-(--text-light)/95 rounded-2xl text-sm font-medium hover:bg-[#B94E31] hover:shadow-lg active:scale-95 transition-all duration-200 shadow-md">
                        <i data-lucide="printer"
                            class=" w-5 h-5 group-hover:-rotate-3 transition-transform duration-200"></i>
                        <span>Bulk Print</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Tabs with smooth indicator transition -->
        <div
            class="relative flex flex-nowrap bg-(--card-bg) rounded-3xl p-1 shadow-sm overflow-x-auto scrollbar-hide mb-8 animate-slideUp">
            <div class="absolute bottom-1 left-0 h-[calc(100%-8px)] bg-(--secondary-color) rounded-3xl transition-all duration-300 ease-out z-0"
                id="tabIndicator"></div>
            <button onclick="switchTab(0)" id="tab-0"
                class="tab-btn relative z-10 px-5 py-3 sm:px-6 sm:py-3.5 rounded-3xl font-medium text-sm transition-all duration-200 whitespace-nowrap bg-(--secondary-color) text-(--text-light)">
                All Orders (1,240)
            </button>
            <button onclick="switchTab(1)" id="tab-1"
                class="tab-btn relative z-10 px-5 py-3 sm:px-6 sm:py-3.5 rounded-3xl font-medium text-sm transition-all duration-200 whitespace-nowrap text-(--text-dark)">
                New (12)
            </button>
            <button onclick="switchTab(2)" id="tab-2"
                class="tab-btn relative z-10 px-5 py-3 sm:px-6 sm:py-3.5 rounded-3xl font-medium text-sm transition-all duration-200 whitespace-nowrap text-(--text-dark)">
                Processing (45)
            </button>
            <button onclick="switchTab(3)" id="tab-3"
                class="tab-btn relative z-10 px-5 py-3 sm:px-6 sm:py-3.5 rounded-3xl font-medium text-sm transition-all duration-200 whitespace-nowrap text-(--text-dark)">
                Shipped (890)
            </button>
            <button onclick="switchTab(4)" id="tab-4"
                class="tab-btn relative z-10 px-5 py-3 sm:px-6 sm:py-3.5 rounded-3xl font-medium text-sm transition-all duration-200 whitespace-nowrap text-(--text-dark)">
                Cancelled (8)
            </button>
        </div>

        <!-- Table Container with smooth loading animation -->
        <div
            class="bg-(--card-bg) rounded-2xl shadow-md overflow-hidden border border-(--text-color)/20 mb-8 transition-all duration-300 hover:shadow-lg">
            <div class="responsive-table-wrapper overflow-x-auto">
                <table class="w-full md:min-w-full">
                    <thead>
                        <tr class="border-b border-gray-100 bg-(--card-dark)">
                            <th
                                class="text-left py-4 px-4 md:px-6 lg:px-8 text-xs font-semibold text-(--text-color) uppercase tracking-wider">
                                Order ID</th>
                            <th
                                class="text-left py-4 px-4 md:px-6 lg:px-8 text-xs font-semibold text-(--text-color) uppercase tracking-wider">
                                Customer Name</th>
                            <th
                                class="text-left py-4 px-4 md:px-6 lg:px-8 text-xs font-semibold text-(--text-color) uppercase tracking-wider">
                                Date</th>
                            <th
                                class="text-left py-4 px-4 md:px-6 lg:px-8 text-xs font-semibold text-(--text-color) uppercase tracking-wider">
                                Amount</th>
                            <th
                                class="text-left py-4 px-4 md:px-6 lg:px-8 text-xs font-semibold text-(--text-color) uppercase tracking-wider">
                                Payment</th>
                            <th
                                class="text-left py-4 px-4 md:px-6 lg:px-8 text-xs font-semibold text-(--text-color) uppercase tracking-wider">
                                Order Status</th>
                            <th
                                class="text-right py-4 px-4 md:px-6 lg:px-8 text-xs font-semibold text-(--text-color) uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-(--text-color)/10 text-sm" id="ordersTableBody">
                        <!-- Row 1 with staggered animation -->
                        <tr class="hover:bg-(--card-dark)/10 transition-all duration-200 cursor-pointer">
                            <td
                                class="px-4 md:px-6 lg:px-8 py-5 text-(--text-color) text-sm font-medium transition-colors">
                                #HK-89234</td>
                            <td class="px-4 md:px-6 lg:px-8 py-5">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-12 h-8 sm:w-13 sm:h-9 bg-(--card-dark) rounded-full flex items-center justify-center font-semibold text-xs sm:text-sm transition-all duration-200">
                                        RP</div>
                                    <div class="font-medium text-(--text-color)">Ram Poudel</div>
                                </div>
                            </td>
                            <td class="px-4 md:px-6 lg:px-8 py-5 text-(--text-color) text-sm">june 1, 2026</td>
                            <td class="px-4 md:px-6 lg:px-8 py-5 font-semibold text-(--text-color)">Rs. 7,550</td>
                            <td class="px-4 md:px-6 lg:px-8 py-5">
                                <span
                                    class="inline-block px-3 py-1.5 text-xs font-medium bg-(--card-dark) text-(--primary-color)/85 rounded-full">Paid</span>
                            </td>
                            <td class="px-4 md:px-6 lg:px-8 py-5">
                                <span class="inline-flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 bg-(--primary-color) rounded-full"></span>
                                    <span class="font-medium text-(--text-color)">Shipped</span>
                                </span>
                            </td>
                            <td class="px-4 md:px-6 lg:px-8 py-5 text-right">
                                <a href="{{ route('order-details') }}"
                                    class="text-(--secondary-color) hover:text-(--hover-color) font-medium flex items-center gap-1 ml-auto text-sm transition-all duration-200 group">
                                    <span class="hover:underline">View Details</span>
                                    <i data-lucide="arrow-right" class="w-6 h-4"></i>

                                </a>
                            </td>
                        </tr>
                        <!-- Row 2 -->
                        <tr class="hover:bg-(--card-dark)/10 transition-all duration-200 cursor-pointer">
                            <td
                                class="px-4 md:px-6 lg:px-8 py-5 text-(--text-color) text-sm font-medium transition-colors">
                                #HK-89235</td>
                            <td class="px-4 md:px-6 lg:px-8 py-5">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-12 h-8 sm:w-13 sm:h-9 bg-(--card-dark) rounded-full flex items-center justify-center font-semibold text-xs sm:text-sm transition-all duration-200">
                                        ST</div>
                                    <div class="font-medium text-(--text-color)">Sita Tamang</div>
                                </div>
                            </td>
                            <td class="px-4 md:px-6 lg:px-8 py-5 text-(--text-color) text-sm">june 2, 2026</td>
                            <td class="px-4 md:px-6 lg:px-8 py-5 font-semibold text-(--text-color)">Rs. 3,500</td>
                            <td class="px-4 md:px-6 lg:px-8 py-5">
                                <span
                                    class="inline-block px-3 py-1.5 text-xs font-medium bg-(--hover-color)/50 text-(--secondary-color) rounded-full">Pending</span>
                            </td>
                            <td class="px-4 md:px-6 lg:px-8 py-5">
                                <span class="inline-flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 bg-(--hover-color) rounded-full"></span>
                                    <span class="font-medium text-(--text-color)">New</span>
                                </span>
                            </td>
                            <td class="px-4 md:px-6 lg:px-8 py-5 text-right">
                                <button
                                    class="text-(--secondary-color) hover:text-(--hover-color) font-medium flex items-center gap-1 ml-auto text-sm transition-all duration-200 group">
                                    <span class="hover:underline">View Details</span>
                                    <i data-lucide="arrow-right" class="w-6 h-4"></i>

                                </button>
                            </td>
                        </tr>
                        <!-- Row 3 -->
                        <tr class="hover:bg-(--card-dark)/10 transition-all duration-200 cursor-pointer">
                            <td
                                class="px-4 md:px-6 lg:px-8 py-5 text-(--text-color) text-sm font-medium transition-colors">
                                #HK-89234</td>
                            <td class="px-4 md:px-6 lg:px-8 py-5">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-12 h-8 sm:w-13 sm:h-9 bg-(--card-dark) rounded-full flex items-center justify-center font-semibold text-xs sm:text-sm transition-all duration-200">
                                        HB</div>
                                    <div class="font-medium text-(--text-color)">Hari Basnet</div>
                                </div>
                            </td>
                            <td class="px-4 md:px-6 lg:px-8 py-5 text-(--text-color) text-sm">june 3, 2026</td>
                            <td class="px-4 md:px-6 lg:px-8 py-5 font-semibold text-(--text-color)">Rs. 5,500</td>
                            <td class="px-4 md:px-6 lg:px-8 py-5">
                                <span
                                    class="inline-block px-3 py-1.5 text-xs font-medium bg-(--card-dark) text-(--primary-color)/85 rounded-full">Paid</span>
                            </td>
                            <td class="px-4 md:px-6 lg:px-8 py-5">
                                <span class="inline-flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 bg-(--secondary-color) rounded-full"></span>
                                    <span class="font-medium text-(--text-color)">processing</span>
                                </span>
                            </td>
                            <td class="px-4 md:px-6 lg:px-8 py-5 text-right">
                                <button
                                    class="text-(--secondary-color) hover:text-(--hover-color) font-medium flex items-center gap-1 ml-auto text-sm transition-all duration-200 group">
                                    <span class="hover:underline">View Details</span>
                                    <i data-lucide="arrow-right" class="w-6 h-4"></i>

                                </button>
                            </td>
                        </tr>
                        <!-- Row 4 -->
                        <tr class="hover:bg-(--card-dark)/10 transition-all duration-200 cursor-pointer">
                            <td
                                class="px-4 md:px-6 lg:px-8 py-5 text-(--text-color) text-sm font-medium transition-colors">
                                #HK-89235</td>
                            <td class="px-4 md:px-6 lg:px-8 py-5">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-12 h-8 sm:w-13 sm:h-9 bg-(--card-dark) rounded-full flex items-center justify-center font-semibold text-xs sm:text-sm transition-all duration-200">
                                        SM</div>
                                    <div class="font-medium text-(--text-color)">Subina Magar</div>
                                </div>
                            </td>
                            <td class="px-4 md:px-6 lg:px-8 py-5 text-(--text-color) text-sm">june 7, 2026</td>
                            <td class="px-4 md:px-6 lg:px-8 py-5 font-semibold text-(--text-color)">Rs. 1,500</td>
                            <td class="px-4 md:px-6 lg:px-8 py-5">
                                <span
                                    class="inline-block px-3 py-1.5 text-xs font-medium bg-(--secondary-color)/20 text-(--secondary-color) rounded-full">Refunded</span>
                            </td>
                            <td class="px-4 md:px-6 lg:px-8 py-5">
                                <span class="inline-flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 bg-(--text-dark)/40 rounded-full"></span>
                                    <span class="font-medium text-(--text-color)">Cancelled</span>
                                </span>
                            </td>
                            <td class="px-4 md:px-6 lg:px-8 py-5 text-right">
                                <button
                                    class="text-(--secondary-color) hover:text-(--hover-color) font-medium flex items-center gap-1 ml-auto text-sm transition-all duration-200 group">
                                    <span class="hover:underline">View Details</span>
                                    <i data-lucide="arrow-right" class="w-6 h-4"></i>

                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination with smooth interactions -->
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-8 animate-slideUp">
            <p class="text-sm text-(--text-dark)/50">
                Showing <span class="font-medium text-(--text-dark)">1–4</span> of <span
                    class="font-medium text-(--text-dark)">1,240</span> orders
            </p>
            <div class="flex items-center gap-2 flex-wrap justify-center">
                <button
                    class="pagination-btn w-9 h-9 sm:w-10 sm:h-10 flex items-center justify-center border border-gray-300 rounded-2xl hover:bg-[#1F3D2E] hover:text-white hover:border-[#1F3D2E] active:scale-95 transition-all duration-200 text-gray-700">
                    <i data-lucide="chevron-left" class="w-3 h-3"></i>
                </button>
                <button
                    class="pagination-btn w-9 h-9 sm:w-10 sm:h-10 bg-[#1F3D2E] text-white rounded-2xl font-medium text-sm transition-all duration-200 hover:bg-[#2a5040] hover:scale-105">1</button>
                <button
                    class="pagination-btn w-9 h-9 sm:w-10 sm:h-10 flex items-center justify-center border border-gray-300 rounded-2xl hover:bg-[#1F3D2E] hover:text-white hover:border-[#1F3D2E] active:scale-95 transition-all duration-200 text-gray-700">2</button>
                <button
                    class="pagination-btn w-9 h-9 sm:w-10 sm:h-10 flex items-center justify-center border border-gray-300 rounded-2xl hover:bg-[#1F3D2E] hover:text-white hover:border-[#1F3D2E] active:scale-95 transition-all duration-200 text-gray-700">3</button>
                <button
                    class="pagination-btn w-9 h-9 sm:w-10 sm:h-10 flex items-center justify-center border border-gray-300 rounded-2xl hover:bg-[#1F3D2E] hover:text-white hover:border-[#1F3D2E] active:scale-95 transition-all duration-200 text-gray-700">
                    <i data-lucide="chevron-right" class="w-3 h-3"></i>
                 </button>
            </div>
        </div>
    </div>

    <script>
        function switchTab(n) {
            document.querySelectorAll('[id^="tab-"]').forEach(tab => {
                tab.classList.remove('tab-active', 'bg-(--secondary-color)', 'text-(--text-light)');
                tab.classList.add('text-(--text-dark)');
            });
            document.getElementById(`tab-${n}`).classList.add('tab-active', 'bg-(--secondary-color)',
                'text-(--text-light)');
        }

        function exportCSV() {
            alert('Export CSV functionality would be implemented here');
        }

        function bulkPrint() {
            alert('Bulk Print functionality would be implemented here');
        }
    </script>

    <style>
        .tab-btn {
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .responsive-table-wrapper {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
    </style>
</x-seller_layout>
