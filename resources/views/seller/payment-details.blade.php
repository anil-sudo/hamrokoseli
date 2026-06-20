<x-seller_layout title="payment Details" searchPlaceholder="Search...">
    <div class="space-y-10">
        <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between items-start gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-semibold text-(--text-color)">Payout Details</h1>
                <p class="text-sm text-(--text-color)/70 mt-1">View detailed information about this payout and download
                    receipt.</p>
            </div>
            <a href="{{ route('seller.payment') }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-(--text-dark) bg-(--text-light) border border-(--text-color)/20 rounded-2xl">
                <i data-lucide="arrow-left" class="w-5 h-5"></i>
                Back to Payment
            </a>
        </div>

        <!-- Status -->
        <div
            class="bg-(--card-bg) border border-(--text-color)/20 rounded-xl p-4 mb-6 flex items-center gap-3 shadow-sm hover:shadow-md transition-all duration-300">
            <div
                class="w-8 h-8 bg-(--primary-color)/30 text-(--primary-color) rounded-full flex items-center justify-center shrink-0">
                <i data-lucide="check"></i>

            </div>
            <div>
                <p class="font-semibold text-(--primary-color)">PROCESSED</p>
                <p class="text-sm text-(--primary-color)/70">This payout has been successfully processed.</p>
            </div>
        </div>

        <!-- Top Info Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            <div
                class="bg-(--card-bg) border border-gray-200 rounded-xl p-5 shadow-sm hover:shadow-md transition-all duration-300">
                <div class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 bg-(--hover-color)/10 rounded-lg flex items-center justify-center text-(--hover-color) text-xl">
                        <i data-lucide="tag"></i>
                    </div>
                    <div>
                        <p class="text-xs text-(--text-color) font-medium">Reference ID</p>
                        <p class="font-semibold text-(--text-dark)">TRX-948271</p>
                    </div>
                </div>
            </div>

            <div
                class="bg-(--card-bg) border border-gray-200 rounded-xl p-5 shadow-sm hover:shadow-md transition-all duration-300">
                <div class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 bg-(--secondary-color)/10 rounded-lg flex items-center justify-center text-(--secondary-color) text-xl">
                        <i data-lucide="calendar-days"></i>
                    </div>
                    <div>
                        <p class="text-xs text-(--text-color) font-medium">Payout Date</p>
                        <p class="font-semibold text-(--text-dark)">Oct 24, 2023</p>
                    </div>
                </div>
            </div>

            <div
                class="bg-(--card-bg) border border-gray-200 rounded-xl p-5 shadow-sm hover:shadow-md transition-all duration-300">
                <div class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 bg-[#1E2A44]/10 rounded-lg flex items-center justify-center text-[#1E2A44] text-xl">
                        <i data-lucide="landmark"></i>
                    </div>
                    <div>
                        <p class="text-xs text-(--text-color) font-medium">Paid To</p>
                        <p class="font-semibold text-(--text-dark)">Bank Account ****4242</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <!-- Left Column: Payment Information -->
            <div class="lg:col-span-7 shadow-sm hover:shadow-md transition-all duration-300">
                <div class="bg-(--card-bg) border border-gray-200 rounded-2xl p-6">
                    <h2 class="text-lg font-semibold mb-5 flex items-center gap-2">
                        <span> <i data-lucide="receipt-text"></i></span> Payment Information
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-xs text-(--text-color)/70 mb-1">Payment Method</p>
                            <p class="font-medium text-(--text-dark)">Bank Transfer</p>
                        </div>
                        <div>
                            <p class="text-xs text-(--text-color)/70 mb-1">Bank Name</p>
                            <p class="text-(--text-dark) font-medium">Nepal Investment Bank Ltd.</p>
                        </div>
                        <div>
                            <p class="text-xs text-(--text-color)/70 mb-1">Account Number</p>
                            <p class="text-(--text-dark) font-medium">****4242</p>
                        </div>
                        <div>
                            <p class="text-xs text-(--text-color)/70 mb-1">Account Holder Name</p>
                            <p class="text-(--text-dark) font-medium">Ram Sharma</p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-xs text-(--text-color)/70 mb-1">Transaction ID</p>
                            <p class="text-(--text-dark) font-mono text-sm px-3 py-2 rounded-lg w-fit">NIBL241024298271</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Amount Summary -->
            <div class="lg:col-span-5 shadow-sm hover:shadow-md transition-all duration-300">
                <div class="bg-(--card-bg) border border-gray-200 rounded-2xl p-6 h-full">
                    <h2 class="text-lg font-semibold mb-5">Amount Summary</h2>

                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-(--text-color)/70">Gross Earnings</span>
                            <span class="font-medium">Rs.3,500</span>
                        </div>
                        <div class="flex justify-between text-(--secondary-color)">
                            <span>Platform Fee</span>
                            <span>- Rs.250</span>
                        </div>
                        <div class="flex justify-between text-(--secondary-color)">
                            <span>TDS (4%)</span>
                            <span>- Rs.130</span>
                        </div>
                        <div class="flex justify-between text-(--text-color)/70">
                            <span>Other Adjustments</span>
                            <span class="text-(--primary-color)">- Rs.0</span>
                        </div>

                        <hr class="my-4">

                        <div class="flex justify-between text-lg font-semibold">
                            <span class="text-(--text-dark)">Net Payout Amount</span>
                            <span class="text-(--primary-color)">Rs.3,120</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Included Orders -->
        <div class="mt-8">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold">Included Orders (4)</h2>
                <a href="{{ route('order') }}"
                    class="text-(--secondary-color) text-sm font-medium flex items-center gap-1">
                    <span class="hover:underline">View All Orders</span>
                     <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>

            <div class="bg-(--card-bg) border border-(--text-color)/20 rounded-2xl overflow-hidden">
                <table class="w-full">
                    <thead class="bg-(--card-dark) border-b">
                        <tr class="text-xs uppercase tracking-widest font-medium text-(--text-color)/70">
                            <th class="text-left py-4 px-6">Order ID</th>
                            <th class="text-left py-4 px-6">Order Date</th>
                            <th class="text-right py-4 px-6">Amount</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        <tr class="hover:bg-(--card-dark)/10 transition-all duration-200 cursor-pointer">
                            <td class="py-4 px-6 font-medium">ORD-1001</td>
                            <td class="py-4 px-6 text-(--text-color)">Oct 30, 2023</td>
                            <td class="py-4 px-6 text-right font-medium">Rs.1,200.00</td>
                        </tr>
                        <tr class="hover:bg-(--card-dark)/10 transition-all duration-200 cursor-pointer">
                            <td class="py-4 px-6 font-medium">ORD-1002</td>
                            <td class="py-4 px-6 text-(--text-color)">Oct 31, 2023</td>
                            <td class="py-4 px-6 text-right font-medium">Rs.950.00</td>
                        </tr>
                        <tr class="hover:bg-(--card-dark)/10 transition-all duration-200 cursor-pointer">
                            <td class="py-4 px-6 font-medium">ORD-1003</td>
                            <td class="py-4 px-6 text-(--text-color)">Oct 22, 2023</td>
                            <td class="py-4 px-6 text-right font-medium">Rs.970.00</td>
                        </tr>
                        <tr class="hover:bg-(--card-dark)/10 transition-all duration-200 cursor-pointer">
                            <td class="py-4 px-6 font-medium">ORD-1004</td>
                            <td class="py-4 px-6 text-(--text-color)">Oct 23, 2023</td>
                            <td class="py-4 px-6 text-right font-medium">Rs.0.50</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center justify-between mt-10">
            <button onclick="downloadReceipt()"
                class="flex items-center gap-2 border border-(--secondary-color) hover:bg-(--card-bg) bg-(--text-light)/70 px-6 py-3 rounded-xl font-medium text-(--text-dark) shadow-sm hover:shadow-md transition-all duration-300  w-fit sm:w-auto">
                <span> <i data-lucide="arrow-down-to-line" class="w-4 h-4"></i></span> Download Receipt
            </button>

            <a href="{{ route('seller.payment') }}"
                class="px-8 py-3 bg-(--secondary-color)/95 hover:bg-[#B94E31] text-(--text-light) rounded-xl font-semibold shadow-sm hover:shadow-md transition-all duration-300  w-fit sm:w-auto">
                Close
            </a>
        </div>
    </div>


    <script>
        function downloadReceipt() {
            alert("Receipt downloaded! (Add your logic here)");
        }

        function closeModal() {
            alert("Modal closed (implement your close logic)");
        }
    </script>
</x-seller_layout>
