<x-user-layout title="Profile">
    <div class="space-y-10">
        <!-- Header -->
        <div>
            <h1 class="text-3xl font-bold text-(--text-color)">Account Settings</h1>
            <p class="text-sm text-(--text-color)/70 mt-1">Manage your profile information</p>
        </div>

        <!-- Flash Messages -->
        @if (session('success'))
            <div class="flex items-center gap-3 px-5 py-4 rounded-2xl bg-(--primary-color)/10 border border-(--primary-color)/25 text-(--primary-color) text-sm font-medium">
                <i data-lucide="check-circle-2" class="w-5 h-5 shrink-0"></i>
                {{ session('success') }}
            </div>
        @endif
        @if (session('password_success'))
            <div class="flex items-center gap-3 px-5 py-4 rounded-2xl bg-green-500/10 border border-green-500/25 text-green-700 text-sm font-medium">
                <i data-lucide="check-circle-2" class="w-5 h-5 shrink-0"></i>
                {{ session('password_success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="flex items-start gap-3 px-5 py-4 rounded-2xl bg-red-500/10 border border-red-500/25 text-red-600 text-sm font-medium">
                <i data-lucide="alert-circle" class="w-5 h-5 shrink-0 mt-0.5"></i>
                <ul class="list-disc pl-4 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="space-y-6">

            <!-- Profile Information Form -->
            <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data" id="profileForm">
                @csrf
                <input type="hidden" name="remove_pic" id="removePic" value="0">

                <div class="bg-(--card-bg) rounded-2xl shadow-sm p-6 hover:shadow-md transition-all duration-300">
                    <div class="flex items-start gap-6">

                        <!-- Profile Picture -->
                        <div id="profileContainer" class="relative group cursor-pointer shrink-0" onclick="document.getElementById('profileImage').click()">
                            <img id="profilePreview"
                                src="{{ $user->profile_pic ? asset('storage/' . $user->profile_pic) : 'https://api.iconify.design/lucide/user.svg?color=%236b7280' }}"
                                alt="Profile"
                                class="w-24 h-24 rounded-full object-cover border border-(--text-color)/10 shadow bg-(--card-dark)">

                            <!-- Hover Overlay -->
                            <div class="absolute inset-0 bg-black/40 rounded-full opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                                <i data-lucide="camera" class="w-5 h-5 text-white"></i>
                            </div>

                            <!-- Delete Button -->
                            <button type="button" id="deleteBtn"
                                onclick="event.stopPropagation(); removeProfilePic()"
                                class="absolute -top-1 -right-1 bg-red-500 hover:bg-red-600 text-white p-1 rounded-full transition {{ $user->profile_pic ? '' : 'hidden' }}">
                                <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                            </button>

                            <!-- Hidden File Input -->
                            <input type="file" name="profile_pic" id="profileImage" accept="image/*" class="hidden">
                        </div>

                        <!-- Form Fields -->
                        <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-brand-dark mb-2">
                                    Full Name <span class="text-(--secondary-color)">*</span>
                                </label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                    placeholder="Enter your name"
                                    class="w-full bg-(--card-dark) rounded-xl px-4 py-3 focus:outline-none focus:ring-1 focus:ring-(--secondary-color)">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-brand-dark mb-1">
                                    Email Address <span class="text-(--secondary-color)">*</span>
                                </label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                    placeholder="e.g. example@gmail.com"
                                    class="w-full bg-(--card-dark) rounded-xl px-4 py-3 focus:outline-none focus:ring-1 focus:ring-(--secondary-color)">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-brand-dark mb-1">
                                    Phone Number
                                </label>
                                <input type="tel" name="phone" id="profile-phone" value="{{ old('phone', $user->phone) }}"
                                    placeholder="e.g. 9800000000" maxlength="10"
                                    class="w-full bg-(--card-dark) rounded-xl px-4 py-3 focus:outline-none focus:ring-1 focus:ring-(--secondary-color)">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-brand-dark mb-1">
                                    Default Delivery Address
                                </label>
                                <input type="text" name="address" value="{{ old('address', $user->address) }}"
                                    placeholder="e.g. Ward 3, Jhamsikhel, Lalitpur"
                                    class="w-full bg-(--card-dark) rounded-xl px-4 py-3 focus:outline-none focus:ring-1 focus:ring-(--secondary-color)">
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mt-8">
                        <button type="reset"
                            class="order-2 sm:order-1 inline-flex items-center justify-center gap-2 px-6 py-3.5 border border-(--secondary-color) text-(--text-color) hover:bg-[#FFFAF5] bg-(--text-light) rounded-2xl font-medium transition">
                            Discard Changes
                        </button>
                        <button type="submit"
                            class="order-1 sm:order-2 inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-(--secondary-color) hover:bg-[#B94E31] text-(--text-light) rounded-2xl font-medium transition">
                            Save Profile
                        </button>
                    </div>
                </div>
            </form>

            <!-- Security & Privacy -->
            <form action="{{ route('user.password.update') }}" method="POST" id="passwordForm">
                @csrf
                <div class="bg-(--card-bg) rounded-2xl shadow-sm p-6 hover:shadow-md transition-all duration-300">
                    <h2 class="text-xl font-semibold mb-6 flex items-center gap-2">
                        <i data-lucide="lock-keyhole"></i>
                        Security & Privacy
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- Current Password -->
                        <div>
                            <label class="block text-sm font-medium text-brand-dark mb-1">Current Password</label>
                            <div class="relative">
                                <input type="password" name="current_password" id="currentPassword"
                                    class="w-full bg-(--card-dark) rounded-xl px-4 py-3 focus:outline-none focus:ring-1 focus:ring-(--secondary-color) pr-12
                                    {{ $errors->has('current_password') ? 'ring-1 ring-red-400' : '' }}">
                                <button type="button" onclick="togglePassword('currentPassword', this)"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-(--text-color)/60 hover:text-(--text-color) transition">
                                    <i data-lucide="eye" class="w-5 h-5"></i>
                                </button>
                            </div>
                            @error('current_password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- New Password -->
                        <div>
                            <label class="block text-sm font-medium text-brand-dark mb-1">New Password</label>
                            <div class="relative">
                                <input type="password" name="new_password" id="newPassword"
                                    class="w-full bg-(--card-dark) rounded-xl px-4 py-3 focus:outline-none focus:ring-1 focus:ring-(--secondary-color) pr-12">
                                <button type="button" onclick="togglePassword('newPassword', this)"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-(--text-color)/60 hover:text-(--text-color) transition">
                                    <i data-lucide="eye" class="w-5 h-5"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Confirm New Password -->
                        <div class="md:col-span-2 md:w-1/2">
                            <label class="block text-sm font-medium text-brand-dark mb-1">Confirm New Password</label>
                            <div class="relative">
                                <input type="password" name="new_password_confirmation" id="confirmPassword"
                                    class="w-full bg-(--card-dark) rounded-xl px-4 py-3 focus:outline-none focus:ring-1 focus:ring-(--secondary-color) pr-12">
                                <button type="button" onclick="togglePassword('confirmPassword', this)"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-(--text-color)/60 hover:text-(--text-color) transition">
                                    <i data-lucide="eye" class="w-5 h-5"></i>
                                </button>
                            </div>
                            @error('new_password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password strength hints -->
                        <div class="md:col-span-2 bg-[#ebd7be]/20 border border-[#ebd7be]/60 rounded-2xl p-4 text-xs text-[#3A2A1F]/70 space-y-1.5">
                            <p class="font-bold text-[#1F3D2E] text-sm mb-1.5">Password must contain:</p>
                            <p id="hint-length" class="flex items-center gap-2"><span class="w-3.5 h-3.5 flex items-center justify-center rounded-full bg-slate-200 text-[8px] font-bold text-slate-500">○</span> At least 8 characters</p>
                            <p id="hint-upper"  class="flex items-center gap-2"><span class="w-3.5 h-3.5 flex items-center justify-center rounded-full bg-slate-200 text-[8px] font-bold text-slate-500">○</span> At least 1 uppercase letter (A–Z)</p>
                            <p id="hint-lower"  class="flex items-center gap-2"><span class="w-3.5 h-3.5 flex items-center justify-center rounded-full bg-slate-200 text-[8px] font-bold text-slate-500">○</span> At least 1 lowercase letter (a–z)</p>
                            <p id="hint-number" class="flex items-center gap-2"><span class="w-3.5 h-3.5 flex items-center justify-center rounded-full bg-slate-200 text-[8px] font-bold text-slate-500">○</span> At least 1 number (0–9)</p>
                            <p id="hint-special" class="flex items-center gap-2"><span class="w-3.5 h-3.5 flex items-center justify-center rounded-full bg-slate-200 text-[8px] font-bold text-slate-500">○</span> At least 1 special character (e.g. ! @ # $ % ^ & *)</p>
                        </div>
                    </div>

                    <div class="flex justify-end mt-8">
                        <button type="submit"
                            class="inline-flex items-center gap-2 px-8 py-3.5 bg-(--secondary-color) hover:bg-[#B94E31] text-(--text-light) rounded-2xl font-semibold transition">
                            Save Password
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Profile picture preview
        document.getElementById('profileImage').addEventListener('change', function () {
            const file = this.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = e => {
                document.getElementById('profilePreview').src = e.target.result;
                document.getElementById('deleteBtn').classList.remove('hidden');
                document.getElementById('removePic').value = '0';
            };
            reader.readAsDataURL(file);
        });

        function removeProfilePic() {
            document.getElementById('profilePreview').src = 'https://api.iconify.design/lucide/user.svg?color=%236b7280';
            document.getElementById('deleteBtn').classList.add('hidden');
            document.getElementById('removePic').value = '1';
            document.getElementById('profileImage').value = '';
        }

        function togglePassword(inputId, btn) {
            const input = document.getElementById(inputId);
            const isHidden = input.type === 'password';
            input.type = isHidden ? 'text' : 'password';
            btn.innerHTML = isHidden
                ? '<i data-lucide="eye-off" class="w-5 h-5"></i>'
                : '<i data-lucide="eye" class="w-5 h-5"></i>';
            lucide.createIcons();
        }

        // Restrict phone input to digits only, max 10
        const phoneInput = document.getElementById('profile-phone');
        if (phoneInput) {
            phoneInput.addEventListener('input', function() {
                let value = this.value.replace(/\D/g, '');
                if (value.length > 10) value = value.substring(0, 10);
                this.value = value;
            });
        }

        // Profile Form Validation
        const profileForm = document.getElementById('profileForm');
        if (profileForm) {
            profileForm.addEventListener('submit', function(e) {
                const phone = phoneInput ? phoneInput.value.trim() : '';
                let errors = [];

                if (phone) {
                    if (!/^\d+$/.test(phone)) {
                        errors.push("Phone Number must contain numbers only.");
                    } else if (phone.length !== 10) {
                        errors.push("Phone Number must be exactly 10 digits.");
                    }
                }

                if (errors.length > 0) {
                    e.preventDefault();
                    alert(errors.join("\n"));
                }
            });
        }

        // Live strength check for new password
        const pwUpperRegex   = /[A-Z]/;
        const pwLowerRegex   = /[a-z]/;
        const pwDigitRegex   = /[0-9]/;
        const pwSpecialRegex = /[\^$*.\[\]{}()?\-"!@#%&\/\\,><':;|_~`+=]/;

        const newPasswordInput = document.getElementById('newPassword');
        if (newPasswordInput) {
            newPasswordInput.addEventListener('input', function() {
                const val = this.value;
                function setHint(id, pass) {
                    const el = document.getElementById(id);
                    const indicator = el?.querySelector('span');
                    if (!el || !indicator) return;
                    if (pass) {
                        indicator.className = 'w-3.5 h-3.5 flex items-center justify-center rounded-full bg-green-500 text-[8px] font-bold text-white';
                        indicator.textContent = '✓';
                        el.classList.add('text-green-600', 'font-semibold');
                    } else {
                        indicator.className = 'w-3.5 h-3.5 flex items-center justify-center rounded-full bg-slate-200 text-[8px] font-bold text-slate-500';
                        indicator.textContent = '○';
                        el.classList.remove('text-green-600', 'font-semibold');
                    }
                }
                setHint('hint-length', val.length >= 8);
                setHint('hint-upper',  pwUpperRegex.test(val));
                setHint('hint-lower',  pwLowerRegex.test(val));
                setHint('hint-number', pwDigitRegex.test(val));
                setHint('hint-special', pwSpecialRegex.test(val));
            });
        }

        // Password Form Validation on Submit
        const passwordForm = document.getElementById('passwordForm');
        if (passwordForm) {
            passwordForm.addEventListener('submit', function(e) {
                const currentPassword = document.getElementById('currentPassword').value;
                const newPassword = document.getElementById('newPassword').value;
                const confirmPassword = document.getElementById('confirmPassword').value;
                let errors = [];

                if (!currentPassword) {
                    errors.push('Current Password is required.');
                }

                if (!newPassword) {
                    errors.push('New Password is required.');
                } else {
                    if (newPassword.length < 8)            errors.push('Password must be at least 8 characters.');
                    if (!pwUpperRegex.test(newPassword))   errors.push('Password must contain at least one uppercase letter (A–Z).');
                    if (!pwLowerRegex.test(newPassword))   errors.push('Password must contain at least one lowercase letter (a–z).');
                    if (!pwDigitRegex.test(newPassword))   errors.push('Password must contain at least one number (0–9).');
                    if (!pwSpecialRegex.test(newPassword)) errors.push('Password must contain at least one special character (e.g. ! @ # $ % ^ & *).');
                }

                if (!confirmPassword) {
                    errors.push('Confirm New Password cannot be empty.');
                } else if (newPassword !== confirmPassword) {
                    errors.push('New passwords do not match.');
                }

                if (errors.length > 0) {
                    e.preventDefault();
                    alert(errors.join('\n'));
                }
            });
        }
    </script>
</x-user-layout>
