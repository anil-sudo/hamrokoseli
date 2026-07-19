// ─────────────────────────────────────────────────────────────────────────────
// HamroKoseli — app.js
// Supports Livewire Navigate (wire:navigate) — initPage() runs on every
// navigation; module-level state (wishlist, cart, dbCartCount) persists.
// ─────────────────────────────────────────────────────────────────────────────
import './seller-layout';

// ═══════════════════════════════════════════════════════════════════════════
// MODULE-LEVEL STATE — survives across Livewire page navigations
// ═══════════════════════════════════════════════════════════════════════════
let wishlist = [];
let cart = [];
let dbCartCount = parseInt(window.initialCartCount) || 0;
let wishlistFetched = false;   // only hit the API once per session
let globalSetupDone = false;   // document-level listeners registered once

// ─────────────────────────────────────────────────────────────────────────────
// HELPERS
// ─────────────────────────────────────────────────────────────────────────────
function getCsrfToken() {
    const meta = document.querySelector('meta[name="csrf-token"]');
    return meta ? meta.getAttribute('content') : '';
}

// ─────────────────────────────────────────────────────────────────────────────
// TOAST
// ─────────────────────────────────────────────────────────────────────────────
const toastStyles = {
    success: { background: '#3498db', color: '#ffffff' },
    error:   { background: '#e74c3c', color: '#ffffff' },
    warning: { background: '#e74c3c', color: '#ffffff' },
    info:    { background: '#e74c3c', color: '#ffffff' },
};

function showToast(message, type = 'success') {
    if (window.Swal) {
        const style = toastStyles[type] ?? toastStyles.success;
        const SwalToast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            customClass: { popup: 'swal-hamrokoseli-toast' },
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            },
        });
        SwalToast.fire({ icon: type, title: message, background: style.background, color: style.color, iconColor: style.color });
    } else {
        console.info(`[Toast] ${type}: ${message}`);
    }
}
window.showToast = showToast;

// ─────────────────────────────────────────────────────────────────────────────
// WISHLIST — state + pure functions (no DOM dependency)
// ─────────────────────────────────────────────────────────────────────────────
function updateWishlistBadge() {
    const badge = document.getElementById('wishlist-badge');
    const headerIcon = document.getElementById('wishlist-header-icon');
    if (!badge) return;
    const count = wishlist.length;
    badge.textContent = count;
    if (count > 0) {
        badge.classList.remove('hidden');
        if (headerIcon) { headerIcon.classList.remove('far'); headerIcon.classList.add('fas', 'text-red-400'); }
    } else {
        badge.classList.add('hidden');
        if (headerIcon) { headerIcon.classList.remove('fas', 'text-red-400'); headerIcon.classList.add('far'); }
    }
}

function syncWishlistIcons() {
    document.querySelectorAll('.wishlist-btn').forEach(btn => {
        const productId = btn.getAttribute('data-product-id');
        const icon = btn.querySelector('i');
        if (icon) {
            const isInWishlist = wishlist.some(item => String(item.id) === String(productId));
            icon.className = isInWishlist
                ? 'fas fa-heart text-red-500'
                : 'far fa-heart text-[#C65A3A] hover:text-[#b04a2c]';
        }
    });
}

function toggleWishlistProduct(productData) {
    if (!window.isLoggedIn) {
        showToast('Please sign in to add items to your wishlist.', 'warning');
        if (typeof window.openLoginModal === 'function') window.openLoginModal(null, 'login');
        else window.location.href = window.loginUrl || '/userlogin';
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
    if (window.isLoggedIn) {
        fetch('/wishlist/toggle', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': getCsrfToken() },
            body: JSON.stringify({ product_id: productData.id }),
        }).catch(() => {});
    }
    return index === -1;
}

function renderWishlistPage() {
    const wishlistGridContainer = document.getElementById('wishlist-grid-container');
    if (!wishlistGridContainer) return;
    wishlistGridContainer.innerHTML = '';
    if (wishlist.length === 0) {
        const emptyTemplate = document.getElementById('wishlist-empty-template');
        if (emptyTemplate) wishlistGridContainer.appendChild(emptyTemplate.content.cloneNode(true));
        return;
    }
    const grid = document.createElement('div');
    grid.className = 'grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-6 md:gap-8';
    const cardTemplate = document.getElementById('wishlist-card-template');
    if (!cardTemplate) return;
    wishlist.forEach(item => {
        const clone = cardTemplate.content.cloneNode(true);
        const img = clone.querySelector('.wishlist-img');
        if (img) { img.src = item.image; img.alt = item.name; }
        const tagSpan = clone.querySelector('.wishlist-tag');
        if (tagSpan) { item.tag ? (tagSpan.textContent = item.tag, tagSpan.classList.remove('hidden')) : tagSpan.classList.add('hidden'); }
        const title = clone.querySelector('.wishlist-title');
        if (title) title.textContent = item.name;
        const desc = clone.querySelector('.wishlist-desc');
        if (desc) desc.textContent = item.desc || '';
        const price = clone.querySelector('.wishlist-price');
        if (price) price.textContent = `रू ${parseInt(item.price).toLocaleString()}`;
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
        const addCartBtn = clone.querySelector('.wishlist-add-cart-btn');
        if (addCartBtn) {
            addCartBtn.addEventListener('click', function () {
                addToCart({ id: item.id, name: item.name, price: item.price, image: item.image, desc: item.desc, category: item.category, tag: item.tag, specs: item.specs || '' }, 1);
            });
        }
        grid.appendChild(clone);
    });
    wishlistGridContainer.appendChild(grid);
}

// ─────────────────────────────────────────────────────────────────────────────
// CART — state + pure functions
// ─────────────────────────────────────────────────────────────────────────────
function updateCartBadge() {
    const badge = document.getElementById('cart-badge');
    const headerIcon = document.getElementById('cart-header-icon');
    if (!badge) return;
    const count = window.isLoggedIn ? dbCartCount : cart.reduce((sum, item) => sum + parseInt(item.qty || 1), 0);
    badge.textContent = count;
    if (count > 0) {
        badge.classList.remove('hidden');
        if (headerIcon) headerIcon.classList.add('text-amber-400');
    } else {
        badge.classList.add('hidden');
        if (headerIcon) headerIcon.classList.remove('text-amber-400');
    }
}

