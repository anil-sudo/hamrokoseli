<x-frontend-layout>
<div class="bg-[#F4EAE1] text-[#3A2A1F] min-h-screen py-10 sm:py-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">

        <!-- Title -->
        <div class="mb-8 sm:mb-10">
            <h1 class="text-4xl font-extrabold text-[#1F3D2E] mb-2">
                Your Handpicked Pieces
            </h1>
            <p class="text-[#3A2A1F]/70 font-semibold">
                Items are grouped by seller — check out one product or the whole box at once.
            </p>
        </div>

        <!-- Flash -->
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-2xl text-green-700">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-2xl text-red-700">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($items->isEmpty())
            <!-- Empty -->
            <div class="text-center py-20 bg-white/40 rounded-3xl">
                <h2 class="text-xl font-bold">Your cart is empty</h2>
                <a href="{{ route('shop') }}" class="text-[#C65A3A] font-bold mt-4 inline-block">
                    Start Exploring
                </a>
            </div>
        @else

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            <!-- LEFT -->
            <div class="lg:col-span-8 space-y-6">

                @foreach ($groupedByVendor as $vendorId => $vendorItems)
                    @php
                        $vendor = $vendorItems->first()->product->vendor;
                        $vendorName = $vendor->vendor_name ?? $vendor->name ?? 'Local Artisan';
                        $vendorTotal = $vendorItems->sum(fn($i) => $i->subtotal());
                    @endphp

                    <div class="bg-white rounded-3xl border border-[#ebd7be]/60 shadow-sm overflow-hidden">

                        <!-- Vendor box header -->
                        <div class="flex items-center justify-between gap-3 px-5 py-4 bg-[#FFF7EF] border-b border-[#ebd7be]/60">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-store text-[#C65A3A]"></i>
                                <h2 class="font-bold text-[#1F3D2E] uppercase text-sm tracking-wide">
                                    {{ $vendorName }}
                                </h2>
                                <span class="text-[10px] font-bold text-[#3A2A1F]/50">
                                    ({{ $vendorItems->count() }} item{{ $vendorItems->count() > 1 ? 's' : '' }})
                                </span>
                            </div>

                            @if ($vendorId && $vendorItems->count() > 1)
                                <button
                                    onclick="openCheckoutModal('{{ route('checkout.save-user-info.vendor', $vendorId) }}')"
                                    class="bg-[#C65A3A] hover:bg-[#b04a2c] text-white text-xs font-bold px-4 py-2 rounded-xl transition whitespace-nowrap">
                                    Checkout All &mdash; रू {{ number_format($vendorTotal, 2) }}
                                </button>
                            @endif
                        </div>

                        <!-- Items in this vendor's box -->
                        <div class="p-4 space-y-4">
                            @foreach ($vendorItems as $item)

                                <div class="flex justify-between items-center">

                                    <!-- Product -->
                                    <div class="flex gap-4 items-center">

                                        <img src="{{ $item->product->primaryImageUrl() }}"
                                             class="w-16 h-16 rounded-xl object-cover">

                                        <div>
                                            <h3 class="font-bold">{{ $item->product->name }}</h3>

                                            @if ($item->variant)
                                                <p class="text-xs text-gray-500">
                                                    {{ collect([$item->variant->size, $item->variant->color])->filter()->implode(' / ') }}
                                                </p>
                                            @endif

                                            <p class="text-[#C65A3A] font-bold">
                                                रू {{ number_format($item->subtotal(), 2) }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Actions -->
                                    <div class="flex gap-2 items-center">

                                        <!-- Checkout (single item) -->
                                        <button
                                            onclick="openCheckoutModal('{{ route('checkout.save-user-info', $item->id) }}')"
                                            class="bg-[#1F3D2E] text-white px-4 py-2 rounded-xl text-sm">
                                            Checkout
                                        </button>

                                        <!-- Remove -->
                                        <form action="{{ route('cart.remove', $item) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-500">
                                                Remove
                                            </button>
                                        </form>

                                    </div>

                                </div>

                            @endforeach
                        </div>
                    </div>

                @endforeach

            </div>

            <!-- RIGHT -->
            <div class="lg:col-span-4">
                <div class="bg-white p-6 rounded-3xl">

                    <h2 class="font-bold text-lg mb-4">Cart Summary</h2>

                    <p class="mb-2">
                        Items: {{ $items->count() }}
                    </p>

                    <p class="font-bold text-[#C65A3A] text-xl">
                        Total: रू {{ number_format($items->sum(fn($i) => $i->subtotal()), 2) }}
                    </p>

                </div>
            </div>

        </div>

        @endif

    </div>
</div>

<!-- ================= MODAL (ONLY ONE) ================= -->
<div id="checkoutModal"
     class="fixed inset-0 bg-black/60 hidden items-center justify-center z-[99999]">

    <div class="bg-white w-full max-w-lg rounded-3xl shadow-xl">

        <div class="p-6 border-b">
            <h2 class="text-xl font-bold text-[#1F3D2E]">
                Delivery Information
            </h2>
            <p class="text-sm text-gray-500">
                Enter phone and address
            </p>
        </div>

        <form id="checkoutForm" method="POST">
            @csrf

            <div class="p-6 space-y-4">

                <input type="text"
                       name="phone"
                       placeholder="Phone Number"
                       class="w-full border rounded-xl px-4 py-3"
                       required>

                <textarea name="address"
                          rows="4"
                          placeholder="Delivery Address"
                          class="w-full border rounded-xl px-4 py-3"
                          required></textarea>

            </div>

            <div class="flex justify-end gap-3 p-6 border-t">

                <button type="button"
                        onclick="closeCheckoutModal()"
                        class="px-4 py-2 border rounded-xl">
                    Cancel
                </button>

                <button type="submit"
                        class="bg-[#1F3D2E] text-white px-6 py-2 rounded-xl">
                    Continue
                </button>

            </div>

        </form>

    </div>
</div>

</x-frontend-layout>

<!-- ================= JS ================= -->
<script>
function openCheckoutModal(url)
{
    document.getElementById('checkoutForm').action = url;

    const modal = document.getElementById('checkoutModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeCheckoutModal()
{
    const modal = document.getElementById('checkoutModal');
    modal.classList.remove('flex');
    modal.classList.add('hidden');
}

document.getElementById('checkoutModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeCheckoutModal();
    }
});
</script>