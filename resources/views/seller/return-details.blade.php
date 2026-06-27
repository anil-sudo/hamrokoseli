<x-seller_layout title="Return Request #R-8291">

    <div class="space-y-8">

        <!-- Back Button -->
        <a href="{{ route('seller.returns') }}"
            class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-(--text-dark) bg-(--text-light) border border-(--text-color)/20 rounded-2xl hover:bg-(--text-color)/5 transition-colors">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
            Back to All Returns
        </a>

        <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold text-(--text-color)">Return Request</h1>
                <div class="flex items-center gap-3 text-sm mt-1">
                    <span class="font-semibold text-(--secondary-color)">#R-8291</span>
                    <span class="text-(--text-color)/50">•</span>
                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-700">
                        Pending Review
                    </span>
                </div>
            </div>

            <div class="flex gap-3">
                <button onclick="showRejectModal()"
                    class="px-6 py-3 rounded-xl border border-red-300 text-(--secondary-color) hover:bg-(--card-bg) font-medium transition-colors">
                    Reject Request
                </button>

                <button onclick="approveReturn()"
                    class="px-6 py-3 rounded-xl bg-(--secondary-color) hover:bg-[#B94E31] text-white font-semibold transition-colors flex items-center gap-2">
                    <i data-lucide="check-circle" class="w-5 h-5"></i>
                    Approve Return
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- LEFT COLUMN -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Product -->
                <div class="bg-(--card-bg) rounded-2xl p-6 shadow-sm">
                    <h2 class="text-lg font-semibold mb-4">Product Information</h2>
                    <div class="flex gap-5">
                        <img src="{{ asset('images/backpack.png') }}" alt="Product"
                            class="w-28 h-28 object-cover rounded-xl border">
                        <div class="flex-1">
                            <h3 class="font-semibold text-lg text-(--text-color)">Handcrafted Leather Bag</h3>
                            <p class="text-sm text-gray-500">Order ID: <span class="font-medium">#HK-8291</span></p>
                            <p class="text-sm text-gray-500 mt-1">Qty: 1 • Price: Rs. 7,550</p>
                            <p class="text-xs text-green-600 mt-2">Delivered on June 14, 2026</p>
                        </div>
                    </div>
                </div>

                <!-- Return Reason -->
                <div class="bg-(--card-bg) rounded-2xl p-6 shadow-sm">
                    <h2 class="text-lg font-semibold mb-3">Return Reason</h2>
                    <div
                        class="inline-flex items-center gap-2 bg-orange-100 text-orange-700 px-5 py-3 rounded-2xl text-sm font-medium">
                        <i data-lucide="alert-triangle" class="w-5 h-5"></i>
                        Received damaged item
                    </div>
                </div>

                <!-- Customer Description -->
                <div class="bg-(--card-bg) rounded-2xl p-6 shadow-sm">
                    <h2 class="text-lg font-semibold mb-3">Customer's Description</h2>
                    <p class="text-(--text-color) leading-relaxed bg-(--text-light)/50 p-5 rounded-xl">
                        The bag arrived with a big scratch on the front and the zipper is not working smoothly.
                        I expected better quality for this price.
                    </p>
                </div>

                <!-- Uploaded Images -->
                <div class="bg-(--card-bg) rounded-2xl p-6 shadow-sm">
                    <h2 class="text-lg font-semibold mb-4">Proof Uploaded (3)</h2>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">

                        <!-- Image 1 -->
                        <div class="relative group rounded-xl overflow-hidden">
                            <img src="{{ asset('images/backpack.png') }}"
                                class="w-full aspect-square object-cover cursor-pointer hover:scale-105 transition-transform"
                                onclick="viewImage(this.src)">
                            <div
                                class="absolute top-3 right-3 bg-black/70 text-white text-[10px] px-2.5 py-1 rounded-full">
                                Photo 1
                            </div>
                        </div>

                        <!-- Image 2 -->
                        <div class="relative group rounded-xl overflow-hidden">
                            <img src="{{ asset('images/backpack.png') }}"
                                class="w-full aspect-square object-cover cursor-pointer hover:scale-105 transition-transform"
                                onclick="viewImage(this.src)">
                            <div
                                class="absolute top-3 right-3 bg-black/70 text-white text-[10px] px-2.5 py-1 rounded-full">
                                Photo 2
                            </div>
                        </div>

                        <!-- Image 3 -->
                        <div class="relative group rounded-xl overflow-hidden">
                            <img src="{{ asset('images/backpack.png') }}"
                                class="w-full aspect-square object-cover cursor-pointer hover:scale-105 transition-transform"
                                onclick="viewImage(this.src)">
                            <div
                                class="absolute top-3 right-3 bg-black/70 text-white text-[10px] px-2.5 py-1 rounded-full">
                                Photo 3
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <!-- RIGHT SIDEBAR -->
            <div class="space-y-6">

                <!-- Customer Info -->
                <div class="bg-(--card-bg) rounded-2xl p-6 shadow-sm">
                    <h2 class="font-semibold mb-4">Customer Details</h2>
                    <div class="space-y-4 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-500">Name</span>
                            <span class="font-medium">Babisa Katwal</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Phone</span>
                            <span class="font-medium">9823456789</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Email</span>
                            <span class="font-medium">you@example.com</span>
                        </div>
                    </div>
                </div>

                <!-- Refund Info -->
                <div class="bg-(--card-bg) rounded-2xl p-6 shadow-sm">
                    <h2 class="font-semibold mb-4">Refund Information</h2>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-500">Order Total</span>
                            <span>Rs. 7,550</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Payment Method</span>
                            <span class="font-medium">eSewa</span>
                        </div>
                        <hr class="border-(--text-color)/10">
                        <div class="flex justify-between font-semibold text-lg">
                            <span>Refund Amount</span>
                            <span class="text-(--secondary-color)">Rs. 7,550</span>
                        </div>
                    </div>
                </div>

                <!-- Timeline -->
                <div class="bg-(--card-bg) rounded-2xl p-6 shadow-sm">
                    <h2 class="font-semibold mb-4">Return Timeline</h2>
                    <div
                        class="space-y-6 text-sm relative pl-6 before:absolute before:left-2 before:top-2 before:bottom-2 before:w-0.5 before:bg-(--text-color)/10">
                        <div class="relative">
                            <div
                                class="absolute -left-6 w-4 h-4 bg-green-500 rounded-full flex items-center justify-center">
                                <div class="w-2 h-2 bg-white rounded-full"></div>
                            </div>
                            <p class="font-medium">Return Requested</p>
                            <p class="text-xs text-gray-500">June 25, 2026 at 7:12 PM</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reject Modal -->
    <div id="rejectModal" class="hidden fixed inset-0 bg-black/70 items-center justify-center z-50">
        <div class="bg-white rounded-2xl p-6 w-full max-w-md mx-4">
            <h3 class="text-lg font-semibold mb-4">Reject Return Request</h3>
            <textarea id="rejectReasonText" rows="4" class="w-full border border-(--text-color)/20 rounded-xl p-4 text-sm"
                placeholder="Please provide reason for rejection..."></textarea>

            <div class="flex gap-3 mt-6">
                <button onclick="closeRejectModal()"
                    class="flex-1 py-3 border border-(--secondary-color)/20 rounded-xl font-medium">Cancel</button>
                <button onclick="submitReject()"
                    class="flex-1 py-3 bg-(--secondary-color) text-white rounded-xl font-medium">Reject Return</button>
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    <div id="imageModal" class="hidden fixed inset-0 bg-black/90 items-center justify-center z-60 overflow-auto p-4">

        <div class="relative">
            <button onclick="closeImageModal()"
                class="absolute top-2 right-2 bg-white text-black rounded-full p-2 z-50">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>

            <img id="modalImage" src=""
                class="max-w-full max-h-[95vh] object-contain rounded-2xl shadow-2xl mx-auto">
        </div>
    </div>

    <script>
        function showRejectModal() {
            const modal = document.getElementById('rejectModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeRejectModal() {
            const modal = document.getElementById('rejectModal');
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }

        function viewImage(src) {
            document.getElementById('modalImage').src = src;

            const modal = document.getElementById('imageModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeImageModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }

        // ESC Key Support
        document.addEventListener('keydown', function(e) {
            if (e.key === "Escape") {
                document.getElementById('imageModal').classList.add('hidden');
                document.getElementById('rejectModal').classList.add('hidden');
            }
        });
    </script>

    </x-seller-layout>
