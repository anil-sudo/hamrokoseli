{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Hamro Koseli</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F5E8D6] min-h-screen flex items-center justify-center font-sans p-0 m-0">

    <!-- Split Screen Container -->
    <div class="flex flex-col lg:flex-row w-full min-h-screen">
        
        <!-- Left Side: Image & Info Section -->
        <div class="lg:w-1/2 relative flex flex-col justify-between p-8 md:p-12 lg:p-16 min-h-[400px] lg:min-h-screen bg-cover bg-center overflow-hidden" 
             style="background-image: linear-gradient(rgba(0, 0, 0, 0.45), rgba(0, 0, 0, 0.55)), url('{{ asset('images/RegisterPageImage.png') }}');">
            
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
                        JOIN OUR <span class="text-[#9FC3AF] font-semibold">ARTISAN</span><br>COMMUNITY.
                    </h1>
                    <p class="text-white/80 text-sm md:text-base max-w-md font-medium leading-relaxed">
                        Start selling your art and handmade creations on HamroKoseli, and let your craftsmanship reach homes across Nepal.
                    </p>
                </div>

                <!-- Glassmorphism Badge Rows -->
                <div class="flex flex-col gap-4 max-w-md">
                    <!-- Row 1 -->
                    <div class="flex items-start gap-4 bg-black/25 backdrop-blur-sm border border-white/10 p-4 rounded-2xl transition hover:bg-black/35 duration-300">
                        <div class="w-10 h-10 rounded-full bg-[#1F3D2E]/20 border border-[#9FC3AF]/30 flex items-center justify-center shrink-0">
                            <i class="fas fa-truck text-[#9FC3AF] text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-white font-bold text-xs tracking-wider uppercase">Easy Shipping</h3>
                            <p class="text-white/70 text-xs mt-0.5">We handle logistics so you can focus on creating</p>
                        </div>
                    </div>

                    <!-- Row 2 -->
                    <div class="flex items-start gap-4 bg-black/25 backdrop-blur-sm border border-white/10 p-4 rounded-2xl transition hover:bg-black/35 duration-300">
                        <div class="w-10 h-10 rounded-full bg-[#1F3D2E]/20 border border-[#9FC3AF]/30 flex items-center justify-center shrink-0">
                            <i class="fas fa-wallet text-[#9FC3AF] text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-white font-bold text-xs tracking-wider uppercase">Secure Payments</h3>
                            <p class="text-white/70 text-xs mt-0.5">Direct transfers for every piece you sell</p>
                        </div>
                    </div>

                    <!-- Row 3 -->
                    <div class="flex items-start gap-4 bg-black/25 backdrop-blur-sm border border-white/10 p-4 rounded-2xl transition hover:bg-black/35 duration-300">
                        <div class="w-10 h-10 rounded-full bg-[#1F3D2E]/20 border border-[#9FC3AF]/30 flex items-center justify-center shrink-0">
                            <i class="fas fa-users text-[#9FC3AF] text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-white font-bold text-xs tracking-wider uppercase">Seller Network</h3>
                            <p class="text-white/70 text-xs mt-0.5">Access workshops and connect with local artists</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: Register Form Section -->
        <div class="lg:w-1/2 flex items-center justify-center p-6 md:p-12 lg:p-16 bg-[#F5E8D6]">
            
            <!-- Register Form Card -->
            <div class="bg-[#FFF7EF] w-full max-w-md rounded-3xl shadow-xl p-8 md:p-10 border border-[#ebd7be]/40 relative my-8 lg:my-0">
                
                <!-- Floating close button for returning home -->
                <a href="{{ url('/') }}" class="absolute top-4 right-4 text-slate-400 hover:text-slate-700 transition" title="Go back home">
                    <i class="fas fa-times text-xl"></i>
                </a>

                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold font-serif text-[#1F2A24] tracking-wide mb-2">CREATE AN ACCOUNT</h2>
                    <p class="text-slate-500 text-xs font-semibold tracking-wide">Register as a seller to showcase your crafts.</p>
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

                <form action="{{ route('vendor.register.post') }}" method="POST" class="space-y-4">
                    @csrf
                    
                    <!-- Name Field -->
                    <div>
                        <label for="name" class="block text-xs font-bold uppercase text-[#3A2A1F]/80 mb-1.5 tracking-wider">Full Name</label>
                        <div class="flex items-center bg-[#F5E8D6]/40 border border-[#ebd7be]/80 rounded-xl px-4 py-3 focus-within:ring-2 focus-within:ring-[#1F3D2E]/40 focus-within:border-transparent transition-all">
                            <i class="far fa-user text-slate-400 text-base shrink-0 mr-3"></i>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Your full name"
                                   class="bg-transparent border-0 outline-none w-full text-slate-800 text-sm placeholder-slate-400 font-medium p-0 focus:ring-0">
                        </div>
                    </div>

                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-xs font-bold uppercase text-[#3A2A1F]/80 mb-1.5 tracking-wider">Email Address</label>
                        <div class="flex items-center bg-[#F5E8D6]/40 border border-[#ebd7be]/80 rounded-xl px-4 py-3 focus-within:ring-2 focus-within:ring-[#1F3D2E]/40 focus-within:border-transparent transition-all">
                            <i class="far fa-envelope text-slate-400 text-base shrink-0 mr-3"></i>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="you@example.com"
                                   class="bg-transparent border-0 outline-none w-full text-slate-800 text-sm placeholder-slate-400 font-medium p-0 focus:ring-0">
                        </div>
                    </div>

                    <!-- Phone Field -->
                    <div>
                        <label for="phone" class="block text-xs font-bold uppercase text-[#3A2A1F]/80 mb-1.5 tracking-wider">Phone Number</label>
                        <div class="flex items-center bg-[#F5E8D6]/40 border border-[#ebd7be]/80 rounded-xl px-4 py-3 focus-within:ring-2 focus-within:ring-[#1F3D2E]/40 focus-within:border-transparent transition-all">
                            <i class="fas fa-phone text-slate-400 text-sm shrink-0 mr-3"></i>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" placeholder="98XXXXXXXX"
                                   class="bg-transparent border-0 outline-none w-full text-slate-800 text-sm placeholder-slate-400 font-medium p-0 focus:ring-0">
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-xs font-bold uppercase text-[#3A2A1F]/80 mb-1.5 tracking-wider">Password</label>
                        <div class="flex items-center bg-[#F5E8D6]/40 border border-[#ebd7be]/80 rounded-xl px-4 py-3 focus-within:ring-2 focus-within:ring-[#1F3D2E]/40 focus-within:border-transparent transition-all">
                            <i class="fas fa-lock text-slate-400 text-base shrink-0 mr-3"></i>
                            <input type="password" id="password" name="password" required placeholder="Choose a password (min. 8 characters)"
                                   class="bg-transparent border-0 outline-none w-full text-slate-800 text-sm placeholder-slate-400 font-medium p-0 focus:ring-0">
                            <button type="button" id="toggle-password" class="text-slate-400 hover:text-slate-700 transition focus:outline-none ml-2">
                                <i class="far fa-eye-slash text-base"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Confirm Password Field -->
                    <div>
                        <label for="password_confirmation" class="block text-xs font-bold uppercase text-[#3A2A1F]/80 mb-1.5 tracking-wider">Confirm Password</label>
                        <div class="flex items-center bg-[#F5E8D6]/40 border border-[#ebd7be]/80 rounded-xl px-4 py-3 focus-within:ring-2 focus-within:ring-[#1F3D2E]/40 focus-within:border-transparent transition-all">
                            <i class="fas fa-lock text-slate-400 text-base shrink-0 mr-3"></i>
                            <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Confirm your password"
                                   class="bg-transparent border-0 outline-none w-full text-slate-800 text-sm placeholder-slate-400 font-medium p-0 focus:ring-0">
                            <button type="button" id="toggle-password-confirm" class="text-slate-400 hover:text-slate-700 transition focus:outline-none ml-2">
                                <i class="far fa-eye-slash text-base"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                            class="bg-[#1F3D2E] hover:bg-[#13261d] text-white font-bold py-3.5 px-6 rounded-xl flex items-center justify-center gap-2 transition duration-300 w-full mt-6 shadow-md shadow-emerald-950/20 active:scale-[0.98]">
                        <span>REGISTER</span>
                        <i class="fas fa-arrow-right text-sm"></i>
                    </button>
                </form>

                <!-- Footer Links -->
                <div class="text-center mt-6 text-xs font-semibold text-slate-500">
                    Already have an account? 
                    <a href="{{ route('seller.login') }}" class="text-[#1F3D2E] font-bold hover:underline ml-1">Sign in</a>
                </div>
            </div>
        </div>
    </div>
    <div id="toast" class="hidden fixed top-5 right-5 bg-green-600 text-white px-6 py-4 rounded-xl shadow-lg z-50">
    <span id="toast-message"></span>
</div>

    <!-- Script to toggle password visibility and restrict phone input -->
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
                        if (type === 'text') {
                            icon.classList.remove('fa-eye-slash');
                            icon.classList.add('fa-eye');
                        } else {
                            icon.classList.remove('fa-eye');
                            icon.classList.add('fa-eye-slash');
                        }
                    }
                });
            }

            const toggleConfirmBtn = document.getElementById('toggle-password-confirm');
            const confirmInput = document.getElementById('password_confirmation');
            
            if (toggleConfirmBtn && confirmInput) {
                toggleConfirmBtn.addEventListener('click', () => {
                    const type = confirmInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    confirmInput.setAttribute('type', type);
                    
                    const icon = toggleConfirmBtn.querySelector('i');
                    if (icon) {
                        if (type === 'text') {
                            icon.classList.remove('fa-eye-slash');
                            icon.classList.add('fa-eye');
                        } else {
                            icon.classList.remove('fa-eye');
                            icon.classList.add('fa-eye-slash');
                        }
                    }
                });
            }

            const phoneInput = document.getElementById('phone');
            if (phoneInput) {
                phoneInput.addEventListener('input', function() {
                    let value = this.value.replace(/\D/g, '');
                    if (value.length > 10) value = value.substring(0, 10);
                    this.value = value;
                });
            }
        });
         @if(session('success'))
        const toast = document.getElementById('toast');
        const msg = document.getElementById('toast-message');

        msg.innerText = "{{ session('success') }}";
        toast.classList.remove('hidden');

        setTimeout(() => {
            toast.classList.add('hidden');
        }, 4000);
    @endif
    </script>
</body>
</html> --}}