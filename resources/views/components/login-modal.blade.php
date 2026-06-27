<!-- Login Modal Overlay -->
<div id="login-modal" class="fixed inset-0 z-[100000] hidden items-center justify-center bg-black/65 backdrop-blur-sm p-3 sm:p-5 lg:p-8 transition-opacity duration-300 opacity-0">

    <!-- Modal Container -->
    <div class="relative bg-[#FFF7EF] w-full
                max-w-sm sm:max-w-md lg:max-w-5xl
                max-h-[95vh] lg:max-h-[88vh]
                rounded-2xl lg:rounded-3xl overflow-hidden shadow-2xl border border-[#ebd7be]/40
                transform scale-95 opacity-0 transition-all duration-300 ease-out
                flex flex-col lg:flex-row"
         id="login-modal-container">

        <!-- Close Button -->
        <button id="close-login-modal"
                class="absolute top-3 right-3 z-50 bg-white/80 hover:bg-white text-slate-800 rounded-full w-9 h-9 flex items-center justify-center shadow-md transition-all hover:scale-105 active:scale-95 cursor-pointer"
                aria-label="Close modal">
            <i class="fas fa-times text-lg"></i>
        </button>

        <!-- ============================ LOGIN VIEW ============================ -->
        <div id="login-view" class="w-full h-full flex flex-col lg:flex-row">

            <!-- LEFT IMAGE PANEL — desktop only -->
            <div class="hidden lg:flex lg:w-1/2 relative flex-col justify-between p-12 xl:p-14 bg-cover bg-center overflow-hidden"
                 style="background-image: linear-gradient(rgba(0,0,0,0.45), rgba(0,0,0,0.55)), url('{{ asset('images/LoginPageImage.png') }}');">
                <div class="z-10">
                    <div class="inline-flex items-center gap-3 bg-white/10 backdrop-blur-md border border-white/20 rounded-full px-5 py-2.5">
                        <img src="{{ asset('images/logo.png') }}" alt="Hamro Koseli Logo" class="w-9 h-9 bg-white rounded-full object-cover">
                        <span class="text-white font-serif tracking-widest font-bold text-sm uppercase">Hamro Koseli</span>
                    </div>
                </div>
                <div class="z-10 flex flex-col gap-7 mt-auto">
                    <div>
                        <h2 class="text-4xl xl:text-5xl font-bold font-serif leading-none tracking-tight text-white mb-3">
                            SUPPORT <span class="text-[#9FC3AF] font-semibold">LOCAL</span><br>MAKERS.
                        </h2>
                        <p class="text-white/80 text-sm max-w-sm font-medium leading-relaxed">
                            Join our community of artisans and discover unique, handcrafted, local products right in your neighborhood.
                        </p>
                    </div>
                    <div class="flex flex-col gap-3.5 max-w-sm">
                        <div class="flex items-start gap-3.5 bg-black/25 backdrop-blur-sm border border-white/10 p-3.5 rounded-xl hover:bg-black/35 transition duration-300">
                            <div class="w-9 h-9 rounded-full bg-[#1F3D2E]/20 border border-[#9FC3AF]/30 flex items-center justify-center shrink-0">
                                <i class="fas fa-shield-halved text-[#9FC3AF] text-base"></i>
                            </div>
                            <div><h3 class="text-white font-bold text-[11px] tracking-wider uppercase">Secure Payments</h3><p class="text-white/70 text-[10px] mt-0.5">100% protected transactions</p></div>
                        </div>
                        <div class="flex items-start gap-3.5 bg-black/25 backdrop-blur-sm border border-white/10 p-3.5 rounded-xl hover:bg-black/35 transition duration-300">
                            <div class="w-9 h-9 rounded-full bg-[#1F3D2E]/20 border border-[#9FC3AF]/30 flex items-center justify-center shrink-0">
                                <i class="fas fa-truck text-[#9FC3AF] text-base"></i>
                            </div>
                            <div><h3 class="text-white font-bold text-[11px] tracking-wider uppercase">Local Pickup</h3><p class="text-white/70 text-[10px] mt-0.5">Convenient neighborhood collection</p></div>
                        </div>
                        <div class="flex items-start gap-3.5 bg-black/25 backdrop-blur-sm border border-white/10 p-3.5 rounded-xl hover:bg-black/35 transition duration-300">
                            <div class="w-9 h-9 rounded-full bg-[#1F3D2E]/20 border border-[#9FC3AF]/30 flex items-center justify-center shrink-0">
                                <i class="fas fa-hand-holding-heart text-[#9FC3AF] text-base"></i>
                            </div>
                            <div><h3 class="text-white font-bold text-[11px] tracking-wider uppercase">Support Artisans</h3><p class="text-white/70 text-[10px] mt-0.5">Directly fund local creators</p></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT: Form — full width on mobile, half on desktop -->
            <div class="w-full lg:w-1/2 flex flex-col justify-center overflow-y-auto bg-[#FFF7EF] p-6 sm:p-8 lg:p-10 xl:p-12">

                <!-- Desktop heading only -->
                <div class="hidden lg:block text-center mb-7">
                    <h2 class="text-3xl xl:text-4xl font-bold font-serif text-[#1F2A24] tracking-wide mb-1">WELCOME BACK</h2>
                    <p class="text-slate-500 text-sm font-semibold tracking-wide">Sign in to continue supporting local business.</p>
                </div>

                <!-- Mobile heading only — plain, no dark bg -->
                <div class="lg:hidden text-center mb-5 pt-2">
                    <h2 class="text-xl font-bold font-serif text-[#1F2A24] tracking-wide">WELCOME BACK</h2>
                    <p class="text-slate-400 text-xs font-medium mt-1">Sign in to continue supporting local business.</p>
                </div>

                <!-- SUCCESS MESSAGE - Shows after successful registration -->
                @if (session('success'))
                    <div class="mb-4 rounded-xl bg-[#E8F3EC] border border-[#9FC3AF]/50 text-[#1F3D2E] text-xs font-semibold px-4 py-3 flex items-center gap-2">
                        <i class="fas fa-check-circle text-[#1F3D2E]"></i>
                        {{ session('success') }}
                    </div>
                @endif

                <!-- LOGIN ERRORS - Only show login-specific errors (not registration errors) -->
                @if ($errors->any() && !session('show_register') && !old('name'))
                    <div class="mb-4 rounded-xl bg-red-50 border border-red-200 text-red-700 text-xs font-semibold px-4 py-3 space-y-1">
                        @foreach ($errors->all() as $error)
                            <p class="flex items-center gap-1.5">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $error }}
                            </p>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('userlogin') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="modal-email" class="block text-[10px] font-bold uppercase text-[#3A2A1F]/80 mb-1.5 tracking-wider">Email</label>
                        <div class="flex items-center bg-[#F5E8D6]/50 border border-[#ebd7be]/80 rounded-xl px-4 py-2.5 lg:py-3 focus-within:ring-2 focus-within:ring-[#1F3D2E]/40 focus-within:border-transparent transition-all">
                            <i class="far fa-envelope text-slate-400 text-sm shrink-0 mr-3"></i>
                            <input type="email" id="modal-email" name="email" required placeholder="you@example.com" value="{{ old('email') }}"
                                   class="bg-transparent border-0 outline-none w-full text-slate-800 text-sm placeholder-slate-400 font-medium p-0 focus:ring-0">
                        </div>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1 font-medium flex items-center gap-1">
                                <i class="fas fa-exclamation-circle text-[10px]"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div>
                        <div class="flex justify-between items-center mb-1.5">
                            <label for="modal-password" class="block text-[10px] font-bold uppercase text-[#3A2A1F]/80 tracking-wider">Password</label>
                            <a href="#" class="text-[11px] font-bold text-[#1F3D2E] hover:text-[#C65A3A] transition">Forgot password?</a>
                        </div>
                        <div class="flex items-center bg-[#F5E8D6]/50 border border-[#ebd7be]/80 rounded-xl px-4 py-2.5 lg:py-3 focus-within:ring-2 focus-within:ring-[#1F3D2E]/40 focus-within:border-transparent transition-all">
                            <i class="fas fa-lock text-slate-400 text-sm shrink-0 mr-3"></i>
                            <input type="password" id="modal-password" name="password" required placeholder="password"
                                   class="bg-transparent border-0 outline-none w-full text-slate-800 text-sm placeholder-slate-400 font-medium p-0 focus:ring-0">
                            <button type="button" id="modal-toggle-password" class="text-slate-400 hover:text-slate-700 transition focus:outline-none ml-2">
                                <i class="far fa-eye-slash text-sm"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1 font-medium flex items-center gap-1">
                                <i class="fas fa-exclamation-circle text-[10px]"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="flex items-center gap-2">
                        <input type="checkbox" id="modal-remember" name="remember" class="w-4 h-4 rounded border-slate-300 accent-[#1F3D2E]">
                        <label for="modal-remember" class="text-xs font-semibold text-slate-600 select-none cursor-pointer">Remember me</label>
                    </div>
                    <button type="submit"
                            class="bg-[#1F3D2E] hover:bg-[#13261d] text-white font-bold py-3 lg:py-3.5 px-6 rounded-xl flex items-center justify-center gap-2 transition duration-300 w-full shadow-md shadow-emerald-950/20 active:scale-[0.98]">
                        <span>SIGN IN</span>
                        <i class="fas fa-arrow-right text-xs"></i>
                    </button>
                </form>

                <div class="flex items-center my-4 lg:my-5">
                    <div class="flex-grow border-t border-[#ebd7be]/50"></div>
                    <span class="px-3 text-[9px] font-bold text-slate-400 tracking-widest uppercase">Or continue with</span>
                    <div class="flex-grow border-t border-[#ebd7be]/50"></div>
                </div>

                <button type="button"
                        class="bg-white hover:bg-slate-50 text-slate-600 font-semibold py-2.5 lg:py-3 px-6 rounded-xl flex items-center justify-center gap-2.5 transition w-full border border-slate-200 active:scale-[0.98]">
                    <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24">
                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
                    </svg>
                    <span class="text-xs">Google</span>
                </button>

                <div class="text-center mt-5 text-[11px] font-semibold text-slate-500">
                    New to the neighborhood?
                    <a href="#" id="modal-show-register" class="text-[#1F3D2E] font-bold hover:underline ml-1">Create an account</a>
                </div>
            </div>
        </div>

        <!-- ============================ REGISTER VIEW ============================ -->
        <div id="register-view" class="w-full h-full flex flex-col lg:flex-row hidden">

            <!-- LEFT IMAGE PANEL — desktop only -->
            <div class="hidden lg:flex lg:w-1/2 relative flex-col justify-between p-12 xl:p-14 bg-cover bg-center overflow-hidden"
                 style="background-image: linear-gradient(rgba(0,0,0,0.45), rgba(0,0,0,0.55)), url('{{ asset('images/RegisterPageImage.png') }}');">
                <div class="z-10">
                    <div class="inline-flex items-center gap-3 bg-white/10 backdrop-blur-md border border-white/20 rounded-full px-5 py-2.5">
                        <img src="{{ asset('images/logo.png') }}" alt="Hamro Koseli Logo" class="w-9 h-9 bg-white rounded-full object-cover">
                        <span class="text-white font-serif tracking-widest font-bold text-sm uppercase">Hamro Koseli</span>
                    </div>
                </div>
                <div class="z-10 flex flex-col gap-7 mt-auto">
                    <div>
                        <h2 class="text-4xl xl:text-5xl font-bold font-serif leading-none tracking-tight text-white mb-3">
                            JOIN OUR <span class="text-[#9FC3AF] font-semibold">ARTISAN</span><br>COMMUNITY.
                        </h2>
                        <p class="text-white/80 text-sm max-w-sm font-medium leading-relaxed">
                            Create your account to discover unique, handcrafted, local products and support artisans across Nepal.
                        </p>
                    </div>
                    <div class="flex flex-col gap-3.5 max-w-sm">
                        <div class="flex items-start gap-3.5 bg-black/25 backdrop-blur-sm border border-white/10 p-3.5 rounded-xl hover:bg-black/35 transition duration-300">
                            <div class="w-9 h-9 rounded-full bg-[#1F3D2E]/20 border border-[#9FC3AF]/30 flex items-center justify-center shrink-0">
                                <i class="fas fa-truck text-[#9FC3AF] text-base"></i>
                            </div>
                            <div><h3 class="text-white font-bold text-[11px] tracking-wider uppercase">Local Pickup</h3><p class="text-white/70 text-[10px] mt-0.5">Convenient neighborhood collection</p></div>
                        </div>
                        <div class="flex items-start gap-3.5 bg-black/25 backdrop-blur-sm border border-white/10 p-3.5 rounded-xl hover:bg-black/35 transition duration-300">
                            <div class="w-9 h-9 rounded-full bg-[#1F3D2E]/20 border border-[#9FC3AF]/30 flex items-center justify-center shrink-0">
                                <i class="fas fa-wallet text-[#9FC3AF] text-base"></i>
                            </div>
                            <div><h3 class="text-white font-bold text-[11px] tracking-wider uppercase">Secure Payments</h3><p class="text-white/70 text-[10px] mt-0.5">100% protected transactions</p></div>
                        </div>
                        <div class="flex items-start gap-3.5 bg-black/25 backdrop-blur-sm border border-white/10 p-3.5 rounded-xl hover:bg-black/35 transition duration-300">
                            <div class="w-9 h-9 rounded-full bg-[#1F3D2E]/20 border border-[#9FC3AF]/30 flex items-center justify-center shrink-0">
                                <i class="fas fa-hand-holding-heart text-[#9FC3AF] text-base"></i>
                            </div>
                            <div><h3 class="text-white font-bold text-[11px] tracking-wider uppercase">Support Artisans</h3><p class="text-white/70 text-[10px] mt-0.5">Directly fund local creators</p></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT: Register Form — full width on mobile, half on desktop -->
            <div class="w-full lg:w-1/2 flex flex-col justify-center overflow-y-auto bg-[#FFF7EF] p-6 sm:p-8 lg:p-10 xl:p-12">

                <!-- Desktop heading only -->
                <div class="hidden lg:block text-center mb-7">
                    <h2 class="text-3xl xl:text-4xl font-bold font-serif text-[#1F2A24] tracking-wide mb-1">CREATE AN ACCOUNT</h2>
                    <p class="text-slate-500 text-sm font-semibold tracking-wide">Register as a buyer to shop local crafts.</p>
                </div>

                <!-- Mobile heading only — plain, no dark bg -->
                <div class="lg:hidden text-center mb-5 pt-2">
                    <h2 class="text-xl font-bold font-serif text-[#1F2A24] tracking-wide">CREATE AN ACCOUNT</h2>
                    <p class="text-slate-400 text-xs font-medium mt-1">Register to shop local crafts.</p>
                </div>

                <!-- REGISTRATION ERRORS - Only show registration-specific errors -->
                @if ($errors->any() && (session('show_register') || old('name')))
                    <div class="mb-4 rounded-xl bg-red-50 border border-red-200 text-red-700 text-xs font-semibold px-4 py-3 space-y-1">
                        @foreach ($errors->all() as $error)
                            <p class="flex items-center gap-1.5">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $error }}
                            </p>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('userregister') }}" method="POST" class="space-y-3.5 lg:space-y-4">
                    @csrf
                    <div>
                        <label for="modal-register-name" class="block text-[10px] font-bold uppercase text-[#3A2A1F]/80 mb-1.5 tracking-wider">Full Name</label>
                        <div class="flex items-center bg-[#F5E8D6]/50 border border-[#ebd7be]/80 rounded-xl px-4 py-2.5 lg:py-3 focus-within:ring-2 focus-within:ring-[#1F3D2E]/40 focus-within:border-transparent transition-all">
                            <i class="far fa-user text-slate-400 text-sm shrink-0 mr-3"></i>
                            <input type="text" id="modal-register-name" name="name" required placeholder="Your full name" value="{{ old('name') }}"
                                   class="bg-transparent border-0 outline-none w-full text-slate-800 text-sm placeholder-slate-400 font-medium p-0 focus:ring-0">
                        </div>
                        @error('name')
                            <p class="text-red-500 text-xs mt-1 font-medium flex items-center gap-1">
                                <i class="fas fa-exclamation-circle text-[10px]"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div>
                        <label for="modal-register-email" class="block text-[10px] font-bold uppercase text-[#3A2A1F]/80 mb-1.5 tracking-wider">Email Address</label>
                        <div class="flex items-center bg-[#F5E8D6]/50 border border-[#ebd7be]/80 rounded-xl px-4 py-2.5 lg:py-3 focus-within:ring-2 focus-within:ring-[#1F3D2E]/40 focus-within:border-transparent transition-all">
                            <i class="far fa-envelope text-slate-400 text-sm shrink-0 mr-3"></i>
                            <input type="email" id="modal-register-email" name="email" required placeholder="you@example.com" value="{{ old('email') }}"
                                   class="bg-transparent border-0 outline-none w-full text-slate-800 text-sm placeholder-slate-400 font-medium p-0 focus:ring-0">
                        </div>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1 font-medium flex items-center gap-1">
                                <i class="fas fa-exclamation-circle text-[10px]"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div>
                        <label for="modal-register-phone" class="block text-[10px] font-bold uppercase text-[#3A2A1F]/80 mb-1.5 tracking-wider">Phone Number</label>
                        <div class="flex items-center bg-[#F5E8D6]/50 border border-[#ebd7be]/80 rounded-xl px-4 py-2.5 lg:py-3 focus-within:ring-2 focus-within:ring-[#1F3D2E]/40 focus-within:border-transparent transition-all">
                            <i class="fas fa-phone text-slate-400 text-sm shrink-0 mr-3"></i>
                            <input type="tel" id="modal-register-phone" name="phone" placeholder="98XXXXXXXX" value="{{ old('phone') }}"
                                   class="bg-transparent border-0 outline-none w-full text-slate-800 text-sm placeholder-slate-400 font-medium p-0 focus:ring-0">
                        </div>
                        @error('phone')
                            <p class="text-red-500 text-xs mt-1 font-medium flex items-center gap-1">
                                <i class="fas fa-exclamation-circle text-[10px]"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div>
                        <label for="modal-register-password" class="block text-[10px] font-bold uppercase text-[#3A2A1F]/80 mb-1.5 tracking-wider">Password</label>
                        <div class="flex items-center bg-[#F5E8D6]/50 border border-[#ebd7be]/80 rounded-xl px-4 py-2.5 lg:py-3 focus-within:ring-2 focus-within:ring-[#1F3D2E]/40 focus-within:border-transparent transition-all">
                            <i class="fas fa-lock text-slate-400 text-sm shrink-0 mr-3"></i>
                            <input type="password" id="modal-register-password" name="password" required placeholder="Min. 8 characters"
                                   class="bg-transparent border-0 outline-none w-full text-slate-800 text-sm placeholder-slate-400 font-medium p-0 focus:ring-0">
                            <button type="button" id="modal-register-toggle-password" class="text-slate-400 hover:text-slate-700 transition focus:outline-none ml-2">
                                <i class="far fa-eye-slash text-sm"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1 font-medium flex items-center gap-1">
                                <i class="fas fa-exclamation-circle text-[10px]"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div>
                        <label for="modal-register-password_confirmation" class="block text-[10px] font-bold uppercase text-[#3A2A1F]/80 mb-1.5 tracking-wider">Confirm Password</label>
                        <div class="flex items-center bg-[#F5E8D6]/50 border border-[#ebd7be]/80 rounded-xl px-4 py-2.5 lg:py-3 focus-within:ring-2 focus-within:ring-[#1F3D2E]/40 focus-within:border-transparent transition-all">
                            <i class="fas fa-lock text-slate-400 text-sm shrink-0 mr-3"></i>
                            <input type="password" id="modal-register-password_confirmation" name="password_confirmation" required placeholder="Confirm your password"
                                   class="bg-transparent border-0 outline-none w-full text-slate-800 text-sm placeholder-slate-400 font-medium p-0 focus:ring-0">
                            <button type="button" id="modal-register-toggle-password-confirm" class="text-slate-400 hover:text-slate-700 transition focus:outline-none ml-2">
                                <i class="far fa-eye-slash text-sm"></i>
                            </button>
                        </div>
                    </div>
                    <button type="submit"
                            class="bg-[#1F3D2E] hover:bg-[#13261d] text-white font-bold py-3 lg:py-3.5 px-6 rounded-xl flex items-center justify-center gap-2 transition duration-300 w-full shadow-md shadow-emerald-950/20 active:scale-[0.98]">
                        <span>CREATE ACCOUNT</span>
                        <i class="fas fa-arrow-right text-xs"></i>
                    </button>
                </form>

                <div class="text-center mt-5 text-[11px] font-semibold text-slate-500">
                    Already have an account?
                    <a href="#" id="modal-show-login" class="text-[#1F3D2E] font-bold hover:underline ml-1">Sign in</a>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // === AUTO-SHOW REGISTER VIEW IF THERE ARE REGISTRATION ERRORS ===
        @if (session('show_register') || ($errors->any() && old('name')))
            if (window.openLoginModal) {
                window.openLoginModal(null, 'register');
            }
        @endif

        // === AUTO-SHOW LOGIN VIEW IF THERE ARE LOGIN ERRORS ===
        @if ($errors->any() && !session('show_register') && !old('name'))
            if (window.openLoginModal) {
                window.openLoginModal(null, 'login');
            }
        @endif

        // === SUCCESS MESSAGE - Auto open modal if success message exists ===
        @if (session('success'))
            if (window.openLoginModal) {
                window.openLoginModal(null, 'login');
            }
        @endif
    });
</script>
