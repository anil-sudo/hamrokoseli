<header id="site-header">

    <!-- 1. Top Thin Bar (hidden on very small screens to save space) -->
    <div class="bg-[#F5E8D6] text-[#2c2523] text-[11px] font-medium py-1.5 px-4 border-b border-[#ebd7be] hidden sm:block">
        <div class="max-w-7xl mx-auto flex items-center justify-between gap-2">
            <!-- Left -->
            <a href="{{ route('seller.login') }}" class="flex items-center gap-1.5 hover:text-[#b55b3d] transition-colors">
                <i class="fas fa-house text-[#b55b3d]"></i>
                <span>Sell on Hamro Koseli</span>
            </a>
            <!-- Right -->
            <div class="flex items-center gap-3">
                <a href="{{ route('seller.login') }}" class="hover:text-[#b55b3d] transition-colors">Become a Seller</a>
                <span class="text-gray-400">|</span>
                <span>Support local artisans &bull; Free shipping on orders over Rs.999</span>
            </div>
        </div>
    </div>

    <!-- 2. Main Navbar -->
    <div class="bg-[#1f3d2e] text-white px-4 py-3 border-b border-emerald-950/40">
        <div class="max-w-7xl mx-auto flex items-center justify-between gap-3">

            <!-- LEFT: Hamburger (mobile only) + Logo -->
            <div class="flex items-center gap-3">
                <!-- Hamburger button – visible only on mobile -->
                <button id="hamburger-btn"
                    class="md:hidden text-white hover:text-emerald-200 transition-colors p-1 shrink-0"
                    aria-label="Open menu" aria-expanded="false">
                    <svg id="icon-menu" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                <!-- Logo -->
                <a href="{{ url('/') }}" class="flex items-center gap-2.5 group shrink-0">
                    <img src="{{ asset('images/logo.png') }}" alt="Hamro Koseli Logo"
                        class="w-10 h-10 bg-white object-contain rounded-full shadow-md transform group-hover:scale-105 transition duration-300">
                    <div>
                        <div class="text-lg md:text-xl font-extrabold tracking-wide leading-none text-white">HAMRO KOSELI</div>
                        <span class="text-[9px] text-emerald-200/90 tracking-wide font-medium hidden sm:block">Special Koseli for Special People</span>
                    </div>
                </a>
            </div>

            <!-- CENTER: Search bar (visible on md+; collapses on mobile) -->
            <form action="{{ route('shop') }}" method="GET"
                class="search-wrap hidden md:flex flex-1 max-w-lg mx-4 items-center bg-[#FDFBF7] rounded-full px-4 py-2 border border-emerald-950/10 shadow-inner">
                <i class="fas fa-search text-slate-400 mr-2"></i>
                <input type="text" name="search" id="desktop-search" placeholder="Search Products....."
                    class="w-full bg-transparent border-0 focus:outline-none text-sm text-slate-800 placeholder-slate-400 font-medium">
            </form>

            <!-- RIGHT: Actions -->
            <div class="flex items-center gap-3 shrink-0">
                <!-- Sign In / Account – hidden on mobile (available inside drawer) -->
                @guest
                    <a href="{{ route('userlogin') }}" id="desktop-signin"
                        class="hidden md:inline-flex rounded-full border border-white/90 text-white font-semibold px-5 py-1.5 text-sm hover:bg-white hover:text-[#1f3d2e] transition-all duration-300 active:scale-95 shadow-sm">
                        Sign In
                    </a>
                @else
                    <div class="hidden md:flex items-center gap-2 relative" id="account-menu-wrap">
                        <button id="account-menu-btn" type="button"
                            class="inline-flex items-center gap-2 rounded-full border border-white/90 text-white font-semibold px-4 py-1.5 text-sm hover:bg-white hover:text-[#1f3d2e] transition-all duration-300 active:scale-95 shadow-sm">
                            <i class="far fa-user-circle"></i>
                            <span>Hello, {{ explode(' ', auth()->user()->name)[0] }}</span>
                            <i class="fas fa-chevron-down text-[10px]"></i>
                        </button>
                        <div id="account-menu-dropdown"
                            class="hidden absolute right-0 top-full mt-2 w-48 bg-white rounded-xl shadow-lg border border-slate-100 py-2 z-50">
                            <div class="px-4 py-2 border-b border-slate-100">
                                <p class="text-xs text-slate-400">Signed in as</p>
                                <p class="text-sm font-semibold text-slate-800 truncate">{{ auth()->user()->name }}</p>
                            </div>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 flex items-center gap-2 font-semibold">
                                    <i class="fas fa-sign-out-alt"></i>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @endguest

                <!-- Icons -->
                <div class="flex items-center gap-3 text-white text-lg">
                    <!-- Search icon (mobile only) -->
                    <button id="mobile-search-btn" class="md:hidden hover:text-emerald-200 transition-colors p-1" aria-label="Search">
                        <i class="fas fa-search"></i>
                    </button>
                    @auth
                        <!-- Wishlist -->
                        <a href="{{ route('wishlist') }}" class="hover:text-emerald-200 transition-colors p-1 relative flex items-center justify-center" title="Wishlist" id="wishlist-header-btn">
                            <i class="far fa-heart" id="wishlist-header-icon"></i>
                            <span id="wishlist-badge" class="absolute -top-1.5 -right-1.5 bg-[#b55b3d] text-white text-[9px] w-4.5 h-4.5 rounded-full flex items-center justify-center font-bold border border-[#1f3d2e] hidden">0</span>
                        </a>
                        <!-- Cart -->
                        <a href="{{ route('cart') }}" class="hover:text-emerald-200 transition-colors p-1 relative flex items-center justify-center" title="Cart" id="cart-header-btn">
                            <i class="fas fa-shopping-cart" id="cart-header-icon"></i>
                            <span id="cart-badge" class="absolute -top-1.5 -right-1.5 bg-[#b55b3d] text-white text-[9px] w-4.5 h-4.5 rounded-full flex items-center justify-center font-bold border border-[#1f3d2e] hidden">0</span>
                        </a>
                    @endauth
                    <!-- Logout icon (always visible, logged-in users only) -->
                    @auth
                        <form action="{{ route('logout') }}" method="POST" class="m-0 p-0">
                            @csrf
                            <button type="submit" class="hover:text-red-300 transition-colors p-1" title="Logout">
                                <i class="fas fa-sign-out-alt"></i>
                            </button>
                        </form>
                    @endauth
                </div>
            </div>

        </div>

        <!-- Mobile search bar (slides down when toggled) -->
        <div id="mobile-search-bar" class="hidden md:hidden mt-2 max-w-full">
            <form action="{{ route('shop') }}" method="GET"
                class="search-wrap flex items-center bg-[#FDFBF7] rounded-full px-4 py-2 border border-emerald-950/10 shadow-inner">
                <i class="fas fa-search text-slate-400 mr-2"></i>
                <input type="text" name="search" id="mobile-search" placeholder="Search Products....."
                    class="w-full bg-transparent border-0 focus:outline-none text-sm text-slate-800 placeholder-slate-400 font-medium">
            </form>
        </div>
    </div>

    <!-- 3. Desktop Sub-Navbar - WITH ICONS FOR ALL ITEMS INCLUDING NEW ARRIVALS -->
    <div class="bg-[#1f3d2e] px-4 py-2.5 hidden md:block border-t border-emerald-900/30">
        <div class="max-w-7xl mx-auto">
            <div class="desktop-nav-container">
                <ul class="desktop-nav-links">
                    <li><a href="{{ url('/') }}" class="subnav-link {{ Request::is('/') ? 'active' : '' }}"><i class="fas fa-home"></i> Home</a></li>
                    <li><a href="{{ url('categories') }}" class="subnav-link {{ Request::is('categories*') ? 'active' : '' }}"><i class="fas fa-th-large"></i> Category</a></li>
                    <li><a href="{{ url('shop') }}" class="subnav-link {{ Request::is('shop*') ? 'active' : '' }}"><i class="fas fa-store"></i> Shop</a></li>
                    <li><a href="{{ url('todays-deals') }}" class="subnav-link {{ Request::is('todays-deals*') ? 'active' : '' }}"><i class="fas fa-tag"></i> Today's Deals</a></li>
                    <li><a href="{{ url('top-sellers') }}" class="subnav-link {{ Request::is('top-sellers*') ? 'active' : '' }}"><i class="fas fa-trophy"></i> Top Sellers</a></li>
                    <li><a href="{{ url('new-arrivals') }}" class="subnav-link {{ Request::is('new-arrivals*') ? 'active' : '' }}"><i class="fa-solid fa-mobile-screen-button"></i> New Arrivals</a></li>
                </ul>
            </div>
        </div>
    </div>

