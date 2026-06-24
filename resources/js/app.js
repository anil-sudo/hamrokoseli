//
import './seller-layout';
document.addEventListener('DOMContentLoaded', () => {
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

    // Keep track of the original page URL before showing the modal
    let originalUrl = window.location.pathname + window.location.search;
    if (originalUrl === '/userlogin' || originalUrl === '/userregister') {
        originalUrl = '/';
    }

    // Helper: Update Browser Address Bar URL State
    function updateUrlState(view) {
        const path = view === 'register' ? '/userregister' : '/userlogin';
        if (window.location.pathname !== path) {
            history.pushState({ modal: view }, '', path);
        }
    }

    // Helper: Restore URL State to Original
    function restoreUrlState() {
        if (window.location.pathname === '/userlogin' || window.location.pathname === '/userregister') {
            history.pushState({ modal: null }, '', originalUrl);
        }
    }

    function openLoginModal(e, view = 'login') {
        if (e) e.preventDefault();
        closeDrawer(); // Close mobile drawer if open

        // Store original URL if opening the modal for the first time
        if (loginModal && loginModal.classList.contains('hidden')) {
            const currentPath = window.location.pathname + window.location.search;
            if (currentPath !== '/userlogin' && currentPath !== '/userregister') {
                originalUrl = currentPath;
            }
        }

        if (loginModal && loginModalContainer) {
            if (view === 'register') {
                if (loginView && registerView) {
                    loginView.classList.add('hidden');
                    registerView.classList.remove('hidden');
                }
                updateUrlState('register');
            } else {
                if (loginView && registerView) {
                    loginView.classList.remove('hidden');
                    registerView.classList.add('hidden');
                }
                updateUrlState('login');
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
            restoreUrlState();

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

    // Export functions to window object
    window.openLoginModal = openLoginModal;
    window.closeLoginModal = closeLoginModal;

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
            updateUrlState('register');
        });
    }

    // Switch to Login View
    if (modalShowLoginBtn && loginView && registerView) {
        modalShowLoginBtn.addEventListener('click', function(e) {
            e.preventDefault();
            registerView.classList.add('hidden');
            loginView.classList.remove('hidden');
            updateUrlState('login');
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

    // Browser back/forward (history state) support
    window.addEventListener('popstate', function(e) {
        const path = window.location.pathname;
        if (path === '/userlogin') {
            openLoginModal(null, 'login');
        } else if (path === '/userregister') {
            openLoginModal(null, 'register');
        } else {
            if (loginModal && !loginModal.classList.contains('hidden')) {
                closeLoginModal();
            }
        }
    });

    // Auto-open modal on page load if direct URL
    const pathOnLoad = window.location.pathname;
    if (pathOnLoad === '/userlogin') {
        openLoginModal(null, 'login');
    } else if (pathOnLoad === '/userregister') {
        openLoginModal(null, 'register');
    }

    // Helper for press-and-hold password toggling
    function setupPasswordToggle(toggleBtn, passwordInput) {
        if (!toggleBtn || !passwordInput) return;

        const icon = toggleBtn.querySelector('i');
        
        const showPassword = (e) => {
            if (e) e.preventDefault();
            passwordInput.type = 'text';
            if (icon) {
                icon.className = 'fas fa-eye text-sm';
            }
        };

        const hidePassword = (e) => {
            if (e) e.preventDefault();
            passwordInput.type = 'password';
            if (icon) {
                icon.className = 'far fa-eye-slash text-sm';
            }
        };

        // Mouse events
        toggleBtn.addEventListener('mousedown', showPassword);
        toggleBtn.addEventListener('mouseup', hidePassword);
        toggleBtn.addEventListener('mouseleave', hidePassword);

        // Touch events
        toggleBtn.addEventListener('touchstart', showPassword);
        toggleBtn.addEventListener('touchend', hidePassword);
        toggleBtn.addEventListener('touchcancel', hidePassword);
        
        // Prevent click default
        toggleBtn.addEventListener('click', (e) => e.preventDefault());
    }

    // Password visibility toggles for login modal
    setupPasswordToggle(
        document.getElementById('modal-toggle-password'),
        document.getElementById('modal-password')
    );

    // Password visibility toggles for register modal
    setupPasswordToggle(
        document.getElementById('modal-register-toggle-password'),
        document.getElementById('modal-register-password')
    );

    // Confirm password visibility toggles for register modal
    setupPasswordToggle(
        document.getElementById('modal-register-toggle-password-confirm'),
        document.getElementById('modal-register-password_confirmation')
    );

    // Phone format filter for register modal
    const modalRegisterPhoneInput = document.getElementById('modal-register-phone');
    if (modalRegisterPhoneInput) {
        modalRegisterPhoneInput.addEventListener('input', function() {
            let value = this.value.replace(/\D/g, '');
            if (value.length > 10) value = value.substring(0, 10);
            this.value = value;
        });
    }

    // ==================== WISHLIST FEATURE LOGIC ====================
    let wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
    const wishlistGridContainer = document.getElementById('wishlist-grid-container');

    // Helper: Seeding defaults on first visit if we are on the wishlist page
    if (wishlistGridContainer && wishlist.length === 0 && !localStorage.getItem('wishlist_visited')) {
        wishlist = [
            {
                id: "1",
                name: "Patan Bronze Bowl",
                price: "4500",
                image: "/images/1st-image.png",
                desc: "Hand-hammered ritual vessel by local metalsmiths.",
                category: "Metalware",
                tag: "Authentic Patan"
            },
            {
                id: "201",
                name: "Yak Wool Scarf",
                price: "3200",
                image: "/images/4th-image.png",
                desc: "100% pure Himalayan wool, naturally dyed.",
                category: "Textiles",
                tag: "Artisan Made"
            },
            {
                id: "202",
                name: "Traditional Dhaka Topi",
                price: "1800",
                image: "/images/Sweaters.png",
                desc: "Hand-woven patterns from the Palpa region.",
                category: "Textiles"
            },
            {
                id: "203",
                name: "Wild Hemp Backpack",
                price: "5600",
                image: "/images/aboutus.jpg",
                desc: "Durable, sustainable, and 100% biodegradable.",
                category: "Accessories"
            }
        ];
        localStorage.setItem('wishlist', JSON.stringify(wishlist));
        localStorage.setItem('wishlist_visited', 'true');
    }

    // Helper: Create/Retrieve Toast Container
    function getToastContainer() {
        let container = document.getElementById('toast-container');
        if (!container) {
            container = document.createElement('div');
            container.id = 'toast-container';
            container.className = 'toast-container';
            document.body.appendChild(container);
        }
        return container;
    }

    // Show Sleek Toast Notification
    function showToast(message, type = 'success') {
        const container = getToastContainer();
        const toast = document.createElement('div');
        toast.className = 'toast-item';
        
        let iconClass = 'fa-regular fa-circle-check text-emerald-500';
        if (type === 'info') {
            iconClass = 'fa-solid fa-circle-info text-sky-500';
        }
        
        toast.innerHTML = `<i class="${iconClass}"></i><span>${message}</span>`;
        container.appendChild(toast);
        
        // Trigger transition
        setTimeout(() => toast.classList.add('show'), 50);
        
        // Remove toast after 3 seconds
        setTimeout(() => {
            toast.classList.remove('show');
            toast.classList.add('hide');
            setTimeout(() => toast.remove(), 400);
        }, 3000);
    }

    // Update Header Badge Count
    function updateWishlistBadge() {
        const badge = document.getElementById('wishlist-badge');
        const headerIcon = document.getElementById('wishlist-header-icon');
        if (badge) {
            const count = wishlist.length;
            badge.textContent = count;
            if (count > 0) {
                badge.classList.remove('hidden');
                if (headerIcon) {
                    headerIcon.classList.remove('far');
                    headerIcon.classList.add('fas', 'text-red-400');
                }
            } else {
                badge.classList.add('hidden');
                if (headerIcon) {
                    headerIcon.classList.remove('fas', 'text-red-400');
                    headerIcon.classList.add('far');
                }
            }
        }
    }

    // Sync all heart icons on the page
    function syncWishlistIcons() {
        document.querySelectorAll('.wishlist-btn').forEach(btn => {
            const productId = btn.getAttribute('data-product-id');
            const icon = btn.querySelector('i');
            if (icon) {
                const isInWishlist = wishlist.some(item => String(item.id) === String(productId));
                if (isInWishlist) {
                    icon.className = 'fas fa-heart text-red-500';
                } else {
                    icon.className = 'far fa-heart text-[#C65A3A] hover:text-[#b04a2c]';
                }
            }
        });
    }

    // Toggle product in wishlist
    function toggleWishlistProduct(productData) {
        const index = wishlist.findIndex(item => String(item.id) === String(productData.id));
        if (index > -1) {
            wishlist.splice(index, 1);
            localStorage.setItem('wishlist', JSON.stringify(wishlist));
            showToast(`${productData.name} removed from wishlist.`, 'info');
            return false;
        } else {
            wishlist.push(productData);
            localStorage.setItem('wishlist', JSON.stringify(wishlist));
            showToast(`${productData.name} added to wishlist!`, 'success');
            return true;
        }
    }

    // Attach listeners to wishlist buttons on the page
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.wishlist-btn');
        if (btn) {
            e.preventDefault();
            e.stopPropagation();
            const productData = {
                id: btn.getAttribute('data-product-id'),
                name: btn.getAttribute('data-product-name'),
                price: btn.getAttribute('data-product-price'),
                image: btn.getAttribute('data-product-image'),
                desc: btn.getAttribute('data-product-desc'),
                category: btn.getAttribute('data-product-category'),
                tag: btn.getAttribute('data-product-tag')
            };
            const added = toggleWishlistProduct(productData);
            updateWishlistBadge();
            syncWishlistIcons();
            
            // If on wishlist page, re-render
            if (wishlistGridContainer) {
                renderWishlistPage();
            }
        }
    });

    // Render Wishlist Page Items
    function renderWishlistPage() {
        if (!wishlistGridContainer) return;
        
        wishlistGridContainer.innerHTML = '';
        
        if (wishlist.length === 0) {
            const emptyTemplate = document.getElementById('wishlist-empty-template');
            if (emptyTemplate) {
                const clone = emptyTemplate.content.cloneNode(true);
                wishlistGridContainer.appendChild(clone);
            }
            return;
        }
        
        const grid = document.createElement('div');
        grid.className = 'grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 sm:gap-8';
        
        const cardTemplate = document.getElementById('wishlist-card-template');
        if (!cardTemplate) return;
        
        wishlist.forEach(item => {
            const clone = cardTemplate.content.cloneNode(true);
            
            // Bind image
            const img = clone.querySelector('.wishlist-img');
            if (img) {
                img.src = item.image;
                img.alt = item.name;
            }
            
            // Bind tag
            const tagSpan = clone.querySelector('.wishlist-tag');
            if (tagSpan) {
                if (item.tag) {
                    tagSpan.textContent = item.tag;
                    tagSpan.classList.remove('hidden');
                } else {
                    tagSpan.classList.add('hidden');
                }
            }
            
            // Bind title
            const title = clone.querySelector('.wishlist-title');
            if (title) title.textContent = item.name;
            
            // Bind description
            const desc = clone.querySelector('.wishlist-desc');
            if (desc) desc.textContent = item.desc || '';
            
            // Bind price
            const price = clone.querySelector('.wishlist-price');
            if (price) {
                const formattedPrice = parseInt(item.price).toLocaleString();
                price.textContent = `रू ${formattedPrice}`;
            }
            
            // Bind delete button
            const deleteBtn = clone.querySelector('.wishlist-delete-btn');
            if (deleteBtn) {
                deleteBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    toggleWishlistProduct(item);
                    updateWishlistBadge();
                    syncWishlistIcons();
                    renderWishlistPage();
                });
            }
            
            // Bind add to cart button
            const addCartBtn = clone.querySelector('.wishlist-add-cart-btn');
            if (addCartBtn) {
                addCartBtn.addEventListener('click', function() {
                    showToast(`${item.name} added to cart!`, 'success');
                });
            }
            
            grid.appendChild(clone);
        });
        
        wishlistGridContainer.appendChild(grid);
    }

    // Initial setups
    updateWishlistBadge();
    syncWishlistIcons();
    renderWishlistPage();
});

