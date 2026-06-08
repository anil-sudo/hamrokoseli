<x-seller_layout>
    <main>
        <!-- Page Header -->
        <div class="flex justify-between items-start mb-6">

            <div>
                <h1 class="text-4xl font-bold text-(--primary-color)">
                    Product Management
                </h1>

                <p class="text-base text-(--primary-color) mt-1">
                    Manage your catalog, stock levels, and pricing from one place.
                </p>
            </div>

            <button
                class="bg-(--secondary-color) text-(--text-light) px-6 py-3 rounded-lg text-sm font-semibold flex items-center gap-2">
                +Add New Product
            </button>

        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-4 gap-5 mb-6">

            <div class="bg-(--card-bg) rounded-xl p-5 shadow-sm">

                <p class="text-sm font-medium text-(--text-dark)">
                    Total Products
                </p>

                <div class="flex justify-between items-center mt-2">
                    <h2 class="text-4xl font-extrabold text-(--text-color) font-sans!">
                        1,248
                    </h2>

                    <span class="bg-blue-100 text-blue-600 text-xs px-3 py-1 rounded-full">
                        +12%
                    </span>
                </div>
            </div>

            <div class="bg-(--card-bg) rounded-xl p-5 shadow-sm">

                <p class="text-sm font-medium text-(--text-dark)">
                    Active Listings
                </p>

                <div class="flex justify-between items-center mt-2">
                    <h2 class="text-4xl font-extrabold text-(--text-color) font-sans!">
                        1,102
                    </h2>

                    <span class="bg-orange-100 text-orange-600 text-xs px-3 py-1 rounded-full">
                        Stable
                    </span>
                </div>
            </div>

            <div class="bg-(--card-bg) rounded-xl p-5 shadow-sm">
                <p class="text-sm font-medium text-(--text-dark)">
                    Out of Stock
                </p>

                <div class="flex justify-between items-center mt-2">
                    <h2 class="text-4xl font-extrabold text-(--text-color) font-sans!">
                        14
                    </h2>

                    <span class="bg-red-100 text-red-500 text-xs px-3 py-1 rounded-full">
                        -3
                    </span>
                </div>
            </div>

            <div class="bg-(--card-bg) rounded-xl p-5 shadow-sm">
                <p class="text-sm font-medium text-(--text-dark)">
                    Avg. Rating
                </p>

                <div class="flex justify-between items-center mt-2">
                    <h2 class="text-4xl font-extrabold text-(--text-color) font-sans!">
                        4.8
                    </h2>

                    <span class="text-yellow-500">
                        ★★★★★
                    </span>
                </div>
            </div>

        </div>

        <!-- Product Table Card -->
        <div class="bg-(--card-bg) rounded-xl overflow-hidden shadow-sm">

            <!-- Filters -->
            <div class="p-5 flex justify-between border-b">

                <div class="flex gap-3">

                    <select class="border border-(--text-color) rounded-lg px-4 py-2 text-sm">
                        <option>All Categories</option>
                    </select>

                    <select class="border  border-(--text-color) rounded-lg px-4 py-2 text-sm">
                        <option>Stock Status</option>
                    </select>

                </div>

                <button class="border px-4 py-2 rounded-lg text-sm font-medium">
                    More Filters
                </button>

            </div>

            <!-- Table -->
            <table class="w-full">

                <thead class="bg-(--bg-color)">

                    <tr class="text-xs font-semibold text-(--text-color) uppercase">

                        <th class="p-4">Image</th>
                        <th class="p-4 text-left">Product Name</th>
                        <th class="p-4">Category</th>
                        <th class="p-4">Price</th>
                        <th class="p-4">Stock Status</th>
                        <th class="p-4">Actions</th>

                    </tr>

                </thead>

                <tbody>

                    <tr class="border-b">

                        <td class="p-4">
                            <div class="flex items-center justify-center">
                                <img src="https://picsum.photos/60" class="w-14 h-14 rounded" />
                            </div>
                        </td>

                        <td class="p-4">
                            <h3 class="text-lg font-semibold">
                                Hand-woven Pashmina Shawl
                            </h3>

                            <p class="text-sm text-gray-500">
                                SKU: HK-PS-001
                            </p>
                        </td>

                        <td>
                            <div class="flex items-center justify-center">
                                <span class=" bg-gray-100 px-3 py-1 rounded-full text-sm ">
                                    Textiles
                                </span>
                            </div>
                        </td>

                        <td class="text-3xl font-bold text-(--text-color)">
                            <div class="flex items-center justify-center">
                                Rs. 12,500
                            </div>
                        </td>

                        <td>
                            <div class="flex items-center justify-center">
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs">
                                    In Stock (42)
                                </span>
                            </div>
                        </td>

                        <td class="space-x-3">
                            <div class="flex items-center justify-center gap-4">
                                <i class="fa-solid fa-pen text-(--secondary-color)"></i> <i
                                    class="fa-solid fa-trash text-(--secondary-color)"></i>
                            </div>
                        </td>

                    </tr>

                </tbody>

            </table>

            <!-- Pagination -->
            <div class="p-5 flex justify-between items-center">

                <p class="text-sm text-gray-500">
                    Showing 1 to 4 of 1,248 products
                </p>

                <div class="flex gap-2">

                    <button class="w-10 h-10 border rounded">
                        ‹
                    </button>

                    <button class="w-10 h-10 bg-(--secondary-color) text-(--text-light) rounded">
                        1
                    </button>

                    <button class="w-10 h-10 border rounded">
                        2
                    </button>

                    <button class="w-10 h-10 border rounded">
                        3
                    </button>

                    <button class="w-10 h-10 border rounded">
                        ›
                    </button>

                </div>

            </div>

        </div>

    </main>
</x-seller_layout>