function addToCartOnServer(productData, qty) {
    const url = window.cartAddUrl || '/cart/add';
    return fetch(url, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': getCsrfToken() },
        body: JSON.stringify({ product_id: productData.id, variant_id: productData.variantId || null, quantity: qty }),
    }).then(async (response) => {
        const data = await response.json().catch(() => ({}));
        if (!response.ok || !data.success) { showToast(data.message || 'Could not add this item to your cart.', 'error'); return false; }
        if (typeof data.cart_count === 'number') dbCartCount = data.cart_count;
        else dbCartCount += qty;
        showToast(data.message || `${productData.name} added to cart!`, 'success');
        updateCartBadge();
        if (document.getElementById('cart-items-container')) window.location.reload();
        return true;
    }).catch(() => { showToast('Something went wrong adding this item to your cart.', 'error'); return false; });
}

function addToCartAsync(productData, qty = 1) {
    if (!window.isLoggedIn) { window.location.href = window.loginUrl || '/userlogin'; return Promise.resolve(false); }
    qty = parseInt(qty) || 1;
    const isRealProduct = productData.id !== undefined && productData.id !== null && String(productData.id).trim() !== '' && !isNaN(Number(productData.id));
    if (isRealProduct) return addToCartOnServer(productData, qty);
    const index = cart.findIndex(item => String(item.id) === String(productData.id));
    if (index > -1) { cart[index].qty = parseInt(cart[index].qty) + qty; showToast(`Updated quantity of ${productData.name} in cart!`, 'success'); }
    else { cart.push({ id: productData.id, name: productData.name, price: productData.price, image: productData.image, desc: productData.desc || '', category: productData.category || '', tag: productData.tag || '', specs: productData.specs || '', qty }); showToast(`${productData.name} added to cart!`, 'success'); }
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartBadge();
    renderCartPage();
    return Promise.resolve(true);
}

function addToCart(productData, qty = 1) { addToCartAsync(productData, qty); }

function removeFromCart(productId) {
    const index = cart.findIndex(item => String(item.id) === String(productId));
    if (index > -1) {
        const name = cart[index].name;
        cart.splice(index, 1);
        localStorage.setItem('cart', JSON.stringify(cart));
        showToast(`${name} removed from cart.`, 'info');
        updateCartBadge();
        renderCartPage();
    }
}

function updateCartQuantity(productId, qty) {
    const index = cart.findIndex(item => String(item.id) === String(productId));
    if (index > -1) {
        cart[index].qty = Math.max(1, parseInt(qty) || 1);
        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartBadge();
        renderCartPage();
    }
}

function moveCartItemToWishlist(item) {
    const wishlistIndex = wishlist.findIndex(w => String(w.id) === String(item.id));
    if (wishlistIndex === -1) {
        wishlist.push({ id: item.id, name: item.name, price: item.price, image: item.image, desc: item.desc || '', category: item.category || '', tag: item.tag || '' });
        localStorage.setItem('wishlist', JSON.stringify(wishlist));
    }
    showToast(`${item.name} moved to wishlist!`, 'success');
    const cartIndex = cart.findIndex(c => String(c.id) === String(item.id));
    if (cartIndex > -1) { cart.splice(cartIndex, 1); localStorage.setItem('cart', JSON.stringify(cart)); }
    updateCartBadge();
    updateWishlistBadge();
    syncWishlistIcons();
    renderCartPage();
}

// Expose to window (inline onclick handlers on pages use these)
window.addToCart = addToCart;
window.addToCartAsync = addToCartAsync;
window.updateCartBadge = updateCartBadge;
window.removeFromCart = removeFromCart;
window.updateCartQuantity = updateCartQuantity;
window.moveCartItemToWishlist = moveCartItemToWishlist;

function renderCartPage() {
    const cartItemsContainer = document.getElementById('cart-items-container');
    if (!cartItemsContainer) return;
    cartItemsContainer.innerHTML = '';
    if (cart.length === 0) {
        const emptyTemplate = document.getElementById('cart-empty-template');
        if (emptyTemplate) cartItemsContainer.appendChild(emptyTemplate.content.cloneNode(true));
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
        const img = clone.querySelector('.cart-item-img');
        if (img) { img.src = item.image; img.alt = item.name; }
        const tagSpan = clone.querySelector('.cart-item-tag');
        const tagText = clone.querySelector('.cart-item-tag-text');
        if (tagSpan) { item.tag ? (tagText && (tagText.textContent = item.tag), tagSpan.classList.remove('hidden')) : tagSpan.classList.add('hidden'); }
        const title = clone.querySelector('.cart-item-title');
        if (title) title.textContent = item.name;
        const specs = clone.querySelector('.cart-item-specs');
        if (specs) specs.textContent = item.specs || (item.desc ? item.desc : '');
        const price = clone.querySelector('.cart-item-price');
        if (price) price.textContent = `रू ${parseInt(item.price).toLocaleString()}`;
        const qtyVal = clone.querySelector('.qty-val');
        if (qtyVal) qtyVal.textContent = item.qty;
        const qtyMinus = clone.querySelector('.qty-minus');
        if (qtyMinus) qtyMinus.addEventListener('click', e => { e.preventDefault(); if (item.qty > 1) updateCartQuantity(item.id, item.qty - 1); });
        const qtyPlus = clone.querySelector('.qty-plus');
        if (qtyPlus) qtyPlus.addEventListener('click', e => { e.preventDefault(); updateCartQuantity(item.id, item.qty + 1); });
        const wishlistBtn = clone.querySelector('.cart-move-wishlist');
        if (wishlistBtn) wishlistBtn.addEventListener('click', e => { e.preventDefault(); moveCartItemToWishlist(item); });
        const deleteBtn = clone.querySelector('.cart-delete-btn');
        if (deleteBtn) deleteBtn.addEventListener('click', e => { e.preventDefault(); removeFromCart(item.id); });
        cartItemsContainer.appendChild(clone);
        subtotal += parseInt(item.price) * parseInt(item.qty);
    });
    const tax = Math.round(subtotal * 0.0837);
    const total = subtotal + tax;
    const subtotalEl = document.getElementById('cart-subtotal');
    const taxEl = document.getElementById('cart-tax');
    const totalEl = document.getElementById('cart-total');
    if (subtotalEl) subtotalEl.textContent = `रू ${subtotal.toLocaleString()}`;
    if (taxEl) taxEl.textContent = `रू ${tax.toLocaleString()}`;
    if (totalEl) totalEl.textContent = `रू ${total.toLocaleString()}`;
}

