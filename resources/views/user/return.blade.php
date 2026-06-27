<x-user-layout title="Request Return">
    <div class="space-y-8">

        <!-- Back Button -->
        <a href="{{ route('order-detail') }}"
            class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-(--text-dark) bg-(--text-light) border border-(--text-color)/20 rounded-2xl">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
            Back to Order Details
        </a>

        <!-- Page Heading -->
        <div>
            <h1 class="text-2xl font-semibold text-(--text-color)">Request Return</h1>
            <div class="flex items-center gap-3 text-sm mt-1">
                <span class="font-semibold text-(--secondary-color)/70">#HK-8291</span>
                <span class="text-(--text-color)/50">•</span>
                <span class="text-(--text-dark)/50">Delivered on June 14, 2026</span>
            </div>
        </div>

        <!-- Main Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- ── LEFT COLUMN ── -->
            <div class="lg:col-span-2 space-y-6">
                <form action="" method="GET" class="space-y-6">

                    <!-- Product Card -->
                    <div class="bg-(--card-bg) rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-200">
                        <div class="flex gap-5">
                            <img src="{{ asset('images/backpack.png') }}" alt="Artisan Tea Set"
                                class="w-24 h-24 object-cover rounded-xl shrink-0">
                            <div class="flex flex-col justify-center">
                                <h3 class="font-semibold text-lg text-(--text-color)">Handcrafted Leather Bag</h3>
                                <p class="text-sm text-gray-500 mt-1">Quantity: 1</p>
                                <p class="text-sm font-medium text-(--text-color) mt-0.5">Price: Rs. 7,550</p>
                                <span
                                    class="mt-2 inline-flex items-center gap-1 bg-green-100 text-green-700 text-xs font-medium px-3 py-1 rounded-full w-fit">
                                    <i data-lucide="check-circle" class="w-3 h-3"></i>
                                    Delivered on June 14, 2023
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Reason + Description -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- 1. Return Reason -->
                        <div
                            class="bg-(--card-bg) rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-200">
                            <h2 class="text-lg font-semibold text-(--text-color) mb-3">
                                1. Why are you returning this item? <span class="text-(--secondary-color)">*</span>
                            </h2>
                            <div class="relative">
                                <select name="reason"
                                    class="w-full appearance-none border border-(--text-color)/20 rounded-xl px-4 py-3 text-sm text-(--text-color) bg-(--card-bg) focus:outline-none focus:ring-1 focus:ring-(--secondary-color) cursor-pointer pr-10">
                                    <option value="">Select a reason</option>
                                    <option value="damaged">Received damaged item</option>
                                    <option value="wrong">Wrong item received</option>
                                    <option value="not_as_described">Item not as described</option>
                                    <option value="other">Other</option>
                                </select>
                                <i data-lucide="chevron-down"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none"></i>
                            </div>
                        </div>

                        <!-- 2. Describe Issue -->
                        <div
                            class="bg-(--card-bg) rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-200">
                            <h2 class="text-lg font-semibold text-(--text-color) mb-3">
                                2. Describe your issue <span class="text-(--secondary-color)">*</span>
                            </h2>
                            <textarea name="description" id="description" maxlength="500" rows="4" required
                                placeholder="Describe your issue in detail..."
                                class="w-full border border-(--text-color)/20 rounded-xl px-4 py-3 text-sm text-(--text-color) bg-(--card-bg) resize-none focus:outline-none focus:ring-1 focus:ring-(--secondary-color) placeholder:text-gray-400"></textarea>

                            <p class="text-xs text-gray-400 text-right mt-1">
                                <span id="char-count" class="font-medium text-(--text-color)">0</span>/500
                            </p>
                        </div>
                    </div>

                    <!-- Upload + Refund To -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- 3. Upload Photos / Videos -->
                        <div
                            class="bg-(--card-bg) rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-200">
                            <h2 class="text-lg font-semibold text-(--text-color) mb-3">
                                3. Upload Photos <span class="text-(--secondary-color)">*</span>
                            </h2>

                            <label id="upload-label"
                                class="flex flex-col items-center justify-center border-2 border-dashed border-(--text-color)/20 rounded-xl py-6 cursor-pointer hover:border-(--secondary-color) transition-colors group">
                                <i data-lucide="camera"
                                    class="w-8 h-8 text-gray-400 group-hover:text-(--secondary-color) transition-colors mb-2"></i>
                                <span class="text-sm text-gray-600">
                                    <span class="text-(--secondary-color) font-medium">Click to upload</span> or drag
                                    and drop
                                </span>
                                <span class="text-xs text-gray-400 mt-1">PNG, JPG up to <strong>100KB</strong> (max 5
                                    image)</span>
                                <input type="file" id="file-upload" name="images[]" accept="image/*" multiple
                                    class="hidden">
                            </label>

                            <!-- Error Message -->
                            <div id="upload-error" class="mt-2 text-red-500 text-sm hidden"></div>

                            <!-- Preview Area -->
                            <div id="upload-preview" class="flex gap-2 mt-3 flex-wrap"></div>
                        </div>

                        <!-- 4. Refund To — Original Payment Method ONLY -->
                        <div
                            class="bg-(--card-bg) rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-200">
                            <h2 class="text-lg font-semibold text-(--text-color) mb-4">
                                4. Refund To <span class="text-(--secondary-color)">*</span>
                            </h2>

                            <div
                                class="flex items-center gap-4 p-4 rounded-xl bg-orange-50 border border-(--secondary-color)">
                                <div
                                    class="w-10 h-10 rounded-full bg-orange-100 flex items-center justify-center shrink-0">
                                    <i data-lucide="wallet" class="w-5 h-5 text-(--secondary-color)"></i>
                                </div>

                                <div>
                                    <p class="font-medium text-(--text-color)">
                                        Original Payment Method<span> (eSewa)</span>
                                    </p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        Refund will be credited back to the same payment method used for this order.
                                    </p>
                                </div>
                            </div>

                            <input type="hidden" name="refund_method" value="original_payment">
                        </div>
                    </div>

                    <!-- Return Policy Note -->
                    <div
                        class="bg-(--card-bg) rounded-2xl p-5 shadow-sm hover:shadow-md transition-all duration-200 flex gap-4 items-start">
                        <div class="w-10 h-10 rounded-full bg-orange-100 flex items-center justify-center shrink-0">
                            <i data-lucide="shield-check" class="w-5 h-5 text-(--secondary-color)"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-(--text-color)">Return Policy</p>
                            <p class="text-xs text-(--text-dark)/55 mt-0.5">
                                You can request a return within 7 days after delivery. The seller will review your
                                request
                                within 48 hours.
                            </p>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end gap-3 pb-2">
                        <a href="{{ route('order-detail') }}"
                            class="px-6 py-3 rounded-xl border border-(--text-color)/20 text-sm font-medium text-(--text-dark) bg-(--text-light) hover:bg-(--text-color)/10 transition-colors">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-6 py-3 rounded-xl bg-(--secondary-color) hover:bg-[#B94E31] text-white text-sm font-semibold transition-colors shadow-sm flex items-center gap-2">
                            <i data-lucide="send" class="w-4 h-4"></i>
                            Submit Return Request
                        </button>
                    </div>
                </form>
            </div>

            <!-- ── RIGHT SIDEBAR ── -->
            <div class="space-y-6">

                <!-- Order Summary -->
                <div class="bg-(--card-bg) rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-200">
                    <h2 class="text-xl font-semibold text-(--text-color) mb-4">Order Summary</h2>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Order ID</span>
                            <span class="font-medium text-(--text-color)">HK-8291</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Order Date</span>
                            <span class="font-medium text-(--text-color)">June 14, 2026</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Payment Method</span>
                            <span class="font-medium text-(--text-color)">eSewa</span>
                        </div>
                        <hr class="border-(--text-color)/10">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Item Total</span>
                            <span>Rs. 7,500</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Shipping Fee</span>
                            <span>Rs. 50</span>
                        </div>
                        <hr class="border-(--text-color)/10">
                        <div class="flex justify-between font-semibold text-lg">
                            <span>Total</span>
                            <span class="text-(--secondary-color)">Rs. 7,550</span>
                        </div>
                    </div>
                </div>

                <!-- Return Policy -->
                <div class="bg-(--card-bg) rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-200">
                    <h2 class="text-xl font-semibold text-(--text-color) mb-4">Return Policy</h2>
                    <ul class="space-y-4">
                        <li class="flex gap-3 items-start">
                            <div class="w-8 h-8 rounded-full bg-orange-100 flex items-center justify-center shrink-0">
                                <i data-lucide="calendar" class="w-4 h-4 text-(--secondary-color)"></i>
                            </div>
                            <p class="text-xs text-(--text-dark)/70 mt-1.5">Return accepted within 7 days of delivery
                            </p>
                        </li>
                        <li class="flex gap-3 items-start">
                            <div class="w-8 h-8 rounded-full bg-orange-100 flex items-center justify-center shrink-0">
                                <i data-lucide="package" class="w-4 h-4 text-(--secondary-color)"></i>
                            </div>
                            <p class="text-xs text-(--text-dark)/70 mt-1.5">Item must be unused and in original
                                condition</p>
                        </li>
                        <li class="flex gap-3 items-start">
                            <div class="w-8 h-8 rounded-full bg-orange-100 flex items-center justify-center shrink-0">
                                <i data-lucide="refresh-ccw" class="w-4 h-4 text-(--secondary-color)"></i>
                            </div>
                            <p class="text-xs text-(--text-dark)/70 mt-1.5">Refund will be processed once the return is
                                approved</p>
                        </li>
                    </ul>
                </div>

            </div>

        </div>
    </div>

    <script>
        // Character Counter
        const textarea = document.getElementById('description');
        const charCount = document.getElementById('char-count');

        function updateCharCount() {
            const currentLength = textarea.value.length;
            charCount.textContent = currentLength;
            if (currentLength > 450) {
                charCount.classList.add('text-red-500');
            } else {
                charCount.classList.remove('text-red-500');
            }
        }

        updateCharCount();

        textarea.addEventListener('input', updateCharCount);

        // Simple File Preview
        const fileInput = document.getElementById('file-upload');
        const previewContainer = document.getElementById('upload-preview');
        const errorDiv = document.getElementById('upload-error');
        const MAX_SIZE = 100 * 1024; // 100KB

        fileInput.addEventListener('change', () => {
            previewContainer.innerHTML = '';
            errorDiv.classList.add('hidden');
            errorDiv.textContent = '';

            const files = Array.from(fileInput.files);
            let validFiles = [];

            files.forEach((file) => {
                if (file.size > MAX_SIZE) {
                    errorDiv.textContent = `image is too large. Maximum size is 100KB.`;
                    errorDiv.classList.remove('hidden');
                    return;
                }
                if (validFiles.length >= 5) {
                    errorDiv.textContent = "Maximum 5 files allowed.";
                    errorDiv.classList.remove('hidden');
                    return;
                }

                validFiles.push(file);

                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'relative w-20 h-20';
                    div.innerHTML = `
                        <img src="${e.target.result}"
                             class="w-20 h-20 object-cover rounded-xl border border-(--text-color)/20">
                        <button type="button" onclick="this.parentElement.remove()"
                            class="absolute -top-1 -right-1 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs hover:bg-red-600">×</button>
                    `;
                    previewContainer.appendChild(div);
                };
                reader.readAsDataURL(file);
            });
        });
    </script>
</x-user-layout>
