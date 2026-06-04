<style>
    .nav-link {
        transition: all 0.2s ease;
    }

    .nav-link:hover {
        transform: translateX(3px);
    }
</style>
<aside id="sidebar"
    class="fixed top-0 left-0 z-50 h-dvh w-72 bg-[#1A3D2E] -translate-x-full md:translate-x-0 transition-transform duration-300 flex flex-col ">
    <!-- Brand / Logo Section -->
    <div class="px-6 pt-8 pb-6 border-b border-white/10">
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logo.jpeg') }}" alt="HamroKoseli Logo" class="w-10 h-10 rounded-full object-cover">

            <div class="transition-all duration-300 hover:translate-x-1">
                <h1 class="text-2xl font-bold tracking-tight text-[#FFF7EF] ">
                    HamroKoseli</h1>
                <p class="text-xs text-[#FFF7EF] font-medium mt-0.5">Seller Portal</p>
            </div>
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="navbar flex-1 px-4 py-2 space-y-1.5 overflow-y-auto scroll-smooth">
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}"
            class="nav-link flex items-center gap-4 px-4 py-3 rounded-xl  hover:bg-[#D4A017] group transition-all duration-300 ease-out active:scale-[0.98]
            {{ Request::routeIs('dashboard') ? 'bg-(--hover-color) text-(--text-color)! ' : '' }}">
            <i class="fas fa-tachometer-alt w-5 text-lg transition-transform duration-300 group-hover:scale-110"></i>
            <span class="font-medium transition-all duration-300 group-hover:translate-x-1">Dashboard</span>
        </a>

        <!-- Products -->
        <a href=""
            class="nav-link flex items-center gap-4 px-4 py-3 rounded-xl  hover:bg-[#D4A017]  group transition-all duration-300 ease-out active:scale-[0.98]">
            <i class="fas fa-boxes w-5 text-lg transition-transform duration-300 group-hover:scale-110"></i>
            <span class="font-medium transition-all duration-300 group-hover:translate-x-1">Products</span>
        </a>

        <!-- Orders -->
        <a href=""
            class="nav-link flex items-center gap-4 px-4 py-3 rounded-xl  hover:bg-[#D4A017]  group transition-all duration-300 ease-out active:scale-[0.98]">
            <i class="fas fa-shopping-cart w-5 text-lg transition-transform duration-300 group-hover:scale-110"></i>
            <span class="font-medium transition-all duration-300 group-hover:translate-x-1">Orders</span>
        </a>

        <!-- Payments -->
        <a href=""
            class="nav-link flex items-center gap-4 px-4 py-3 rounded-xl  hover:bg-[#D4A017]  group transition-all duration-300 ease-out active:scale-[0.98]">
            <i class="fas fa-wallet w-5 text-lg transition-transform duration-300 group-hover:scale-110"></i>
            <span class="font-medium transition-all duration-300 group-hover:translate-x-1">Payments</span>
        </a>

        <!-- Reviews -->
        <a href=""
            class="nav-link flex items-center gap-4 px-4 py-3 rounded-xl hover:bg-[#D4A017] group transition-all duration-300 ease-out active:scale-[0.98]">
            <i class="fas fa-star w-5 text-lg transition-transform duration-300 group-hover:scale-110"></i>
            <span class="font-medium transition-all duration-300 group-hover:translate-x-1">Reviews</span>
        </a>

        <!-- Reviews -->
        <a href=""
            class="nav-link flex items-center gap-4 px-4 py-3 rounded-xl hover:bg-[#D4A017] group transition-all duration-300 ease-out active:scale-[0.98]">
            <i class="fas fa-user w-5 text-lg transition-transform duration-300 group-hover:scale-110"></i>
            <span class="font-medium transition-all duration-300 group-hover:translate-x-1">Profile</span>
        </a>

        <!-- Reviews -->
        <a href=""
            class="nav-link flex items-center gap-4 px-4 py-3 rounded-xl hover:bg-[#D4A017] group transition-all duration-300 ease-out active:scale-[0.98]">
            <i class="fas fa-bell w-5 text-lg transition-transform duration-300 group-hover:scale-110"></i>
            <span class="font-medium transition-all duration-300 group-hover:translate-x-1">Notification</span>
        </a>
    </nav>

    <div class=" px-4 pb-8 mt-auto border-t border-white/10 pt-4 space-y-4">
        <!-- Add New Product (shown as prominent call to action) -->
        <a href="#"
            class="flex items-center gap-4 px-4 py-3 rounded-xl bg-[#C65A3A]  hover:bg-[#B14E32] text-[#FFF7EF]  transition-all duration-300 active:scale-[0.98] group">
            <i
                class="fas fa-plus-circle w-5 text-[#FFF7EF] text-lg transition-transform duration-300 group-hover:rotate-90"></i>
            <span class="font-semibold group-hover:translate-x-1 transition">Add New Product</span>
        </a>

        <!-- Logout button section with proper spacing and hover effect (original design improved) -->
        <div class="navbar">
            <a href=""
                class="nav-link w-full flex items-center gap-4 px-4 py-3 rounded-xl hover:bg-[#D4A017]  transition-all duration-300 active:scale-[0.98]">
                <i class="fas fa-sign-out-alt w-5 text-lg transition-transform duration-300 group-hover:scale-110"></i>
                <span class="font-medium group-hover:translate-x-1 transition">Logout</span>
            </a>
        </div>
    </div>
</aside>