// ─────────────────────────────────────────────────────────────────────────────
// PRODUCT DETAILS MODAL — pure functions (DOM refs re-queried in initPage)
// ─────────────────────────────────────────────────────────────────────────────
let originalUrlBeforeProduct = '/shop';

function updateProductUrlState(productId, productSlug) {
    const identifier = productSlug || productId;
    const path = `/viewdetails/${identifier}`;
    if (window.location.pathname !== path) {
        const currentPath = window.location.pathname + window.location.search;
        if (!currentPath.startsWith('/viewdetails/')) originalUrlBeforeProduct = currentPath;
        history.pushState({ productModal: identifier }, '', path);
    }
}

function restoreProductUrlState() {
    if (window.location.pathname.startsWith('/viewdetails/')) {
        history.pushState({ productModal: null }, '', originalUrlBeforeProduct);
    }
}

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
                    star.className = i <= avg ? 'fas fa-star text-yellow-500' : (i - avg < 1 ? 'fas fa-star-half-alt text-yellow-500' : 'far fa-star text-yellow-500');
                    starsContainer.appendChild(star);
                }
            }
            if (reviews.length === 0) { listContainer.innerHTML = '<p class="text-[#3A2A1F]/60 text-xs italic py-4">No reviews yet for this product. Be the first to write one!</p>'; return; }
            listContainer.innerHTML = '';
            reviews.forEach(review => {
                let starsHtml = '';
                for (let i = 1; i <= 5; i++) starsHtml += i <= review.rating ? '<i class="fas fa-star text-yellow-500 text-[10px]"></i>' : '<i class="far fa-star text-[#3A2A1F]/20 text-[10px]"></i>';
                const verifiedHtml = review.verified_purchase ? '<span class="text-[9px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200 uppercase tracking-wider flex items-center gap-1"><i class="fas fa-check-circle"></i> Verified Purchase</span>' : '';
                const replyHtml = review.reply ? `<div class="mt-3 ml-6 bg-[#E5DCD0] border border-[#ebd7be]/30 rounded-xl p-3 space-y-1"><div class="flex items-center justify-between"><span class="text-[10px] font-bold text-[#C65A3A] flex items-center gap-1"><i class="fas fa-reply fa-flip-horizontal"></i> Vendor Response</span><span class="text-[8px] text-[#3A2A1F]/50 font-semibold">${review.replied_at || ''}</span></div><p class="text-xs text-[#3A2A1F]/80 leading-relaxed font-medium">${review.reply}</p></div>` : '';
                const card = document.createElement('div');
                card.className = 'bg-[#FFF7EF] border border-[#ebd7be]/30 rounded-xl p-4 space-y-2';
                card.innerHTML = `<div class="flex items-start justify-between gap-3"><div class="space-y-1"><div class="flex items-center gap-2"><h5 class="text-xs font-bold text-[#1F3D2E]">${review.user_name}</h5>${verifiedHtml}</div><div class="flex items-center gap-2"><div class="flex gap-0.5">${starsHtml}</div><span class="text-[10px] text-[#3A2A1F]/50 font-semibold">${review.date}</span></div></div></div>${review.comment ? `<p class="text-xs text-[#3A2A1F]/80 leading-relaxed font-medium mt-1">"${review.comment}"</p>` : ''}${replyHtml}`;
                listContainer.appendChild(card);
            });
            if (pagContainer && pagination.last_page > 1) {
                pagContainer.className = 'flex items-center justify-center gap-3 mt-8 pb-4';
                const prevBtn = document.createElement('button');
                if (pagination.current_page > 1) { prevBtn.className = 'w-10 h-10 rounded-full border border-[#1F3D2E]/20 flex items-center justify-center text-[#1F3D2E] hover:border-[#1F3D2E] hover:bg-[#1F3D2E]/5 transition duration-300 shadow-sm cursor-pointer'; prevBtn.onclick = () => fetchReviewsForProduct(productId, pagination.current_page - 1); }
                else prevBtn.className = 'w-10 h-10 rounded-full border border-[#1F3D2E]/10 flex items-center justify-center text-[#1F3D2E]/30 shadow-sm cursor-not-allowed';
                prevBtn.innerHTML = '<i class="fas fa-chevron-left text-xs"></i>';
                pagContainer.appendChild(prevBtn);
                const pageNumbersContainer = document.createElement('div');
                pageNumbersContainer.className = 'flex items-center gap-1';
                const start = Math.max(1, pagination.current_page - 2);
                const end = Math.min(pagination.last_page, pagination.current_page + 2);
                if (start > 1) { const fp = document.createElement('button'); fp.className = 'w-10 h-10 flex items-center justify-center text-sm font-semibold text-[#3A2A1F]/60 hover:text-[#1F3D2E] transition-colors cursor-pointer'; fp.textContent = '1'; fp.onclick = () => fetchReviewsForProduct(productId, 1); pageNumbersContainer.appendChild(fp); if (start > 2) { const dots = document.createElement('span'); dots.className = 'text-sm font-semibold text-[#3A2A1F]/40 px-2 select-none'; dots.textContent = '...'; pageNumbersContainer.appendChild(dots); } }
                for (let p = start; p <= end; p++) { const pb = document.createElement('button'); if (p === pagination.current_page) { pb.className = 'w-10 h-10 flex flex-col items-center justify-center text-sm font-bold text-[#1F3D2E] relative cursor-pointer'; pb.innerHTML = `<span>${p}</span><span class="absolute bottom-1 w-5 h-0.5 bg-[#1F3D2E] rounded-full"></span>`; } else { pb.className = 'w-10 h-10 flex items-center justify-center text-sm font-semibold text-[#3A2A1F]/60 hover:text-[#1F3D2E] transition-colors cursor-pointer'; pb.textContent = p; pb.onclick = () => fetchReviewsForProduct(productId, p); } pageNumbersContainer.appendChild(pb); }
                if (end < pagination.last_page) { if (end < pagination.last_page - 1) { const dots = document.createElement('span'); dots.className = 'text-sm font-semibold text-[#3A2A1F]/40 px-2 select-none'; dots.textContent = '...'; pageNumbersContainer.appendChild(dots); } const lp = document.createElement('button'); lp.className = 'w-10 h-10 flex items-center justify-center text-sm font-semibold text-[#3A2A1F]/60 hover:text-[#1F3D2E] transition-colors cursor-pointer'; lp.textContent = pagination.last_page; lp.onclick = () => fetchReviewsForProduct(productId, pagination.last_page); pageNumbersContainer.appendChild(lp); }
                pagContainer.appendChild(pageNumbersContainer);
                const nextBtn = document.createElement('button');
                if (pagination.current_page < pagination.last_page) { nextBtn.className = 'w-10 h-10 rounded-full border border-[#1F3D2E]/20 flex items-center justify-center text-[#1F3D2E] hover:border-[#1F3D2E] hover:bg-[#1F3D2E]/5 transition duration-300 shadow-sm cursor-pointer'; nextBtn.onclick = () => fetchReviewsForProduct(productId, pagination.current_page + 1); }
                else nextBtn.className = 'w-10 h-10 rounded-full border border-[#1F3D2E]/10 flex items-center justify-center text-[#1F3D2E]/30 shadow-sm cursor-not-allowed';
                nextBtn.innerHTML = '<i class="fas fa-chevron-right text-xs"></i>';
                pagContainer.appendChild(nextBtn);
            }
        })
        .catch(() => { if (listContainer) listContainer.innerHTML = '<p class="text-red-500 text-xs py-4">Failed to load reviews.</p>'; });
}

