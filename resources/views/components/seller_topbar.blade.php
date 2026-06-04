            <header
                class="sticky top-0 z-30 w-full bg-(--primary-color) border-b border-(--primary-color)/15 shadow-sm backdrop-blur-md">
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
                        <a href="#"
                            class="relative p-3 text-white hover:bg-white/10 hover:text-(--hover-color) active:bg-white/20 rounded-3xl transition-all duration-200 group">
                            <i class="fas fa-bell text-xl"></i>
                            <span class="absolute top-2 right-2 flex h-5 w-5 items-center justify-center">
                                <span
                                    class="animate-ping absolute inline-flex h-4 w-4 rounded-full bg-red-400 opacity-75"></span>
                                <span
                                    class="relative inline-flex rounded-full h-4 w-4 bg-red-500 text-[10px] font-medium items-center justify-center ring-2 ring-(--primary-color)">
                                    3
                                </span>
                            </span>
                        </a>

                        {{-- Profile --}}
                        <a href=""
                            class="w-8 h-8 bg-(--text-light) rounded-full flex items-center justify-center hover:bg-(--hover-color) cursor-pointer hover:scale-110 transition-transform">
                            <i class="fas fa-user text-(--text-color)"></i>
                        </a>
                    </div>
                </div>
            </header>
