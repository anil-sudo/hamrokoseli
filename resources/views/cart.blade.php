<x-frontend-layout>
    <div class="bg-[#F4EAE1] text-[#3A2A1F] min-h-screen py-10 sm:py-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">

            <!-- Page Title Section -->
            <div class="mb-8 sm:mb-10">
                <h1 class="text-3.5xl sm:text-4xl md:text-5xl font-extrabold text-[#1F3D2E] tracking-tight mb-2 sm:mb-3">
                    Your Handpicked Pieces
                </h1>
                <p class="text-[#3A2A1F]/70 text-sm sm:text-base font-semibold max-w-xl">
                    Each item checks out separately, so every artisan gets their own order.
                </p>
            </div>

            <!-- Flash messages -->
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-2xl text-green-700 text-sm font-semibold">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-2xl text-red-700 text-sm">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if ($items->isEmpty())
                <!-- Empty State -->
                <div class="text-center py-20 bg-white/40 rounded-3xl border border-[#ebd7be]/20 shadow-sm max-w-xl mx-auto px-6">
                    <div class="w-16 h-16 bg-[#ebd7be]/30 rounded-full flex items-center justify-center mx-auto mb-5 text-[#C65A3A]">
                        <i class="fas fa-shopping-cart text-2xl"></i>
                    </div>
                    <h2 class="text-xl font-bold text-[#1F3D2E] mb-2">Your cart is empty</h2>
                    <p class="text-sm text-[#3A2A1F]/70 max-w-sm mx-auto mb-8 font-semibold">
                        Looks like you haven't added any beautiful Nepalese handicrafts yet.
                    </p>
                    <a href="{{ route('shop') }}" class="inline-flex items-center gap-2 bg-[#C65A3A] hover:bg-[#b04a2c] text-white font-bold px-8 py-3.5 rounded-full shadow-md hover:shadow transition duration-300 text-sm">
                        Start Exploring
                    </a>
                </div>
            @else
                <!-- Two-column Layout -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

                    <!-- LEFT COLUMN: Cart Items grouped by vendor -->
                    <div class="lg:col-span-8 space-y-8">
                        @foreach ($groupedByVendor as $vendorName => $vendorItems)
                            <div class="space-y-4">
                                <!-- Vendor header -->
                                <div class="flex items-center gap-2 px-1">
                                    <i class="fas fa-store text-[#C65A3A] text-sm"></i>
                                    <h2 class="text-sm font-extrabold text-[#1F3D2E] uppercase tracking-wider">
                                        {{ $vendorName }}
                                    </h2>
                                    <span class="text-[10px] font-bold text-[#3A2A1F]/40">
                                        &mdash; ships and checks out separately
                                    </span>
                                </div>

                                @foreach ($vendorItems as $item)
                                    <div class="bg-white rounded-3xl p-4 sm:p-5 border border-[#ebd7be]/40 shadow-xs flex flex-col sm:flex-row gap-4 items-start sm:items-center hover:shadow-md transition duration-300">

                                        <!-- Product Image -->
                                        <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-2xl overflow-hidden border border-[#ebd7be]/30 shadow-xs shrink-0 bg-white">
                                            <img src="{{ $item->product->primaryImageUrl() }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                        </div>

                                        <!-- Product Details -->
                                        <div class="flex-grow space-y-1.5 w-full">
                                            <h3 class="text-sm sm:text-base font-bold text-[#1F3D2E] leading-tight">
                                                {{ $item->product->name }}
                                            </h3>

                                            @if ($item->variant)
                                                <p class="text-[10px] sm:text-xs text-[#3A2A1F]/70 font-semibold">
                                                    {{ collect([$item->variant->size, $item->variant->color])->filter()->implode(' / ') }}
                                                </p>
                                            @endif

                                            <div class="flex flex-wrap items-center justify-between gap-3 pt-1">
                                                <!-- Quantity Adjuster -->
                                                <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center border border-[#ebd7be] rounded-full bg-white px-2 py-0.5 gap-2.5 shadow-xs">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" name="quantity" value="{{ max(1, $item->quantity - 1) }}"
                                                            class="text-[#3A2A1F] hover:text-[#C65A3A] font-bold text-xs w-4.5 h-4.5 flex items-center justify-center transition cursor-pointer">&minus;</button>
                                                    <span class="text-xs font-bold text-[#1F3D2E] w-5 text-center select-none">{{ $item->quantity }}</span>
                                                    <button type="submit" name="quantity" value="{{ $item->quantity + 1 }}"
                                                            class="text-[#3A2A1F] hover:text-[#C65A3A] font-bold text-xs w-4.5 h-4.5 flex items-center justify-center transition cursor-pointer">+</button>
                                                </form>

                                                <span class="text-[#C65A3A] font-extrabold text-sm sm:text-base">
                                                    रू {{ number_format($item->subtotal(), 2) }}
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Actions -->
                                        <div class="flex sm:flex-col items-center sm:items-end gap-2 w-full sm:w-auto sm:pl-2">
                                            <a href="{{ route('checkout.show', $item) }}"
                                               class="whitespace-nowrap inline-flex items-center justify-center gap-1.5 bg-[#1F3D2E] hover:bg-[#13261d] text-white text-xs font-bold py-2.5 px-4 rounded-xl shadow-sm transition w-full sm:w-auto">
                                                Checkout <i class="fas fa-arrow-right text-[10px]"></i>
                                            </a>
                                            <form action="{{ route('cart.remove', $item) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" title="Remove item"
                                                        class="text-[#C65A3A]/75 hover:text-red-600 rounded-full w-8 h-8 flex items-center justify-center hover:bg-red-50 transition cursor-pointer">
                                                    <i class="fa-regular fa-trash-can text-sm"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach

                        <!-- Bottom navigation link -->
                        <div>
                            <a href="{{ route('shop') }}" class="inline-flex items-center gap-2 text-[#C65A3A] hover:text-[#b04a2c] font-bold text-sm transition duration-300">
                                <i class="fas fa-arrow-left"></i> Explore More Treasures
                            </a>
                        </div>
                    </div>

                    <!-- RIGHT COLUMN: Informational summary -->
                    <div class="lg:col-span-4 space-y-6">
                        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-[#ebd7be]/40 shadow-sm space-y-5">
                            <h2 class="text-xl font-bold text-[#1F3D2E]">Cart Summary</h2>

                            <div class="flex items-center justify-between text-sm font-semibold text-[#3A2A1F]/80">
                                <span>Items across {{ $groupedByVendor->count() }} {{ Str::plural('artisan', $groupedByVendor->count()) }}</span>
                                <span class="text-[#1F3D2E] font-bold">{{ $items->count() }}</span>
                            </div>

                            <div class="border-t border-[#ebd7be]/40 pt-4 flex items-center justify-between">
                                <span class="text-base font-extrabold text-[#1F3D2E]">Combined Total</span>
                                <span class="text-[#C65A3A] font-extrabold text-xl">रू {{ number_format($items->sum(fn ($i) => $i->subtotal()), 2) }}</span>
                            </div>

                            <p class="text-[10px] sm:text-xs text-[#3A2A1F]/60 font-semibold leading-relaxed pt-1">
                                This total is shown for reference only. Since every product ships from a different
                                local artisan, please use the <strong>Checkout</strong> button on each item to place
                                its order individually.
                            </p>
                        </div>

                        <!-- Impact Spotlight Box -->
                        <div class="bg-[#FFF7EF] rounded-3xl p-6 border border-[#ebd7be]/40 shadow-sm flex items-start gap-4">
                            <div class="shrink-0 w-12 h-12 rounded-full overflow-hidden border border-[#ebd7be]">
                                <img src="{{ asset('images/logo.jpeg') }}" alt="Artisan Spotlight" class="w-full h-full object-cover">
                            </div>
                            <div class="space-y-1">
                                <h3 class="text-xs font-extrabold text-[#1F3D2E] uppercase tracking-wider">Impact Spotlight</h3>
                                <p class="text-sm font-semibold text-[#C65A3A] italic leading-relaxed">
                                    "Every checkout goes straight to the artisan who made it."
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            @endif

        </div>
    </div>
</x-frontend-layout>