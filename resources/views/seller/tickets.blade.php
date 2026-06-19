<x-seller_layout title="My Tickets">

    <div class="space-y-10">

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between items-start gap-4">
            <div>
                <h1 class="text-3xl font-semibold text-(--text-color)">My Tickets</h1>
                <p class="text-(--text-color)/70 mt-1">View and track all your support requests</p>
            </div>

            <a href="{{ route('create-ticket') }}"
                class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-(--secondary-color) hover:bg-[#B94E31] text-white font-medium rounded-2xl transition">
                <i data-lucide="plus" class="w-5 h-5"></i>
                Create New Ticket
            </a>
        </div>

        <!-- Tickets List -->
        <div class="space-y-6">

            <!-- Ticket Card 1 -->
            <div class="bg-(--card-bg) border border-(--text-color)/20 rounded-3xl p-6 hover:shadow-md transition">
                <div class="flex flex-col md:flex-row md:items-start justify-between gap-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-3">
                            <span
                                class="px-3 py-1 text-xs font-medium bg-(--card-dark)/50 text-(--text-dark) rounded-full">General
                                Support</span>
                            <span class="text-sm text-(--text-color)/60">TK-74829</span>
                        </div>
                        <h3 class="text-lg font-semibold text-(--text-color) mt-3">Payment not credited this week</h3>
                        <p class="text-(--text-color)/70 mt-2 line-clamp-2">
                            My weekly payout for last week has not been received yet. Please check...
                        </p>
                    </div>

                    <div class="text-right">
                        <span
                            class="inline-block px-4 py-1.5 text-sm font-medium bg-(--primary-color)/20 text-(--primary-color) rounded-2xl">
                            Resolved
                        </span>
                        <p class="text-xs text-(--text-color)/50 mt-3">2 days ago</p>
                    </div>
                </div>
            </div>

            <!-- Ticket Card 2 -->
            <div class="bg-(--card-bg) border border-(--text-color)/20 rounded-3xl p-6 hover:shadow-md transition">
                <div class="flex flex-col md:flex-row md:items-start justify-between gap-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-3">
                            <span
                                class="px-3 py-1 text-xs font-medium bg-(--hover-color)/20 text-(--hover-color) rounded-full">Technical
                                Support</span>
                            <span class="text-sm text-(--text-color)/60">TK-74815</span>
                        </div>
                        <h3 class="text-lg font-semibold text-(--text-color) mt-3">Unable to upload product images</h3>
                        <p class="text-(--text-color)/70 mt-2 line-clamp-2">
                            Getting error when trying to upload images for new products.
                        </p>
                    </div>

                    <div class="text-right">
                        <span
                            class="inline-block px-4 py-1.5 text-sm font-medium bg-(--hover-color)/20 text-(--hover-color) rounded-2xl">
                            In Progress
                        </span>
                        <p class="text-xs text-(--text-color)/50 mt-3">5 days ago</p>
                    </div>
                </div>
            </div>

            <!-- Ticket Card 3 -->
            <div class="bg-(--card-bg) border border-(--text-color)/20 rounded-3xl p-6 hover:shadow-md transition">
                <div class="flex flex-col md:flex-row md:items-start justify-between gap-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-3">
                            <span
                                class="px-3 py-1 text-xs font-medium bg-(--secondary-color)/20 text-(--secondary-color) rounded-full">Order
                                Related</span>
                            <span class="text-sm text-(--text-color)/60">TK-74792</span>
                        </div>
                        <h3 class="text-lg font-semibold text-(--text-color) mt-3">Order status not updating</h3>
                        <p class="text-(--text-color)/70 mt-2 line-clamp-2">
                            Customer order status is stuck at "Processing" even after shipping.
                        </p>
                    </div>

                    <div class="text-right">
                        <span
                            class="inline-block px-4 py-1.5 text-sm font-medium bg-(--secondary-color)/20 text-(--secondary-color) rounded-2xl">
                            Pending
                        </span>
                        <p class="text-xs text-(--text-color)/50 mt-3">Oct 12, 2023</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="text-center text-(--text-color)/60 text-sm pt-8">
            Need help right now? Email us at
            <a href="mailto:hamrokoseli06@gmail.com" class="text-(--secondary-color) hover:underline font-medium">
                hamrokoseli06@gmail.com
            </a>
        </div>

        <!-- Back to Support -->
        <div class="flex justify-center mt-12">
            <a href="{{ route('seller-support') }}"
                class="flex items-center gap-3 bg-(--secondary-color) hover:bg-[#B94E31] text-white font-semibold text-lg px-5 py-2 rounded-2xl shadow-sm hover:shadow-md transition-all active:scale-95">
                <span>←</span>
                Back to Support
            </a>
        </div>

    </div>

    <script>
        // Initialize Lucide icons
        if (typeof lucide !== "undefined") lucide.createIcons();
    </script>

</x-seller_layout>
