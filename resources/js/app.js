//
import './seller-layout';
(function () {
    const hamburger     = document.getElementById('hamburger-btn');
    const drawer        = document.getElementById('mobile-drawer');
    const overlay       = document.getElementById('drawer-overlay');
    const closeBtn      = document.getElementById('close-drawer-btn');
    const mobileSearchBtn = document.getElementById('mobile-search-btn');
    const mobileSearchBar = document.getElementById('mobile-search-bar');
    const mobileSearchInput = document.getElementById('mobile-search');

    function openDrawer() {
        drawer.classList.add('open');
        overlay.classList.add('open');
        if (hamburger) hamburger.setAttribute('aria-expanded', 'true');
        document.body.style.overflow = 'hidden';
    }

    function closeDrawer() {
        drawer.classList.remove('open');
        overlay.classList.remove('open');
        if (hamburger) hamburger.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
    }

    if (hamburger) hamburger.addEventListener('click', openDrawer);
    if (closeBtn) closeBtn.addEventListener('click', closeDrawer);
    if (overlay) overlay.addEventListener('click', closeDrawer);

    // Close drawer on nav link click (smooth UX)
    if (drawer) {
        drawer.querySelectorAll('a').forEach(function(link) {
            link.addEventListener('click', closeDrawer);
        });
    }

    // Escape key closes drawer
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeDrawer();
    });

    // Mobile search toggle
    if (mobileSearchBtn && mobileSearchBar) {
        mobileSearchBtn.addEventListener('click', function() {
            const hidden = mobileSearchBar.classList.contains('hidden');
            mobileSearchBar.classList.toggle('hidden', !hidden);
            if (hidden && mobileSearchInput) {
                mobileSearchInput.focus();
            }
        });
    }

    // Login / Register Modal Logic
    const loginModal = document.getElementById('login-modal');
    const loginModalContainer = document.getElementById('login-modal-container');
    const desktopSigninBtn = document.getElementById('desktop-signin');
    const mobileSigninBtn = document.getElementById('mobile-signin');
    const mobileSignupBtn = document.getElementById('mobile-signup');
    const closeLoginModalBtn = document.getElementById('close-login-modal');

    const loginView = document.getElementById('login-view');
    const registerView = document.getElementById('register-view');
    const modalShowRegisterBtn = document.getElementById('modal-show-register');
    const modalShowLoginBtn = document.getElementById('modal-show-login');

    function openLoginModal(e, view = 'login') {
        if (e) e.preventDefault();
        closeDrawer(); // Close mobile drawer if open

        if (loginModal && loginModalContainer) {
            if (view === 'register') {
                if (loginView && registerView) {
                    loginView.classList.add('hidden');
                    registerView.classList.remove('hidden');
                }
            } else {
                if (loginView && registerView) {
                    loginView.classList.remove('hidden');
                    registerView.classList.add('hidden');
                }
            }

            loginModal.classList.remove('hidden');
            loginModal.classList.add('flex');
            
            // Trigger animation frame
            setTimeout(() => {
                loginModal.classList.remove('opacity-0');
                loginModal.classList.add('opacity-100');
                loginModalContainer.classList.remove('scale-95', 'opacity-0');
                loginModalContainer.classList.add('scale-100', 'opacity-100');
            }, 10);

            document.body.style.overflow = 'hidden';
        }
    }

    function closeLoginModal() {
        if (loginModal && loginModalContainer) {
            loginModal.classList.remove('opacity-100');
            loginModal.classList.add('opacity-0');
            loginModalContainer.classList.remove('scale-100', 'opacity-100');
            loginModalContainer.classList.add('scale-95', 'opacity-0');

            // Wait for transition to finish
            setTimeout(() => {
                loginModal.classList.remove('flex');
                loginModal.classList.add('hidden');
                // Reset to login view on close
                if (loginView && registerView) {
                    loginView.classList.remove('hidden');
                    registerView.classList.add('hidden');
                }
            }, 300);

            document.body.style.overflow = '';
        }
    }

    if (desktopSigninBtn) desktopSigninBtn.addEventListener('click', (e) => openLoginModal(e, 'login'));
    if (mobileSigninBtn) mobileSigninBtn.addEventListener('click', (e) => openLoginModal(e, 'login'));
    if (mobileSignupBtn) mobileSignupBtn.addEventListener('click', (e) => openLoginModal(e, 'register'));
    if (closeLoginModalBtn) closeLoginModalBtn.addEventListener('click', closeLoginModal);

    // Switch to Register View
    if (modalShowRegisterBtn && loginView && registerView) {
        modalShowRegisterBtn.addEventListener('click', function(e) {
            e.preventDefault();
            loginView.classList.add('hidden');
            registerView.classList.remove('hidden');
        });
    }

    // Switch to Login View
    if (modalShowLoginBtn && loginView && registerView) {
        modalShowLoginBtn.addEventListener('click', function(e) {
            e.preventDefault();
            registerView.classList.add('hidden');
            loginView.classList.remove('hidden');
        });
    }

    // Close on clicking outside the modal container
    if (loginModal) {
        loginModal.addEventListener('click', function(e) {
            if (e.target === loginModal) {
                closeLoginModal();
            }
        });
    }

    // Escape key closes modal too
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeLoginModal();
        }
    });

    // Password visibility toggle for login modal
    const modalTogglePassword = document.getElementById('modal-toggle-password');
    const modalPasswordInput = document.getElementById('modal-password');
    if (modalTogglePassword && modalPasswordInput) {
        modalTogglePassword.addEventListener('click', function() {
            const type = modalPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            modalPasswordInput.setAttribute('type', type);
            const icon = modalTogglePassword.querySelector('i');
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

    // Password visibility toggle for register modal
    const modalRegisterTogglePassword = document.getElementById('modal-register-toggle-password');
    const modalRegisterPasswordInput = document.getElementById('modal-register-password');
    if (modalRegisterTogglePassword && modalRegisterPasswordInput) {
        modalRegisterTogglePassword.addEventListener('click', function() {
            const type = modalRegisterPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            modalRegisterPasswordInput.setAttribute('type', type);
            const icon = modalRegisterTogglePassword.querySelector('i');
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

    // Confirm password visibility toggle for register modal
    const modalRegisterTogglePasswordConfirm = document.getElementById('modal-register-toggle-password-confirm');
    const modalRegisterPasswordConfirmInput = document.getElementById('modal-register-password_confirmation');
    if (modalRegisterTogglePasswordConfirm && modalRegisterPasswordConfirmInput) {
        modalRegisterTogglePasswordConfirm.addEventListener('click', function() {
            const type = modalRegisterPasswordConfirmInput.getAttribute('type') === 'password' ? 'text' : 'password';
            modalRegisterPasswordConfirmInput.setAttribute('type', type);
            const icon = modalRegisterTogglePasswordConfirm.querySelector('i');
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

    // Phone format filter for register modal
    const modalRegisterPhoneInput = document.getElementById('modal-register-phone');
    if (modalRegisterPhoneInput) {
        modalRegisterPhoneInput.addEventListener('input', function() {
            let value = this.value.replace(/\D/g, '');
            if (value.length > 10) value = value.substring(0, 10);
            this.value = value;
        });
    }
})();

