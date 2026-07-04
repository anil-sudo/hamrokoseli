document.addEventListener('DOMContentLoaded', () => {
    lucide.createIcons();

    const profilePreview = document.getElementById('profilePreview');
    const deleteBtn = document.getElementById('deleteBtn');
    const fileInput = document.getElementById('profileImage');
    const profileContainer = document.getElementById('profileContainer');

    const defaultAvatar = "https://api.iconify.design/lucide/user.svg?color=%236b7280";

    // ====================== TOAST ======================
    function showToast(message, type = 'success') {
        const toast = document.createElement('div');
        toast.className = `
            fixed right-5 top-5 px-5 py-3 rounded-lg shadow-lg z-50
            transition-all duration-300 text-sm font-medium
            ${type === 'error'
                ? 'bg-red-50 text-red-600 border border-red-200'
                : 'bg-white text-(--secondary-color) border border-(--secondary-color)/20'}
        `;
        toast.innerText = message;
        document.body.appendChild(toast);

        setTimeout(() => {
            toast.style.opacity = '0';
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }

    // ====================== ERROR HANDLING ======================
    function showError(input, message) {
        removeError(input);
        const error = document.createElement("p");
        error.className = "text-red-500 text-xs mt-1 error";
        error.innerText = message;
        input.parentElement.appendChild(error);
        input.classList.add("border-red-500", "focus:ring-red-500");
    }

    function removeError(input) {
        const error = input.parentElement.querySelector(".error");
        if (error) error.remove();
        input.classList.remove("border-red-500", "focus:ring-red-500");
    }

    function clearAllErrors(form) {
        form.querySelectorAll('input, select').forEach(input => removeError(input));
    }

    // ====================== PROFILE PICTURE ======================
    if (profileContainer) {
        profileContainer.addEventListener('click', (e) => {
            if (e.target.closest('#deleteBtn')) return;
            fileInput.click();
        });
    }

    fileInput.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (!file) return;

        if (!file.type.startsWith('image/')) {
            showToast('Please select a valid image file.', 'error');
            return;
        }
        if (file.size > 100 * 1024) {
            showToast('Profile picture must be less than 100KB.', 'error');
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

    deleteBtn.addEventListener('click', () => {
        profilePreview.src = defaultAvatar;
        fileInput.value = '';
        deleteBtn.classList.add('hidden');
    });

    // ====================== PASSWORD TOGGLE ======================
    function setupPasswordToggle(inputId, buttonId) {
        const input = document.getElementById(inputId);
        const button = document.getElementById(buttonId);

        button.addEventListener('click', () => {
            const isHidden = input.type === 'password';
            input.type = isHidden ? 'text' : 'password';

            button.innerHTML = isHidden
                ? '<i data-lucide="eye-off" class="w-5 h-5"></i>'
                : '<i data-lucide="eye" class="w-5 h-5"></i>';

            lucide.createIcons();
        });
    }

    setupPasswordToggle('currentPassword', 'toggleCurrent');
    setupPasswordToggle('newPassword', 'toggleNew');

    // ====================== VALIDATION HELPERS ======================
    function isValidEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    function isValidPhone(phone) {
        return /^[0-9]{10}$/.test(phone); // Nepal 10 digit
    }

    function isValidName(name) {
        return name.trim().length >= 2 && /^[a-zA-Z\s\u0900-\u097F]+$/.test(name); // English + Nepali
    }

    // ====================== PROFILE FORM VALIDATION ======================
    const saveProfileBtn = document.getElementById('saveProfileBtn');

    if (saveProfileBtn) {
        saveProfileBtn.addEventListener('click', (e) => {
            // e.preventDefault();

            const nameInput = document.querySelector('input[placeholder="Enter your name"]');
            const emailInput = document.querySelector('input[type="email"]');
            const phoneInput = document.querySelector('input[type="tel"]');
            const regionInput = document.querySelector('input[placeholder="e.g. kathmandu valley"]');
            const addressInput = document.querySelector('input[placeholder="e.g. Ward 3, Jhamsikhel, Lalitpur, Nepal"]');

            let isValid = true;

            // Full Name
            if (!nameInput.value.trim()) {
                showError(nameInput, "Full name is required");
                isValid = false;
            } else if (!isValidName(nameInput.value)) {
                showError(nameInput, "Please enter a valid name");
                isValid = false;
            }

            // Email
            if (!emailInput.value.trim()) {
                showError(emailInput, "Email is required");
                isValid = false;
            } else if (!isValidEmail(emailInput.value)) {
                showError(emailInput, "Please enter a valid email address");
                isValid = false;
            }

            // Phone
            if (!phoneInput.value.trim()) {
                showError(phoneInput, "Phone number is required");
                isValid = false;
            } else if (!isValidPhone(phoneInput.value)) {
                showError(phoneInput, "Please enter a valid 10-digit phone number");
                isValid = false;
            }

            // Region
            if (!regionInput.value.trim()) {
                showError(regionInput, "Preferred delivery region is required");
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault();
                return;
            }

            // Success
            // showToast("Profile updated successfully!");
        });
    }

    // ====================== PASSWORD FORM VALIDATION ======================
    const savePasswordBtn = document.getElementById('savePasswordBtn');

    if (savePasswordBtn) {
        savePasswordBtn.addEventListener('click', (e) => {
            e.preventDefault();

            const currentPass = document.getElementById('currentPassword');
            const newPass = document.getElementById('newPassword');

            // Clear previous errors
            removeError(currentPass);
            removeError(newPass);

            let isValid = true;

            // Current Password → Optional
            if (currentPass.value.trim() !== "") {
                if (currentPass.value.length < 6) {
                    showError(currentPass, "Current password must be at least 6 characters");
                    isValid = false;
                }
            }

            // New Password → Required
            if (!newPass.value.trim()) {
                showError(newPass, "New password is required");
                isValid = false;
            }
            else if (newPass.value.length < 8) {
                showError(newPass, "New password must be at least 8 characters long");
                isValid = false;
            }
            else if (!/[A-Z]/.test(newPass.value)) {
                showError(newPass, "Password must contain at least one uppercase letter");
                isValid = false;
            }
            else if (!/[0-9]/.test(newPass.value)) {
                showError(newPass, "Password must contain at least one number");
                isValid = false;
            }

            // Check if both filled and same
            if (currentPass.value.trim() && newPass.value.trim() &&
                currentPass.value === newPass.value) {
                showError(newPass, "New password cannot be the same as current password");
                isValid = false;
            }

            if (!valid) return;

            // Success
            // showToast("Password changed successfully!");

        });
    }
    // ====================== BANK FORM VALIDATION ======================
    const saveBankBtn = document.getElementById('saveBankBtn');

    if (saveBankBtn) {
        saveBankBtn.addEventListener('click', (e) => {
            e.preventDefault();

            const accName = document.getElementById('accName');
            const bankName = document.getElementById('bankName');
            const accNumber = document.getElementById('accNumber');
            const accType = document.getElementById('accType');
            const branchName = document.getElementById('branchName');

            let isValid = true;

            // Clear previous errors
            [accName, bankName, accNumber, accType, branchName].forEach(removeError);

            // Account Holder Name
            if (!accName.value.trim()) {
                showError(accName, "Account holder name is required");
                isValid = false;
            }

            // Bank Name
            if (!bankName.value.trim()) {
                showError(bankName, "Bank name is required");
                isValid = false;
            }

            // Account Number
            if (!accNumber.value.trim()) {
                showError(accNumber, "Account number is required");
                isValid = false;
            } else if (!/^\d{8,20}$/.test(accNumber.value.replace(/\s/g, ''))) {
                showError(accNumber, "Account number must be 8-20 digits");
                isValid = false;
            }

            // Account Type
            if (!accType.value) {
                showError(accType, "Please select an account type");
                isValid = false;
            }

            if (!valid) return;

            // Success
            // showToast("Bank information saved successfully!");

        });
    }
});
