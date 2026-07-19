document.addEventListener('DOMContentLoaded', function () {
    const categoryPills = document.querySelectorAll('.filter-pill');
    const productCards = document.querySelectorAll('.product-card');
    const gridContainer = document.getElementById('product-grid');
    const modal = document.getElementById('product-details-modal');
    const container = document.getElementById('product-details-container');
    const closeBtn = document.getElementById('close-product-details');

    // Filter functionality
    function filterProducts(category) {
        productCards.forEach(card => {
            const cardCategory = card.getAttribute('data-category');
            card.style.display = (category === 'all' || cardCategory === category) ? '' : 'none';
        });
    }

    categoryPills.forEach(pill => {
        pill.addEventListener('click', function () {
            categoryPills.forEach(p => p.classList.remove('active'));
            pill.classList.add('active');
            filterProducts(pill.getAttribute('data-category'));
        });
    });

    // Sort functionality
    const sortSelect = document.getElementById('sort-select');
    function sortProducts(criteria) {
        const cardsArray = Array.from(productCards).filter(card => card.style.display !== 'none');
        cardsArray.sort((a, b) => {
            if (criteria === 'discount') return parseInt(b.getAttribute('data-discount')) - parseInt(a.getAttribute('data-discount'));
            if (criteria === 'price-asc') return parseFloat(a.getAttribute('data-price')) - parseFloat(b.getAttribute('data-price'));
            if (criteria === 'price-desc') return parseFloat(b.getAttribute('data-price')) - parseFloat(a.getAttribute('data-price'));
            return 0;
        });
        cardsArray.forEach(card => gridContainer.appendChild(card));
    }

    sortSelect.addEventListener('change', () => sortProducts(sortSelect.value));

    // Modal functionality
    document.querySelectorAll('.view-details-btn').forEach(btn => {
        btn.addEventListener('click', function (e) {
            // If the click came from inside a wishlist button, ignore it
            if (e.target.closest('.wishlist-btn')) return;
            e.preventDefault();

            document.getElementById('modal-product-name').textContent = btn.getAttribute('data-name');
            document.getElementById('modal-main-image').src = btn.getAttribute('data-image');
            document.getElementById('modal-product-price').textContent = 'Rs. ' + parseFloat(btn.getAttribute('data-price')).toLocaleString();
            document.getElementById('modal-product-desc').textContent = btn.getAttribute('data-desc');
            document.getElementById('modal-reviews-count').textContent = btn.getAttribute('data-reviews');

            const rating = parseFloat(btn.getAttribute('data-rating') || 5);
            const starsContainer = document.getElementById('modal-stars-container');
            starsContainer.innerHTML = '';
            for (let i = 1; i <= 5; i++) {
                const star = document.createElement('i');
                star.className = i <= rating ? 'fas fa-star' : (i - rating < 1 ? 'fas fa-star-half-alt' : 'far fa-star');
                starsContainer.appendChild(star);
            }

            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                container.classList.remove('scale-95', 'opacity-0');
                container.classList.add('scale-100', 'opacity-100');
            }, 10);
            document.body.style.overflow = 'hidden';
        });
    });

    function closeModal() {
        modal.classList.add('opacity-0');
        container.classList.add('scale-95', 'opacity-0');
        setTimeout(() => modal.classList.add('hidden'), 300);
        document.body.style.overflow = '';
    }

    closeBtn.addEventListener('click', closeModal);
    modal.addEventListener('click', (e) => e.target === modal && closeModal());
    document.addEventListener('keydown', (e) => e.key === 'Escape' && closeModal());

    // ==================== FEATURED CAROUSEL LOGIC ====================
    const carousel = document.getElementById('featured-carousel');
    const prevBtn = document.getElementById('featured-prev');
    const nextBtn = document.getElementById('featured-next');
    const cards = document.querySelectorAll('.featured-card');
    let currentIndex = 0;

    function updateCarousel() {
        const cardWidth = cards[0].offsetWidth;
        const offset = -currentIndex * (cardWidth + 24); // 24px is the gap
        carousel.style.transform = `translateX(${offset}px)`;
    }

    prevBtn.addEventListener('click', () => {
        currentIndex = Math.max(0, currentIndex - 1);
        updateCarousel();
    });

    nextBtn.addEventListener('click', () => {
        currentIndex = Math.min(cards.length - 1, currentIndex + 1);
        updateCarousel();
    });

    // Handle window resize for responsive behavior
    window.addEventListener('resize', () => {
        updateCarousel();
    });

    // ==================== TRENDING NOW CAROUSEL LOGIC ====================
    const trendingCarousel = document.getElementById('trending-carousel');
    const trendingPrevBtn = document.getElementById('trending-prev');
    const trendingNextBtn = document.getElementById('trending-next');
    const trendingCards = document.querySelectorAll('.trending-card');
    let trendingIndex = 0;

    function updateTrendingCarousel() {
        const cardWidth = trendingCards[0].offsetWidth;
        const offset = -trendingIndex * (cardWidth + 24); // 24px is the gap
        trendingCarousel.style.transform = `translateX(${offset}px)`;
    }

    trendingPrevBtn.addEventListener('click', () => {
        trendingIndex = Math.max(0, trendingIndex - 1);
        updateTrendingCarousel();
    });

    trendingNextBtn.addEventListener('click', () => {
        trendingIndex = Math.min(trendingCards.length - 1, trendingIndex + 1);
        updateTrendingCarousel();
    });

    // Handle window resize for responsive behavior
    window.addEventListener('resize', () => {
        updateTrendingCarousel();
    });
    
    // =============================
    // Featured Slider
    // =============================

    const featuredCarousel = document.getElementById("featured-carousel");
    const featuredCards = document.querySelectorAll(".featured-card");

    let currentSlide = 0;

    function moveFeaturedSlider() {

        currentSlide++;

        if (currentSlide >= featuredCards.length) {
            currentSlide = 0;
        }

        featuredCarousel.style.transform =
            `translateX(-${currentSlide * 100}%)`;
    }

    setInterval(moveFeaturedSlider, 3000);

    const countdownEl = document.getElementById('deal-countdown');
    const dealEndsAt = countdownEl ? countdownEl.getAttribute('data-ends-at') : null;
    const endTime = dealEndsAt ? new Date(dealEndsAt).getTime() : (new Date().getTime() + (8 * 60 * 60 * 1000));

    function updateCountdown() {

        const now = new Date().getTime();
        const distance = endTime - now;

        if (distance <= 0) {
            const daysElExp = document.getElementById("countdown-days");
            if (daysElExp) daysElExp.textContent = "00";
            document.getElementById("countdown-hours").textContent = "00";
            document.getElementById("countdown-minutes").textContent = "00";
            document.getElementById("countdown-seconds").textContent = "00";

            clearInterval(timer);
            return;
        }

        const days    = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours   = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        const daysEl = document.getElementById("countdown-days");
        if (daysEl) daysEl.textContent = String(days).padStart(2, "0");

        document.getElementById("countdown-hours").textContent =
            String(hours).padStart(2, "0");

        document.getElementById("countdown-minutes").textContent =
            String(minutes).padStart(2, "0");

        document.getElementById("countdown-seconds").textContent =
            String(seconds).padStart(2, "0");
    }

    updateCountdown();

    const timer = setInterval(updateCountdown, 1000);
});