</header>

<!-- ===== OVERLAY ===== -->
<div id="drawer-overlay" aria-hidden="true"></div>

<!-- ===== MOBILE DRAWER - WITH ICONS FOR ALL ITEMS INCLUDING NEW ARRIVALS ===== -->
<aside id="mobile-drawer" aria-label="Mobile Navigation" role="dialog">
    <!-- Drawer header -->
    <div class="flex items-center justify-between px-5 py-4 border-b border-white/10">
        <div class="flex items-center gap-2.5">
            <img src="{{ asset('images/logo.png') }}" alt="Hamro Koseli" class="w-9 h-9 bg-white rounded-full object-contain">
            <span class="font-extrabold text-white text-base">HAMRO KOSELI</span>
        </div>
        <!-- Close button -->
        <button id="close-drawer-btn" class="text-white/80 hover:text-white transition-colors p-1" aria-label="Close menu">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    <!-- Login / Signup buttons in drawer -->
    <div class="flex gap-3 px-5 py-4 border-b border-white/10">
        @guest
            <a href="{{ route('userlogin') }}" id="mobile-signin"
                class="flex-1 text-center rounded-full border border-white text-white font-semibold py-2 text-sm hover:bg-white hover:text-[#1f3d2e] transition-all duration-300">
                Login
            </a>
            <a href="{{ route('userregister') }}" id="mobile-signup"
                class="flex-1 text-center rounded-full bg-white text-[#1f3d2e] font-semibold py-2 text-sm hover:bg-emerald-100 transition-all duration-300">
                Sign Up
            </a>
        @else
            <div class="flex-1 text-center text-white font-semibold py-2 text-sm">
                <i class="far fa-user-circle mr-1.5"></i>Hello, {{ explode(' ', auth()->user()->name)[0] }}
            </div>
            <form action="{{ route('logout') }}" method="POST" class="flex-1">
                @csrf
                <button type="submit"
                    class="w-full text-center rounded-full bg-white text-red-600 font-semibold py-2 text-sm hover:bg-red-50 transition-all duration-300 flex items-center justify-center gap-1.5">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </button>
            </form>
        @endguest
    </div>

    <!-- Navigation links with icons for ALL items (including New Arrivals) -->
    <nav>
        <a href="{{ url('/') }}"          class="mob-nav-link {{ Request::is('/') ? 'active' : '' }}"><i class="fas fa-home"></i>Home</a>
        <a href="{{ url('categories') }}"     class="mob-nav-link {{ Request::is('categories*') ? 'active' : '' }}"><i class="fas fa-th-large"></i>Category</a>
        <a href="{{ url('shop') }}"           class="mob-nav-link {{ Request::is('shop*') ? 'active' : '' }}"><i class="fas fa-store"></i>Shop</a>
        <a href="{{ url('todays-deals') }}"      class="mob-nav-link {{ Request::is('todays-deals*') ? 'active' : '' }}"><i class="fas fa-tag"></i>Today's Deals</a>
        <a href="{{ url('top-sellers') }}"       class="mob-nav-link {{ Request::is('top-sellers*') ? 'active' : '' }}"><i class="fas fa-trophy"></i>Top Sellers</a>
        <a href="{{ url('new-arrivals') }}"   class="mob-nav-link {{ Request::is('new-arrivals*') ? 'active' : '' }}"><i class="fa-solid fa-mobile-screen-button"></i>New Arrivals</a>
        @auth
            @if(auth()->user()->hasRole('vendor'))
                <a href="{{ route('dashboard') }}" class="mob-nav-link"><i class="fas fa-store"></i>Seller Dashboard</a>
            @else
                <a href="{{ route('seller') }}" class="mob-nav-link"><i class="fas fa-store"></i>Become a Seller</a>
            @endif
        @else
            <a href="{{ route('seller') }}" class="mob-nav-link"><i class="fas fa-store"></i>Become a Seller</a>
        @endauth
    </nav>

    <!-- Support note at bottom -->
    <div class="px-5 py-4 mt-2 text-emerald-200/70 text-xs text-center">
        Support local artisans &bull; Free shipping on orders over Rs.999
    </div>
</aside>