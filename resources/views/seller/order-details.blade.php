<x-seller_layout title="Order Management" searchPlaceholder="Search by Order ID or Customer...">

    <a href="{{ route('order') }}"
        class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-(--text-dark) bg-(--text-light) border border-(--text-color)/20 rounded-2xl">
        <i data-lucide="arrow-left" class="w-5 h-5"></i>
        Back to Orders
    </a>

    @php
        $customer = $order->user;
        $initials = $customer
            ? \Illuminate\Support\Str::upper(
                \Illuminate\Support\Str::substr(
                    collect(explode(' ', trim($customer->name)))
                        ->map(fn($part) => \Illuminate\Support\Str::substr($part, 0, 1))
                        ->join(''),
                    0,
                    2
                )
            )
            : '??';

        $payment = $order->payment;

        $orderStatusOptions = [
            'pending' => 'New',
            'confirmed' => 'Processing',
            'shipped' => 'Shipped',
            'delivered' => 'Delivered',
            'cancelled' => 'Cancelled',
        ];

        $paymentStatusOptions = [
            'pending' => 'Pending',
            'completed' => 'Paid',
            'failed' => 'Failed',
            'refunded' => 'Refunded',
        ];
    @endphp

    <div class="mb-8 mt-4">
        <h1 class="text-2xl font-semibold text-(--text-color)">Order Details</h1>
        <div class="flex items-center gap-3 text-sm mt-1">
            <span class="font-semibold text-(--secondary-color)/70">#HK-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
            <span class="text-(--text-color)/50">•</span>
            <span class="text-(--text-dark)/50">Placed on {{ $order->created_at?->format('F j, Y \a\t g:i A') }}</span>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-12 gap-6">

        <!-- Order Summary -->
        <div class="xl:col-span-5 bg-(--card-dark) rounded-3xl shadow-sm hover:shadow-md border border-(--text-color)/20 p-6 lg:p-8 transition-all duration-300">
            <h2 class="text-xl font-semibold mb-6 flex items-center gap-2">
                <i data-lucide="package" class="w-6 h-6 text-(--primary-color)"></i>
                Order Summary
            </h2>

            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Order Status -->
                    <div>
                        <label class="block text-sm font-medium text-(--text-color) mb-2">Order Status</label>
                        <div class="relative">
                            <select
                                class="w-full bg-(--text-light) border border-(--bg-color)/30 focus:outline-none focus:border-(--secondary-color) rounded-2xl px-5 py-4 text-base appearance-none transition-all">
                                @foreach ($orderStatusOptions as $value => $label)
                                    <option value="{{ $value }}" @selected($order->status === $value)>{{ $label }}</option>
                                @endforeach
                            </select>
                            <div class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-(--text-color)">
                                <i data-lucide="chevron-down" class="w-5 h-5"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Status -->
                    <div>
                        <label class="block text-sm font-medium text-(--text-color) mb-2">Payment Status</label>
                        <div class="relative">
                            <select id="paymentStatus"
                                class="w-full bg-(--text-light) border border-(--bg-color)/30 focus:outline-none focus:border-(--secondary-color) rounded-2xl px-5 py-4 text-base appearance-none transition-all">
                                @foreach ($paymentStatusOptions as $value => $label)
                                    <option value="{{ $value }}" @selected(($payment->status ?? 'pending') === $value)>{{ $label }}</option>
                                @endforeach
                            </select>
                            <div class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-(--text-color)">
                                <i data-lucide="chevron-down" class="w-5 h-5"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-6 text-sm">
                    <div>
                        <p class="text-(--text-dark)">Transaction ID</p>
                        <p class="font-semibold mt-1 break-all">{{ $payment?->transaction_id ?? $order->transaction_id ?? '—' }}</p>
                    </div>
                    <div>
                        <p class="text-(--text-dark)">Payment Date</p>
                        <p class="font-semibold mt-1 flex gap-2">
                            @if ($payment?->paid_at)
                                <span>{{ $payment->paid_at->format('Y-m-d') }}</span>
                                <span>{{ $payment->paid_at->format('g:i A') }}</span>
                            @else
                                <span>Not paid yet</span>
                            @endif
                        </p>
                    </div>
                    <div>
                        <p class="text-(--text-dark)">Payment Method</p>
                        <p class="font-semibold mt-1">{{ ucfirst($payment?->gateway ?? $order->payment_method ?? '—') }}</p>
                    </div>
                    <div>
                        <p class="text-(--text-dark)">Reference ID</p>
                        <p class="font-semibold mt-1 break-all">{{ $payment?->reference_id ?? '—' }}</p>
                    </div>
                </div>

                <div class="bg-(--primary-color)/70 border border-(--bg-color)/30 rounded-2xl p-5 text-sm flex gap-3">
                    <i data-lucide="info" class="w-5 h-5 text-(--text-light) mt-0.5 shrink-0"></i>
                    <p class="text-(--text-light)">Update the order status, payment status and click Save to notify the customer.</p>
                </div>

                <div class="flex gap-3 pt-4">
                    <a href="{{ route('order') }}"
                        class="flex-1 text-center py-4 border border-(--secondary-color) hover:bg-(--card-bg) bg-(--text-light)/70 rounded-2xl font-medium transition-all duration-200">
                        Cancel
                    </a>
                    <button type="button" disabled title="Status updates aren't wired up yet"
                        class="flex-1 py-4 bg-(--secondary-color)/60 cursor-not-allowed text-(--text-light) rounded-2xl font-medium transition-all duration-200">
                        Save Changes
                    </button>
                </div>
            </div>
        </div>

        <!-- Customer & Shipping -->
        <div class="xl:col-span-7 grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Customer Info -->
            <div class="bg-(--card-dark) rounded-3xl shadow-sm hover:shadow-md border border-(--text-color)/20 p-6 lg:p-8 transition-all duration-200">
                <h2 class="text-xl font-semibold mb-6">Customer Information</h2>
                <div class="flex items-start gap-4">
                    <div
                        class="w-12 h-12 bg-(--card-bg) text-(--text-color) rounded-2xl flex items-center justify-center text-lg font-semibold shrink-0">
                        {{ $initials }}
                    </div>
                    <div class="space-y-4 min-w-0 flex-1">
                        <p class="text-lg font-semibold">{{ $customer->name ?? 'Unknown Customer' }}</p>
                        <div class="space-y-3">
                            <div class="flex items-center gap-3 min-w-0">
                                <i data-lucide="mail" class="w-5 h-5 text-(--text-color)/60 shrink-0"></i>
                                @if ($customer?->email)
                                    <a href="mailto:{{ $customer->email }}"
                                        class="hover:text-(--text-color) text-(--text-color)/90 transition break-all">{{ $customer->email }}</a>
                                @else
                                    <span class="text-(--text-color)/60">—</span>
                                @endif
                            </div>
                            <div class="flex items-center gap-3 min-w-0">
                                <i data-lucide="phone" class="w-5 h-5 text-(--text-color)/60 shrink-0"></i>
                                @if ($customer?->phone)
                                    <a href="tel:{{ $customer->phone }}" class="hover:text-(--text-color) text-(--text-color)/90 transition break-all">{{ $customer->phone }}</a>
                                @else
                                    <span class="text-(--text-color)/60">—</span>
                                @endif
                            </div>
                            <div class="flex items-center gap-3 min-w-0">
                                <i data-lucide="map-pin" class="w-5 h-5 text-(--text-color)/60 shrink-0"></i>
                                <span class="break-words">{{ $order->shippingAddress?->city ?? '—' }}{{ $order->shippingAddress?->country ? ', '.$order->shippingAddress->country : '' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Shipping Address -->
            <div class="bg-(--card-dark) rounded-3xl shadow-sm hover:shadow-md border border-(--text-color)/20 p-6 lg:p-8 transition-all duration-200">
                <h2 class="text-xl font-semibold mb-6">Shipping Address</h2>
                @if ($order->shippingAddress)
                    <div class="space-y-2 text-lg leading-relaxed">
                        <p>{{ $order->shippingAddress->address }}</p>
                        <p>{{ $order->shippingAddress->city }}, {{ $order->shippingAddress->province }}</p>
                        <p>{{ $order->shippingAddress->country }}</p>
                        <p class="pt-3 font-medium">{{ $order->shippingAddress->phone }}</p>
                    </div>
                @else
                    <p class="text-(--text-color)/60">No shipping address on file for this order.</p>
                @endif
            </div>
        </div>

        <!-- Order Items -->
        <div class="xl:col-span-12 bg-(--card-dark) rounded-3xl shadow-sm hover:shadow-md border border-(--text-color)/20 overflow-hidden transition-all duration-300">
            <div class="px-6 lg:px-8 py-5 border-b bg-(--card-bg)">
                <h2 class="text-xl font-semibold">Order Items</h2>
            </div>
            <div class="divide-y">
                @forelse ($items as $item)
                    <div class="p-6 lg:p-8 flex flex-col sm:flex-row sm:items-center gap-5">
                        <img src="{{ $item->product?->primaryImageUrl() ?? asset('images/placeholder.png') }}"
                            class="w-20 h-20 object-cover rounded-2xl" alt="{{ $item->product?->name ?? 'product' }}">
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-lg">{{ $item->product?->name ?? 'Product removed' }}</p>
                            <p class="text-(--text-dark)/70 text-sm">
                                SKU: {{ $item->variant?->sku ?? $item->product?->sku ?? '—' }}
                                @if ($item->variant && ($item->variant->size || $item->variant->color))
                                    &nbsp;•&nbsp;{{ collect([$item->variant->size, $item->variant->color])->filter()->join(' / ') }}
                                @endif
                            </p>
                        </div>
                        <div class="text-right sm:text-center">
                            <p class="font-semibold">Rs. {{ number_format($item->price, 2) }}</p>
                            <p class="text-sm text-(--text-dark)/70">Qty: {{ $item->quantity }}</p>
                        </div>
                        <div class="text-right font-semibold text-lg sm:w-28">Rs. {{ number_format($item->subtotal, 2) }}</div>
                    </div>
                @empty
                    <div class="p-6 lg:p-8 text-center text-(--text-color)/60">No items found for this order.</div>
                @endforelse
            </div>
        </div>

        <!-- Totals -->
        <div class="xl:col-span-5">
            <div class="bg-(--card-dark) rounded-3xl shadow-sm hover:shadow-md border border-(--text-color)/20 p-6 lg:p-8">
                <h2 class="text-xl font-semibold mb-6">Order Totals</h2>
                <div class="space-y-4 text-[15px]">
                    <div class="flex justify-between">
                        <span class="text-(--text-dark)/70">Items Subtotal</span>
                        <span class="font-medium">Rs. {{ number_format($subtotal, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-(--text-dark)/70">Discount</span>
                        <span class="text-(--secondary-color) font-medium">- Rs. {{ number_format($order->discount, 2) }}</span>
                    </div>
                    <div class="h-px bg-(--text-color) my-2"></div>
                    <div class="flex justify-between text-lg font-semibold">
                        <span>Order Total</span>
                        <span>Rs. {{ number_format($order->total_amount, 2) }}</span>
                    </div>
                    <p class="text-xs text-(--text-dark)/50 pt-1">Order Total reflects the full order as paid by the
                        customer; Items Subtotal reflects only the items in this order.</p>
                </div>
            </div>
        </div>
    </div>
</x-seller_layout>