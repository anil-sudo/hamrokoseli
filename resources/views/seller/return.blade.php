<x-seller_layout title="All Returns">

    <div class="space-y-8">

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold text-(--text-color)">All Return Requests</h1>
                <p class="text-sm text-(--text-color)/60 mt-1">Manage customer return requests</p>
            </div>

            <div class="flex items-center gap-3">
                <select
                    class="border border-(--text-color)/20 bg-(--card-bg) rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-(--secondary-color)">
                    <option value="">All Status</option>
                    <option value="pending">Pending</option>
                    <option value="approved">Approved</option>
                    <option value="rejected">Rejected</option>
                </select>

                <input type="text" placeholder="Search by Order ID or Customer..."
                    class="border border-(--text-color)/20 bg-(--card-bg) rounded-xl px-4 py-2.5 text-sm w-72 focus:outline-none focus:ring-1 focus:ring-(--secondary-color)">
            </div>
        </div>

        <!-- Returns Table -->
        <div class="bg-(--card-bg) rounded-2xl shadow-md hover:shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-(--text-color)/10 bg-(--card-dark)">
                            <th class="px-6 py-4 text-left text-sm font-medium text-(--text-color)">Return ID</th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-(--text-color)">Order ID</th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-(--text-color)">Customer</th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-(--text-color)">Product</th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-(--text-color)">Reason</th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-(--text-color)">Requested On</th>
                            <th class="px-6 py-4 text-center text-sm font-medium text-(--text-color)">Status</th>
                            <th class="px-6 py-4 text-center text-sm font-medium text-(--text-color)">Action</th>
                        </tr>
                    </thead>
                    <tbody id="returnsTable" class="divide-y divide-(--text-color)/10">

                        <!-- Example Row 1 -->
                        <tr class="hhover:bg-(--card-dark)/10 transition-colors">
                            <td class="px-6 py-5">
                                <a href="" class="font-semibold text-(--secondary-color)">#R-8291</a>
                            </td>
                            <td class="px-6 py-5">#HK-8291</td>
                            <td class="px-6 py-5">
                                <div>
                                    <p class="font-medium">Babisa katwal</p>
                                    <p class="text-xs text-gray-500">9823456789</p>
                                </div>
                            </td>
                            <td class="px-6 py-5 text-sm">Handcrafted Leather Bag</td>
                            <td class="px-6 py-5 text-sm text-orange-700">Damaged Item</td>
                            <td class="px-6 py-5 text-sm text-gray-500">Jun 25, 2026</td>
                            <td class="px-6 py-5 text-center">
                                <span
                                    class="px-3 py-1 text-xs font-medium bg-amber-100 text-amber-700 rounded-full">Pending</span>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <a href="{{ route('return-details') }}"
                                    class="inline-flex items-center gap-1 text-(--secondary-color) hover:underline text-sm font-medium">
                                    <span class="hover:underline">View Details</span>
                                    <i data-lucide="arrow-right" class="w-6 h-4"></i> </a>
                            </td>
                        </tr>

                        <!-- Example Row 2 -->
                        <tr class="hover:bg-(--card-dark)/10 transition-colors">
                            <td class="px-6 py-5">
                                <a href="" class="font-semibold text-(--secondary-color)">#R-8285</a>
                            </td>
                            <td class="px-6 py-5">#HK-8274</td>
                            <td class="px-6 py-5">
                                <div>
                                    <p class="font-medium">Sita Sharma</p>
                                </div>
                            </td>
                            <td class="px-6 py-5 text-sm">Artisan Tea Set</td>
                            <td class="px-6 py-5 text-sm text-orange-700">Wrong Item</td>
                            <td class="px-6 py-5 text-sm text-gray-500">Jun 23, 2026</td>
                            <td class="px-6 py-5 text-center">
                                <span
                                    class="px-3 py-1 text-xs font-medium bg-green-100 text-green-700 rounded-full">Approved</span>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <a href=""
                                    class="inline-flex items-center gap-1 text-(--secondary-color) hover:underline text-sm font-medium">
                                    <span class="hover:underline">View Details</span>
                                    <i data-lucide="arrow-right" class="w-6 h-4"></i> </a>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination (optional) -->
        <div class="flex justify-between items-center text-sm">
            <p class="text-(--text-color)/60">Showing 1-5 of 24 returns</p>
            <div class="flex gap-2">
                <button class="px-4 py-2 border hover:bg-(--secondary-color) hover:text-white rounded-xl">Previous</button>
                <button class="px-4 py-2 border hover:bg-(--secondary-color) hover:text-white rounded-xl">1</button>
                <button class="px-4 py-2 border hover:bg-(--secondary-color) hover:text-white rounded-xl">2</button>
                <button class="px-4 py-2 border hover:bg-(--secondary-color) hover:text-white rounded-xl">Next</button>
            </div>
        </div>

    </div>

</x-seller_layout>
