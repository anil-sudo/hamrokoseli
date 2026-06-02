            <header
                class="sticky top-0 z-30 w-full bg-(--primary-color) border-b border-(--primary-color)/15% shadow-sm">
                <div class="flex items-center gap-3 w-full px-4 md:px-8 py-3 justify-between">
                    <button id="menu-btn" class="md:hidden text-white mr-2">

                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    {{-- Search Bar --}}
                    <div class="flex-1 min-w-0 md:max-w-md">
                        <div class="relative bg-(--text-light) rounded-full">
                            <i class="absolute left-3 top-1/2 -translate-y-1/2 text-(--text-color) fas fa-search"></i>
                            <input type="text" placeholder="{{ $searchPlaceholder ?? 'Search...' }}"
                                class="w-full py-2 pl-10 pr-4 text-sm rounded-full focus:outline-none">
                        </div>
                    </div>

                    {{-- Right Icons --}}
                    <div class="flex items-center gap-3">
                        {{-- Notification Bell --}}
                        <a href="" class="relative p-1 text-(--text-light) hover:text-(--hover-color)">
                            <i class="fas fa-bell text-lg"></i>
                            <span class="absolute top-0 right-0 w-2 h-2"></span>
                        </a>

                        {{-- Profile --}}
                        <a href=""
                            class="w-8 h-8 bg-(--text-light) rounded-full flex items-center justify-center hover:bg-(--hover-color) transition">
                            <i class="fas fa-user text-(--text-color)"></i>
                        </a>
                    </div>
                </div>
            </header>
