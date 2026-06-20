<x-seller_layout title="payment Management" searchPlaceholder="Search by Orders , products or analytics...">
    <!-- Main Content -->
    <div class="space-y-10">
        <!-- Header -->
        <div class="mb-6 animate-fadeIn">
            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-(--text-color)">Financial Overview</h1>
                    <p class="text-sm text-(--text-color)/70 mt-1">Manage your earnings, payouts, and settlement history
                        in
                        one place.</p>
                </div>

                <div class="flex flex-wrap gap-3">
                    <button
                        class="group flex items-center gap-2 px-4 py-2.5 sm:px-5 sm:py-3 bg-(--card-bg) border border-(--text-color)/10 rounded-2xl text-sm font-medium hover:border-(--secondary-color) hover:shadow-md active:scale-95 transition-all duration-200">
                        <i data-lucide="hard-drive-download"
                            class="w-5 h-5 group-hover:-translate-y-0.5 transition-transform duration-200"></i>
                        <span> Export Statement</span>
                    </button>
                    <button id="requestPayoutBtn" onclick="openPayoutModal()"
                        class="group flex items-center gap-2 px-4 py-2.5 sm:px-5 sm:py-3 bg-(--secondary-color) text-(--text-light)/95 rounded-2xl text-sm font-medium hover:bg-[#B94E31] hover:shadow-lg active:scale-95 transition-all duration-200 shadow-md">
                        <i data-lucide="credit-card"
                            class=" w-5 h-5 group-hover:-rotate-3 transition-transform duration-200"></i>
                        <span>Request Payout</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-18">
            <!-- Current Balance -->

            <div
                class="relative overflow-hidden bg-[#FFF7EF] rounded-3xl p-6 shadow-sm hover:shadow-md transition-all duration-300">

                <div class="relative">

                    <!-- Header -->
                    <div class="flex items-center gap-2">
                        <div class="w-10 h-10 rounded-xl bg-(--primary-color)/10 flex items-center justify-center mb-3">
                            <i data-lucide="wallet-minimal" class="w-5 h-5 text-(--primary-color)"></i>
                        </div>

                        <p class="text-sm font-medium text-(--text-color) uppercase tracking-widest">
                            Current Balance
                        </p>
                    </div>

                    <!-- Balance -->
                    <p class="text-3xl font-extrabold text-(--text-dark) mt-3">
                        Rs.15,000
                    </p>

                </div>

            </div>

            <!-- total earnings-->
            <div
                class="relative overflow-hidden bg-[#FFF7EF] rounded-3xl p-6 shadow-sm hover:shadow-md transition-all duration-300">

                <div class="relative">

                    <!-- Header -->
                    <div class="flex items-center gap-2">
                        <div
                            class="w-10 h-10 rounded-xl bg-(--secondary-color)/10 flex items-center justify-center mb-3">
                            <i data-lucide="wallet-cards" class="w-5 h-5 text-(--secondary-color)"></i>
                        </div>

                        <p class="text-sm font-medium text-(--text-color) uppercase tracking-widest">
                            Total Earnings </p>
                    </div>

                    <!-- Balance -->
                    <p class="text-3xl font-extrabold text-(--text-dark) mt-3">
                        Rs.80,000
                    </p>

                </div>

            </div>

            <!-- total Payout -->
            <div
                class="relative overflow-hidden bg-[#FFF7EF] rounded-3xl p-6 shadow-sm hover:shadow-md transition-all duration-300">

                <div class="relative">

                    <!-- Header -->
                    <div class="flex items-center gap-2">
                        <div class="w-10 h-10 rounded-xl bg-(--hover-color)/10 flex items-center justify-center mb-3">
                            <i data-lucide="banknote-check" class="w-5 h-5 text-(--hover-color)"></i>
                        </div>

                        <p class="text-sm font-medium text-(--text-color) uppercase tracking-widest">
                            Total <br> Payout </p>
                    </div>

                    <!-- Balance -->
                    <p class="text-3xl font-extrabold text-(--text-dark) mt-3">
                        Rs.60,000
                    </p>

                </div>

            </div>

            <!-- Pending Settlement -->

            <div
                class="relative overflow-hidden bg-emerald-800 rounded-3xl p-6 shadow-sm hover:shadow-md transition-all duration-300">

                <div class="relative">

                    <!-- Header -->
                    <div class="flex items-center gap-2">
                        <div class="w-10 h-10 rounded-xl bg-(--text-light)/10 flex items-center justify-center mb-3">
                            <i data-lucide="calendar-clock" class="w-5 h-5 text-(--text-light)"></i>
                        </div>

                        <p class="text-sm font-medium text-white uppercase tracking-widest">
                            Pending Settlement</p>
                    </div>

                    <!-- Balance -->
                    <p class="text-3xl font-extrabold text-white mt-3">
                        Rs.5,000
                    </p>

                </div>

            </div>
        </div>

        <!-- Payout History -->
        <div
            class="bg-(--card-bg) rounded-2xl shadow-md overflow-hidden border border-(--text-color)/20 mb-8 transition-all duration-300 hover:shadow-lg">
            <div class="px-6 py-5 border-b border-(--card-dark) flex justify-between items-center">
                <h2 class="text-xl md:text-2xl font-semibold text-(--text-color)">Payout History</h2>
                <div class="relative">
                    <select
                        class="px-3 md:px-4 py-2 text-sm border border-gray-300 rounded-xl bg-white cursor-pointer focus:outline-none focus:ring-1 focus:ring-(--secondary-color) transition duration-300">
                        <option>Last 7 Days</option>
                        <option selected>Last 30 Days</option>
                        <option>Last 3 Months</option>
                        <option>Last 6 Months</option>
                        <option>Last Year</option>
                        <option>All Time</option>
                    </select>
                </div>
            </div>

            <div class="responsive-table-wrapper overflow-x-auto">
                <table class="w-full md:min-w-full">
                    <thead>
                        <tr class="border-b border-gray-100 bg-(--card-dark)">
                            <th
                                class="text-left py-4 px-4 md:px-6 lg:px-8 text-xs font-semibold text-(--text-color) uppercase tracking-wider">
                                Reference ID</th>
                            <th
                                class="text-left py-4 px-4 md:px-6 lg:px-8 text-xs font-semibold text-(--text-color) uppercase tracking-wider">
                                Date</th>
                            <th
                                class="text-left py-4 px-4 md:px-6 lg:px-8 text-xs font-semibold text-(--text-color) uppercase tracking-wider">
                                Method</th>
                            <th
                                class="text-left py-4 px-4 md:px-6 lg:px-8 text-xs font-semibold text-(--text-color) uppercase tracking-wider">
                                Amount</th>
                            <th
                                class="text-left py-4 px-4 md:px-6 lg:px-8 text-xs font-semibold text-(--text-color) uppercase tracking-wider">
                                Status</th>
                            <th
                                class="text-right py-4 px-4 md:px-6 lg:px-8 text-xs font-semibold text-(--text-color) uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-(--text-color)/10 text-sm">
                        <tr class="hover:bg-(--card-dark)/10 transition-all duration-200 cursor-pointer">
                            <td
                                class="px-4 md:px-6 lg:px-8 py-5 text-(--text-color) text-sm font-medium transition-colors">
                                TRX-948271</td>
                            <td class="px-4 md:px-6 lg:px-8 py-5 text-(--text-color) text-sm">Oct 24, 2023</td>
                            <td class="px-4 md:px-6 lg:px-8 py-5 font-medium text-(--text-color)">Bank Transfer
                                (••••4242)</td>
                            <td class="px-4 md:px-6 lg:px-8 py-5 font-semibold text-(--text-color)">Rs.3,120.50</td>
                            <td class="px-4 md:px-6 lg:px-8 py-5"><span
                                    class="inline-block px-3 py-1.5 text-xs font-medium bg-(--card-dark) text-(--primary-color)/85 rounded-full">PROCESSED</span>
                            </td>
                            <td class="px-4 md:px-6 lg:px-8 py-5 text-right">
                                <a href="{{ route('payment-details') }}"
                                    class="text-(--secondary-color) hover:text-(--hover-color) font-medium flex items-center gap-1 ml-auto text-sm transition-all duration-200 group">
                                    <span class="hover:underline">View Details</span>
                                    <i data-lucide="arrow-right" class="w-6 h-4"></i>

                                </a>
                            </td>
                        </tr>
                        <tr class="hover:bg-(--card-dark)/10 transition-all duration-200 cursor-pointer">
                            <td
                                class="px-4 md:px-6 lg:px-8 py-5 text-(--text-color) text-sm font-medium transition-colors">
                                TRX-837462</td>
                            <td class="px-4 md:px-6 lg:px-8 py-5 text-(--text-color) text-sm">Oct 17, 2023</td>
                            <td class="px-4 md:px-6 lg:px-8 py-5 font-medium text-(--text-color)">Bank Transfer
                                (••••4242)</td>
                            <td class="px-4 md:px-6 lg:px-8 py-5 font-semibold text-(--text-color)">Rs.2,840.00</td>
                            <td class="px-4 md:px-6 lg:px-8 py-5"><span
                                    class="inline-block px-3 py-1.5 text-xs font-medium bg-(--card-dark) text-(--primary-color)/85 rounded-full">PROCESSED</span>
                            </td>
                            <td class="px-4 md:px-6 lg:px-8 py-5 text-right">
                                <a href=""
                                    class="text-(--secondary-color) hover:text-(--hover-color) font-medium flex items-center gap-1 ml-auto text-sm transition-all duration-200 group">
                                    <span class="hover:underline">View Details</span>
                                    <i data-lucide="arrow-right" class="w-6 h-4"></i>

                                </a>
                            </td>
                        </tr>
                        <tr class="hover:bg-(--card-dark)/10 transition-all duration-200 cursor-pointer">
                            <td
                                class="px-4 md:px-6 lg:px-8 py-5 text-(--text-color) text-sm font-medium transition-colors">
                                TRX-726354</td>
                            <td class="px-4 md:px-6 lg:px-8 py-5 text-(--text-color) text-sm">Oct 10, 2023</td>
                            <td class="px-4 md:px-6 lg:px-8 py-5 font-medium text-(--text-color)">Bank Transfer
                                (••••4242)</td>
                            <td class="px-4 md:px-6 lg:px-8 py-5 font-semibold text-(--text-color)">Rs.4,200.75</td>
                            <td class="px-4 md:px-6 lg:px-8 py-5"><span
                                    class="inline-block px-3 py-1.5 text-xs font-medium bg-(--hover-color)/50 text-(--secondary-color) rounded-full">PENDING</span>
                            </td>
                            <td class="px-4 md:px-6 lg:px-8 py-5 text-right">
                                <a href=""
                                    class="text-(--secondary-color) hover:text-(--hover-color) font-medium flex items-center gap-1 ml-auto text-sm transition-all duration-200 group">
                                    <span class="hover:underline">View Details</span>
                                    <i data-lucide="arrow-right" class="w-6 h-4"></i>

                                </a>
                            </td>
                        </tr>
                        <tr class="hover:bg-(--card-dark)/10 transition-all duration-200 cursor-pointer">
                            <td
                                class="px-4 md:px-6 lg:px-8 py-5 text-(--text-color) text-sm font-medium transition-colors">
                                TRX-615243</td>
                            <td class="px-4 md:px-6 lg:px-8 py-5 text-(--text-color) text-sm">Oct 03, 2023</td>
                            <td class="px-4 md:px-6 lg:px-8 py-5 font-medium text-(--text-color)">Bank Transfer
                                (••••4242)</td>
                            <td class="px-4 md:px-6 lg:px-8 py-5 font-semibold text-(--text-color)">Rs.1,950.00</td>
                            <td class="px-4 md:px-6 lg:px-8 py-5"><span
                                    class="inline-block px-3 py-1.5 text-xs font-medium bg-(--card-dark) text-(--primary-color)/85 rounded-full">PROCESSED</span>
                            </td>
                            <td class="px-4 md:px-6 lg:px-8 py-5 text-right">
                                <a href=""
                                    class="text-(--secondary-color) hover:text-(--hover-color) font-medium flex items-center gap-1 ml-auto text-sm transition-all duration-200 group">
                                    <span class="hover:underline">View Details</span>
                                    <i data-lucide="arrow-right" class="w-6 h-4"></i>

                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div
                class="px-6 py-5 bg-(--card-dark) border-t border-(--text-color)/10 flex flex-col sm:flex-row items-center justify-between gap-4 text-sm">

                <p class="text-sm text-(--text-color)/70">
                    Showing <span class="font-medium">1-4</span> of
                    <span class="font-medium">24</span> settlements
                </p>


                <div class="flex items-center gap-2">

                    <button
                        class="px-4 py-2 text-sm rounded-xl border border-(--text-color) hover:bg-(--primary-color) hover:text-white transition">
                        Previous
                    </button>

                    <button
                        class="w-10 h-10 rounded-xl border border-(--text-color) hover:bg-(--primary-color) hover:text-whitefont-medium">
                        1
                    </button>

                    <button
                        class="w-10 h-10 rounded-xl border border-(--text-color) hover:bg-(--primary-color) hover:text-white transition">
                        2
                    </button>

                    <button
                        class="w-10 h-10 rounded-xl border border-(--text-color) hover:bg-(--primary-color) hover:text-white transition">
                        3
                    </button>

                    <button
                        class="px-4 py-2 text-sm rounded-xl border border-(--text-color) hover:bg-(--primary-color) hover:text-white transition">
                        Next
                    </button>

                </div>

            </div>
        </div>
        <!-- Bottom Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">


            <!-- Active Alerts -->
            <div class="bg-(--card-bg) rounded-3xl p-6 shadow-sm">
                <h3 class="font-semibold mb-4">ACTIVE ALERTS</h3>
                <div class="space-y-4">
                    <div class="bg-(--hover-color)/20 border border-(--text-color)/10 p-4 rounded-2xl">
                        <p class="font-medium text-(--secondary-color)">TDS Filing Due</p>
                        <p class="text-sm text-amber-700 mt-1">Submit by Oct 31st to avoid penalties.</p>
                    </div>
                    <div class="bg-(--primary-color)/30 border-(--text-color)/10 p-4 rounded-2xl">
                        <p class="font-medium text-(--text-dark)">Bank verification</p>
                        <p class="text-sm text-(--text-color) mt-1">Primary account successfully verified.</p>
                    </div>
                </div>
            </div>

            <!-- Need Help -->
            <div class="bg-emerald-800 text-white rounded-3xl p-6 shadow-sm">
                <h3 class="font-semibold mb-2">NEED HELP?</h3>
                <p class="text-emerald-100 text-base mb-6">Reach out to our team for account and settlement
                    queries.</p>
                <a href="{{ route('create-ticket') }}"
                    class="bg-white text-emerald-800 px-6 py-3 rounded-2xl font-medium hover:bg-emerald-100 transition">
                    Create Ticket
                </a>
            </div>
        </div>
    </div>

    <!-- Request Payout Modal -->
    <div id="payoutModal"
        class="hidden fixed inset-0 z-50 bg-black/60 backdrop-blur-sm items-center justify-center p-4">

        <div class="bg-[#FFFCF8] w-full max-w-lg rounded-3xl shadow-2xl overflow-hidden">
            <!-- Header -->
            <div class="px-6 py-4 border-b flex justify-between items-start">
                <div class="flex gap-3">
                    <div class="w-12 h-12 rounded-2xl bg-(--primary-color)/20 flex items-center justify-center">
                        <i data-lucide="wallet" class="w-6 h-6 text-(--primary-color)"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-(--text-color)">
                            Request Payout
                        </h2>
                        <p class="text-sm text-(--text-color)/70">
                            Withdraw your earnings securely
                        </p>
                    </div>
                </div>

                <button onclick="closePayoutModal()"
                    class="w-10 h-10 rounded-full text-2xl text-gray-600 hover:text-gray-700 transition">
                    &times;
                </button>
            </div>


            <div class="p-5 space-y-4 max-h-[70vh] overflow-y-auto">
                <!-- Balance Card -->
                <div class="rounded-3xl bg-(--card-dark)/50 p-4 border border-(--text-color)/20">
                    <p class="text-sm  text-(--text-color)/90">Available Balance </p>
                    <h3 class="text-3xl font-bold text-(--secondary-color) mt-1">
                        Rs.15,000
                    </h3>
                    <div
                        class="mt-3 inline-flex items-center gap-2 bg-[#FFFCF8] px-3 py-1 rounded-full text-(--primary-color) text-sm">
                        <i data-lucide="check-circle" class="w-4 h-4"></i>
                        Available for payout
                    </div>
                </div>

                <!-- Amount -->
                <div>
                    <label class="text-sm font-medium text-(--text-dark)">
                        Payout Amount
                    </label>
                    <div class="relative mt-2">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-(--text-color)/70">
                            Rs.
                        </span>
                        <input id="payoutAmount" oninput="formatAmount(this)" type="number"
                            class="bg-(--card-dark) w-full pl-12 pr-4 py-4 border border-(--text-color)/20 rounded-2xl text-lg focus:outline-none focus:border-(--secondary-color) transition"
                            placeholder="Enter amount">
                    </div>
                    <p class="text-xs text-(--text-color)/70 mt-2">
                        Minimum payout amount is Rs.500
                    </p>
                </div>

                <!-- Payment Method -->
                <div>
                    <label class="block text-sm font-medium text-(--text-dark) mb-2">Payment Method</label>
                    <div class="border border-(--text-color)/20  rounded-2xl p-5 bg-(--card-dark)/50">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-10 h-10 bg-[#FFFCF8] rounded-xl flex items-center justify-center text-2xl">
                                    <i data-lucide="landmark"></i>
                                </div>
                                <div>
                                    <p class="font-semibold">Bank Transfer (••4242)</p>
                                    <p class="text-sm text-(--text-color)/80">Nabil Bank - Savings Account</p>
                                </div>
                            </div>
                            <button onclick="toggleBankInfo()"
                                class="px-5 py-2.5 text-sm font-medium text-(--secondary-color) border border-(--text-color)/20 focus:outline-none focus:border-(--secondary-color) rounded-xl">
                                Change Bank
                            </button>
                        </div>
                    </div>
                </div>

                <!-- ==================== BANK INFORMATION FORM ==================== -->
                <div id="bankInfoSection"
                    class="hidden bg-(--card-dark)/50 border border-(--text-color)/20  rounded-2xl p-6">
                    <h3 class="font-semibold text-(--text-color) mb-5">Bank Information</h3>

                    <form id="bankForm" class="space-y-5">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-medium text-brand-dark mb-1">
                                    Account Holder Name <span class="text-(--secondary-color)">*</span>
                                </label>
                                <input type="text" id="accName"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-(--secondary-color)">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-brand-dark mb-1">
                                    Bank Name <span class="text-(--secondary-color)">*</span>
                                </label>
                                <input type="text" id="bankName"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-(--secondary-color)">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-brand-dark mb-1">
                                    Account Number <span class="text-(--secondary-color)">*</span>
                                </label>
                                <input type="text" id="accNumber"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-(--secondary-color)">
                            </div>

                            <div>
                                <label class="block text-xs font-medium text-brand-dark mb-1">
                                    Account Type <span class="text-(--secondary-color)">*</span>
                                </label>
                                <select id="accType" name="accType"
                                    class="w-full border border-(--text-color)/20  rounded-xl px-4 py-3 focus:outline-none focus:border-(--secondary-color)">
                                    <option value="" selected>Select Account Type</option>
                                    <option value="Savings">Savings</option>
                                    <option value="Current">Current</option>
                                    <option value="Fixed Deposit">Fixed Deposit</option>
                                </select>
                            </div>
                            <div class="col-span-2">
                                <label class="block text-xs font-medium text-brand-dark mb-1">
                                    Branch Name <span class="text-gray-500 text-xs">(optional)</span>
                                </label>
                                <input type="text" id="branchName"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-(--secondary-color)">
                            </div>
                        </div>

                        <!-- Save & Cancel Buttons -->
                        <div class="flex gap-3 pt-4">
                            <button type="button" onclick="cancelBankEdit()"
                                class="flex-1 py-3.5 text-gray-700 font-medium border border-(--text-color)/20  rounded-2xl hover:bg-gray-50 focus:outline-none focus:border-(--secondary-color)">
                                Cancel
                            </button>
                            <button type="button" onclick="saveBankInfo()"
                                class="flex-1 py-3.5 bg-(--secondary-color) hover:bg-[#B94E31] text-white font-semibold rounded-2xl">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Summary -->
                <div class="bg-(--card-dark)/50 rounded-3xl p-5">
                    <h3 class="font-semibold mb-3">
                        Payout Summary
                    </h3>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span>Requested Amount</span>
                            <span>Rs.5000</span>
                        </div>

                        <div class="flex justify-between">
                            <span>Processing Fee</span>
                            <span>Rs.0</span>
                        </div>
                        <hr>

                        <div class="flex justify-between font-bold">
                            <span>You Receive</span>
                            <span class="text-(--primary-color)">
                                Rs.5000
                            </span>
                        </div>
                    </div>
                </div>


                <!-- Info -->
                <div class="bg-(--secondary-color)/20 rounded-2xl p-4 text-sm">

                    <p class="font-medium text-(--secondary-color)">
                        <i data-lucide="info" class="inline mr-1 w-4 h-4"></i>
                        Payout Information
                    </p>
                    <ul class="list-disc pl-5 mt-2 text-(--secondary-color)">
                        <li>
                            Processed within 1-2 days
                        </li>

                        <li>
                            Email notification will be sent
                        </li>

                    </ul>
                </div>
            </div>


            <!-- Footer -->
            <div class="border-t p-4 grid grid-cols-2 gap-3">
                <button onclick="closePayoutModal()"
                    class="py-3 rounded-2xl border border-(--secondary-color)  hover:bg-gray-50 transition">
                    Cancel
                </button>

                <button onclick="requestPayout()"
                    class="py-3 rounded-2xl bg-(--secondary-color)
                text-white font-semibold hover:bg-[#B94E31]
                transition">
                    Request Payout
                </button>
            </div>
        </div>
    </div>

    <script>
        function openPayoutModal() {
            const modal = document.getElementById('payoutModal');
            modal.classList.remove('hidden');
            modal.classList.add("flex");
            document.getElementById('bankInfoSection').classList.add('hidden');
        }

        function closePayoutModal() {
            const modal = document.getElementById('payoutModal');

            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }

        function toggleBankInfo() {
            document.getElementById('bankInfoSection').classList.toggle('hidden');
        }

        function cancelBankEdit() {
            document.getElementById('bankInfoSection').classList.add('hidden');
        }


        function formatAmount(input) {
            let value = input.value.replace(/[^0-9]/g, '');
            input.value = value;
        }

        function showError(input, message) {
            removeError(input);
            const error = document.createElement("p");
            error.className = "text-red-500 text-xs mt-2 error";
            error.innerText = message;

            input.parentElement.parentElement.appendChild(error);
            input.classList.add("border-red-500");
        }

        function removeError(input) {
            const error = input.closest("div").querySelector(".error");
            if (error) {
                error.remove();
            }
            input.classList.remove("border-red-500");
        }

        function requestPayout() {

            let amount = document.getElementById('payoutAmount');
            let valid = true;
            // amount validation
            if (!amount.value) {
                showError(amount, "Please enter payout amount");
                valid = false;
            } else if (parseFloat(amount.value) < 500) {
                showError(amount, "Minimum payout amount is Rs.500");
                valid = false;
            } else {
                removeError(amount);
            }
            if (!valid) return;

            closePayoutModal();
        }

        function saveBankInfo() {
            let valid = true;
            let fields = [{
                    id: "accName",
                    msg: "Account holder name required"
                },
                {
                    id: "bankName",
                    msg: "Bank name required"
                },
                {
                    id: "accNumber",
                    msg: "Account number required"
                },
                {
                    id: "accType",
                    msg: "Account type required"
                }
            ];
            fields.forEach(field => {
                let input = document.getElementById(field.id);
                if (!input.value.trim()) {
                    showError(input, field.msg);
                    valid = false;
                } else {
                    removeError(input);
                }
            });

            if (!valid) return;
            // success bhaye
            document.getElementById('bankInfoSection').classList.add('hidden');
        }
    </script>
</x-seller_layout>
