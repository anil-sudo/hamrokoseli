<x-seller_layout title="Dashboard" searchPlaceholder="Search orders, products...">
    <div class="space-y-10">

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between items-start gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-bold text-(--text-color)">Product Management</h1>
                <p class="text-sm text-(--text-color) mt-1">Manage your catalog, stock levels, and pricing from one
                    place.</p>
            </div>

            <a href="{{ route('product-create') }}"
                class="inline-flex items-center justify-center gap-2 px-4 py-3 sm:px-5 sm:py-2.5 bg-(--secondary-color)/95 text-(--text-light)/95 rounded-2xl text-sm font-medium hover:bg-(--secondary-color) hover:shadow-lg active:scale-95 transition-all duration-200 shadow-md">
                <i data-lucide="plus" class="w-5 h-5"></i>
                Add New Product
            </a>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <div
                class=" bg-(--card-bg) border border-gray-200 rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-300">
                <p class="text-sm font-medium text-(--text-color) uppercase tracking-widest mt-3">
                    Total Products
                </p>
                <p class="text-3xl font-extrabold text-(--text-dark) mt-2.5 font-sans"> 1,248 </p>
            </div>
            <div
                class=" bg-(--card-bg) border border-gray-200 rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-300">
                <p class="text-sm font-medium text-(--text-color) uppercase tracking-widest mt-3">
                    Active Listings
                </p>
                <p class="text-3xl font-extrabold text-(--text-dark) mt-2.5 font-sans">1,102</p>
            </div>

            <div
                class=" bg-(--card-bg) border border-gray-200 rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-300">
                <p class="text-sm font-medium text-(--text-color) uppercase tracking-widest mt-3">
                    Out of Stock
                </p>
                <p class="text-3xl font-extrabold text-(--text-dark) mt-2.5 font-sans">14</p>
            </div>

            <div
                class=" bg-(--card-bg) border border-gray-200 rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-300">
                <p class="text-sm font-medium text-(--text-color) uppercase tracking-widest mt-3">
                    Avg. Rating
                </p>
                <p class="text-3xl font-extrabold text-(--text-dark) mt-2.5 font-sans">4.8</p>
                <div class="text-xs flex flex-row items-center gap-1 mt-4 text-(--hover-color)">
                    <i data-lucide="star" class="w-4 h-4 fill-current text-(--hover-color)"></i>
                    <i data-lucide="star" class="w-4 h-4 fill-current text-(--hover-color)"></i>
                    <i data-lucide="star" class="w-4 h-4 fill-current text-(--hover-color)"></i>
                    <i data-lucide="star" class="w-4 h-4 fill-current text-(--hover-color)"></i>
                    <i data-lucide="star" class="w-4 h-4"></i>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div
            class="bg-(--card-bg)/60 rounded-3xl shadow-sm hover:shadow-md border border-(--text-color)/20 p-4 md:p-6  transition-all duration-300">
            <div class="flex flex-col md:flex-row gap-4 items-center">
                <div class="flex-1 flex flex-col md:flex-row gap-4">
                    <select
                        class="bg-(--card-bg) border border-(--text-color)/20 rounded-2xl px-5 py-3 focus:outline-none focus:border-(--secondary-color) w-full md:w-56 text-base transition-all">
                        <option>All Categories</option>
                        <option>Textiles</option>
                        <option>Spices</option>
                        <option>Handicrafts</option>
                        <option>Fashion</option>
                    </select>

                    <select
                        class="bg-(--card-bg) border border-(--text-color)/20 rounded-2xl px-5 py-3 focus:outline-none focus:border-(--secondary-color) w-full md:w-56 text-base transition-all">
                        <option>Stock Status</option>
                        <option>In Stock</option>
                        <option>Low Stock</option>
                        <option>Out of Stock</option>
                    </select>
                </div>

            </div>
        </div>

        <!-- Products Table -->
        <div
            class="bg-(--card-bg) rounded-2xl shadow-sm border border-(--text-color)/20 overflow-hidden transition-all duration-300 hover:shadow-md">

            <div class="responsive-table-wrapper overflow-x-auto">
                <table class="w-full min-w-full">
                    <thead>
                        <tr class="bg-(--card-dark) border-b">
                            <th
                                class="text-left py-4 px-4 md:px-6 lg:px-8 text-sm font-semibold text-(--text-color) uppercase tracking-wider">
                                IMAGE</th>
                            <th
                                class="text-left py-4 px-4 md:px-6 lg:px-8 text-sm font-semibold text-(--text-color) uppercase tracking-wider">
                                PRODUCT NAME</th>
                            <th
                                class="text-left py-4 px-4 md:px-6 lg:px-8 text-sm font-semibold text-(--text-color) uppercase tracking-wider">
                                CATEGORY</th>
                            <th
                                class="text-left py-4 px-4 md:px-6 lg:px-8 text-sm font-semibold text-(--text-color) uppercase tracking-wider">
                                PRICE</th>
                            <th
                                class="text-left py-4 px-4 md:px-6 lg:px-8 text-sm font-semibold text-(--text-color) uppercase tracking-wider">
                                STOCK STATUS</th>
                            <th
                                class="text-left py-4 px-4 md:px-6 lg:px-8 text-sm font-semibold text-(--text-color) uppercase tracking-wider">
                                ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-(--text-color)/10 text-sm">
                        <!-- Product Row 1 -->
                        <tr class="hover:bg-(--card-dark)/10 transition-all duration-200 cursor-pointer">
                            <td class="px-4 py-4 lg:p-8">
                                <img src="https://picsum.photos/id/1015/80/80"
                                    class="w-14 h-14 object-cover rounded-2xl" alt="">
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-semibold">Hand-woven Pashmina Shawl</p>
                                <p class="text-xs (--text-dark)/70">SKU: HK-PS-001</p>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-4 py-1 bg-(--text-dark)/20 text-(--text-dark) text-xs rounded-full">Textiles</span>
                            </td>
                            <td class="px-6 py-4 text-right font-semibold">Rs.12,500</td>
                            <td class="px-6 py-4 text-center">
                                <span
                                    class="inline-flex items-center gap-1.5 px-4 py-1 bg-(--card-dark) text-(--primary-color)/85 text-xs font-medium rounded-2xl">
                                    <i data-lucide="circle" class="w-3 h-3 fill-current"></i>
                                    In Stock (42)
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-4">
                                    <a href="{{ route('product-edit') }}"
                                        class="text-(--text-color)/70 hover:text-(--hover-color) transition">
                                        <i data-lucide="edit" class="w-5 h-5"></i>
                                    </a>
                                    <a href=""
                                        class="text-(--text-color)/70 hover:text-(--secondary-color) transition">
                                        <i data-lucide="trash-2" class="w-5 h-5"></i>
                                </a>
                                </div>
                            </td>
                        </tr>

                        <!-- Product Row 2 -->
                        <tr class="hover:bg-(--card-dark)/10 transition-all duration-200 cursor-pointer">
                            <td class="px-4 py-4 lg:p-8">
                                <img src="https://picsum.photos/id/201/80/80" class="w-14 h-14 object-cover rounded-2xl"
                                    alt="">
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-semibold">Himalayan Organic Turmeric</p>
                                <p class="text-xs (--text-dark)/70">SKU: HK-SP-024</p>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-4 py-1 bg-(--text-dark)/20 text-(--text-dark) text-xs rounded-full">Spices</span>
                            </td>
                            <td class="px-6 py-4 text-right font-semibold">Rs.850</td>
                            <td class="px-6 py-4 text-center">
                                <span
                                    class="inline-flex items-center gap-1.5 px-4 py-1 bg-(--hover-color)/50 text-(--secondary-color) text-xs font-medium rounded-2xl">
                                    Low Stock (5)
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-4">
                                    <a href="{{ route('product-edit') }}"
                                        class="text-(--text-color)/70 hover:text-(--hover-color) transition">
                                        <i data-lucide="edit" class="w-5 h-5"></i>
                                    </a>
                                    <a href=""
                                        class="text-(--text-color)/70 hover:text-(--secondary-color) transition">
                                        <i data-lucide="trash-2" class="w-5 h-5"></i>
                                </a>
                                </div>
                            </td>
                        </tr>

                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-5 bg-(--card-dark) border-t flex items-center justify-between text-sm">
                <p class="text-(text-color)">Showing 1 to 4 of 1,248 products</p>
                <div class="flex items-center gap-1">
                    <button
                        class="px-4 py-2 border border-(text-color) hover:bg-(--primary-color) hover:text-(--text-light) rounded-xl transition">‹</button>
                    <button
                        class="px-4 py-2 border border-(text-color) hover:bg-(--primary-color) hover:text-(--text-light) rounded-xl transition">1</button>
                    <button
                        class="px-4 py-2 border border-(text-color) hover:bg-(--primary-color) hover:text-(--text-light) rounded-xl transition">2</button>
                    <button
                        class="px-4 py-2 border border-(text-color) hover:bg-(--primary-color) hover:text-(--text-light) rounded-xl transition">3</button>
                    <span class="px-3">...</span>
                    <button
                        class="px-4 py-2 border border-(text-color) hover:bg-(--primary-color) hover:text-(--text-light) rounded-xl transition">312</button>
                    <button
                        class="px-4 py-2 border border-(text-color) hover:bg-(--primary-color) hover:text-(--text-light) rounded-xl transition">›</button>
                </div>
            </div>
        </div>
    </div>
</x-seller_layout>