// ─────────────────────────────────────────────────────────────────────────────
// GLOBAL DELEGATED EVENT LISTENERS — registered only ONCE
// ─────────────────────────────────────────────────────────────────────────────
function setupGlobalListeners() {
    // Wishlist click (event delegation — survives DOM swaps)
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
            renderWishlistPage();
        }
    });

    // Add-to-cart click (event delegation)
    document.addEventListener('click', function (e) {
        const btn = e.target.closest('.add-to-cart-btn');
        if (btn) {
            e.preventDefault();
            e.stopPropagation();
            if (!window.isLoggedIn) {
                if (typeof window.openLoginModal === 'function') window.openLoginModal(null, 'login');
                else window.location.href = window.loginUrl || '/userlogin';
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

    // View-details modal trigger (event delegation)
    document.addEventListener('click', function (e) {
        const btn = e.target.closest('.view-details-btn');
        if (btn) {
            if (e.target.closest('.wishlist-btn') || e._handledByWishlist) return;
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

    // Escape key — close modals
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            if (typeof closeLoginModal === 'function') closeLoginModal();
            if (typeof closeProductDetailsModal === 'function') closeProductDetailsModal();
        }
    });

    // History pop state — handle back/forward for modals
    window.addEventListener('popstate', function (e) {
        const path = window.location.pathname;
        if (path === '/userlogin') { if (typeof openLoginModal === 'function') openLoginModal(null, 'login'); }
        else if (path === '/userregister') { if (typeof openLoginModal === 'function') openLoginModal(null, 'register'); }
        else { if (loginModalEl && !loginModalEl.classList.contains('hidden') && typeof closeLoginModal === 'function') closeLoginModal(); }
        const match = path.match(/^\/viewdetails\/([^/]+)$/);
        if (match) {
            if (window.activeProductOnLoad && (String(window.activeProductOnLoad.slug) === match[1] || String(window.activeProductOnLoad.id) === match[1])) {
                populateAndShowProductModal(window.activeProductOnLoad);
            } else {
                const btn = document.querySelector(`.view-details-btn[data-slug="${match[1]}"], .view-details-btn[data-id="${match[1]}"]`);
                if (btn) btn.click();
            }
        } else {
            const productModal = document.getElementById('product-details-modal');
            if (productModal && !productModal.classList.contains('hidden') && typeof closeProductDetailsModal === 'function') closeProductDetailsModal();
        }
    });
}

// ─────────────────────────────────────────────────────────────────────────────
// Cached element references refreshed per-navigation
// ─────────────────────────────────────────────────────────────────────────────
let loginModalEl = null;

function populateAndShowProductModal(productData) {
    const productModal = document.getElementById('product-details-modal');
    const productContainer = document.getElementById('product-details-container');
    if (!productModal || !productContainer) return;
    const reviewForm = document.getElementById('product-review-form');
    if (reviewForm) reviewForm.reset();
    const reviewSuccessMsg = document.getElementById('review-success-message');
    if (reviewSuccessMsg) { reviewSuccessMsg.textContent = ''; reviewSuccessMsg.classList.add('hidden'); }
    const reviewErrorMsg = document.getElementById('review-error-message');
    if (reviewErrorMsg) { reviewErrorMsg.textContent = ''; reviewErrorMsg.classList.add('hidden'); }
    const reviewSection = document.getElementById('modal-add-review-section');
    if (reviewSection) reviewSection.classList.add('hidden');
    const ratingVal = document.getElementById('review-rating-value');
    if (ratingVal) ratingVal.value = '';
    document.querySelectorAll('.star-select-btn').forEach(s => { const icon = s.querySelector('i'); if (icon) icon.className = 'far fa-star text-[#3A2A1F]/40'; s.classList.remove('text-yellow-400'); });

    let categoryName = typeof productData.category === 'string' ? productData.category : (productData.category?.cat_name || productData.category?.name || productData.category_name || 'Crafts');
    let vendorName = typeof productData.vendor === 'string' ? productData.vendor : (productData.vendor?.vendor_name || productData.vendor?.business_name || productData.vendor?.name || productData.vendor_name || '');
    let imageUrl = productData.primary_image_url || (typeof productData.image === 'string' && productData.image.startsWith('http') ? productData.image : (productData.image ? '/' + productData.image.replace(/^\/+/, '') : ''));

    window.activeProduct = { id: productData.id, name: productData.name, price: parseFloat(productData.price), image: imageUrl, category: categoryName, desc: productData.desc || productData.description || '', vendor: vendorName, tag: productData.tag || (categoryName === 'Metalware' ? 'Authentic' : 'Handmade') };

    const fields = {
        'modal-product-name': d => d.textContent = productData.name,
        'modal-main-image': d => { d.src = imageUrl; d.alt = productData.name; },
        'modal-breadcrumb-cat': d => d.textContent = categoryName,
        'modal-product-desc': d => d.textContent = productData.desc || productData.description || '',
        'modal-product-story': d => d.textContent = productData.desc || productData.description || '',
        'modal-reviews-count': d => d.textContent = productData.reviews || productData.reviews_count || '0',
    };
    Object.entries(fields).forEach(([id, fn]) => { const el = document.getElementById(id); if (el) fn(el); });

    if (vendorName) {
        const modalVendorName = document.getElementById('modal-vendor-name');
        const vendorCard = document.getElementById('modal-vendor-card');
        const avatarEl = document.getElementById('modal-vendor-avatar');
        if (modalVendorName) modalVendorName.textContent = vendorName;
        if (avatarEl) avatarEl.textContent = vendorName.charAt(0).toUpperCase();
        if (vendorCard) vendorCard.classList.remove('hidden');
    } else {
        const vendorCard = document.getElementById('modal-vendor-card');
        if (vendorCard) vendorCard.classList.add('hidden');
    }

    const price = Number(productData.price ?? productData.effective_price ?? 0);
    const originalPrice = Number(productData.originalPrice ?? productData.original_price ?? productData.price ?? price);
    const discountPrice = Number(productData.discount_price ?? productData.discountPrice ?? 0);
    const hasDiscount = productData.discount === 'true' || (!isNaN(discountPrice) && discountPrice > 0 && discountPrice < originalPrice) || originalPrice > price;
    const displayPrice = Number.isFinite(price) ? price : 0;
    const displayOriginalPrice = Number.isFinite(originalPrice) ? originalPrice : displayPrice;
    const savings = Math.max(0, displayOriginalPrice - displayPrice);
    const discountPercentage = displayOriginalPrice > 0 ? Math.round((savings / displayOriginalPrice) * 100) : 0;
    const modalProductPrice = document.getElementById('modal-product-price');
    if (modalProductPrice) modalProductPrice.textContent = `Rs. ${displayPrice.toLocaleString()}`;
    const modalProductOriginalPrice = document.getElementById('modal-product-original-price');
    const modalDiscountTag = document.getElementById('modal-discount-tag');
    const modalSavingsTag = document.getElementById('modal-savings-tag');
    if (hasDiscount && modalProductOriginalPrice && savings > 0) {
        modalProductOriginalPrice.textContent = `Rs. ${displayOriginalPrice.toLocaleString()}`;
        modalProductOriginalPrice.classList.remove('hidden');
        if (modalDiscountTag) { modalDiscountTag.textContent = `-${discountPercentage}% OFF`; modalDiscountTag.classList.remove('hidden'); }
        if (modalSavingsTag) modalSavingsTag.classList.add('hidden');
    } else {
        if (modalProductOriginalPrice) modalProductOriginalPrice.classList.add('hidden');
        if (modalDiscountTag) modalDiscountTag.classList.add('hidden');
        if (modalSavingsTag) modalSavingsTag.classList.add('hidden');
    }

    const stock = parseInt(productData.stock || 10);
    const modalStockStatus = document.getElementById('modal-stock-status');
    if (modalStockStatus) {
        if (stock > 0) { modalStockStatus.textContent = 'In Stock'; modalStockStatus.className = 'text-xs text-emerald-700 font-bold'; }
        else { modalStockStatus.textContent = 'Out of Stock'; modalStockStatus.className = 'text-xs text-red-500 font-bold'; }
    }

    const modalStarsContainer = document.getElementById('modal-stars-container');
    if (modalStarsContainer) {
        modalStarsContainer.innerHTML = '';
        const rating = parseFloat(productData.rating || 5);
        for (let i = 1; i <= 5; i++) { const star = document.createElement('i'); star.style.marginRight = '2px'; star.className = i <= rating ? 'fas fa-star text-yellow-500' : (i - rating < 1 ? 'fas fa-star-half-alt text-yellow-500' : 'far fa-star text-yellow-500'); modalStarsContainer.appendChild(star); }
    }

    const qtyInput = productModal.querySelector('.qty-val-input');
    if (qtyInput) qtyInput.value = 1;

    fetchReviewsForProduct(productData.id);

    const toggleReviewBtn = document.getElementById('toggle-add-review-btn');
    if (toggleReviewBtn) {
        toggleReviewBtn.innerHTML = '<i class="fas fa-pen-fancy"></i> Write a Review';
        if (window.isLoggedIn) {
            fetch('/product/' + productData.id + '/can-review').then(res => res.json()).then(data => { if (data.eligible && data.existing) toggleReviewBtn.innerHTML = '<i class="fas fa-edit"></i> Edit a Review'; }).catch(() => {});
        }
    }

    productModal.classList.remove('hidden');
    productModal.classList.add('block');
    setTimeout(() => {
        productModal.classList.remove('opacity-0'); productModal.classList.add('opacity-100');
        productContainer.classList.remove('scale-95', 'opacity-0'); productContainer.classList.add('scale-100', 'opacity-100');
    }, 10);
    document.body.style.overflow = 'hidden';
}

function closeProductDetailsModal() {
    const productModal = document.getElementById('product-details-modal');
    const productContainer = document.getElementById('product-details-container');
    if (!productModal || !productContainer) return;
    restoreProductUrlState();
    productModal.classList.remove('opacity-100'); productModal.classList.add('opacity-0');
    productContainer.classList.remove('scale-100', 'opacity-100'); productContainer.classList.add('scale-95', 'opacity-0');
    setTimeout(() => { productModal.classList.remove('block'); productModal.classList.add('hidden'); }, 300);
    document.body.style.overflow = '';
}
window.closeProductDetailsModal = closeProductDetailsModal;

// ─────────────────────────────────────────────────────────────────────────────
// PASSWORD TOGGLE HELPER
// ─────────────────────────────────────────────────────────────────────────────
function setupPasswordToggle(toggleBtn, passwordInput) {
    if (!toggleBtn || !passwordInput) return;
    const icon = toggleBtn.querySelector('i');
    const show = (e) => { if (e) e.preventDefault(); passwordInput.type = 'text'; if (icon) icon.className = 'fas fa-eye text-sm'; };
    const hide = (e) => { if (e) e.preventDefault(); passwordInput.type = 'password'; if (icon) icon.className = 'far fa-eye-slash text-sm'; };
    toggleBtn.addEventListener('mousedown', show);
    toggleBtn.addEventListener('mouseup', hide);
    toggleBtn.addEventListener('mouseleave', hide);
    toggleBtn.addEventListener('touchstart', show);
    toggleBtn.addEventListener('touchend', hide);
    toggleBtn.addEventListener('touchcancel', hide);
    toggleBtn.addEventListener('click', e => e.preventDefault());
}

// ─────────────────────────────────────────────────────────────────────────────
// PER-PAGE INIT — called on every DOMContentLoaded AND livewire:navigated
// ─────────────────────────────────────────────────────────────────────────────
function initPage() {
    // ── Drawer ──────────────────────────────────────────────────────────────
    const hamburger      = document.getElementById('hamburger-btn');
    const drawer         = document.getElementById('mobile-drawer');
    const overlay        = document.getElementById('drawer-overlay');
    const closeBtn       = document.getElementById('close-drawer-btn');
    const mobileSearchBtn  = document.getElementById('mobile-search-btn');
    const mobileSearchBar  = document.getElementById('mobile-search-bar');
    const mobileSearchInput = document.getElementById('mobile-search');

    function openDrawer()  { if (drawer) drawer.classList.add('open');  if (overlay) overlay.classList.add('open');  if (hamburger) hamburger.setAttribute('aria-expanded', 'true');  document.body.style.overflow = 'hidden'; }
    function closeDrawer() { if (drawer) drawer.classList.remove('open'); if (overlay) overlay.classList.remove('open'); if (hamburger) hamburger.setAttribute('aria-expanded', 'false'); document.body.style.overflow = ''; }

    if (hamburger) hamburger.addEventListener('click', openDrawer);
    if (closeBtn)  closeBtn.addEventListener('click', closeDrawer);
    if (overlay)   overlay.addEventListener('click', closeDrawer);
    if (drawer) drawer.querySelectorAll('a').forEach(link => link.addEventListener('click', closeDrawer));

    if (mobileSearchBtn && mobileSearchBar) {
        mobileSearchBtn.addEventListener('click', function () {
            const hidden = mobileSearchBar.classList.contains('hidden');
            mobileSearchBar.classList.toggle('hidden', !hidden);
            if (hidden && mobileSearchInput) mobileSearchInput.focus();
        });
    }

    // ── Login / Register Modal ───────────────────────────────────────────────
    const loginModal          = document.getElementById('login-modal');
    loginModalEl              = loginModal; // cache for global listeners
    const loginModalContainer = document.getElementById('login-modal-container');
    const desktopSigninBtn    = document.getElementById('desktop-signin');
    const mobileSigninBtn     = document.getElementById('mobile-signin');
    const mobileSignupBtn     = document.getElementById('mobile-signup');
    const closeLoginModalBtn  = document.getElementById('close-login-modal');
    const loginView           = document.getElementById('login-view');
    const registerView        = document.getElementById('register-view');
    const forgotView          = document.getElementById('forgot-view');
    const modalShowRegisterBtn = document.getElementById('modal-show-register');
    const modalShowLoginBtn    = document.getElementById('modal-show-login');

    let originalUrl = window.location.pathname + window.location.search;
    if (originalUrl === '/userlogin' || originalUrl === '/userregister') originalUrl = '/';

    function updateUrlState(view) {
        const path = view === 'register' ? '/userregister' : '/userlogin';
        if (window.location.pathname !== path) history.pushState({ modal: view }, '', path);
    }
    function restoreUrlState() {
        if (window.location.pathname === '/userlogin' || window.location.pathname === '/userregister') history.pushState({ modal: null }, '', originalUrl);
    }
    function switchModalView(view) {
        [loginView, registerView, forgotView].forEach(v => v && v.classList.add('hidden'));
        if (view === 'register' && registerView) registerView.classList.remove('hidden');
        else if (view === 'forgot' && forgotView) forgotView.classList.remove('hidden');
        else if (loginView) loginView.classList.remove('hidden');
    }

    function openLoginModal(e, view = 'login') {
        if (e) e.preventDefault();
        closeDrawer();
        if (loginModal && loginModal.classList.contains('hidden')) {
            const currentPath = window.location.pathname + window.location.search;
            if (currentPath !== '/userlogin' && currentPath !== '/userregister') originalUrl = currentPath;
        }
        if (loginModal && loginModalContainer) {
            switchModalView(view);
            if (view === 'register') updateUrlState('register');
            else if (view === 'login') updateUrlState('login');
            loginModal.classList.remove('hidden');
            loginModal.classList.add('flex');
            setTimeout(() => { loginModal.classList.remove('opacity-0'); loginModal.classList.add('opacity-100'); loginModalContainer.classList.remove('scale-95', 'opacity-0'); loginModalContainer.classList.add('scale-100', 'opacity-100'); }, 10);
            document.body.style.overflow = 'hidden';
        }
    }

    function closeLoginModal() {
        if (loginModal && loginModalContainer) {
            restoreUrlState();
            loginModal.classList.remove('opacity-100'); loginModal.classList.add('opacity-0');
            loginModalContainer.classList.remove('scale-100', 'opacity-100'); loginModalContainer.classList.add('scale-95', 'opacity-0');
            setTimeout(() => { loginModal.classList.remove('flex'); loginModal.classList.add('hidden'); switchModalView('login'); }, 300);
            document.body.style.overflow = '';
        }
    }

    window.openLoginModal = openLoginModal;
    window.closeLoginModal = closeLoginModal;

    if (desktopSigninBtn) desktopSigninBtn.addEventListener('click', e => openLoginModal(e, 'login'));
    if (mobileSigninBtn)  mobileSigninBtn.addEventListener('click', e => openLoginModal(e, 'login'));
    if (mobileSignupBtn)  mobileSignupBtn.addEventListener('click', e => openLoginModal(e, 'register'));
    if (closeLoginModalBtn) closeLoginModalBtn.addEventListener('click', closeLoginModal);
    if (modalShowRegisterBtn) modalShowRegisterBtn.addEventListener('click', e => { e.preventDefault(); switchModalView('register'); updateUrlState('register'); });
    if (modalShowLoginBtn)    modalShowLoginBtn.addEventListener('click', e => { e.preventDefault(); switchModalView('login'); updateUrlState('login'); });

    const modalShowForgotBtn  = document.getElementById('modal-show-forgot');
    const forgotBackToLoginBtn = document.getElementById('forgot-back-to-login');
    if (modalShowForgotBtn)    modalShowForgotBtn.addEventListener('click', e => { e.preventDefault(); switchModalView('forgot'); });
    if (forgotBackToLoginBtn)  forgotBackToLoginBtn.addEventListener('click', e => { e.preventDefault(); switchModalView('login'); updateUrlState('login'); });
    if (loginModal) loginModal.addEventListener('click', e => { if (e.target === loginModal) closeLoginModal(); });

    // Auto-open modal if direct URL
    const pathOnLoad = window.location.pathname;
    if (pathOnLoad === '/userlogin') openLoginModal(null, 'login');
    else if (pathOnLoad === '/userregister') openLoginModal(null, 'register');

    // ── Password toggles ─────────────────────────────────────────────────────
    setupPasswordToggle(document.getElementById('modal-toggle-password'), document.getElementById('modal-password'));
    setupPasswordToggle(document.getElementById('modal-register-toggle-password'), document.getElementById('modal-register-password'));
    setupPasswordToggle(document.getElementById('modal-register-toggle-password-confirm'), document.getElementById('modal-register-password_confirmation'));

    const modalRegisterPhoneInput = document.getElementById('modal-register-phone');
    if (modalRegisterPhoneInput) {
        modalRegisterPhoneInput.addEventListener('input', function () {
            let value = this.value.replace(/\D/g, '');
            if (value.length > 10) value = value.substring(0, 10);
            this.value = value;
        });
    }

    // ── Product Details Modal wiring ──────────────────────────────────────────
    const productModal    = document.getElementById('product-details-modal');
    const closeProductBtn = document.getElementById('close-product-details');
    const qtyInput        = productModal ? productModal.querySelector('.qty-val-input') : null;

    if (closeProductBtn) closeProductBtn.addEventListener('click', closeProductDetailsModal);
    if (productModal) {
        productModal.addEventListener('click', e => { if (e.target === productModal) closeProductDetailsModal(); });
        // Tabs
        const tabBtns = productModal.querySelectorAll('.tab-btn');
        const tabPanels = productModal.querySelectorAll('.tab-panel');
        tabBtns.forEach(btn => {
            btn.addEventListener('click', function () {
                const target = btn.getAttribute('data-tab');
                tabBtns.forEach(b => { b.classList.remove('text-[#C65A3A]', 'border-b-2', 'border-[#C65A3A]', 'font-bold'); b.classList.add('text-[#3A2A1F]/60', 'font-semibold'); });
                btn.classList.add('text-[#C65A3A]', 'border-b-2', 'border-[#C65A3A]', 'font-bold'); btn.classList.remove('text-[#3A2A1F]/60', 'font-semibold');
                tabPanels.forEach(panel => { panel.getAttribute('data-panel') === target ? panel.classList.remove('hidden') : panel.classList.add('hidden'); });
            });
        });
        // Quantity controls
        const qtyPlus = productModal.querySelector('.qty-plus-btn');
        const qtyMinus = productModal.querySelector('.qty-minus-btn');
        if (qtyPlus && qtyInput) qtyPlus.addEventListener('click', () => { qtyInput.value = parseInt(qtyInput.value) + 1; });
        if (qtyMinus && qtyInput) qtyMinus.addEventListener('click', () => { const val = parseInt(qtyInput.value); if (val > 1) qtyInput.value = val - 1; });
        if (qtyInput) qtyInput.addEventListener('change', function () { let val = parseInt(this.value) || 1; if (val < 1) val = 1; this.value = val; });
        // Add to cart inside modal
        const addToCartModalBtn = document.getElementById('modal-add-to-cart-btn');
        const buyNowModalBtn    = document.getElementById('modal-buy-now-btn');
        if (addToCartModalBtn) {
            addToCartModalBtn.addEventListener('click', function () {
                if (!window.isLoggedIn) { window.location.href = window.loginUrl || '/userlogin'; return; }
                if (window.activeProduct && typeof window.addToCart === 'function') { window.addToCart(window.activeProduct, parseInt(qtyInput?.value) || 1); closeProductDetailsModal(); }
            });
        }
        if (buyNowModalBtn) {
            buyNowModalBtn.addEventListener('click', function () {
                if (!window.isLoggedIn) { window.location.href = window.loginUrl || '/userlogin'; return; }
                if (window.activeProduct && typeof window.addToCartAsync === 'function') {
                    window.addToCartAsync(window.activeProduct, parseInt(qtyInput?.value) || 1).then(() => { window.location.href = '/cart'; });
                }
            });
        }
    }

    // ── Review form ───────────────────────────────────────────────────────────
    const starSelectBtns = document.querySelectorAll('.star-select-btn');
    const ratingVal      = document.getElementById('review-rating-value');
    if (starSelectBtns.length > 0 && ratingVal) {
        starSelectBtns.forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                const rating = parseInt(this.getAttribute('data-rating'));
                ratingVal.value = rating;
                starSelectBtns.forEach(s => { const r = parseInt(s.getAttribute('data-rating')); const icon = s.querySelector('i'); icon.className = r <= rating ? 'fas fa-star text-[#C65A3A]' : 'far fa-star text-[#3A2A1F]/40'; });
            });
        });
    }

    const reviewForm = document.getElementById('product-review-form');
    if (reviewForm) {
        reviewForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const rating  = ratingVal?.value;
            const comment = document.getElementById('review-comment')?.value;
            const errorMsg  = document.getElementById('review-error-message');
            const successMsg = document.getElementById('review-success-message');
            const submitBtn = document.getElementById('submit-review-btn');
            if (!rating) { showToast('Please select a rating star.', 'error'); return; }
            if (errorMsg) errorMsg.classList.add('hidden');
            if (successMsg) successMsg.classList.add('hidden');
            submitBtn.disabled = true; submitBtn.textContent = 'Submitting...';
            fetch('/product/' + window.activeProduct.id + '/reviews', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content ?? '' },
                body: JSON.stringify({ rating, comment })
            }).then(res => res.json()).then(data => {
                submitBtn.disabled = false; submitBtn.textContent = 'Submit Review';
                if (data.success) {
                    showToast(data.message || 'Review submitted!', 'success');
                    reviewForm.reset();
                    starSelectBtns.forEach(s => { s.querySelector('i').className = 'far fa-star text-[#3A2A1F]/40'; });
                    if (ratingVal) ratingVal.value = '';
                    fetchReviewsForProduct(window.activeProduct.id);
                    const toggleReviewBtn = document.getElementById('toggle-add-review-btn');
                    if (toggleReviewBtn) toggleReviewBtn.innerHTML = '<i class="fas fa-edit"></i> Edit a Review';
                    const reviewSection = document.getElementById('modal-add-review-section');
                    if (reviewSection) reviewSection.classList.add('hidden');
                } else { showToast(data.message || 'Something went wrong.', 'error'); }
            }).catch(() => { submitBtn.disabled = false; submitBtn.textContent = 'Submit Review'; showToast('Server error. Please try again.', 'error'); });
        });
    }

    // ── Forgot Password AJAX form ──────────────────────────────────────────────
    const forgotForm   = document.getElementById('forgot-password-form');
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
            const btn     = document.getElementById('forgot-submit-btn');
            const btnText = document.getElementById('forgot-btn-text');
            const email   = document.getElementById('forgot-email').value;
            btn.disabled  = true; btnText.textContent = 'Sending…';
            const iconEl = btn.querySelector('i');
            if (iconEl) iconEl.className = 'fas fa-spinner fa-spin text-xs';
            forgotForm.querySelectorAll('.forgot-error').forEach(el => el.remove());
            try {
                const res  = await fetch(forgotForm.action, { method: 'POST', headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content ?? '' }, body: JSON.stringify({ email }) });
                const json = await res.json();
                if (res.ok && (json.status || json.status === true)) {
                    document.getElementById('forgot-form-wrap')?.classList.add('hidden');
                    const sentEl = document.getElementById('forgot-sent-email');
                    if (sentEl) sentEl.textContent = email;
                    document.getElementById('forgot-success')?.classList.remove('hidden');
                } else {
                    const errMsg = json.errors?.email?.[0] ?? json.message ?? 'Something went wrong. Please try again.';
                    const errEl = document.createElement('p');
                    errEl.className = 'forgot-error text-red-500 text-xs mt-1.5 font-medium flex items-center gap-1';
                    errEl.innerHTML = '<i class="fas fa-exclamation-circle text-[10px]"></i> ' + errMsg;
                    document.getElementById('forgot-email')?.closest('div[class*="flex"]')?.after(errEl);
                    btn.disabled = false; btnText.textContent = 'SEND RESET LINK';
                    if (iconEl) iconEl.className = 'fas fa-paper-plane text-xs';
                }
            } catch { btn.disabled = false; btnText.textContent = 'SEND RESET LINK'; if (iconEl) iconEl.className = 'fas fa-paper-plane text-xs'; }
        });
    }

    // ── Wishlist & Cart initial render ────────────────────────────────────────
    updateWishlistBadge();
    updateCartBadge();
    syncWishlistIcons();
    renderWishlistPage();
    renderCartPage();

    // ── Product modal on direct URL load ──────────────────────────────────────
    if (window.activeProductOnLoad) populateAndShowProductModal(window.activeProductOnLoad);
}

