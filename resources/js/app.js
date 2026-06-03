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
})();



//welcome
    tailwind = window.tailwind || {};
    tailwind.config = {
        theme: {
            extend: {
                fontFamily: {
                    sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    serif: ['"Playfair Display"', 'serif'],
                },
                colors: {
                    brand: {
                        primary: '#b55b3d',    /* Handcrafted Clay / Terracotta */
                        secondary: '#1f3d2e',  /* Deep Forest Green */
                        cream: '#F5E8D6',      /* Brand Peach/Pink Background */
                        dark: '#2c2523',       /* Charcoal Brown for Typography */
                    }
                }
            }
        }
    }







//footer
    tailwind = window.tailwind || {};
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    brand: {
                        primary: '#b55b3d',    /* Handcrafted Clay / Terracotta */
                        secondary: '#2a5c43',  /* Deep Forest Green */
                        cream: '#fdfbf7',      /* Soft Warm Ivory Background */
                        dark: '#2c2523',       /* Charcoal Brown for Typography */
                    }
                }
            }
        }
    }

    //about us
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        serif: ['"Playfair Display"', 'serif'],
                    },
                    colors: {
                        brand: {
                            primary: '#b55b3d',    /* Handcrafted Clay / Terracotta */
                            secondary: '#2a5c43',  /* Deep Forest Green */
                            cream: '#F5E8D6',      /* Brand Peach/Pink Background */
                            dark: '#2c2523',       /* Charcoal Brown for Typography */
                        }
                    }
                }
            }
        }
