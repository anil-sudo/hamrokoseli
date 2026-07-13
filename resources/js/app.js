//
import './seller-layout';
document.addEventListener('DOMContentLoaded', () => {
    function getCsrfToken() {
        const meta = document.querySelector('meta[name="csrf-token"]');
        return meta ? meta.getAttribute('content') : '';
    }

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
        drawer.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', closeDrawer);
        });
    }

    // Escape key closes drawer
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeDrawer();
    });

    // Mobile search toggle
    if (mobileSearchBtn && mobileSearchBar) {
        mobileSearchBtn.addEventListener('click', function () {
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
    const forgotView = document.getElementById('forgot-view');
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

    // Helper: hide all views, show only the requested one
    function switchModalView(view) {
        [loginView, registerView, forgotView].forEach(v => v && v.classList.add('hidden'));
        if (view === 'register' && registerView) registerView.classList.remove('hidden');
        else if (view === 'forgot' && forgotView) forgotView.classList.remove('hidden');
        else if (loginView) loginView.classList.remove('hidden');
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
            switchModalView(view);

            // Only update URL for login / register (not forgot)
            if (view === 'register') updateUrlState('register');
            else if (view === 'login') updateUrlState('login');

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
                // Reset to login view on close — hide all, show login
                switchModalView('login');
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
    if (modalShowRegisterBtn) {
        modalShowRegisterBtn.addEventListener('click', function (e) {
            e.preventDefault();
            switchModalView('register');
            updateUrlState('register');
        });
    }

    // Switch to Login View
    if (modalShowLoginBtn) {
        modalShowLoginBtn.addEventListener('click', function (e) {
            e.preventDefault();
            switchModalView('login');
            updateUrlState('login');
        });
    }

    // Switch to Forgot Password View
    const modalShowForgotBtn = document.getElementById('modal-show-forgot');
    const forgotBackToLoginBtn = document.getElementById('forgot-back-to-login');

    if (modalShowForgotBtn) {
        modalShowForgotBtn.addEventListener('click', function (e) {
            e.preventDefault();
            switchModalView('forgot');
        });
    }

    if (forgotBackToLoginBtn) {
        forgotBackToLoginBtn.addEventListener('click', function (e) {
            e.preventDefault();
            switchModalView('login');
            updateUrlState('login');
        });
    }

    // Close on clicking outside the modal container
    if (loginModal) {
        loginModal.addEventListener('click', function (e) {
            if (e.target === loginModal) {
                closeLoginModal();
            }
        });
    }

    // Escape key closes modal too
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            closeLoginModal();
        }
    });

    // Browser back/forward (history state) support
    window.addEventListener('popstate', function (e) {
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
        modalRegisterPhoneInput.addEventListener('input', function () {
            let value = this.value.replace(/\D/g, '');
            if (value.length > 10) value = value.substring(0, 10);
            this.value = value;
        });
    }

    // ==================== WISHLIST FEATURE LOGIC ====================
let wishlist = [];

if (!window.isLoggedIn) {
    localStorage.removeItem('wishlist');
    localStorage.removeItem('wishlist_visited');
    wishlist = [];
} else {
    wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
}

// If logged in, load wishlist from database and sync to localStorage
if (window.isLoggedIn) {
    fetch('/wishlist/items', {
        headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': getCsrfToken() },
    })
    .then(res => res.json())
    .then(data => {
        if (data.items) {
            wishlist = data.items;
            localStorage.setItem('wishlist', JSON.stringify(wishlist));
            updateWishlistBadge();
            syncWishlistIcons();
            renderWishlistPage();
        }
    })
    .catch(() => {});
}    const wishlistGridContainer = document.getElementById('wishlist-grid-container');

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

    // SweetAlert2 Toast — top-right, below the navbar so it never covers product buttons
    const SwalToast = window.Swal ? Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        customClass: {
            popup: 'swal-hamrokoseli-toast',
        },
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer);
            toast.addEventListener('mouseleave', Swal.resumeTimer);
        },
    }) : null;

    const toastStyles = {
        success: { background: '#3498db', color: '#ffffff' },
        error:   { background: '#e74c3c', color: '#ffffff' },
        warning: { background: '#e74c3c', color: '#ffffff' },
        info:    { background: '#e74c3c', color: '#ffffff' },
    };

    function showToast(message, type = 'success') {
        if (SwalToast) {
            const style = toastStyles[type] ?? toastStyles.success;
            SwalToast.fire({
                icon: type,
                title: message,
                background: style.background,
                color: style.color,
                iconColor: style.color,
            });
        } else {
            console.info(`[Toast] ${type}: ${message}`);
        }
    }

    window.showToast = showToast;
    if (window.flashMessages) {
        window.flashMessages.forEach(msg => showToast(msg.message, msg.type));
        window.flashMessages = [];
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
    // Guests must log in before adding to wishlist
    if (!window.isLoggedIn) {
        showToast('Please sign in to add items to your wishlist.', 'warning');
        if (typeof window.openLoginModal === 'function') {
            window.openLoginModal(null, 'login');
        } else {
            window.location.href = window.loginUrl || '/userlogin';
        }
        return false;
    }

    const index = wishlist.findIndex(item => String(item.id) === String(productData.id));
    if (index > -1) {
        wishlist.splice(index, 1);
        localStorage.setItem('wishlist', JSON.stringify(wishlist));
        showToast(`${productData.name} removed from wishlist.`, 'info');
    } else {
        wishlist.push(productData);
        localStorage.setItem('wishlist', JSON.stringify(wishlist));
        showToast(`${productData.name} added to wishlist!`, 'success');
    }

    // Sync to database if logged in
    if (window.isLoggedIn) {
        fetch('/wishlist/toggle', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': getCsrfToken(),
            },
            body: JSON.stringify({ product_id: productData.id }),
        }).catch(() => {
            // Fail silently — localStorage still updated
        });
    }

    return index === -1; // true if added, false if removed
}

    // Attach listeners to wishlist buttons on the page
    document.addEventListener('click', function (e) {
        const btn = e.target.closest('.wishlist-btn');
        if (btn) {
            e.preventDefault();
            e.stopPropagation();
            e._handledByWishlist = true;
            const productData = {
                id: btn.getAttribute('data-product-id'),
                name: btn.getAttribute('data-product-name'),
                slug: btn.getAttribute('data-slug'),
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
        grid.className = 'grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-6 md:gap-8';

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
                deleteBtn.addEventListener('click', function (e) {
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
                addCartBtn.addEventListener('click', function () {
                    addToCart({
                        id: item.id,
                        name: item.name,
                        price: item.price,
                        image: item.image,
                        desc: item.desc,
                        category: item.category,
                        tag: item.tag,
                        specs: item.specs || ''
                    }, 1);
                });
            }

            grid.appendChild(clone);
        });

        wishlistGridContainer.appendChild(grid);
    }

    // ==================== CART FEATURE LOGIC ====================
    // `cart` (localStorage) still backs the demo/mock product pages that
    // don't have real database rows (e.g. static New Arrivals cards).
    // `dbCartCount` tracks the real, database-backed cart (see CartController)
    // and is what actually persists — it's what /cart shows on reload.
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    let dbCartCount = parseInt(window.initialCartCount) || 0;

    // Clear local storage cart if logged in to prevent count mismatches
    if (window.isLoggedIn) {
        localStorage.removeItem('cart');
        cart = [];
    }

    const cartItemsContainer = document.getElementById('cart-items-container');

    // Update Header Badge Count
    function updateCartBadge() {
        const badge = document.getElementById('cart-badge');
        const headerIcon = document.getElementById('cart-header-icon');
        if (badge) {
            const count = window.isLoggedIn ? dbCartCount : cart.reduce((sum, item) => sum + parseInt(item.qty || 1), 0);
            badge.textContent = count;
            if (count > 0) {
                badge.classList.remove('hidden');
                if (headerIcon) {
                    headerIcon.classList.add('text-amber-400');
                }
            } else {
                badge.classList.add('hidden');
                if (headerIcon) {
                    headerIcon.classList.remove('text-amber-400');
                }
            }
        }
    }

    // Persist a real product to the database via the existing /cart/add route.
    // Returns a promise resolving true/false depending on success.
    function addToCartOnServer(productData, qty) {
        const url = window.cartAddUrl || '/cart/add';

        return fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': getCsrfToken(),
            },
            body: JSON.stringify({
                product_id: productData.id,
                variant_id: productData.variantId || null,
                quantity: qty,
            }),
        })
            .then(async (response) => {
                const data = await response.json().catch(() => ({}));

                if (!response.ok || !data.success) {
                    showToast(data.message || 'Could not add this item to your cart.', 'error');
                    return false;
                }

                if (typeof data.cart_count === 'number') {
                    dbCartCount = data.cart_count;
                } else {
                    dbCartCount += qty;
                }

                showToast(data.message || `${productData.name} added to cart!`, 'success');
                updateCartBadge();

                // The /cart page is rendered server-side from the database,
                // so refresh it if the user is currently looking at it.
                if (cartItemsContainer) {
                    window.location.reload();
                }

                return true;
            })
            .catch(() => {
                showToast('Something went wrong adding this item to your cart.', 'error');
                return false;
            });
    }

    // Add to cart. Returns a Promise that resolves once the item has been
    // added (to the database for real products, or to localStorage for
    // demo/mock cards), so callers that need to navigate afterward (e.g.
    // "Buy Now") can wait for it via addToCartAsync below.
    function addToCartAsync(productData, qty = 1) {
        // Guests get sent to login instead of having anything added
        if (!window.isLoggedIn) {
            window.location.href = window.loginUrl || '/userlogin';
            return Promise.resolve(false);
        }

        qty = parseInt(qty) || 1;

        // Real products carry a numeric database id — persist those to the
        // database. Demo/mock cards (e.g. static New Arrivals) use string
        // ids like "new-arrival-1" and only exist in localStorage.
        const isRealProduct = productData.id !== undefined
            && productData.id !== null
            && String(productData.id).trim() !== ''
            && !isNaN(Number(productData.id));

        if (isRealProduct) {
            return addToCartOnServer(productData, qty);
        }

        const index = cart.findIndex(item => String(item.id) === String(productData.id));
        if (index > -1) {
            cart[index].qty = parseInt(cart[index].qty) + qty;
            showToast(`Updated quantity of ${productData.name} in cart!`, 'success');
        } else {
            cart.push({
                id: productData.id,
                name: productData.name,
                price: productData.price,
                image: productData.image,
                desc: productData.desc || '',
                category: productData.category || '',
                tag: productData.tag || '',
                specs: productData.specs || '',
                qty: qty
            });
            showToast(`${productData.name} added to cart!`, 'success');
        }
        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartBadge();

        if (cartItemsContainer) {
            renderCartPage();
        }

        return Promise.resolve(true);
    }

    // Fire-and-forget wrapper kept for existing callers that don't await.
    function addToCart(productData, qty = 1) {
        addToCartAsync(productData, qty);
    }

    // Remove from cart
    function removeFromCart(productId) {
        const index = cart.findIndex(item => String(item.id) === String(productId));
        if (index > -1) {
            const name = cart[index].name;
            cart.splice(index, 1);
            localStorage.setItem('cart', JSON.stringify(cart));
            showToast(`${name} removed from cart.`, 'info');
            updateCartBadge();
            if (cartItemsContainer) {
                renderCartPage();
            }
        }
    }

    // Update quantity
    function updateCartQuantity(productId, qty) {
        const index = cart.findIndex(item => String(item.id) === String(productId));
        if (index > -1) {
            cart[index].qty = Math.max(1, parseInt(qty) || 1);
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartBadge();
            if (cartItemsContainer) {
                renderCartPage();
            }
        }
    }

    // Move to wishlist
    function moveCartItemToWishlist(item) {
        // Add to wishlist if not already there
        const wishlistIndex = wishlist.findIndex(w => String(w.id) === String(item.id));
        if (wishlistIndex === -1) {
            wishlist.push({
                id: item.id,
                name: item.name,
                price: item.price,
                image: item.image,
                desc: item.desc || '',
                category: item.category || '',
                tag: item.tag || ''
            });
            localStorage.setItem('wishlist', JSON.stringify(wishlist));
        }
        showToast(`${item.name} moved to wishlist!`, 'success');

        // Remove from cart
        const cartIndex = cart.findIndex(c => String(c.id) === String(item.id));
        if (cartIndex > -1) {
            cart.splice(cartIndex, 1);
            localStorage.setItem('cart', JSON.stringify(cart));
        }

        updateCartBadge();
        updateWishlistBadge();
        syncWishlistIcons();
        if (cartItemsContainer) {
            renderCartPage();
        }
    }

    // Export functions globally
    window.addToCart = addToCart;
    window.addToCartAsync = addToCartAsync;
    window.updateCartBadge = updateCartBadge;
    window.removeFromCart = removeFromCart;
    window.updateCartQuantity = updateCartQuantity;
    window.moveCartItemToWishlist = moveCartItemToWishlist;

    // Attach global click listener for any elements with .add-to-cart-btn
    document.addEventListener('click', function (e) {
        const btn = e.target.closest('.add-to-cart-btn');
        if (btn) {
            e.preventDefault();
            e.stopPropagation();
            if (!window.isLoggedIn) {
                if (typeof window.openLoginModal === 'function') {
                    window.openLoginModal(null, 'login');
                } else {
                    window.location.href = window.loginUrl || '/userlogin';
                }
                return;
            }
            const productData = {
                id: btn.getAttribute('data-product-id'),
                name: btn.getAttribute('data-product-name'),
                price: btn.getAttribute('data-product-price'),
                image: btn.getAttribute('data-product-image'),
                desc: btn.getAttribute('data-product-desc') || '',
                category: btn.getAttribute('data-product-category') || '',
                tag: btn.getAttribute('data-product-tag') || '',
                specs: btn.getAttribute('data-product-specs') || ''
            };
            const qty = parseInt(btn.getAttribute('data-product-qty') || '1');
            addToCart(productData, qty);
        }
    });

    // Render Cart Page
    function renderCartPage() {
        if (!cartItemsContainer) return;

        cartItemsContainer.innerHTML = '';

        if (cart.length === 0) {
            const emptyTemplate = document.getElementById('cart-empty-template');
            if (emptyTemplate) {
                const clone = emptyTemplate.content.cloneNode(true);
                cartItemsContainer.appendChild(clone);
            }
            // Reset Summary panel
            const subtotalEl = document.getElementById('cart-subtotal');
            const totalEl = document.getElementById('cart-total');
            const taxEl = document.getElementById('cart-tax');
            if (subtotalEl) subtotalEl.textContent = 'रू 0';
            if (taxEl) taxEl.textContent = 'रू 0';
            if (totalEl) totalEl.textContent = 'रू 0';
            return;
        }

        const cardTemplate = document.getElementById('cart-item-template');
        if (!cardTemplate) return;

        let subtotal = 0;

        cart.forEach(item => {
            const clone = cardTemplate.content.cloneNode(true);

            // Image
            const img = clone.querySelector('.cart-item-img');
            if (img) {
                img.src = item.image;
                img.alt = item.name;
            }

            // Tag
            const tagSpan = clone.querySelector('.cart-item-tag');
            const tagText = clone.querySelector('.cart-item-tag-text');
            if (tagSpan) {
                if (item.tag) {
                    if (tagText) tagText.textContent = item.tag;
                    tagSpan.classList.remove('hidden');
                } else {
                    tagSpan.classList.add('hidden');
                }
            }

            // Title
            const title = clone.querySelector('.cart-item-title');
            if (title) title.textContent = item.name;

            // Specs / Description
            const specs = clone.querySelector('.cart-item-specs');
            if (specs) {
                specs.textContent = item.specs || (item.desc ? item.desc : '');
            }

            // Price
            const price = clone.querySelector('.cart-item-price');
            if (price) {
                const formattedPrice = parseInt(item.price).toLocaleString();
                price.textContent = `रू ${formattedPrice}`;
            }

            // Quantity Input value
            const qtyVal = clone.querySelector('.qty-val');
            if (qtyVal) {
                qtyVal.textContent = item.qty;
            }

            // Quantity decrement
            const qtyMinus = clone.querySelector('.qty-minus');
            if (qtyMinus) {
                qtyMinus.addEventListener('click', function (e) {
                    e.preventDefault();
                    if (item.qty > 1) {
                        updateCartQuantity(item.id, item.qty - 1);
                    }
                });
            }

            // Quantity increment
            const qtyPlus = clone.querySelector('.qty-plus');
            if (qtyPlus) {
                qtyPlus.addEventListener('click', function (e) {
                    e.preventDefault();
                    updateCartQuantity(item.id, item.qty + 1);
                });
            }

            // Move to wishlist
            const wishlistBtn = clone.querySelector('.cart-move-wishlist');
            if (wishlistBtn) {
                wishlistBtn.addEventListener('click', function (e) {
                    e.preventDefault();
                    moveCartItemToWishlist(item);
                });
            }

            // Delete button
            const deleteBtn = clone.querySelector('.cart-delete-btn');
            if (deleteBtn) {
                deleteBtn.addEventListener('click', function (e) {
                    e.preventDefault();
                    removeFromCart(item.id);
                });
            }

            cartItemsContainer.appendChild(clone);
            subtotal += parseInt(item.price) * parseInt(item.qty);
        });

        // Update Order Summary
        const tax = Math.round(subtotal * 0.0837); // Simulated taxes like in the image (1850 tax on 22100 subtotal is ~8.37%)
        const total = subtotal + tax; // shipping is FREE

        const subtotalEl = document.getElementById('cart-subtotal');
        const taxEl = document.getElementById('cart-tax');
        const totalEl = document.getElementById('cart-total');

        if (subtotalEl) subtotalEl.textContent = `रू ${subtotal.toLocaleString()}`;
        if (taxEl) taxEl.textContent = `रू ${tax.toLocaleString()}`;
        if (totalEl) totalEl.textContent = `रू ${total.toLocaleString()}`;
    }

    // ==================== PRODUCT DETAILS MODAL GLOBAL LOGIC ====================
    const productModal = document.getElementById('product-details-modal');
    const productContainer = document.getElementById('product-details-container');
    const closeProductBtn = document.getElementById('close-product-details');
    const qtyInput = productModal ? productModal.querySelector('.qty-val-input') : null;

    let originalUrlBeforeProduct = window.location.pathname + window.location.search;
    if (originalUrlBeforeProduct.startsWith('/viewdetails/')) {
        originalUrlBeforeProduct = '/shop'; // Default fallback
    }

    function updateProductUrlState(productId, productSlug) {
    const identifier = productSlug || productId;
    const path = `/viewdetails/${identifier}`;
    if (window.location.pathname !== path) {
        const currentPath = window.location.pathname + window.location.search;
        if (!currentPath.startsWith('/viewdetails/')) {
            originalUrlBeforeProduct = currentPath;
        }
        history.pushState({ productModal: identifier }, '', path);
    }
}

    function restoreProductUrlState() {
        if (window.location.pathname.startsWith('/viewdetails/')) {
            history.pushState({ productModal: null }, '', originalUrlBeforeProduct);
        }
    }

    function populateAndShowProductModal(productData) {
        if (!productModal || !productContainer) return;

        // Reset review form and status messages from previous product
        const reviewForm = document.getElementById('product-review-form');
        if (reviewForm) {
            reviewForm.reset();
        }
        const reviewSuccessMsg = document.getElementById('review-success-message');
        if (reviewSuccessMsg) {
            reviewSuccessMsg.textContent = '';
            reviewSuccessMsg.classList.add('hidden');
        }
        const reviewErrorMsg = document.getElementById('review-error-message');
        if (reviewErrorMsg) {
            reviewErrorMsg.textContent = '';
            reviewErrorMsg.classList.add('hidden');
        }
        const reviewSection = document.getElementById('modal-add-review-section');
        if (reviewSection) {
            reviewSection.classList.add('hidden');
        }
        const ratingVal = document.getElementById('review-rating-value');
        if (ratingVal) {
            ratingVal.value = '';
        }
        const starSelectBtns = document.querySelectorAll('.star-select-btn');
        starSelectBtns.forEach(s => {
            const icon = s.querySelector('i');
            if (icon) {
                icon.className = 'far fa-star text-[#3A2A1F]/40';
            }
            s.classList.remove('text-yellow-400');
        });

        let categoryName = typeof productData.category === 'string' ? productData.category : (productData.category?.cat_name || productData.category?.name || productData.category_name || 'Crafts');
        let vendorName = typeof productData.vendor === 'string' ? productData.vendor : (productData.vendor?.vendor_name || productData.vendor?.business_name || productData.vendor?.name || productData.vendor_name || '');
        let imageUrl = productData.primary_image_url || (typeof productData.image === 'string' && productData.image.startsWith('http') ? productData.image : (productData.image ? '/' + productData.image.replace(/^\/+/, '') : ''));

        window.activeProduct = {
            id: productData.id,
            name: productData.name,
            price: parseFloat(productData.price),
            image: imageUrl,
            category: categoryName,
            desc: productData.desc || productData.description || '',
            vendor: vendorName,
            tag: productData.tag || (categoryName === 'Metalware' ? 'Authentic' : 'Handmade')
        };

        const modalProductName = document.getElementById('modal-product-name');
        const modalMainImage = document.getElementById('modal-main-image');
        const modalBreadcrumbCat = document.getElementById('modal-breadcrumb-cat');
        const modalProductDesc = document.getElementById('modal-product-desc');
        const modalVendorName = document.getElementById('modal-vendor-name');
        const modalReviewsCount = document.getElementById('modal-reviews-count');
        const modalProductPrice = document.getElementById('modal-product-price');
        const modalProductOriginalPrice = document.getElementById('modal-product-original-price');
        const modalStockStatus = document.getElementById('modal-stock-status');
        const modalStarsContainer = document.getElementById('modal-stars-container');
        const modalDiscountTag = document.getElementById('modal-discount-tag');
        const modalSavingsTag = document.getElementById('modal-savings-tag');

        if (modalProductName) modalProductName.textContent = productData.name;
        if (modalMainImage) {
            modalMainImage.src = imageUrl;
            modalMainImage.alt = productData.name;
        }
        if (modalBreadcrumbCat) modalBreadcrumbCat.textContent = categoryName;
        const modalProductStory = document.getElementById('modal-product-story');
        const descText = productData.desc || productData.description || '';
        if (modalProductDesc) modalProductDesc.textContent = descText;
        if (modalProductStory) modalProductStory.textContent = descText;
        if (modalVendorName) {
            const vendorCard = document.getElementById('modal-vendor-card');
            const avatarEl = document.getElementById('modal-vendor-avatar');
            if (vendorName) {
                modalVendorName.textContent = vendorName;
                if (avatarEl) avatarEl.textContent = vendorName.charAt(0).toUpperCase();
                if (vendorCard) vendorCard.classList.remove('hidden');
            } else {
                if (vendorCard) vendorCard.classList.add('hidden');
            }
        }
        if (modalReviewsCount) modalReviewsCount.textContent = productData.reviews || productData.reviews_count || '0';

        // Pricing
        const price = Number(productData.price ?? productData.effective_price ?? 0);
        const originalPrice = Number(productData.originalPrice ?? productData.original_price ?? productData.price ?? price);
        const discountPrice = Number(productData.discount_price ?? productData.discountPrice ?? 0);
        const hasDiscount = productData.discount === 'true'
            || (!isNaN(discountPrice) && discountPrice > 0 && discountPrice < originalPrice)
            || originalPrice > price;

        const displayPrice = Number.isFinite(price) ? price : 0;
        const displayOriginalPrice = Number.isFinite(originalPrice) ? originalPrice : displayPrice;
        const savings = Math.max(0, displayOriginalPrice - displayPrice);
        const discountPercentage = displayOriginalPrice > 0 ? Math.round((savings / displayOriginalPrice) * 100) : 0;

        if (modalProductPrice) modalProductPrice.textContent = `Rs. ${displayPrice.toLocaleString()}`;

        if (hasDiscount && modalProductOriginalPrice && savings > 0) {
            modalProductOriginalPrice.textContent = `Rs. ${displayOriginalPrice.toLocaleString()}`;
            modalProductOriginalPrice.classList.remove('hidden');

            if (modalDiscountTag) {
                modalDiscountTag.textContent = `-${discountPercentage}% OFF`;
                modalDiscountTag.classList.remove('hidden');
            }
            if (modalSavingsTag) {
                modalSavingsTag.classList.add('hidden');
            }
        } else {
            if (modalProductOriginalPrice) modalProductOriginalPrice.classList.add('hidden');
            if (modalDiscountTag) modalDiscountTag.classList.add('hidden');
            if (modalSavingsTag) modalSavingsTag.classList.add('hidden');
        }

        // Stock status
        const stock = parseInt(productData.stock || 10);
        if (modalStockStatus) {
            if (stock > 0) {
                modalStockStatus.textContent = 'In Stock';
                modalStockStatus.className = 'text-xs text-emerald-700 font-bold';
            } else {
                modalStockStatus.textContent = 'Out of Stock';
                modalStockStatus.className = 'text-xs text-red-500 font-bold';
            }
        }

        // Stars
        if (modalStarsContainer) {
            modalStarsContainer.innerHTML = '';
            const rating = parseFloat(productData.rating || 5);
            for (let i = 1; i <= 5; i++) {
                const star = document.createElement('i');
                star.style.marginRight = '2px';
                if (i <= rating) {
                    star.className = 'fas fa-star text-yellow-500';
                } else if (i - rating < 1) {
                    star.className = 'fas fa-star-half-alt text-yellow-500';
                } else {
                    star.className = 'far fa-star text-yellow-500';
                }
                modalStarsContainer.appendChild(star);
            }
        }

        if (qtyInput) qtyInput.value = 1;

        fetchReviewsForProduct(productData.id);

        const toggleReviewBtn = document.getElementById('toggle-add-review-btn');
        if (toggleReviewBtn) {
            toggleReviewBtn.innerHTML = '<i class="fas fa-pen-fancy"></i> Write a Review';
            if (window.isLoggedIn) {
                fetch('/product/' + productData.id + '/can-review')
                    .then(res => res.json())
                    .then(data => {
                        if (data.eligible && data.existing) {
                            toggleReviewBtn.innerHTML = '<i class="fas fa-edit"></i> Edit a Review';
                        }
                    })
                    .catch(() => {});
            }
        }

        productModal.classList.remove('hidden');
        productModal.classList.add('block');
        setTimeout(() => {
            productModal.classList.remove('opacity-0');
            productModal.classList.add('opacity-100');
            productContainer.classList.remove('scale-95', 'opacity-0');
            productContainer.classList.add('scale-100', 'opacity-100');
        }, 10);
        document.body.style.overflow = 'hidden';
    }

    function closeProductDetailsModal() {
        if (!productModal || !productContainer) return;

        restoreProductUrlState();

        productModal.classList.remove('opacity-100');
        productModal.classList.add('opacity-0');
        productContainer.classList.remove('scale-100', 'opacity-100');
        productContainer.classList.add('scale-95', 'opacity-0');

        setTimeout(() => {
            productModal.classList.remove('block');
            productModal.classList.add('hidden');
        }, 300);
        document.body.style.overflow = '';
    }

    window.closeProductDetailsModal = closeProductDetailsModal;

    // Listeners for view details buttons
    document.addEventListener('click', function (e) {
        const btn = e.target.closest('.view-details-btn');
        if (btn) {
            // Ignore clicks originating from wishlist buttons to avoid opening view details modal
            if (e.target.closest('.wishlist-btn') || e._handledByWishlist) {
                return;
            }
            e.preventDefault();

            const productData = {
                id: btn.getAttribute('data-id'),
                slug: btn.getAttribute('data-slug'),
                name: btn.getAttribute('data-name'),
                price: btn.getAttribute('data-price'),
                originalPrice: btn.getAttribute('data-original-price'),
                discount: btn.getAttribute('data-discount'),
                discount_price: btn.getAttribute('data-discount-price'),
                image: btn.getAttribute('data-image'),
                category: btn.getAttribute('data-category'),
                vendor: btn.getAttribute('data-vendor'),
                desc: btn.getAttribute('data-desc'),
                rating: btn.getAttribute('data-rating'),
                reviews: btn.getAttribute('data-reviews'),
                stock: btn.getAttribute('data-stock')
            };

            populateAndShowProductModal(productData);
            updateProductUrlState(productData.id, productData.slug);

        }
    });

    if (closeProductBtn) closeProductBtn.addEventListener('click', closeProductDetailsModal);
    if (productModal) {
        productModal.addEventListener('click', function (e) {
            if (e.target === productModal) closeProductDetailsModal();
        });
    }

    // Modal tabs
    if (productModal) {
        const tabBtns = productModal.querySelectorAll('.tab-btn');
        const tabPanels = productModal.querySelectorAll('.tab-panel');
        tabBtns.forEach(btn => {
            btn.addEventListener('click', function () {
                const target = btn.getAttribute('data-tab');
                tabBtns.forEach(b => {
                    b.classList.remove('text-[#C65A3A]', 'border-b-2', 'border-[#C65A3A]', 'font-bold');
                    b.classList.add('text-[#3A2A1F]/60', 'font-semibold');
                });
                btn.classList.add('text-[#C65A3A]', 'border-b-2', 'border-[#C65A3A]', 'font-bold');
                btn.classList.remove('text-[#3A2A1F]/60', 'font-semibold');

                tabPanels.forEach(panel => {
                    if (panel.getAttribute('data-panel') === target) {
                        panel.classList.remove('hidden');
                    } else {
                        panel.classList.add('hidden');
                    }
                });
            });
        });

        // Quantity controls
        const qtyPlus = productModal.querySelector('.qty-plus-btn');
        const qtyMinus = productModal.querySelector('.qty-minus-btn');
        if (qtyPlus && qtyInput) {
            qtyPlus.addEventListener('click', function () {
                qtyInput.value = parseInt(qtyInput.value) + 1;
            });
        }
        if (qtyMinus && qtyInput) {
            qtyMinus.addEventListener('click', function () {
                const val = parseInt(qtyInput.value);
                if (val > 1) qtyInput.value = val - 1;
            });
        }
        if (qtyInput) {
            qtyInput.addEventListener('change', function () {
                let val = parseInt(this.value) || 1;
                if (val < 1) val = 1;
                this.value = val;
            });
        }

        // Add to Cart inside modal
        const addToCartModalBtn = document.getElementById('modal-add-to-cart-btn');
        const buyNowModalBtn = document.getElementById('modal-buy-now-btn');

        if (addToCartModalBtn) {
            addToCartModalBtn.addEventListener('click', function () {
                if (!window.isLoggedIn) {
                    window.location.href = window.loginUrl || '/userlogin';
                    return;
                }
                if (window.activeProduct && typeof window.addToCart === 'function') {
                    const qty = parseInt(qtyInput.value) || 1;
                    window.addToCart(window.activeProduct, qty);
                    closeProductDetailsModal();
                } else {
                    const name = document.getElementById('modal-product-name').textContent;
                    const qty = qtyInput.value;
                    alert(`${name} (${qty}) added to cart!`);
                }
            });
        }

        if (buyNowModalBtn) {
            buyNowModalBtn.addEventListener('click', function () {
                if (!window.isLoggedIn) {
                    window.location.href = window.loginUrl || '/userlogin';
                    return;
                }
                if (window.activeProduct && typeof window.addToCartAsync === 'function') {
                    const qty = parseInt(qtyInput.value) || 1;
                    // Wait for the database write to finish before navigating,
                    // otherwise the cart page can load before the row exists.
                    window.addToCartAsync(window.activeProduct, qty).then(function () {
                        window.location.href = "/cart";
                    });
                } else {
                    const name = document.getElementById('modal-product-name').textContent;
                    const qty = qtyInput.value;
                    alert(`Proceeding to checkout with ${qty}x ${name}!`);
                }
            });
        }
    }

    // ==================== PRODUCT DETAILS REVIEWS AJAX ====================
    function fetchReviewsForProduct(productId, page = 1) {
        const listContainer = document.getElementById('modal-reviews-list');
        const pagContainer = document.getElementById('modal-reviews-pagination');
        const countBadge = document.getElementById('modal-reviews-count-badge');
        const mainCount = document.getElementById('modal-reviews-count');
        const starsContainer = document.getElementById('modal-stars-container');

        if (!listContainer) return;

        listContainer.innerHTML = '<p class="text-[#3A2A1F]/60 text-xs italic">Loading customer reviews...</p>';
        if (pagContainer) pagContainer.innerHTML = '';

        fetch('/product/' + productId + '/reviews?page=' + page)
            .then(res => res.json())
            .then(data => {
                const reviews = data.reviews || [];
                const pagination = data.pagination || {};

                if (countBadge) countBadge.textContent = pagination.total || reviews.length;
                if (mainCount) mainCount.textContent = pagination.total || reviews.length;

                if (starsContainer && reviews.length > 0 && page === 1) {
                    const avg = reviews.reduce((sum, r) => sum + r.rating, 0) / reviews.length;
                    starsContainer.innerHTML = '';
                    for (let i = 1; i <= 5; i++) {
                        const star = document.createElement('i');
                        star.style.marginRight = '2px';
                        if (i <= avg) {
                            star.className = 'fas fa-star text-yellow-500';
                        } else if (i - avg < 1) {
                            star.className = 'fas fa-star-half-alt text-yellow-500';
                        } else {
                            star.className = 'far fa-star text-yellow-500';
                        }
                        starsContainer.appendChild(star);
                    }
                }

                if (reviews.length === 0) {
                    listContainer.innerHTML = '<p class="text-[#3A2A1F]/60 text-xs italic py-4">No reviews yet for this product. Be the first to write one!</p>';
                    if (pagContainer) pagContainer.innerHTML = '';
                    return;
                }

                listContainer.innerHTML = '';
                reviews.forEach(review => {
                    let starsHtml = '';
                    for (let i = 1; i <= 5; i++) {
                        if (i <= review.rating) {
                            starsHtml += '<i class="fas fa-star text-yellow-500 text-[10px]"></i>';
                        } else {
                            starsHtml += '<i class="far fa-star text-[#3A2A1F]/20 text-[10px]"></i>';
                        }
                    }

                    const verifiedHtml = review.verified_purchase
                        ? '<span class="text-[9px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200 uppercase tracking-wider flex items-center gap-1"><i class="fas fa-check-circle"></i> Verified Purchase</span>'
                        : '';

                    const replyHtml = review.reply
                        ? `
                        <div class="mt-3 ml-6 bg-[#E5DCD0] border border-[#ebd7be]/30 rounded-xl p-3 space-y-1">
                            <div class="flex items-center justify-between">
                                <span class="text-[10px] font-bold text-[#C65A3A] flex items-center gap-1">
                                    <i class="fas fa-reply fa-flip-horizontal"></i> Vendor Response
                                </span>
                                <span class="text-[8px] text-[#3A2A1F]/50 font-semibold">${review.replied_at || ''}</span>
                            </div>
                            <p class="text-xs text-[#3A2A1F]/80 leading-relaxed font-medium">${review.reply}</p>
                        </div>
                        `
                        : '';

                    const card = document.createElement('div');
                    card.className = 'bg-[#FFF7EF] border border-[#ebd7be]/30 rounded-xl p-4 space-y-2';
                    card.innerHTML = `
                        <div class="flex items-start justify-between gap-3">
                            <div class="space-y-1">
                                <div class="flex items-center gap-2">
                                    <h5 class="text-xs font-bold text-[#1F3D2E]">${review.user_name}</h5>
                                    ${verifiedHtml}
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="flex gap-0.5">${starsHtml}</div>
                                    <span class="text-[10px] text-[#3A2A1F]/50 font-semibold">${review.date}</span>
                                </div>
                            </div>
                        </div>
                        ${review.comment ? `<p class="text-xs text-[#3A2A1F]/80 leading-relaxed font-medium mt-1">"${review.comment}"</p>` : ''}
                        ${replyHtml}
                    `;
                    listContainer.appendChild(card);
                });

                if (pagContainer) {
                    pagContainer.innerHTML = '';
                    if (pagination.last_page > 1) {
                        pagContainer.className = 'flex items-center justify-center gap-3 mt-8 pb-4';

                        // Previous button
                        const prevBtn = document.createElement('button');
                        if (pagination.current_page > 1) {
                            prevBtn.className = 'w-10 h-10 rounded-full border border-[#1F3D2E]/20 flex items-center justify-center text-[#1F3D2E] hover:border-[#1F3D2E] hover:bg-[#1F3D2E]/5 transition duration-300 shadow-sm cursor-pointer';
                            prevBtn.onclick = () => fetchReviewsForProduct(productId, pagination.current_page - 1);
                        } else {
                            prevBtn.className = 'w-10 h-10 rounded-full border border-[#1F3D2E]/10 flex items-center justify-center text-[#1F3D2E]/30 shadow-sm cursor-not-allowed';
                        }
                        prevBtn.innerHTML = '<i class="fas fa-chevron-left text-xs"></i>';
                        pagContainer.appendChild(prevBtn);

                        // Page numbers container
                        const pageNumbersContainer = document.createElement('div');
                        pageNumbersContainer.className = 'flex items-center gap-1';

                        const start = Math.max(1, pagination.current_page - 2);
                        const end = Math.min(pagination.last_page, pagination.current_page + 2);

                        if (start > 1) {
                            const firstPageBtn = document.createElement('button');
                            firstPageBtn.className = 'w-10 h-10 flex items-center justify-center text-sm font-semibold text-[#3A2A1F]/60 hover:text-[#1F3D2E] transition-colors cursor-pointer';
                            firstPageBtn.textContent = '1';
                            firstPageBtn.onclick = () => fetchReviewsForProduct(productId, 1);
                            pageNumbersContainer.appendChild(firstPageBtn);

                            if (start > 2) {
                                const dots = document.createElement('span');
                                dots.className = 'text-sm font-semibold text-[#3A2A1F]/40 px-2 select-none';
                                dots.textContent = '...';
                                pageNumbersContainer.appendChild(dots);
                            }
                        }

                        for (let page = start; page <= end; page++) {
                            const pageBtn = document.createElement('button');
                            if (page === pagination.current_page) {
                                pageBtn.className = 'w-10 h-10 flex flex-col items-center justify-center text-sm font-bold text-[#1F3D2E] relative cursor-pointer';
                                pageBtn.innerHTML = `<span>${page}</span><span class="absolute bottom-1 w-5 h-0.5 bg-[#1F3D2E] rounded-full"></span>`;
                            } else {
                                pageBtn.className = 'w-10 h-10 flex items-center justify-center text-sm font-semibold text-[#3A2A1F]/60 hover:text-[#1F3D2E] transition-colors cursor-pointer';
                                pageBtn.textContent = page;
                                pageBtn.onclick = () => fetchReviewsForProduct(productId, page);
                            }
                            pageNumbersContainer.appendChild(pageBtn);
                        }

                        if (end < pagination.last_page) {
                            if (end < pagination.last_page - 1) {
                                const dots = document.createElement('span');
                                dots.className = 'text-sm font-semibold text-[#3A2A1F]/40 px-2 select-none';
                                dots.textContent = '...';
                                pageNumbersContainer.appendChild(dots);
                            }
                            const lastPageBtn = document.createElement('button');
                            lastPageBtn.className = 'w-10 h-10 flex items-center justify-center text-sm font-semibold text-[#3A2A1F]/60 hover:text-[#1F3D2E] transition-colors cursor-pointer';
                            lastPageBtn.textContent = pagination.last_page;
                            lastPageBtn.onclick = () => fetchReviewsForProduct(productId, pagination.last_page);
                            pageNumbersContainer.appendChild(lastPageBtn);
                        }

                        pagContainer.appendChild(pageNumbersContainer);

                        // Next button
                        const nextBtn = document.createElement('button');
                        if (pagination.current_page < pagination.last_page) {
                            nextBtn.className = 'w-10 h-10 rounded-full border border-[#1F3D2E]/20 flex items-center justify-center text-[#1F3D2E] hover:border-[#1F3D2E] hover:bg-[#1F3D2E]/5 transition duration-300 shadow-sm cursor-pointer';
                            nextBtn.onclick = () => fetchReviewsForProduct(productId, pagination.current_page + 1);
                        } else {
                            nextBtn.className = 'w-10 h-10 rounded-full border border-[#1F3D2E]/10 flex items-center justify-center text-[#1F3D2E]/30 shadow-sm cursor-not-allowed';
                        }
                        nextBtn.innerHTML = '<i class="fas fa-chevron-right text-xs"></i>';
                        pagContainer.appendChild(nextBtn);
                    }
                }
            })
            .catch(err => {
                listContainer.innerHTML = '<p class="text-red-500 text-xs py-4">Failed to load reviews.</p>';
            });
    }

    // Review Form event listeners
    const starSelectBtns = document.querySelectorAll('.star-select-btn');
    const ratingVal = document.getElementById('review-rating-value');
    if (starSelectBtns.length > 0 && ratingVal) {
        starSelectBtns.forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                const rating = parseInt(this.getAttribute('data-rating'));
                ratingVal.value = rating;

                starSelectBtns.forEach(s => {
                    const r = parseInt(s.getAttribute('data-rating'));
                    const icon = s.querySelector('i');
                    if (r <= rating) {
                        icon.className = 'fas fa-star text-[#C65A3A]';
                    } else {
                        icon.className = 'far fa-star text-[#3A2A1F]/40';
                    }
                });
            });
        });
    }

    const reviewForm = document.getElementById('product-review-form');
    if (reviewForm) {
        reviewForm.addEventListener('submit', function (e) {
            e.preventDefault();

            const rating = ratingVal.value;
            const comment = document.getElementById('review-comment').value;
            const errorMsg = document.getElementById('review-error-message');
            const successMsg = document.getElementById('review-success-message');
            const submitBtn = document.getElementById('submit-review-btn');

            if (!rating) {
                if (window.showToast) {
                    window.showToast('Please select a rating star.', 'error');
                } else if (errorMsg) {
                    errorMsg.textContent = 'Please select a rating star.';
                    errorMsg.classList.remove('hidden');
                }
                return;
            }

            if (errorMsg) errorMsg.classList.add('hidden');
            if (successMsg) successMsg.classList.add('hidden');
            submitBtn.disabled = true;
            submitBtn.textContent = 'Submitting...';

            fetch('/product/' + window.activeProduct.id + '/reviews', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content ?? ''
                },
                body: JSON.stringify({ rating, comment })
            })
                .then(res => res.json())
                .then(data => {
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Submit Review';

                    if (data.success) {
                        if (window.showToast) {
                            window.showToast(data.message || 'Review submitted successfully!', 'success');
                        } else if (successMsg) {
                            successMsg.textContent = data.message;
                            successMsg.classList.remove('hidden');
                        }

                        reviewForm.reset();

                        starSelectBtns.forEach(s => {
                            s.querySelector('i').className = 'far fa-star text-[#3A2A1F]/40';
                        });

                        ratingVal.value = '';

                        fetchReviewsForProduct(window.activeProduct.id);

                        const toggleReviewBtn = document.getElementById('toggle-add-review-btn');
                        if (toggleReviewBtn) {
                            toggleReviewBtn.innerHTML = '<i class="fas fa-edit"></i> Edit a Review';
                        }

                        const reviewSection = document.getElementById('modal-add-review-section');
                        if (reviewSection) {
                            reviewSection.classList.add('hidden');
                        }

                    } else {
                        if (window.showToast) {
                            window.showToast(data.message || 'Something went wrong.', 'error');
                        } else if (errorMsg) {
                            errorMsg.textContent = data.message || 'Something went wrong.';
                            errorMsg.classList.remove('hidden');
                        }
                    }
                })
                .catch(err => {
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Submit Review';

                    if (window.showToast) {
                        window.showToast('Server error. Please try again.', 'error');
                    } else if (errorMsg) {
                        errorMsg.textContent = 'Server error. Please try again.';
                        errorMsg.classList.remove('hidden');
                    }
                });
        });
    }


    // Handle direct loading and history state popped
    window.addEventListener('popstate', function (e) {
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

const match = path.match(/^\/viewdetails\/([^/]+)$/);
if (match) {
    if (window.activeProductOnLoad && (String(window.activeProductOnLoad.slug) === match[1] || String(window.activeProductOnLoad.id) === match[1])) {
        populateAndShowProductModal(window.activeProductOnLoad);
    } else {
        const btn = document.querySelector(`.view-details-btn[data-slug="${match[1]}"], .view-details-btn[data-id="${match[1]}"]`);
        if (btn) {
            btn.click();
        }
    }
} else {
            if (productModal && !productModal.classList.contains('hidden')) {
                closeProductDetailsModal();
            }
        }
    });

    if (window.activeProductOnLoad) {
        populateAndShowProductModal(window.activeProductOnLoad);
    }

    // Initial setups
    updateWishlistBadge();
    updateCartBadge();
    syncWishlistIcons();
    renderWishlistPage();
    renderCartPage();

    // ─── Forgot Password: AJAX form submit ────────────────────────────────────
    const forgotForm = document.getElementById('forgot-password-form');
    const forgotResend = document.getElementById('forgot-resend');

    if (forgotResend) {
        forgotResend.addEventListener('click', function () {
            document.getElementById('forgot-success')?.classList.add('hidden');
            document.getElementById('forgot-form-wrap')?.classList.remove('hidden');
        });
    }

    if (forgotForm) {
        forgotForm.addEventListener('submit', async function (e) {
            e.preventDefault();

            const btn = document.getElementById('forgot-submit-btn');
            const btnText = document.getElementById('forgot-btn-text');
            const email = document.getElementById('forgot-email').value;

            // Loading state
            btn.disabled = true;
            btnText.textContent = 'Sending…';
            const iconEl = btn.querySelector('i');
            if (iconEl) iconEl.className = 'fas fa-spinner fa-spin text-xs';

            // Clear previous inline errors
            forgotForm.querySelectorAll('.forgot-error').forEach(el => el.remove());

            try {
                const res = await fetch(forgotForm.action, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content ?? '',
                    },
                    body: JSON.stringify({ email }),
                });

                const json = await res.json();

                if (res.ok && (json.status || json.status === true)) {
                    // Success: swap form for confirmation message
                    document.getElementById('forgot-form-wrap')?.classList.add('hidden');
                    const sentEl = document.getElementById('forgot-sent-email');
                    if (sentEl) sentEl.textContent = email;
                    document.getElementById('forgot-success')?.classList.remove('hidden');
                } else {
                    // Show inline error under the email input
                    const errMsg = json.errors?.email?.[0] ?? json.message ?? 'Something went wrong. Please try again.';
                    const errEl = document.createElement('p');
                    errEl.className = 'forgot-error text-red-500 text-xs mt-1.5 font-medium flex items-center gap-1';
                    errEl.innerHTML = '<i class="fas fa-exclamation-circle text-[10px]"></i> ' + errMsg;
                    document.getElementById('forgot-email')?.closest('div[class*="flex"]')?.after(errEl);

                    btn.disabled = false;
                    btnText.textContent = 'SEND RESET LINK';
                    if (iconEl) iconEl.className = 'fas fa-paper-plane text-xs';
                }
            } catch {
                btn.disabled = false;
                btnText.textContent = 'SEND RESET LINK';
                if (iconEl) iconEl.className = 'fas fa-paper-plane text-xs';
            }
        });
    }
});