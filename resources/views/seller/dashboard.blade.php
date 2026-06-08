<x-seller_layout title="Dashboard" searchPlaceholder="Search orders, products...">
    <div class="space-y-10">

        <!-- Header -->
        <div>
            <h1 class="text-3xl font-bold text-(--primary-color)">Dashboard</h1>
            <p class="text-sm text-(--text-color) mt-1">Welcome back! Here's what's happening with your store today.</p>
        </div>

        <!-- Stats Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Sales Card -->
            <div
                class="card group border-b-4 border-b-(--primary-color) p-6 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <div class="flex justify-between items-start">
                    <!-- Icon -->
                    <div
                        class="w-11 h-11 bg-(--primary-color)/10 rounded-2xl flex items-center justify-center text-(--primary-color) text-3xl group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-chart-line"></i>
                    </div>

                    <!-- Growth -->
                    <div class="text-emerald-600 text-sm font-medium flex items-center gap-1 mt-2">
                        +12.5%
                        <i class="fas fa-arrow-up text-xs"></i>
                    </div>
                </div>

                <!-- Label & Value -->
                <div class="mt-6">
                    <p class="text-sm font-medium text-(--text-color) uppercase tracking-widest">Total Sales</p>
                    <h2 class="text-3xl font-extrabold text-(--text-dark) mt-1 font-sans!">Rs. 4,52,300</h2>
                </div>
            </div>

            <!-- Total Orders -->
            <div
                class="card group border-b-4 border-b-(--primary-color) p-6 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <div class="flex justify-between items-start">
                    <div
                        class="w-11 h-11 bg-(--primary-color)/10 rounded-2xl flex items-center justify-center text-(--text-color) text-3xl
                        group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-shopping-bag"></i>
                    </div>

                    <div class="text-emerald-600 text-sm font-medium flex items-center gap-1 mt-2">
                        +8.2%
                        <i class="fas fa-arrow-up text-xs"></i>
                    </div>
                </div>
                <div class="mt-6">
                    <p class="text-sm font-medium text-(--text-color) uppercase tracking-widest">Total Orders</p>
                    <h2 class="text-3xl font-extrabold text-(--text-dark) mt-1 font-sans!">1,284</h2>
                </div>
            </div>


            <!-- Active Products -->
            <div
                class="card group border-b-4 border-b-(--primary-color) p-6 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <div class="flex justify-between items-start ">
                    <div
                        class="w-11 h-11 rounded-2xl bg-(--card-dark) flex items-center justify-center text-(--secondary-color) text-3xl group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-boxes"></i>
                    </div>
                    <div class="text-sm text-(--text-color) font-medium mt-2">
                        +12
                    </div>
                </div>
                <div class="mt-6">
                    <p class="text-sm font-medium text-(--text-color) uppercase tracking-widest">Active Products</p>
                    <h2 class="text-3xl font-extrabold text-(--text-dark) mt-1 font-sans!">86</h2>
                </div>

            </div>

            <!-- Avg Rating -->
            <div
                class="card group border-b-4 border-b-(--primary-color) p-6 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <div class="flex items-start justify-between">
                    <div
                        class="w-11 h-11 rounded-2xl bg-(--card-dark) flex items-center justify-center text-(--hover-color) text-3xl group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="text-xs flex flex-row items-center gap-1 mt-4 text-(--hover-color)">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fa-solid fa-star-half-stroke"></i>
                    </div>
                </div>
                <div class="mt-6">
                    <p class="text-sm font-medium text-(--text-color) uppercase tracking-widest">Avg Rating</p>
                    <h2 class="text-3xl font-extrabold text-(--text-dark) mt-1 font-sans!">4.82 <span
                            class="text-xl text-(--text-color)/70 font-sans!">/ 5.0</span></h2>
                </div>

            </div>
        </div>

        <!-- Sales Trend & Quick Actions -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Sales Trend Chart -->
            <div class="card-dark lg:col-span-2 rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-300">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-semibold text-(--text-color)">Sales Trend</h3>
                    <select
                        class="text-sm bg-transparent border border-(--text-color)/20 rounded-xl px-4 py-2 text-(--text-color) focus:outline-none focus:ring-2 focus:ring-(--primary-color)/30 transition">
                        <option>This Week</option>
                        <option>This Month</option>
                        <option>This Year</option>
                    </select>
                </div>

                <div class="flex items-end justify-between gap-4 h-52">
                    <div class="flex-1 flex flex-col items-center gap-2 group cursor-pointer">
                        <div class="chart-bar w-full bg-(--text-light) rounded-t-xl hover:bg-(--primary-color) transition-all duration-300 group-hover:scale-y-110 origin-bottom"
                            style="height: 72px;"></div>
                        <span
                            class="text-sm font-medium text-(--text-color)/70 group-hover:text-(--text-dark)">Mon</span>
                    </div>
                    <div class="flex-1 flex flex-col items-center gap-2 group cursor-pointer">
                        <div class="chart-bar w-full bg-(--text-light) rounded-t-xl hover:bg-(--secondary-color) transition-all duration-300 group-hover:scale-y-110 origin-bottom"
                            style="height: 96px;"></div>
                        <span
                            class="text-sm font-medium text-(--text-color)/70 group-hover:text-(--text-dark)">Tue</span>
                    </div>
                    <div class="flex-1 flex flex-col items-center gap-2 group cursor-pointer">
                        <div class="chart-bar w-full bg-(--text-light) rounded-t-xl hover:bg-(--primary-color) transition-all duration-300 group-hover:scale-y-110 origin-bottom"
                            style="height: 64px;"></div>
                        <span
                            class="text-sm font-medium text-(--text-color)/70 group-hover:text-(--text-dark)">Wed</span>
                    </div>
                    <div class="flex-1 flex flex-col items-center gap-2 group cursor-pointer">
                        <div class="chart-bar w-full bg-(--text-light) rounded-t-xl hover:bg-(--secondary-color) transition-all duration-300 group-hover:scale-y-110 origin-bottom"
                            style="height: 112px;"></div>
                        <span
                            class="text-sm font-medium text-(--text-color)/70 group-hover:text-(--text-dark)">Thu</span>
                    </div>
                    <div class="flex-1 flex flex-col items-center gap-2 group cursor-pointer">
                        <div class="chart-bar w-full bg-(--text-light) rounded-t-xl hover:bg-(--primary-color) transition-all duration-300 group-hover:scale-y-110 origin-bottom"
                            style="height: 88px;"></div>
                        <span
                            class="text-sm font-medium text-(--text-color)/70 group-hover:text-(--text-dark)">Fri</span>
                    </div>
                    <div class="flex-1 flex flex-col items-center gap-2 group cursor-pointer">
                        <div class="chart-bar w-full bg-(--text-light) rounded-t-xl hover:bg-(--secondary-color) transition-all duration-300 group-hover:scale-y-110 origin-bottom"
                            style="height: 104px;"></div>
                        <span
                            class="text-sm font-medium text-(--text-color)/70 group-hover:text-(--text-dark)">Sat</span>
                    </div>
                    <div class="flex-1 flex flex-col items-center gap-2 group cursor-pointer">
                        <div class="chart-bar w-full bg-(--text-light) rounded-t-xl hover:bg-(--primary-color) transition-all duration-300 group-hover:scale-y-110 origin-bottom"
                            style="height: 128px;"></div>
                        <span
                            class="text-sm font-medium text-(--text-color)/70 group-hover:text-(--text-dark)">Sun</span>
                    </div>
                </div>

                <div class="mt-5 text-center text-xs text-(--text-color)/50 flex items-center justify-center gap-2">
                    <i class="fas fa-chart-simple"></i> Last 7 days performance
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card-dark p-6 shadow-sm hover:shadow-md transition-all duration-300">
                <h3 class="text-xl font-semibold text-(--text-color) mb-5">Quick Actions</h3>
                <div class="space-y-4">
                    <a href="#"
                        class="flex items-center gap-4 p-4 rounded-2xl bg-(--card-dark)/40 hover:bg-(--card-dark)/70 transition-all duration-300 group">
                        <div
                            class="w-11 h-11 rounded-2xl bg-(--card-dark) flex items-center justify-center text-(--secondary-color) text-2xl group-hover:scale-110 transition-transform">
                            <i class="fas fa-plus-circle"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-(--text-dark) group-hover:translate-x-1 transition">Add New
                                Product</p>
                            <p class="text-sm text-(--text-color)">List a new item in your catalog</p>
                        </div>
                    </a>

                    <a href="#"
                        class="flex items-center gap-4 p-4 rounded-2xl bg-(--card-dark)/40 hover:bg-(--card-dark)/70 transition-all duration-300 group">
                        <div
                            class="w-11 h-11 rounded-2xl bg-(--card-dark) flex items-center justify-center text-(--secondary-color) text-2xl group-hover:scale-110 transition-transform">
                            <i class="fas fa-headset"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-(--text-dark) group-hover:translate-x-1 transition">Contact
                                Support</p>
                            <p class="text-sm text-(--text-color)">Need help with your store?</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="card bg-(--card-bg) rounded-2xl shadow-sm border border-(--card-dark) overflow-hidden">
            <div class="px-6 py-5 border-b border-(--card-dark) flex justify-between items-center">
                <h3 class="font-semibold text-(--text-color) flex items-center gap-2">
                    <i class="fas fa-history"></i>
                    Recent Orders
                </h3>
                <a href="#"
                    class="text-sm text-(--secondary-color) hover:text-(--hover-color) flex items-center gap-1.5 transition">
                    View All
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full min-w-212.5 table-auto">
                    <thead class="bg-(--card-dark)">
                        <tr class="text-xs uppercase tracking-widest font-medium text-(--text-color)/70">
                            <th class="px-6 py-4 text-left">Order ID</th>
                            <th class="px-6 py-4 text-left">Customer</th>
                            <th class="px-6 py-4 text-left">Date</th>
                            <th class="px-6 py-4 text-left">Total</th>
                            <th class="px-6 py-4 text-left">Status</th>
                            <th class="px-6 py-4 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-(--card-dark)/50 text-sm">

                        <!-- Row 1 -->
                        <tr class="hover:bg-(--card-dark)/10 transition-all duration-200 cursor-pointer">
                            <td class="px-6 py-5 whitespace-nowrap font-medium text-(--text-color)">HK-29401</td>
                            <td class="px-6 py-5 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-full bg-(--card-dark) flex items-center justify-center text-xs font-bold">
                                        <i class="fas fa-user text-(--text-color)"></i>
                                    </div>
                                    Sujit Nepal
                                </div>
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap text-(--text-color)">Oct 24, 2023</td>
                            <td class="px-6 py-5 whitespace-nowrap font-medium text-(--text-color)">Rs. 12,450</td>
                            <td class="px-6 py-5">
                                <span
                                    class="px-4 py-1.5 text-xs font-medium rounded-full bg-(--hover-color)/50 text-(--secondary-color)">Pending</span>
                            </td>
                            <td class="px-6 py-5">
                                <button
                                    class="text-(--secondary-color) hover:text-(--hover-color) transition flex items-center gap-1">
                                    <i class="fas fa-edit"></i> Update
                                </button>
                            </td>
                        </tr>

                        <!-- Row 2 -->
                        <tr class="hover:bg-(--card-dark)/10 transition-all duration-200 cursor-pointer">
                            <td class="px-6 py-5 whitespace-nowrap font-medium text-(--text-color)">HK-29398</td>
                            <td class="px-6 py-5 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-full bg-(--card-dark) flex items-center justify-center text-xs font-bold">
                                        <i class="fas fa-user text-(--text-color)"></i>
                                    </div>
                                    Anita Dahal
                                </div>
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap text-(--text-color)">Oct 23, 2023</td>
                            <td class="px-6 py-5 whitespace-nowrap font-medium text-(--text-color)">Rs. 8,200</td>
                            <td class="px-6 py-5">
                                <span
                                    class="px-4 py-1.5 text-xs font-medium rounded-full bg-(--secondary-color)/50 text-(--text-dark)">Shipped</span>
                            </td>
                            <td class="px-6 py-5">
                                <button
                                    class="text-(--secondary-color) hover:text-(--hover-color) transition flex items-center gap-1">
                                    <i class="fas fa-edit"></i> Update
                                </button>
                            </td>
                        </tr>

                        <!-- Row 3 -->
                        <tr class="hover:bg-(--card-dark)/10 transition-all duration-200 cursor-pointer">
                            <td class="px-6 py-5 whitespace-nowrap font-medium text-(--text-color)">HK-29395</td>
                            <td class="px-6 py-5 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-full bg-(--card-dark) flex items-center justify-center text-xs font-bold">
                                        <i class="fas fa-user text-(--text-color)"></i>
                                    </div>
                                    Bishal Thapa
                                </div>
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap text-(--text-color)">Oct 23, 2023</td>
                            <td class="px-6 py-5 whitespace-nowrap font-medium text-(--text-color)">Rs. 15,000</td>
                            <td class="px-6 py-5">
                                <span
                                    class="px-4 py-1.5 text-xs font-medium rounded-full bg-(--card-dark) text-(--primary-color)/85">Delivered</span>
                            </td>
                            <td class="px-6 py-5">
                                <button
                                    class="text-(--secondary-color) hover:text-(--hover-color) transition flex items-center gap-1">
                                    <i class="fas fa-eye"></i> View
                                </button>
                            </td>
                        </tr>

                        <!-- Row 4 -->
                        <tr class="hover:bg-(--card-dark)/10 transition-all duration-200 cursor-pointer">
                            <td class="px-6 py-5 whitespace-nowrap font-medium text-(--text-color)">HK-29392</td>
                            <td class="px-6 py-5 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-full bg-(--card-dark) flex items-center justify-center text-xs font-bold">
                                        <i class="fas fa-user text-(--text-color)"></i>
                                    </div>
                                    Rita Poudel
                                </div>
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap text-(--text-color)">Oct 22, 2023</td>
                            <td class="px-6 py-5 whitespace-nowrap font-medium text-(--text-color)">Rs. 4,500</td>
                            <td class="px-6 py-5">
                                <span
                                    class="px-4 py-1.5 text-xs font-medium rounded-full bg-(--card-dark) text-(--primary-color)/85">Delivered</span>
                            </td>
                            <td class="px-6 py-5">
                                <button
                                    class="text-(--secondary-color) hover:text-(--hover-color) transition flex items-center gap-1">
                                    <i class="fas fa-eye"></i> View
                                </button>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-seller_layout>
