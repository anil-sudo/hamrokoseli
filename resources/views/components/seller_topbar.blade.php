<header
                class="sticky top-0 z-30 w-full bg-[#1E2A44] border-b border-(--primary-color)/15 shadow-sm backdrop-blur-md">
                <div class="flex items-center gap-3 w-full px-4 md:px-8 py-3 justify-between">

                    <button id="menu-btn" class="md:hidden text-(--text-light) mr-2">
                        <i data-lucide="menu" class="text-xl"></i>
                    </button>

                    {{-- Search Bar --}}
                    <div class="flex-1 min-w-0 md:max-w-md">
                        <div class="relative bg-(--text-light) rounded-full">
                            <i data-lucide="search" class="h-5 w-5 absolute left-3 top-1/2 -translate-y-1/2 text-(--text-color)"></i>
                            <input type="text" id="seller-search-input" value="{{ request('search') }}"
                                placeholder="{{ $searchPlaceholder ?? 'Search...' }}"
                                onkeydown="if(event.key==='Enter'){event.preventDefault(); if(window.sellerSearchHandler){window.sellerSearchHandler(this.value);}}"
                                class="w-full py-2 pl-10 pr-4 text-sm rounded-full focus:outline-none">
                        </div>
                    </div>

                    {{-- Right Icons --}}
                    <div class="flex items-center gap-3">
                        {{-- Notification Bell --}}
                        <a href="{{ route('seller-notification') }}"
                            class="relative p-3 text-(--text-color) cursor-pointer hover:scale-110 transition-transform">
                            <i data-lucide="bell" class="w-5 fill-current text-(--text-light)"></i>
                        </a>

                        {{-- Profile --}}
                        <a href="{{ route('seller.profile') }}"
                            class="w-8 h-8 bg-(--text-light) rounded-full flex items-center justify-center cursor-pointer hover:scale-110 transition-transform overflow-hidden">
                            @if(Auth::user()->profile_pic)
                                <img src="{{ asset('storage/' . Auth::user()->profile_pic) }}" alt="Profile" class="w-full h-full object-cover">
                            @else
                                <span class="text-sm font-bold text-(--text-color)">{{ strtoupper(substr(Auth::user()->name ?? 'V', 0, 1)) }}</span>
                            @endif
                        </a>
                    </div>
                </div>
            </header>