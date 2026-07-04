<x-user-layout title="Notifications">
    <div class="space-y-8">

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-(--text-color)">Notifications</h1>
                <p class="text-sm text-(--text-color)/70 mt-1">Stay updated with your orders, deliveries, and account.</p>
            </div>
            @if ($unreadCount > 0)
                <form method="POST" action="{{ route('user.notifications.markAllRead') }}">
                    @csrf
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-(--text-dark) bg-(--text-light) border border-(--text-color)/20 rounded-2xl hover:bg-(--card-dark) transition">
                        <i data-lucide="check" class="w-4 h-4"></i>
                        Mark all as read
                        <span class="bg-(--secondary-color) text-white text-xs px-2 py-0.5 rounded-full">{{ $unreadCount }}</span>
                    </button>
                </form>
            @endif
        </div>

        @if (session('success'))
            <div class="flex items-center gap-3 px-5 py-4 rounded-2xl bg-(--primary-color)/10 border border-(--primary-color)/25 text-(--primary-color) text-sm font-medium">
                <i data-lucide="check-circle-2" class="w-5 h-5 shrink-0"></i>
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabs -->
        @php
            $tabs = [
                null         => 'All',
                'orders'     => 'Orders',
                'deliveries' => 'Deliveries',
                'account'    => 'Account',
            ];
            $active = $type ?? null;
        @endphp

        <div class="flex flex-wrap border-b border-(--secondary-color)/20">
            @foreach ($tabs as $key => $label)
                <a href="{{ route('user-notification', $key ? ['type' => $key] : []) }}"
                    class="flex-1 sm:flex-none px-4 sm:px-8 py-3 sm:py-4 text-sm font-semibold border-b-2 transition
                        {{ $active === $key
                            ? 'text-(--secondary-color) border-(--secondary-color)'
                            : 'text-(--text-color) border-transparent hover:text-(--secondary-color)' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>

        <!-- Notification List -->
        @php
            $iconMap = [
                'order_placed'     => ['icon' => 'shopping-bag',  'bg' => 'bg-blue-100',               'color' => 'text-blue-600'],
                'order_confirmed'  => ['icon' => 'check-circle',  'bg' => 'bg-blue-100',               'color' => 'text-blue-600'],
                'order_shipped'    => ['icon' => 'truck',          'bg' => 'bg-(--primary-color)/20',   'color' => 'text-(--primary-color)'],
                'order_delivered'  => ['icon' => 'package-check', 'bg' => 'bg-green-100',              'color' => 'text-green-600'],
                'order_cancelled'  => ['icon' => 'x-circle',      'bg' => 'bg-red-100',                'color' => 'text-red-500'],
                'return_requested' => ['icon' => 'rotate-ccw',    'bg' => 'bg-amber-100',              'color' => 'text-amber-600'],
                'return_approved'  => ['icon' => 'badge-check',   'bg' => 'bg-green-100',              'color' => 'text-green-600'],
                'payment_received' => ['icon' => 'credit-card',   'bg' => 'bg-(--card-dark)',          'color' => 'text-amber-600'],
                'payout_processed' => ['icon' => 'banknote',      'bg' => 'bg-(--card-dark)',          'color' => 'text-amber-600'],
            ];
        @endphp

        <div class="space-y-4">
            @forelse ($notifications as $notification)
                @php
                    $meta = $iconMap[$notification->type] ?? ['icon' => 'bell', 'bg' => 'bg-(--card-dark)', 'color' => 'text-(--text-color)'];
                @endphp

                <div id="notif-{{ $notification->id }}"
                    class="bg-(--card-bg) rounded-2xl p-6 shadow-sm border transition-all duration-300
                        {{ $notification->is_read ? 'border-(--text-color)/10' : 'border-(--secondary-color)/30 bg-orange-50/30' }}
                        hover:shadow-md flex gap-5"
                    data-id="{{ $notification->id }}"
                    data-read="{{ $notification->is_read ? '1' : '0' }}">

                    <!-- Icon -->
                    <div class="w-12 h-12 {{ $meta['bg'] }} rounded-2xl flex items-center justify-center shrink-0">
                        <i data-lucide="{{ $meta['icon'] }}" class="w-5 h-5 {{ $meta['color'] }}"></i>
                    </div>

                    <!-- Content -->
                    <div class="flex-1 min-w-0">
                        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-1">
                            <h3 class="font-semibold text-(--text-color) flex items-center gap-2">
                                {{ $notification->title }}
                                @if (! $notification->is_read)
                                    <span class="w-2 h-2 bg-(--secondary-color) rounded-full shrink-0"></span>
                                @endif
                            </h3>
                            <span class="text-xs text-(--text-color)/60 shrink-0">
                                {{ $notification->created_at->diffForHumans() }}
                            </span>
                        </div>

                        <p class="text-(--text-color)/80 mt-1 text-sm">{{ $notification->message }}</p>

                        <!-- Actions -->
                        <div class="flex items-center gap-3 mt-4">
                            @if (in_array($notification->type, ['order_placed','order_confirmed','order_shipped','order_delivered','order_cancelled']))
                                <a href="{{ route('User-orders') }}"
                                    class="px-4 py-2 bg-(--secondary-color) hover:bg-[#B94E31] text-white rounded-xl text-xs font-medium transition">
                                    View Orders
                                </a>
                            @elseif (in_array($notification->type, ['return_requested','return_approved']))
                                <a href="{{ route('User-orders') }}"
                                    class="px-4 py-2 bg-(--secondary-color) hover:bg-[#B94E31] text-white rounded-xl text-xs font-medium transition">
                                    View Returns
                                </a>
                            @endif

                            @if (! $notification->is_read)
                                <button onclick="markRead({{ $notification->id }})"
                                    class="text-xs text-(--text-color)/50 hover:text-(--secondary-color) transition">
                                    Mark as read
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-(--card-bg) rounded-2xl p-16 text-center border border-(--text-color)/10">
                    <i data-lucide="bell-off" class="w-12 h-12 mx-auto text-(--text-color)/30 mb-4"></i>
                    <p class="text-(--text-color)/60 font-medium">
                        No {{ $active ? $active : '' }} notifications yet.
                    </p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if ($notifications->hasPages())
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                <p class="text-sm text-(--text-dark)/50">
                    Showing <span class="font-medium text-(--text-dark)">{{ $notifications->firstItem() }}–{{ $notifications->lastItem() }}</span>
                    of <span class="font-medium text-(--text-dark)">{{ $notifications->total() }}</span>
                </p>
                <div class="flex items-center gap-2">
                    @if ($notifications->onFirstPage())
                        <button disabled class="w-10 h-10 flex items-center justify-center border border-gray-300 rounded-2xl opacity-40 cursor-not-allowed">
                            <i data-lucide="chevron-left" class="w-3 h-3"></i>
                        </button>
                    @else
                        <a href="{{ $notifications->previousPageUrl() }}" class="w-10 h-10 flex items-center justify-center border border-gray-300 rounded-2xl hover:bg-[#1F3D2E] hover:text-white transition">
                            <i data-lucide="chevron-left" class="w-3 h-3"></i>
                        </a>
                    @endif

                    @foreach ($notifications->getUrlRange(max(1, $notifications->currentPage() - 2), min($notifications->lastPage(), $notifications->currentPage() + 2)) as $page => $url)
                        @if ($page == $notifications->currentPage())
                            <button class="w-10 h-10 bg-[#1F3D2E] text-white rounded-2xl font-medium text-sm">{{ $page }}</button>
                        @else
                            <a href="{{ $url }}" class="w-10 h-10 flex items-center justify-center border border-gray-300 rounded-2xl hover:bg-[#1F3D2E] hover:text-white transition">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if ($notifications->hasMorePages())
                        <a href="{{ $notifications->nextPageUrl() }}" class="w-10 h-10 flex items-center justify-center border border-gray-300 rounded-2xl hover:bg-[#1F3D2E] hover:text-white transition">
                            <i data-lucide="chevron-right" class="w-3 h-3"></i>
                        </a>
                    @else
                        <button disabled class="w-10 h-10 flex items-center justify-center border border-gray-300 rounded-2xl opacity-40 cursor-not-allowed">
                            <i data-lucide="chevron-right" class="w-3 h-3"></i>
                        </button>
                    @endif
                </div>
            </div>
        @endif
    </div>

    <script>
        function markRead(id) {
            fetch(`/user-notification/${id}/read`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                        || '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                }
            }).then(res => {
                if (res.ok) {
                    const el = document.getElementById('notif-' + id);
                    // Remove unread dot and highlight
                    el.classList.remove('border-(--secondary-color)/30', 'bg-orange-50/30');
                    el.classList.add('border-(--text-color)/10');
                    el.querySelector('.w-2.h-2')?.remove();
                    el.querySelector('button[onclick]')?.remove();
                }
            });
        }
    </script>
</x-user-layout>