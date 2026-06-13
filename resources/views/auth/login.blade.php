<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Hamro Koseli</title>
    <meta name="description" content="Sign in to your Hamro Koseli account and continue supporting local artisans.">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F5E8D6] min-h-screen font-sans p-0 m-0">

    <!-- ============================================================
         MOBILE (< lg): Plain centered form, no split, no image panel
         ============================================================ -->
    <div class="lg:hidden min-h-screen flex flex-col items-center justify-center px-4 py-8">

        <!-- Logo & back link -->
        <div class="w-full max-w-sm flex items-center justify-between mb-5">
            <a href="{{ url('/') }}" class="flex items-center gap-1.5 text-[#1F3D2E] font-semibold text-sm hover:opacity-70 transition">
                <i class="fas fa-arrow-left text-xs"></i> Home
            </a>
            <div class="flex items-center gap-2">
                <img src="{{ asset('images/logo.jpeg') }}" alt="Logo" class="w-7 h-7 rounded-full object-cover border border-[#ebd7be]">
                <span class="text-[#1F3D2E] font-bold text-xs tracking-wide uppercase">Hamro Koseli</span>
            </div>
        </div>

        <!-- Form card — plain, no dark header -->
        <div class="bg-[#FFF7EF] w-full max-w-sm rounded-2xl shadow-md border border-[#ebd7be]/50 p-6">

            <div class="text-center mb-5">
                <h1 class="text-xl font-bold font-serif text-[#1F2A24] tracking-wide">WELCOME BACK</h1>
                <p class="text-slate-400 text-xs font-medium mt-1">Sign in to continue supporting local business.</p>
            </div>

            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-xl text-red-700 text-xs">
                    <ul class="list-disc list-inside space-y-0.5">
                        @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-3.5">
                @csrf
                <div>
                    <label for="mob-email" class="block text-[10px] font-bold uppercase text-[#3A2A1F]/70 mb-1 tracking-wider">Email</label>
                    <div class="flex items-center bg-[#F5E8D6]/60 border border-[#ebd7be] rounded-xl px-3.5 py-2.5 focus-within:ring-2 focus-within:ring-[#1F3D2E]/30 transition-all">
                        <i class="far fa-envelope text-slate-400 text-sm shrink-0 mr-2.5"></i>
                        <input type="email" id="mob-email" name="email" value="{{ old('email') }}" required placeholder="you@example.com"
                               class="bg-transparent border-0 outline-none w-full text-slate-800 text-sm placeholder-slate-400 font-medium p-0 focus:ring-0">
                    </div>
                </div>
                <div>
                    <div class="flex justify-between items-center mb-1">
                        <label for="mob-password" class="text-[10px] font-bold uppercase text-[#3A2A1F]/70 tracking-wider">Password</label>
                        <a href="#" class="text-[10px] font-bold text-[#1F3D2E] hover:text-[#C65A3A] transition">Forgot?</a>
                    </div>
                    <div class="flex items-center bg-[#F5E8D6]/60 border border-[#ebd7be] rounded-xl px-3.5 py-2.5 focus-within:ring-2 focus-within:ring-[#1F3D2E]/30 transition-all">
                        <i class="fas fa-lock text-slate-400 text-sm shrink-0 mr-2.5"></i>
                        <input type="password" id="mob-password" name="password" required placeholder="password"
                               class="bg-transparent border-0 outline-none w-full text-slate-800 text-sm placeholder-slate-400 font-medium p-0 focus:ring-0">
                        <button type="button" id="mob-toggle-password" class="text-slate-400 hover:text-slate-600 transition focus:outline-none ml-2">
                            <i class="far fa-eye-slash text-sm"></i>
                        </button>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" id="mob-remember" name="remember" class="w-4 h-4 rounded border-slate-300 accent-[#1F3D2E]">
                    <label for="mob-remember" class="text-xs font-semibold text-slate-500 select-none cursor-pointer">Remember me</label>
                </div>
                <button type="submit" class="bg-[#1F3D2E] hover:bg-[#13261d] text-white font-bold py-3 rounded-xl flex items-center justify-center gap-2 transition w-full shadow-sm active:scale-[0.98]">
                    <span>SIGN IN</span>
                    <i class="fas fa-arrow-right text-xs"></i>
                </button>
            </form>

            <div class="flex items-center my-4">
                <div class="flex-grow border-t border-[#ebd7be]"></div>
                <span class="px-3 text-[9px] font-bold text-slate-400 tracking-widest uppercase">Or</span>
                <div class="flex-grow border-t border-[#ebd7be]"></div>
            </div>

            <button type="button" class="bg-white hover:bg-slate-50 text-slate-600 font-semibold py-2.5 rounded-xl flex items-center justify-center gap-2.5 w-full border border-slate-200 active:scale-[0.98] transition">
                <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24">
                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
                </svg>
                <span class="text-sm">Continue with Google</span>
            </button>

            <div class="text-center mt-4 text-xs font-semibold text-slate-400">
                New here? <a href="{{ route('vendor.register') }}" class="text-[#1F3D2E] font-bold hover:underline ml-1">Create an account</a>
            </div>
        </div>
    </div>

    <!-- ============================================================
         DESKTOP (>= lg): Full split-screen
         ============================================================ -->
    <div class="hidden lg:flex w-full min-h-screen">

        <!-- Left: Image & Info -->
        <div class="w-1/2 relative flex flex-col justify-between p-12 xl:p-16 bg-cover bg-center overflow-hidden"
             style="background-image: linear-gradient(rgba(0,0,0,0.45), rgba(0,0,0,0.55)), url('{{ asset('images/LoginPageImage.png') }}');">

            <div class="z-10">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-3 bg-white/10 backdrop-blur-md border border-white/20 rounded-full px-5 py-2.5 hover:bg-white/20 transition-all duration-300">
                    <img src="{{ asset('images/logo.jpeg') }}" alt="Hamro Koseli Logo" class="w-9 h-9 rounded-full object-cover">
                    <span class="text-white font-serif tracking-widest font-bold text-sm uppercase">Hamro Koseli</span>
                </a>
            </div>

            <div class="z-10 flex flex-col gap-8 mt-auto">
                <div>
                    <h1 class="text-5xl xl:text-6xl font-bold font-serif leading-none tracking-tight text-white mb-4">
                        SUPPORT <span class="text-[#9FC3AF] font-semibold">LOCAL</span><br>MAKERS.
                    </h1>
                    <p class="text-white/80 text-sm xl:text-base max-w-md font-medium leading-relaxed">
                        Join our community of artisans and discover unique, handcrafted, local products right in your neighborhood.
                    </p>
                </div>
                <div class="flex flex-col gap-4 max-w-md">
                    <div class="flex items-start gap-4 bg-black/25 backdrop-blur-sm border border-white/10 p-4 rounded-2xl hover:bg-black/35 transition duration-300">
                        <div class="w-10 h-10 rounded-full bg-[#1F3D2E]/20 border border-[#9FC3AF]/30 flex items-center justify-center shrink-0">
                            <i class="fas fa-shield-halved text-[#9FC3AF] text-lg"></i>
                        </div>
                        <div><h3 class="text-white font-bold text-xs tracking-wider uppercase">Secure Payments</h3><p class="text-white/70 text-xs mt-0.5">100% protected transactions</p></div>
                    </div>
                    <div class="flex items-start gap-4 bg-black/25 backdrop-blur-sm border border-white/10 p-4 rounded-2xl hover:bg-black/35 transition duration-300">
                        <div class="w-10 h-10 rounded-full bg-[#1F3D2E]/20 border border-[#9FC3AF]/30 flex items-center justify-center shrink-0">
                            <i class="fas fa-truck text-[#9FC3AF] text-lg"></i>
                        </div>
                        <div><h3 class="text-white font-bold text-xs tracking-wider uppercase">Local Pickup</h3><p class="text-white/70 text-xs mt-0.5">Convenient neighborhood collection</p></div>
                    </div>
                    <div class="flex items-start gap-4 bg-black/25 backdrop-blur-sm border border-white/10 p-4 rounded-2xl hover:bg-black/35 transition duration-300">
                        <div class="w-10 h-10 rounded-full bg-[#1F3D2E]/20 border border-[#9FC3AF]/30 flex items-center justify-center shrink-0">
                            <i class="fas fa-hand-holding-heart text-[#9FC3AF] text-lg"></i>
                        </div>
                        <div><h3 class="text-white font-bold text-xs tracking-wider uppercase">Support Artisans</h3><p class="text-white/70 text-xs mt-0.5">Directly fund local creators</p></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Login Form -->
        <div class="w-1/2 flex items-center justify-center p-10 xl:p-16 bg-[#F5E8D6]">
            <div class="bg-[#FFF7EF] w-full max-w-lg rounded-3xl shadow-xl p-10 xl:p-12 border border-[#ebd7be]/40 relative">
                <a href="{{ url('/') }}" class="absolute top-5 right-5 text-slate-400 hover:text-slate-700 transition" title="Go back home">
                    <i class="fas fa-times text-xl"></i>
                </a>
                <div class="text-center mb-8">
                    <h2 class="text-3xl xl:text-4xl font-bold font-serif text-[#1F2A24] tracking-wide mb-2">WELCOME BACK</h2>
                    <p class="text-slate-500 text-sm font-semibold tracking-wide">Sign in to continue supporting local business.</p>
                </div>
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-2xl text-red-700 text-sm">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('login') }}" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label for="email" class="block text-xs font-bold uppercase text-[#3A2A1F]/80 mb-2 tracking-wider">Email</label>
                        <div class="flex items-center bg-[#F5E8D6]/40 border border-[#ebd7be]/80 rounded-xl px-4 py-3.5 focus-within:ring-2 focus-within:ring-[#1F3D2E]/40 focus-within:border-transparent transition-all">
                            <i class="far fa-envelope text-slate-400 text-base shrink-0 mr-3"></i>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="you@example.com"
                                   class="bg-transparent border-0 outline-none w-full text-slate-800 text-sm placeholder-slate-400 font-medium p-0 focus:ring-0">
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label for="password" class="block text-xs font-bold uppercase text-[#3A2A1F]/80 tracking-wider">Password</label>
                            <a href="#" class="text-xs font-bold text-[#1F3D2E] hover:text-[#C65A3A] transition">Forgot password?</a>
                        </div>
                        <div class="flex items-center bg-[#F5E8D6]/40 border border-[#ebd7be]/80 rounded-xl px-4 py-3.5 focus-within:ring-2 focus-within:ring-[#1F3D2E]/40 focus-within:border-transparent transition-all">
                            <i class="fas fa-lock text-slate-400 text-base shrink-0 mr-3"></i>
                            <input type="password" id="password" name="password" required placeholder="password"
                                   class="bg-transparent border-0 outline-none w-full text-slate-800 text-sm placeholder-slate-400 font-medium p-0 focus:ring-0">
                            <button type="button" id="toggle-password" class="text-slate-400 hover:text-slate-700 transition focus:outline-none ml-2">
                                <i class="far fa-eye-slash text-base"></i>
                            </button>
                        </div>
                    </div>
                    <div class="flex items-center gap-2.5">
                        <input type="checkbox" id="remember" name="remember" class="w-4 h-4 rounded border-slate-300 accent-[#1F3D2E]">
                        <label for="remember" class="text-sm font-semibold text-slate-600 select-none cursor-pointer">Remember me</label>
                    </div>
                    <button type="submit" class="bg-[#1F3D2E] hover:bg-[#13261d] text-white font-bold py-4 px-6 rounded-xl flex items-center justify-center gap-2 transition duration-300 w-full mt-2 shadow-md shadow-emerald-950/20 active:scale-[0.98] text-base">
                        <span>SIGN IN</span>
                        <i class="fas fa-arrow-right text-sm"></i>
                    </button>
                </form>
                <div class="flex items-center my-6">
                    <div class="flex-grow border-t border-[#ebd7be]/40"></div>
                    <span class="px-4 text-[10px] font-bold text-slate-400 tracking-widest uppercase">Or continue with</span>
                    <div class="flex-grow border-t border-[#ebd7be]/40"></div>
                </div>
                <button type="button" class="bg-[#F5E8D6]/50 hover:bg-[#ebd7be]/60 text-slate-700 font-bold py-3.5 px-6 rounded-xl flex items-center justify-center gap-3 transition w-full border border-[#ebd7be]/60 active:scale-[0.98]">
                    <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24">
                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
                    </svg>
                    <span class="text-sm">Google</span>
                </button>
                <div class="text-center mt-8 text-sm font-semibold text-slate-500">
                    New to the neighborhood?
                    <a href="{{ route('vendor.register') }}" class="text-[#1F3D2E] font-bold hover:underline ml-1">Create an account</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const makeToggle = (btnId, inputId) => {
                const btn = document.getElementById(btnId);
                const inp = document.getElementById(inputId);
                if (btn && inp) {
                    btn.addEventListener('click', () => {
                        const t = inp.getAttribute('type') === 'password' ? 'text' : 'password';
                        inp.setAttribute('type', t);
                        const ic = btn.querySelector('i');
                        if (ic) { ic.classList.toggle('fa-eye-slash', t === 'password'); ic.classList.toggle('fa-eye', t === 'text'); }
                    });
                }
            };
            makeToggle('toggle-password', 'password');
            makeToggle('mob-toggle-password', 'mob-password');
        });
    </script>
</body>
</html>