// ─────────────────────────────────────────────────────────────────────────────
// STATE INITIALISATION — run once on very first load
// ─────────────────────────────────────────────────────────────────────────────
function initState() {
    if (!window.isLoggedIn) {
        localStorage.removeItem('wishlist');
        localStorage.removeItem('wishlist_visited');
        wishlist = [];
        cart = [];
    } else {
        wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
        cart = [];
        dbCartCount = parseInt(window.initialCartCount) || 0;
        if (!wishlistFetched) {
            wishlistFetched = true;
            fetch('/wishlist/items', { headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': getCsrfToken() } })
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
        }
    }

    // Seed wishlist defaults on first visit
    const wishlistGridContainer = document.getElementById('wishlist-grid-container');
    if (wishlistGridContainer && wishlist.length === 0 && !localStorage.getItem('wishlist_visited')) {
        wishlist = [
            { id: "1",   name: "Patan Bronze Bowl",      price: "4500", image: "/images/1st-image.png",  desc: "Hand-hammered ritual vessel by local metalsmiths.", category: "Metalware",  tag: "Authentic Patan" },
            { id: "201", name: "Yak Wool Scarf",         price: "3200", image: "/images/4th-image.png",  desc: "100% pure Himalayan wool, naturally dyed.",          category: "Textiles",   tag: "Artisan Made" },
            { id: "202", name: "Traditional Dhaka Topi", price: "1800", image: "/images/Sweaters.png",   desc: "Hand-woven patterns from the Palpa region.",         category: "Textiles" },
            { id: "203", name: "Wild Hemp Backpack",     price: "5600", image: "/images/aboutus.jpg",    desc: "Durable, sustainable, and 100% biodegradable.",      category: "Accessories" },
        ];
        localStorage.setItem('wishlist', JSON.stringify(wishlist));
        localStorage.setItem('wishlist_visited', 'true');
    }
}

// ─────────────────────────────────────────────────────────────────────────────
// NPROGRESS CONFIGURATION
// ─────────────────────────────────────────────────────────────────────────────
if (window.NProgress) {
    NProgress.configure({ showSpinner: false, trickleSpeed: 200, minimum: 0.1 });
    // Livewire Navigate hooks
    document.addEventListener('livewire:navigate', () => NProgress.start());
    document.addEventListener('livewire:navigated', () => NProgress.done());
}

// ─────────────────────────────────────────────────────────────────────────────
// PAGE FADE-IN AFTER NAVIGATION
// ─────────────────────────────────────────────────────────────────────────────
document.addEventListener('livewire:navigated', () => {
    document.body.style.opacity = '0';
    requestAnimationFrame(() => {
        document.body.style.transition = 'opacity 0.18s ease';
        document.body.style.opacity = '1';
    });
});

// ─────────────────────────────────────────────────────────────────────────────
// BOOTSTRAP
// ─────────────────────────────────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', () => {
    initState();
    if (!globalSetupDone) {
        setupGlobalListeners();
        globalSetupDone = true;
    }
    initPage();
});

document.addEventListener('livewire:navigated', () => {
    // Re-sync state vars that may change after a redirect
    if (window.isLoggedIn) {
        dbCartCount = parseInt(window.initialCartCount) || dbCartCount;
    }
    initPage();
});