<x-seller_layout title="Dashboard" searchPlaceholder="Search orders, products...">
    <div>
        <div>
            <h1 class="text-2xl font-bold text-(--primary-color)">Dashboard</h1>
            <p class="text-sm text-(--text-color) mt-0.5">Welcome back! Here's what's happening with your
                store today.</p>
        </div>
        <!-- Stats Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mt-8">
            <!-- Total Sales -->
            <div class="card group hover:shadow-md transition  border-b-3 border-b-(--primary-color)">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-(--text-color) uppercase tracking-wide">Total Sales
                        </p>
                        <h2 class="text-3xl font-bold text-(--text-dark) mt-1">Rs. 4,52,300</h2>
                        <p class="text-xs text-(--secondary-color) mt-2"><i class="fas fa-arrow-up"></i> +12.5%
                            from
                            last month</p>
                    </div>
                    <div
                        class="w-12 h-12 rounded-full bg-(--card-dark) flex items-center justify-center text-(--secondary-color) text-xl">
                        <i class="fas fa-chart-line"></i>
                    </div>
                </div>
            </div>

            <!-- Total Orders -->
            <div class="card group hover:shadow-md transition border-b-3 border-b-(--primary-color)">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-(--text-color) uppercase tracking-wide">Total
                            Orders</p>
                        <h2 class="text-3xl font-bold  text-(--text-dark) mt-1">1,284</h2>
                        <p class="text-xs text-(--secondary-color) mt-2"><i class="fas fa-arrow-up"></i> +8.2%
                            from
                            last month</p>
                    </div>
                    <div
                        class="w-12 h-12 rounded-full bg-(--card-dark) flex items-center justify-center text-(--text-color) text-xl">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                </div>
            </div>

            <!-- Active Products -->
            <div class="card group hover:shadow-md transition border-b-3 border-b-(--primary-color)">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-(--text-color) uppercase tracking-wide">Active
                            Products</p>
                        <h2 class="text-3xl font-bold  text-(--text-dark) mt-1">86</h2>
                        <p class="text-xs text-[#3A2A1F]/50 mt-2">+12 this week</p>
                    </div>
                    <div
                        class="w-12 h-12 rounded-full bg-(--card-dark) flex items-center justify-center text-(--secondary-color) text-xl">
                        <i class="fas fa-boxes"></i>
                    </div>
                </div>
            </div>

            <!-- Avg Rating -->
            <div class="card group hover:shadow-md transition border-b-3 border-b-(--primary-color)">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-(--text-color) uppercase tracking-wide">Avg Rating
                        </p>
                        <h2 class="text-3xl font-bold  text-(--text-dark) mt-1">4.82 <span
                                class="text-lg text-[#3A2A1F]/50">/ 5.0</span></h2>
                        <p class="text-xs text-(--hover-color) mt-2"><i class="fas fa-star"></i> Excellent
                            feedback</p>
                    </div>
                    <div
                        class="w-12 h-12 rounded-full bg-(--card-dark) flex items-center justify-center text-(--hover-color) text-xl">
                        <i class="fas fa-star"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sales Trend & Quick Actions Row -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8 mt-10">
            <!-- Sales Trend Chart (static design) -->
            <div class="card-dark lg:col-span-2">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-semibold  text-(--text-dark)">Sales Trend</h3>
                    <select
                        class="text-sm bg-transparent border border-[#1F3D2E]/20 rounded-lg px-3 py-1.5 text-(--text-color) focus:outline-none focus:ring-1 focus:ring-[#C65A3A]">
                        <option>This Week</option>
                        <option>This Month</option>
                        <option>This Year</option>
                    </select>
                </div>
                <div class="flex items-end justify-between gap-3 h-48">
                    <!-- Mon -->
                    <div class="flex-1 flex flex-col items-center gap-2">
                        <div class="chart-bar w-full bg-[#C65A3A]/80 rounded-t-lg"
                            style="height: 72px; max-height: 160px;"></div>
                        <span class="text-sm font-medium text-[#3A2A1F]/70">Mon</span>
                    </div>
                    <!-- Tue -->
                    <div class="flex-1 flex flex-col items-center gap-2">
                        <div class="chart-bar w-full bg-[#C65A3A]/80 rounded-t-lg" style="height: 96px;">
                        </div>
                        <span class="text-sm font-medium text-[#3A2A1F]/70">Tue</span>
                    </div>
                    <!-- Wed -->
                    <div class="flex-1 flex flex-col items-center gap-2">
                        <div class="chart-bar w-full bg-[#C65A3A]/80 rounded-t-lg" style="height: 64px;">
                        </div>
                        <span class="text-sm font-medium text-[#3A2A1F]/70">Wed</span>
                    </div>
                    <!-- Thu -->
                    <div class="flex-1 flex flex-col items-center gap-2">
                        <div class="chart-bar w-full bg-[#D4A017]/80 rounded-t-lg" style="height: 112px;">
                        </div>
                        <span class="text-sm font-medium text-[#3A2A1F]/70">Thu</span>
                    </div>
                    <!-- Fri -->
                    <div class="flex-1 flex flex-col items-center gap-2">
                        <div class="chart-bar w-full bg-[#C65A3A]/80 rounded-t-lg" style="height: 88px;">
                        </div>
                        <span class="text-sm font-medium text-[#3A2A1F]/70">Fri</span>
                    </div>
                    <!-- Sat -->
                    <div class="flex-1 flex flex-col items-center gap-2">
                        <div class="chart-bar w-full bg-[#C65A3A]/80 rounded-t-lg" style="height: 104px;">
                        </div>
                        <span class="text-sm font-medium text-[#3A2A1F]/70">Sat</span>
                    </div>
                    <!-- Sun -->
                    <div class="flex-1 flex flex-col items-center gap-2">
                        <div class="chart-bar w-full bg-[#D4A017]/80 rounded-t-lg" style="height: 128px;">
                        </div>
                        <span class="text-sm font-medium text-[#3A2A1F]/70">Sun</span>
                    </div>
                </div>
                <div class="mt-4 text-center text-xs text-[#3A2A1F]/50">
                    <i class="fas fa-chart-simple"></i> Last 7 days performance
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card-dark">
                <h3 class="text-xl font-semibold text-[#1F3D2E] mb-4">Quick Actions</h3>
                <div class="space-y-3">
                    <a href="#"
                        class=" card flex items-center gap-4 p-4 rounded-xl bg-[#1F3D2E]/5 hover:bg-[#1F3D2E]/10 transition group">
                        <div
                            class="w-10 h-10 rounded-full bg-(--card-dark) flex items-center justify-center text-(--secondary-color) group-hover:scale-105 transition">
                            <i class="fas fa-plus-circle text-lg"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-(--text-dark)">Add New Product</p>
                            <p class="text-xs text-(--text-color)">List a new item in your catalog</p>
                        </div>
                    </a>
                    <a href="#"
                        class=" card flex items-center gap-4 p-4 rounded-xl bg-[#1F3D2E]/5 hover:bg-[#1F3D2E]/10 transition group">
                        <div
                            class="w-10 h-10 rounded-full bg-(--card-dark) flex items-center justify-center text-(--secondary-color) group-hover:scale-105 transition">
                            <i class="fas fa-headset text-lg"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-(--text-dark)">Contact Support</p>
                            <p class="text-xs text-(--text-color)">Need help with your store?</p>
                        </div>
                    </a>

                </div>
            </div>
        </div>
        {{-- Recent Orders Table --}}
        <div class=" card bg-(--card-bg) rounded-xl shadow-sm border border-(--card-dark) overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                <h3 class="font-semibold text-(--text-color)">
                    <i class="fas fa-history text-(--text-dark) mr-2"></i>
                    Recent Orders
                </h3>
                <a href="#" class="text-sm text-(--secondary-color) hover:text-(--secondary-color)-800">
                    View All <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            <div class="overflow-x-auto w-full">
                <table class="w-full min-w-175 ">
                    <thead class="bg-(--card-dark)">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-(--text-color)  uppercase tracking-wider">
                                ORDER ID</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-(--text-color)  uppercase tracking-wider">
                                CUSTOMER</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-(--text-color)  uppercase tracking-wider">
                                DATE</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-(--text-color)  uppercase tracking-wider">
                                TOTAL</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-(--text-color)  uppercase tracking-wider">
                                STATUS</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-(--text-color)  uppercase tracking-wider">
                                ACTION</th>
                        </tr>
                    </thead>
                    <tbody class="card">
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-(--text-color)">
                                <i class="fas fa-hashtag text-(--text-dark) text-xs"></i> HK-29401
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-(--text-dark)">
                                <div class="flex items-center">
                                    <span
                                        class="w-7 h-7 rounded-full bg-(--card-dark) flex items-center justify-center text-xs font-bold mr-2">
                                        <i class="fas fa-user text-(--text-color) text-xs"></i>
                                    </span>
                                    Sujit Nepal
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-(--text-dark)">
                                <i class="far fa-calendar-alt text-(--text-dark) mr-1"></i> Oct 24, 2023
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-(--text-color)">
                                <i class="fas fa-rupee-sign text-(--text-dark) text-xs"></i> 12,450
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 py-1 text-xs rounded-full bg-(--hover-color)/55 text-(--text-dark) font-semi-bold">
                                    <i class="fas fa-hourglass-half mr-1"></i> Pending
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <button class="text-(--secondary-color) hover:text-(--hover-color)">
                                    <i class="fas fa-edit"></i> Update
                                </button>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-(--text-color)">
                                <i class="fas fa-hashtag text-(--text-dark) text-xs"></i> HK-29398
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-(--text-dark)">
                                <div class="flex items-center">
                                    <span
                                        class="w-7 h-7 rounded-full bg-(--card-dark) flex items-center justify-center text-xs font-bold mr-2">
                                        <i class="fas fa-user text-(--text-color) text-xs"></i>
                                    </span>
                                    Anita Dahal
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-(--text-dark)">
                                <i class="far fa-calendar-alt text-(--text-dark) mr-1"></i> Oct 23, 2023
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-(--text-color)">
                                <i class="fas fa-rupee-sign text-(--text-dark) text-xs"></i> 8,200
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 py-1 text-xs  rounded-full bg-(--secondary-color)/70 text-(--text-dark) font-medium">
                                    <i class="fas fa-hourglass-half mr-1"></i> Shipped
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <button class="text-(--secondary-color) hover:text-(--hover-color)">
                                    <i class="fas fa-edit"></i> Update
                                </button>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-(--text-color)">
                                <i class="fas fa-hashtag text-(--text-dark) text-xs"></i> HK-29395
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-(--text-dark)">
                                <div class="flex items-center">
                                    <span
                                        class="w-7 h-7 rounded-full bg-(--card-dark) flex items-center justify-center text-xs font-bold mr-2">
                                        <i class="fas fa-user text-(--text-color) text-xs"></i>
                                    </span>
                                    Bishal Thapa
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-(--text-dark)">
                                <i class="far fa-calendar-alt text-(--text-dark) mr-1"></i> Oct 23, 2023
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-(--text-color)">
                                <i class="fas fa-rupee-sign text-(--text-dark) text-xs"></i> 15,000
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs rounded-full bg-(--card-dark) text-(--primary-coor)">
                                    <i class="fas fa-check-circle mr-1"></i>Delivered
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <button class="text-(--secondary-color) hover:text-(--hover-color)">
                                    <i class="fas fa-eye"></i> view
                                </button>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-(--text-color)">
                                <i class="fas fa-hashtag text-(--text-dark) text-xs"></i> HK-29392
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-(--text-dark)">
                                <div class="flex items-center">
                                    <span
                                        class="w-7 h-7 rounded-full bg-(--card-dark) flex items-center justify-center text-xs font-bold mr-2">
                                        <i class="fas fa-user text-(--text-color) text-xs"></i>
                                    </span>
                                    Rita Poudel
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-(--text-dark)">
                                <i class="far fa-calendar-alt text-(--text-dark) mr-1"></i> Oct 22, 2023
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-(--text-color)">
                                <i class="fas fa-rupee-sign text-(--text-dark) text-xs"></i> 4,500
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs rounded-full bg-(--card-dark) text-(--primary-coor)">
                                    <i class="fas fa-check-circle mr-1"></i> Delivered
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <button class="text-(--secondary-color) hover:text-(--hover-color)">
                                    <i class="fas fa-eye"></i> view
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Footer spacer -->
            <div class="h-6"></div>
        </div>

    </div>

</x-seller_layout>
