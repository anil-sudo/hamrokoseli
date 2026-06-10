<x-frontend-layout>
    <div class="max-w-4xl mx-auto px-6 py-12">
        <!-- Hero Title -->
        <div class="text-center mb-10">
            <h1 class="text-3xl sm:text-4xl md:text-4xl lg:text-5xl font-bold mb-3 sm:mb-4 tracking-tight leading-tight">
                Join our Artisan Community
            </h1>
            <p class="text-[#3A2A1F] text-sm sm:text-base md:text-lg mb-6 sm:mb-8 max-w-xl mx-auto px-2">
                Start selling your art and handmade creations on HamroKoseli
            </p>
        </div>

        <!-- Form Container -->
        <div class="bg-(--card-dark) rounded-3xl shadow-sm overflow-hidden">
            <form method="POST" id="sellerForm" class="p-8 md:p-12">
                @csrf
                <!-- Artist Profile -->
                <div class="mb-12">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-9 h-9 bg-[#E5DCD0]/60 rounded-2xl flex items-center justify-center text-xl">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-brand-dark">Artist Profile</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-brand-dark mb-2">Full Name</label>
                            <input type="text" id="fullName"
                                class="w-full px-6 py-4 bg-(--card-bg) border border-(--bg-color)/30 rounded-xl focus:outline-none focus:border-(--secondary-color) transition duration-200"
                                placeholder="Enter your name" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-brand-dark mb-2">Shop Name</label>
                            <input type="text" id="shopName"
                                class="w-full px-6 py-4 bg-(--card-bg) border border-(--bg-color)/30 rounded-xl focus:outline-none focus:border-(--secondary-color) transition duration-200"
                                placeholder="Enter your shop name" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-brand-dark mb-2">Email Address</label>
                            <input type="email" id="email"
                                class="w-full px-6 py-4 bg-(--card-bg) border border-(--bg-color)/30 rounded-xl focus:outline-none focus:border-(--secondary-color) transition duration-200"
                                placeholder="Enter your email address" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-brand-dark mb-2">Phome Number</label>
                            <input type="tel" id="phone"
                                class="w-full px-6 py-4 bg-(--text-light) border border-(--bg-color)/30 rounded-xl focus:outline-none focus:border-(--secondary-color) transition duration-200"
                                placeholder="Enter phone number" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-brand-dark mb-2">Address</label>
                            <input type="text" id="address"
                                class="w-full px-6 py-4 bg-(--text-light) border border-(--bg-color)/30 rounded-xl focus:outline-none focus:border-(--secondary-color) transition duration-200"
                                placeholder="Enter your address" required>
                        </div>
                    </div>

                </div>

                <!-- Creative Identity -->
                <div class="mb-12">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-9 h-9 bg-[#E5DCD0]/60 rounded-2xl flex items-center justify-center text-xl">
                            <i class="fa-solid fa-palette"></i>
                        </div>
                        <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-brand-dark">Creative Identity</h2>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-brand-dark mb-2">CATEGORY</label>
                        <select id="category"
                            class="w-full px-6 py-4 bg-(--card-bg) border border-(--bg-color)/30 rounded-xl focus:outline-none focus:border-(--secondary-color) transition duration-200">
                            <option value="">Select your craft</option>
                            <option value="pottery">Pottery & Ceramics</option>
                            <option value="weaving">Hand Weaving & Textiles</option>
                            <option value="woodwork">Woodwork & Carving</option>
                            <option value="jewelry">Jewelry & Beadwork</option>
                            <option value="painting">Painting & Thangka</option>
                            <option value="metal">Metal Craft</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-brand-dark mb-2">ABOUT YOUR CRAFT</label>
                        <textarea id="aboutCraft" rows="5"
                            class="w-full px-6 py-4 bg-(--card-bg) border border-(--bg-color)/30 rounded-xl focus:outline-none focus:border-(--secondary-color) transition duration-200"
                            placeholder="Tell us about your artistic journey and what you create..."></textarea>
                        <p class="text-xs text-(--text-dark)/90 mt-2">Sharing your story helps customers connect with
                            your art.
                        </p>
                    </div>
                </div>

                <!-- Verification & Legal -->
                <div class="mb-12">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-9 h-9 bg-[#E5DCD0]/60 rounded-2xl flex items-center justify-center text-xl">
                            <i class="fa-regular fa-file-lines"></i>
                        </div>
                        <h2 class="text-3xl font-semibold text-[#2c1810]">Verification & Legal</h2>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-brand-dark mb-2">DOCUMENT TYPE</label>
                        <select id="docType"
                            class="w-full px-6 py-4 bg-(--card-bg) border border-(--bg-color)/30 rounded-xl focus:outline-none focus:border-(--secondary-color) transition duration-200">
                            <option value="citizenship">Citizenship ID</option>
                            <option value="national_id">National ID Card</option>
                            <option value="pan_vat">PAN/VAT Registration</option>
                            <option value="business_license">Business Registration Certificate</option>
                        </select>
                    </div>

                    <!-- Upload Area -->
                    <div>
                        <label class="block text-sm font-medium text-brand-dark mb-2">UPLOAD DOCUMENT</label>
                        <div id="fileNameDisplay" class="mt-4 text-sm text-green-600 font-medium hidden"></div>
                        <div id="uploadZone"
                            class="border-2 border-dashed border-(--text-light) rounded-3xl p-12 text-center cursor-pointer hover:bg-(--card-bg) transition-all duration-300">
                            <div
                                class="mx-auto w-16 h-16 bg-[#E5DCD0]/60 rounded-2xl flex items-center justify-center mb-4">
                                <i class="fas fa-cloud-upload-alt text-4xl text-(--secondary-color)"></i>
                            </div>
                            <p class="font-medium text-(--text-color)">Click to upload or drag and drop</p>
                            <p class="text-sm text(--text-color) mt-1">PNG, JPG, PDF (Max 5MB)</p>
                            <input type="file" id="document" accept="image/*,.pdf" class="hidden">
                        </div>
                    </div>
                </div>

                <!-- Social & Portfolio -->
                <div class="mb-12">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-9 h-9 bg-[#E5DCD0]/60 rounded-2xl flex items-center justify-center text-xl">
                            <i class="fa-brands fa-dribbble"></i>
                        </div>
                        <h2 class="text-3xl font-semibold text-[#2c1810]">Social & Portfolio</h2>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-brand-dark mb-2">PORTFOLIO LINK / SOCIAL MEDIA
                            <span class="text-(--text-dark)/60">(OPTIONAL)</span></label>
                        <input type="url" id="portfolio"
                            class="w-full px-6 py-4 bg-(--card-bg) border border-(--bg-color)/30 rounded-xl focus:outline-none focus:border-(--secondary-color) transition duration-200"
                            placeholder="https://instagram.com/your-art">
                        <p class="text-xs text-(--text-dark)/90 mt-2">Help us verify your work by sharing where you show
                            it off!
                        </p>
                    </div>
                </div>

                <!-- Terms -->
                <div class="flex items-start gap-3 mb-10">
                    <input type="checkbox" id="terms"
                        class="mt-1 w-5 h-5 accent-(--secondary-color) cursor-pointer">
                    <label for="terms" class="text-sm leading-relaxed text-(--text-color)/90">
                        I agree to the <a href="#" class="text-(--text-dark) hover:underline">Terms and
                            Conditions</a>
                        and understand that HamroKoseli supports fair trade for local artisans.
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-(--secondary-color)/95 hover:bg-(--secondary-color) text-(--text-light) font-semibold text-lg py-5 rounded-3xl transition-all duration-300 shadow-lg flex items-center justify-center gap-3">
                    <span>Register as an Artist</span>
                    <i class="fas fa-arrow-right"></i>
                </button>

                <div class="text-center mt-6">
                    <p class="text-sm text-(--text-color)/70">
                        Already have an account?
                        <a href="#" class="text-(--text-dark) font-medium hover:underline">Login</a>
                    </p>
                </div>
            </form>
        </div>

        <!-- Trust Badges -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-16">
            <div class="text-center">
                <div
                    class="w-12 h-12 mx-auto bg-[#E5DCD0]/60 rounded-2xl shadow flex items-center justify-center text-4xl mb-4">
                    <i class="fa-solid fa-truck"></i>
                </div>
                <p class="font-semibold text-(--text-dark)">Easy Shipping</p>
                <p class="text-sm text-(--text-color) mt-2">We handle the logistics so you can focus on creating.</p>
            </div>
            <div class="text-center">
                <div
                    class="w-12 h-12 mx-auto bg-[#E5DCD0]/60 rounded-2xl shadow flex items-center justify-center text-4xl mb-4">
                    <i class="fa-solid fa-lock"></i>
                </div>
                <p class="font-semibold text-(--text-dark)">Secure Payments</p>
                <p class="text-sm text-(--text-color) mt-2">Direct bank transfers for every piece you sell.</p>
            </div>
            <div class="text-center">
                <div
                    class="w-12 h-12 mx-auto bg-[#E5DCD0]/60 rounded-2xl shadow flex items-center justify-center text-4xl mb-4">
                    <i class="fa-solid fa-users"></i>
                </div>
                <p class="font-semibold text-(--text-dark)">Seller Community</p>
                <p class="text-sm text-(--text-color) mt-2">Access workshops and networking with other Nepalese
                    artists.</p>
            </div>
        </div>
    </div>

    <!-- Bottom Banner -->
    <div class="mt-20 mb-20">
        <div class="relative max-w-6xl mx-auto h-100.5 overflow-hidden rounded-3xl shadow-xl">

            <!-- Image -->
            <img src="{{ asset('images/craft.png') }}" alt="Artisan crafts" class="w-full h-full object-cover">

            <!-- Dark Overlay -->
            <div class="absolute inset-0 bg-black/40"></div>

            <!-- Content -->
            <div class="absolute bottom-10 left-5 md:bottom-14 md:left-14 max-w-xl">
                <p class="text-(--hover-color) text-xs md:text-sm tracking-[0.3em] uppercase mb-3">
                    Every Creation Has a Story
                </p>

                <h2 class="text-(--text-light) text-3xl md:text-5xl font-bold leading-tight mb-4">
                    Tell Yours on HamroKoseli
                </h2>

                <p class="text-(--text-light)/90 text-sm md:text-base leading-relaxed">
                    Share authentic handmade products, connect with customers,
                    and let your craftsmanship reach homes across Nepal.
                </p>

            </div>

        </div>
    </div>

    <script>
        // ==================== DRAG & DROP UPLOAD ====================
        const uploadZone = document.getElementById('uploadZone');
        const fileInput = document.getElementById('document');
        const fileNameDisplay = document.getElementById('fileNameDisplay');

        uploadZone.addEventListener('click', () => {
            fileInput.click();
        });

        fileInput.addEventListener('change', (e) => {
            handleFile(e.target.files[0]);
        });

        // Drag & Drop
        uploadZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadZone.classList.add('!border-orange-500', 'bg-orange-50', 'scale-[1.02]');
        });

        uploadZone.addEventListener('dragleave', () => {
            uploadZone.classList.remove('!border-orange-500', 'bg-orange-50', 'scale-[1.02]');
        });

        uploadZone.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadZone.classList.remove('!border-orange-500', 'bg-orange-50', 'scale-[1.02]');
            handleFile(e.dataTransfer.files[0]);
        });

        function handleFile(file) {
            if (!file) return;

            if (file.size > 5 * 1024 * 1024) {
                alert("File is too large! Maximum size is 5MB.");
                return;
            }

            // Show selected file
            fileNameDisplay.classList.remove('hidden');
            fileNameDisplay.innerHTML = `
                <i class="fas fa-check-circle"></i>
                <span>${file.name}</span>
            `;
        }

        const sellerForm = document.getElementById('sellerForm');

        sellerForm.addEventListener('submit', function(e) {

            const fullName = document.getElementById('fullName').value.trim();
            const shopName = document.getElementById('shopName').value.trim();
            const email = document.getElementById('email').value.trim();
            const phone = document.getElementById('phone').value.trim();
            const termsChecked = document.getElementById('terms').checked;

            let isValid = true;
            let errorMessage = "";

            // Validation
            if (!fullName) {
                isValid = false;
                errorMessage += "Full Name is required.\n";
            }
            if (!shopName) {
                isValid = false;
                errorMessage += "Shop Name is required.\n";
            }
            if (!email) {
                isValid = false;
                errorMessage += "Email Address is required.\n";
            } else if (!email.includes('@')) {
                isValid = false;
                errorMessage += "Please enter a valid email.\n";
            }
            if (!phone) {
                isValid = false;
                errorMessage += "Phone Number is required.\n";
            }
            if (!termsChecked) {
                isValid = false;
                errorMessage += "You must agree to the Terms and Conditions.\n";
            }

            if (!isValid) {
                e.preventDefault();
                alert(errorMessage);
                return;
            }
        });

        const phoneInput = document.getElementById('phone');
        phoneInput.addEventListener('input', function() {
            let value = this.value.replace(/\D/g, '');
            if (value.length > 10) value = value.substring(0, 10);
            this.value = value;
        });
    </script>
</x-frontend-layout>
