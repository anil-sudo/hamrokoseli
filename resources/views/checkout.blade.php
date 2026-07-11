<x-frontend-layout title="Checkout - Hamro Koseli">
    <div class="bg-[#F4EAE1] text-[#3A2A1F] min-h-screen py-10 sm:py-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">

            <div class="mb-8">
                <h1 class="text-3xl sm:text-4xl font-extrabold text-[#1F3D2E] tracking-tight mb-2">
                    Checkout
                </h1>
                <p class="text-[#3A2A1F]/70 text-sm font-semibold">
                    Sold by <span class="text-[#C65A3A] font-bold">{{ $cartItem->product->vendor->vendor_name ?? 'Local Artisan' }}</span>
                    &mdash; this order is placed separately from the rest of your cart.
                </p>
            </div>

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-2xl text-red-700 text-sm">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Item summary -->
            <div class="bg-white rounded-3xl p-5 border border-[#ebd7be]/40 shadow-xs flex items-center gap-4 mb-8">
                <div class="w-20 h-20 rounded-2xl overflow-hidden border border-[#ebd7be]/30 shrink-0 bg-white">
                    <img src="{{ $cartItem->product->primaryImageUrl() }}" alt="{{ $cartItem->product->name }}" class="w-full h-full object-cover">
                </div>
                <div class="flex-grow">
                    <h3 class="font-bold text-[#1F3D2E]">{{ $cartItem->product->name }}</h3>
                    @if ($cartItem->variant)
                        <p class="text-xs text-[#3A2A1F]/70 font-semibold">
                            {{ collect([$cartItem->variant->size, $cartItem->variant->color])->filter()->implode(' / ') }}
                        </p>
                    @endif
                    <p class="text-xs text-[#3A2A1F]/70 font-semibold">Qty: {{ $cartItem->quantity }} &times; रू {{ number_format($unitPrice, 2) }}</p>
                </div>
                <span class="text-[#C65A3A] font-extrabold text-lg">रू {{ number_format($subtotal, 2) }}</span>
            </div>

            <form action="{{ route('checkout.store', $cartItem) }}" method="POST" class="space-y-8">
                @csrf

                <!-- Shipping address -->
                <div class="bg-white rounded-3xl p-6 border border-[#ebd7be]/40 shadow-sm">
                    <h2 class="text-lg font-bold text-[#1F3D2E] mb-4">Shipping Address</h2>
                    <p class="text-xs text-[#3A2A1F]/60 font-semibold mb-4">
                        Pulled from your account -update it here if anything's changed.
                    </p>

                    <div class="space-y-4">
                        <div>
                            <label for="phone" class="block text-xs font-bold text-[#1F3D2E] mb-1.5">Phone Number</label>
                            <input type="tel" id="phone" name="phone" required maxlength="10"
                                   value="{{ old('phone', $user->phone) }}"
                                   placeholder="98XXXXXXXX"
                                   class="w-full px-4 py-3 rounded-xl border border-[#ebd7be] bg-[#FFF7EF] text-sm font-semibold text-[#3A2A1F] focus:outline-none focus:ring-2 focus:ring-[#1F3D2E]/25">
                        </div>
                        <div>
                            <label for="address" class="block text-xs font-bold text-[#1F3D2E] mb-1.5">Delivery Address</label>
                            <textarea id="address" name="address" required maxlength="255" rows="3"
                                      placeholder="Street, city, landmark..."
                                      class="w-full px-4 py-3 rounded-xl border border-[#ebd7be] bg-[#FFF7EF] text-sm font-semibold text-[#3A2A1F] focus:outline-none focus:ring-2 focus:ring-[#1F3D2E]/25">{{ old('address', $user->address) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Payment method -->
                <div class="bg-white rounded-3xl p-6 border border-[#ebd7be]/40 shadow-sm">
                    <h2 class="text-lg font-bold text-[#1F3D2E] mb-4">Payment Method</h2>
                    <div class="space-y-3">
                        <label class="flex items-center gap-3 p-4 border border-[#ebd7be] rounded-2xl cursor-pointer hover:border-[#C65A3A] transition">
                            <input type="radio" name="payment_method" value="cod" checked required class="accent-[#1F3D2E]">
                            <span class="text-sm font-semibold text-[#3A2A1F]">Cash on Delivery</span>
                        </label>
                        <label class="flex items-center gap-3 p-4 border border-[#ebd7be] rounded-2xl cursor-pointer hover:border-[#C65A3A] transition">
                            <input type="radio" name="payment_method" value="esewa" class="accent-[#1F3D2E]">
                            <span class="text-sm font-semibold text-[#3A2A1F]">eSewa</span>
                        </label>
                        <label class="flex items-center gap-3 p-4 border border-[#ebd7be] rounded-2xl cursor-pointer hover:border-[#C65A3A] transition">
                            <input type="radio" name="payment_method" value="khalti" class="accent-[#1F3D2E]">
                            <span class="text-sm font-semibold text-[#3A2A1F]">Khalti</span>
                        </label>
                    </div>
                </div>

                <button type="submit"
                        class="w-full flex items-center justify-center gap-2 bg-[#C65A3A] hover:bg-[#b04a2c] disabled:opacity-50 disabled:cursor-not-allowed text-white font-bold py-3.5 px-4 rounded-xl shadow-md transition duration-300">
                    Place Order &mdash; Rs. {{ number_format($subtotal, 2) }} <i class="fas fa-arrow-right text-xs"></i>
                </button>
            </form>

            <div class="mt-6">
                <a href="{{ route('cart') }}" class="inline-flex items-center gap-2 text-[#C65A3A] hover:text-[#b04a2c] font-bold text-sm transition duration-300">
                    <i class="fas fa-arrow-left"></i> Back to Cart
                </a>
            </div>

        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const phoneInput = document.getElementById('phone');
        // Strip non-digits and cap at 10 as user types
        if (phoneInput) {
            phoneInput.addEventListener('input', function () {
                this.value = this.value.replace(/\D/g, '').substring(0, 10);
            });
        }
        // Block submit if phone isn't exactly 10 digits
        const form = document.querySelector('form');
        if (form && phoneInput) {
            form.addEventListener('submit', function (e) {
                const phone = phoneInput.value.trim();
                if (!/^\d{10}$/.test(phone)) {
                    e.preventDefault();
                    phoneInput.focus();
                    alert('Phone number must be exactly 10 digits.');
                }
            });
        }
    });
    </script>
</x-frontend-layout>