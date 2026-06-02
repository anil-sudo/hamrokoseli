<style>
    .nav-link {
        transition: all 0.2s ease;
    }
</style>
<aside id="sidebar"
    class="fixed top-0 left-0 z-50
       h-dvh
       w-72
       bg-[#1A3D2E]
       -translate-x-full md:translate-x-0
       transition-transform duration-300
       flex flex-col">
    <!-- Brand / Logo Section -->
    <div class="px-6 pt-8 pb-6 border-b border-white/10">
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logo.jpeg') }}" alt="HamroKoseli Logo" class="w-10 h-10 rounded-full object-cover">

            <div>
                <h1 class="text-2xl font-bold tracking-tight text-[#FFF7EF] ">
                    HamroKoseli</h1>
                <p class="text-xs text-[#FFF7EF] font-medium mt-0.5">Seller Portal</p>
            </div>
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="navbar flex-1 px-4 py-2 space-y-1.5 overflow-y-auto">
        <!-- Dashboard -->
        <a href="{{ route('seller.dashboard') }}"
            class="nav-link flex items-center gap-4 px-4 py-3 rounded-xl  hover:bg-[#D4A017] group transition nav-active">
            <i class="fas fa-tachometer-alt w-5 text-lg"></i>
            <span class="font-medium">Dashboard</span>
        </a>

        <!-- Products -->
        <a href=""
            class="nav-link flex items-center gap-4 px-4 py-3 rounded-xl  hover:bg-[#D4A017]  group transition">
            <i class="fas fa-boxes w-5 text-lg"></i>
            <span class="font-medium">Products</span>
        </a>

        <!-- Orders -->
        <a href=""
            class="nav-link flex items-center gap-4 px-4 py-3 rounded-xl  hover:bg-[#D4A017]  group transition">
            <i class="fas fa-shopping-cart w-5 text-lg"></i>
            <span class="font-medium">Orders</span>
        </a>

        <!-- Payments -->
        <a href=""
            class="nav-link flex items-center gap-4 px-4 py-3 rounded-xl  hover:bg-[#D4A017]  group transition">
            <i class="fas fa-wallet w-5 text-lg"></i>
            <span class="font-medium">Payments</span>
        </a>

        <!-- Reviews -->
        <a href=""
            class="nav-link flex items-center gap-4 px-4 py-3 rounded-xl hover:bg-[#D4A017] group transition">
            <i class="fas fa-star w-5 text-lg"></i>
            <span class="font-medium">Reviews</span>
        </a>

        <!-- Reviews -->
        <a href=""
            class="nav-link flex items-center gap-4 px-4 py-3 rounded-xl hover:bg-[#D4A017] group transition">
            <i class="fas fa-user w-5 text-lg"></i>
            <span class="font-medium">Profile</span>
        </a>

        <!-- Reviews -->
        <a href=""
            class="nav-link flex items-center gap-4 px-4 py-3 rounded-xl hover:bg-[#D4A017] group transition">
            <i class="fas fa-bell w-5 text-lg"></i>
            <span class="font-medium">Notification</span>
        </a>
    </nav>

    <div class=" px-4 pb-8 mt-auto border-t border-white/10 pt-4 space-y-4">
        <!-- Add New Product (shown as prominent call to action) -->
        <a href="#"
            class="flex items-center gap-4 px-4 py-3 rounded-xl bg-[#C65A3A] a text-[#FFF7EF]  hover:bg-[#C65A3A] transition group">
            <i class="fas fa-plus-circle w-5 text-[#FFF7EF] text-lg"></i>
            <span class="font-semibold">Add New Product</span>
        </a>

        <!-- Logout button section with proper spacing and hover effect (original design improved) -->
        <div class="navbar">
            <a href=""
                class="nav-link w-full flex items-center gap-4 px-4 py-3 rounded-xl hover:bg-[#D4A017] transition group logout-btn">
                <i class="fas fa-sign-out-alt w-5 text-lg"></i>
                <span class="font-medium">Logout</span>
            </a>
        </div>
    </div>
</aside>
