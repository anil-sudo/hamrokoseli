<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Login - Hamro Koseli</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F5E8D6] min-h-screen flex items-center justify-center font-sans p-0 m-0">

    <!-- Split Screen Container -->
    <div class="flex flex-col lg:flex-row w-full min-h-screen">

        <!-- Left Side: Image & Info Section -->
        <div class="lg:w-1/2 relative flex flex-col justify-between p-8 md:p-12 lg:p-16 min-h-[400px] lg:min-h-screen bg-cover bg-center overflow-hidden"
             style="background-image: linear-gradient(rgba(0, 0, 0, 0.45), rgba(0, 0, 0, 0.55)), url('{{ asset('images/LoginPageImage.png') }}');">

            <!-- Logo Header -->
            <div class="z-10">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-3 bg-white/10 backdrop-blur-md border border-white/20 rounded-full px-5 py-2 hover:bg-white/20 transition-all duration-300">
                    <img src="{{ asset('images/logo.jpeg') }}" alt="Hamro Koseli Logo" class="w-8 h-8 rounded-full object-cover">
                    <span class="text-white font-serif tracking-widest font-bold text-sm uppercase">Hamro Koseli</span>
                </a>
            </div>

            <!-- Bottom Content Group -->
            <div class="z-10 flex flex-col gap-8 mt-12 lg:mt-auto">
                <div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold font-serif leading-none tracking-tight text-white mb-4">
                        GROW <span class="text-[#9FC3AF] font-semibold">YOUR</span><br>BUSINESS.
                    </h1>
                    <p class="text-white/80 text-sm md:text-base max-w-md font-medium leading-relaxed">
                        Join our platform for local artisans and showcase your handmade products to thousands of customers.
                    </p>
                </div>

                <!-- Glassmorphism Badge Rows -->
                <div class="flex flex-col gap-4 max-w-md">
                    <!-- Row 1 -->
                    <div class="flex items-start gap-4 bg-black/25 backdrop-blur-sm border border-white/10 p-4 rounded-2xl transition hover:bg-black/35 duration-300">
                        <div class="w-10 h-10 rounded-full bg-[#1F3D2E]/20 border border-[#9FC3AF]/30 flex items-center justify-center shrink-0">
                            <i class="fas fa-store text-[#9FC3AF] text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-white font-bold text-xs tracking-wider uppercase">Easy Product Listing</h3>
                            <p class="text-white/70 text-xs mt-0.5">Upload products in minutes</p>
                        </div>
                    </div>

                    <!-- Row 2 -->
                    <div class="flex items-start gap-4 bg-black/25 backdrop-blur-sm border border-white/10 p-4 rounded-2xl transition hover:bg-black/35 duration-300">
                        <div class="w-10 h-10 rounded-full bg-[#1F3D2E]/20 border border-[#9FC3AF]/30 flex items-center justify-center shrink-0">
                            <i class="fas fa-users text-[#9FC3AF] text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-white font-bold text-xs tracking-wider uppercase">Reach More Customers</h3>
                            <p class="text-white/70 text-xs mt-0.5">Connect with local buyers</p>
                        </div>
                    </div>

                    <!-- Row 3 -->
                    <div class="flex items-start gap-4 bg-black/25 backdrop-blur-sm border border-white/10 p-4 rounded-2xl transition hover:bg-black/35 duration-300">
                        <div class="w-10 h-10 rounded-full bg-[#1F3D2E]/20 border border-[#9FC3AF]/30 flex items-center justify-center shrink-0">
                            <i class="fas fa-gem text-[#9FC3AF] text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-white font-bold text-xs tracking-wider uppercase">Showcase Your Craft</h3>
                            <p class="text-white/70 text-xs mt-0.5">Turn creativity into opportunity</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: Seller Login Form -->
        <div class="lg:w-1/2 flex items-center justify-center p-6 md:p-12 lg:p-16 bg-[#F5E8D6]">

            <!-- Login Form Card -->
            <div class="bg-[#FFF7EF] w-full max-w-md rounded-3xl shadow-xl p-8 md:p-10 border border-[#ebd7be]/40 relative">

                <!-- Floating close button -->
                <a href="{{ url('/') }}" class="absolute top-4 right-4 text-slate-400 hover:text-slate-700 transition" title="Go back home">
                    <i class="fas fa-times text-xl"></i>
                </a>

                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold font-serif text-[#1F2A24] tracking-wide mb-2">WELCOME BACK</h2>
                    <p class="text-slate-500 text-xs font-semibold tracking-wide">Sign in to manage your shop & orders.</p>
                </div>

                <!-- Validation Errors -->
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-2xl text-red-700 text-sm">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('seller.login.submit') }}" method="POST" class="space-y-5">
                    @csrf
                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-xs font-bold uppercase text-[#3A2A1F]/80 mb-2 tracking-wider">Email</label>
                        <div class="flex items-center bg-[#F5E8D6]/40 border border-[#ebd7be]/80 rounded-xl px-4 py-3 focus-within:ring-2 focus-within:ring-[#1F3D2E]/40 focus-within:border-transparent transition-all">
                            <i class="far fa-envelope text-slate-400 text-base shrink-0 mr-3"></i>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="you@example.com"
                                   class="bg-transparent border-0 outline-none w-full text-slate-800 text-sm placeholder-slate-400 font-medium p-0 focus:ring-0">
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label for="password" class="block text-xs font-bold uppercase text-[#3A2A1F]/80 tracking-wider">Password</label>
                            <a href="#" class="text-xs font-bold text-[#1F3D2E] hover:text-[#C65A3A] transition">Forgot password?</a>
                        </div>
                        <div class="flex items-center bg-[#F5E8D6]/40 border border-[#ebd7be]/80 rounded-xl px-4 py-3 focus-within:ring-2 focus-within:ring-[#1F3D2E]/40 focus-within:border-transparent transition-all">
                            <i class="fas fa-lock text-slate-400 text-base shrink-0 mr-3"></i>
                            <input type="password" id="password" name="password" required placeholder="password"
                                   class="bg-transparent border-0 outline-none w-full text-slate-800 text-sm placeholder-slate-400 font-medium p-0 focus:ring-0">
                            <button type="button" id="toggle-password" class="text-slate-400 hover:text-slate-700 transition focus:outline-none ml-2">
                                <i class="far fa-eye-slash text-base"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center gap-2.5">
                        <input type="checkbox" id="remember" name="remember"
                               class="w-4.5 h-4.5 rounded border-slate-300 text-[#1F3D2E] focus:ring-[#1F3D2E] accent-[#1F3D2E]">
                        <label for="remember" class="text-sm font-semibold text-slate-600 select-none cursor-pointer">Remember me</label>
                    </div>

                    <!-- Sign In Button -->
                    <button type="submit"
                            class="bg-[#1F3D2E] hover:bg-[#13261d] text-white font-bold py-3.5 px-6 rounded-xl flex items-center justify-center gap-2 transition duration-300 w-full mt-6 shadow-md shadow-emerald-950/20 active:scale-[0.98]">
                        <span>SIGN IN </span>
                        <i class="fas fa-arrow-right text-sm"></i>
                    </button>
                </form>

                <!-- OR Separator -->
                <div class="flex items-center my-6">
                    <div class="flex-grow border-t border-[#ebd7be]/40"></div>
                    <span class="px-4 text-[10px] font-bold text-slate-400 tracking-widest uppercase">Or continue with</span>
                    <div class="flex-grow border-t border-[#ebd7be]/40"></div>
                </div>

                <!-- Google OAuth -->
                <button type="button"
                        class="bg-[#F5E8D6]/50 hover:bg-[#ebd7be]/60 text-slate-700 font-bold py-3.5 px-6 rounded-xl flex items-center justify-center gap-3 transition w-full border border-[#ebd7be]/60 active:scale-[0.98]">
                    <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24">
                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
                    </svg>
                    <span class="text-sm">Continue with Google</span>
                </button>

                <!-- Footer -->
                <div class="text-center mt-8 text-xs font-semibold text-slate-500">
                    Don't have a seller account?
                    <a href="{{ route('seller') }}" class="text-[#1F3D2E] font-bold hover:underline ml-1">Register as Seller</a>
                </div>
            </div>
        </div>
<div id="toast"
     class="hidden fixed top-5 left-1/2 transform -translate-x-1/2 bg-green-600 text-white px-6 py-4 rounded-xl shadow-lg z-50 transition-all duration-300 opacity-0">
    <span id="toast-message"></span>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const toast = document.getElementById('toast');
    const msg = document.getElementById('toast-message');

    const successMessage = @json(session('success'));

    if (successMessage) {
        msg.innerText = successMessage;

        toast.classList.remove('hidden', 'opacity-0', 'translate-y-[-10px]');
        toast.classList.add('opacity-100', 'translate-y-0');

        setTimeout(() => {
            toast.classList.add('hidden');
        }, 4000);
    }
});
</script> 
</script>

    <!-- Password Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const togglePasswordBtn = document.getElementById('toggle-password');
            const passwordInput = document.getElementById('password');

            if (togglePasswordBtn && passwordInput) {
                togglePasswordBtn.addEventListener('click', () => {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);

                    const icon = togglePasswordBtn.querySelector('i');
                    if (icon) {
                        icon.classList.toggle('fa-eye-slash');
                        icon.classList.toggle('fa-eye');
                    }
                });
            }
        });
    </script>
</body>
</html>