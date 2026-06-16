<x-seller_layout title="Edit Product">
    <div class="space-y-10">
        <!-- Header -->
        <div>
            <h1 class="text-3xl font-bold text-(--text-color)">Account Settings</h1>
            <p class="text-sm text-(--text-color)/70 mt-1">Manage your profile information </p>
        </div>

        <div class="space-y-6">
            <!-- Profile Information -->
            <div class="bg-(--card-bg) rounded-2xl shadow-sm p-6">
                <div class="flex items-start gap-6">
                    <!-- Profile Picture -->
                    <div id="profileContainer" class="relative group cursor-pointer">
                        <img id="profilePreview" src="https://api.iconify.design/lucide/user.svg?color=%236b7280"
                            alt="Profile"
                            class="w-24 h-24 rounded-full object-cover border border-(--text-color)/10 shadow bg-(--card-dark)">

                        <!-- Hover Overlay -->
                        <div
                            class="absolute inset-0 bg-black/40 rounded-full opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                            <i data-lucide="camera" class="w-5 h-5 text-white"></i>
                        </div>

                        <!-- Delete Button (hidden by default) -->
                        <button type="button" id="deleteBtn"
                            class="absolute -top-1 -right-1 bg-red-500 hover:bg-red-600 text-white p-1 rounded-full transition hidden">
                            <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                        </button>

                        <!-- Hidden File Input -->
                        <input type="file" id="profileImage" accept="image/*" class="hidden">
                    </div>

                    <!-- Form Fields -->
                    <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-brand-dark mb-2">Full Name <span
                                    class="text-(--secondary-color)">*</span></label>
                            <input type="text" placeholder="Enter your name"
                                class="w-full bg-(--card-dark) rounded-xl px-4 py-3 focus:outline-none focus:ring-1 focus:ring-(--secondary-color)">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-brand-dark mb-1">Email Address <span
                                    class="text-(--secondary-color)">*</span></label>
                            <input type="email" placeholder="e.g. example22@gmail.com"
                                class="w-full bg-(--card-dark) rounded-xl px-4 py-3 focus:outline-none focus:ring-1 focus:ring-(--secondary-color)">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-brand-dark mb-1">Phone Number <span
                                    class="text-(--secondary-color)">*</span></label>
                            <input type="tel" placeholder="e.g. 1234567890"
                                class="w-full bg-(--card-dark) rounded-xl px-4 py-3 focus:outline-none focus:ring-1 focus:ring-(--secondary-color)">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-brand-dark mb-1">Preferred Delivery
                                Region<span class="text-(--secondary-color)">*</span></label>
                            <input type="text" placeholder="e.g. kathmandu valley"
                                class="w-full bg-(--card-dark) rounded-xl px-4 py-3 focus:outline-none focus:ring-1 focus:ring-(--secondary-color)">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-brand-dark mb-1">
                                Default Delivery Address
                            </label>
                            <input type="text" placeholder="e.g. Ward 3, Jhamsikhel, Lalitpur, Nepal"
                                class="w-full bg-(--card-dark) rounded-xl px-4 py-3 focus:outline-none focus:ring-1 focus:ring-(--secondary-color)">
                        </div>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mt-8">

                    <button type="submit"
                        class="order-1 sm:order-2 inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-(--secondary-color) hover:bg-[#B94E31] text-(--text-light) rounded-2xl font-medium transition">
                        Save &nbsp; Profile
                    </button>
                    <a href="#"
                        class="order-2 sm:order-1 inline-flex items-center justify-center gap-2 px-6 py-3.5 border border-(--secondary-color) text-(--text-color)! hover:bg-[#FFFAF5] bg-(--text-light) rounded-2xl font-medium transition">
                        Discard &nbsp; Changes
                    </a>

                </div>
            </div>

            <!-- Security & Privacy -->
            <div class="bg-(--card-bg) rounded-2xl shadow-sm p-6">
                <h2 class="text-xl font-semibold mb-6 flex items-center gap-2">
                    <i data-lucide="lock-keyhole" class="w-5 h-5"></i>
                    Security & Privacy
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Current Password -->
                    <div>
                        <label class="block text-sm font-medium text-brand-dark mb-1">Current Password</label>
                        <div class="relative">
                            <input type="password" id="currentPassword"
                                class="w-full bg-(--card-dark) rounded-xl px-4 py-3 focus:outline-none focus:ring-1 focus:ring-(--secondary-color) pr-12">
                            <button type="button" id="toggleCurrent"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-(--text-color)/60 hover:text-(--text-color) transition">
                                <i data-lucide="eye" class="w-5 h-5"></i>
                            </button>
                        </div>
                    </div>

                    <!-- New Password -->
                    <div>
                        <label class="block text-sm font-medium text-brand-dark mb-1">New Password</label>
                        <div class="relative">
                            <input type="password" id="newPassword"
                                class="w-full bg-(--card-dark) rounded-xl px-4 py-3 focus:outline-none focus:ring-1 focus:ring-(--secondary-color) pr-12">
                            <button type="button" id="toggleNew"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-(--text-color)/60 hover:text-(--text-color) transition">
                                <i data-lucide="eye" class="w-5 h-5"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end mt-8">
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-8 py-3.5 bg-(--secondary-color) hover:bg-[#B94E31] text-(--text-light) rounded-2xl font-semibold transition">
                        Save &nbsp; Password
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showToast(message) {
            const toast = document.createElement('div');

            toast.className = `
        fixed right-5 top-5 text-(--secondary-color) bg-white
        px-5 py-3 rounded-lg shadow-lg z-50
        transition-all duration-300`;

            toast.innerText = message;

            document.body.appendChild(toast);

            setTimeout(() => {
                toast.remove();
            }, 3000);
        }
        document.addEventListener('DOMContentLoaded', () => {

            // Initialize Lucide
            lucide.createIcons();

            const profilePreview = document.getElementById('profilePreview');
            const deleteBtn = document.getElementById('deleteBtn');
            const fileInput = document.getElementById('profileImage');
            const profileContainer = document.getElementById('profileContainer');

            const defaultAvatar =
                "https://api.iconify.design/lucide/user.svg?color=%236b7280";

            // ==========================
            // Upload Profile Picture
            // ==========================
            if (profileContainer) {
                profileContainer.addEventListener('click', (e) => {

                    if (e.target.closest('#deleteBtn')) {
                        return;
                    }

                    fileInput.click();
                });
            }

            fileInput.addEventListener('change', (e) => {

                const file = e.target.files[0];

                if (!file) return;

                // Image Validation
                if (!file.type.startsWith('image/')) {
                    showToast('Please select a valid image.');
                    return;
                }
                // Image Size Validation (500KB)
                if (file.size > 100 * 1024) {
                    showToast('Profile picture must be less than 100KB.');
                    fileInput.value = '';
                    return;
                }
                const reader = new FileReader();

                reader.onload = (event) => {
                    profilePreview.src = event.target.result;
                    deleteBtn.classList.remove('hidden');
                };

                reader.readAsDataURL(file);
            });

            // ==========================
            // Delete Profile Picture
            // ==========================
            deleteBtn.addEventListener('click', () => {
                profilePreview.src = defaultAvatar;
                fileInput.value = '';
                deleteBtn.classList.add('hidden');
            });

            // ==========================
            // Password Toggle Function
            // ==========================
            function setupPasswordToggle(inputId, buttonId) {

                const input = document.getElementById(inputId);
                const button = document.getElementById(buttonId);

                button.addEventListener('click', () => {

                    const isHidden = input.type === 'password';

                    input.type = isHidden ? 'text' : 'password';

                    button.innerHTML = isHidden ?
                        '<i data-lucide="eye-off" class="w-5 h-5"></i>' :
                        '<i data-lucide="eye" class="w-5 h-5"></i>';

                    lucide.createIcons();
                });
            }

            setupPasswordToggle('currentPassword', 'toggleCurrent');
            setupPasswordToggle('newPassword', 'toggleNew');
        });
    </script>
</x-seller_layout>
