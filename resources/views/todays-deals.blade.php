<x-frontend-layout>

    <main class="main-container">

        <div class="today-deals-header">
            <div class="header-content">
                <h1 color="green">Today's Deals</h1>
            </div>

        </div>

        <div class="today-deals-container">
            <div class = "today-deal" id="deal-1">

                <div class="deal-image-wrapper">
                    <img src="{{ asset('images/Pottery.png') }}" alt="Sample product" class="deal-image">
                    <span class="deal-discount">-20% off</span>
                </div>

                <div class="details">
                    <div class="deal-info">
                        <h2 class="deal-title">Sample Product Name</h2>
                        <p class="deal-price">Rs. 1,234</p>
                        <p class="deal-desc">Short description of the product goes here. Highlight features or promos.
                        </p>
                    </div>

                    <div class="deal-rating">
                        <span class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </span>
                        <span class="review-count">(124)</span>
                    </div>

                    {{-- Dynamic Rating's code , we have to update later guys --}}
                    {{-- <div class="deal-rating">
                        <span class="stars">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $product->rating)
                                    <i class="fas fa-star"></i>
                                @elseif($i - $product->rating < 1)
                                    <i class="fas fa-star-half-alt"></i>
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                            @endfor
                        </span>
                        <span class="review-count">({{ $product->review_count }})</span>
                    </div> --}}

                    <div class="actions">
                        <button class="add-to-cart">Add to Cart</button>
                        <button class="view-details">View Details</button>
                    </div>

                </div>
            </div>

            <div class = "today-deal" id="deal-2">

                <div class="deal-image-wrapper">
                    <img src="{{ asset('images/Pottery.png') }}" alt="Sample product" class="deal-image">
                    <span class="deal-discount">-20% off</span>
                </div>

                <div class="details">
                    <div class="deal-info">
                        <h2 class="deal-title">Sample Product Name</h2>
                        <p class="deal-price">Rs. 1,234</p>
                        <p class="deal-desc">Short description of the product goes here. Highlight features or promos.
                        </p>
                    </div>

                    <div class="deal-rating">
                        <span class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </span>
                        <span class="review-count">(124)</span>
                    </div>

                    <div class="actions">
                        <button class="add-to-cart">Add to Cart</button>
                        <button class="view-details">View Details</button>
                    </div>
                </div>
            </div>
            <div class = "today-deal" id="deal-3">

                <div class="deal-image-wrapper">
                    <img src="{{ asset('images/Pottery.png') }}" alt="Sample product" class="deal-image">
                    <span class="deal-discount">-20% off</span>
                </div>

                <div class="details">
                    <div class="deal-info">
                        <h2 class="deal-title">Sample Product Name</h2>
                        <p class="deal-price">Rs. 1,234</p>
                        <p class="deal-desc">Short description of the product goes here. Highlight features or promos.
                        </p>
                    </div>

                    <div class="deal-rating">
                        <span class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </span>
                        <span class="review-count">(124)</span>
                    </div>

                    <div class="actions">
                        <button class="add-to-cart">Add to Cart</button>
                        <button class="view-details">View Details</button>
                    </div>
                </div>
            </div>
            <div class = "today-deal" id="deal-4">

                <div class="deal-image-wrapper">
                    <img src="{{ asset('images/Pottery.png') }}" alt="Sample product" class="deal-image">
                    <span class="deal-discount">-20% off</span>
                </div>

                <div class="details">
                    <div class="deal-info">
                        <h2 class="deal-title">Sample Product Name</h2>
                        <p class="deal-price">Rs. 1,234</p>
                        <p class="deal-desc">Short description of the product goes here. Highlight features or promos.
                        </p>
                    </div>

                    <div class="deal-rating">
                        <span class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </span>
                        <span class="review-count">(124)</span>
                    </div>

                    <div class="actions">
                        <button class="add-to-cart">Add to Cart</button>
                        <button class="view-details">View Details</button>
                    </div>
                </div>
            </div>
            <div class = "today-deal" id="deal-5">

                <div class="deal-image-wrapper">
                    <img src="{{ asset('images/Pottery.png') }}" alt="Sample product" class="deal-image">
                    <span class="deal-discount">-20% off</span>
                </div>

                <div class="details">
                    <div class="deal-info">
                        <h2 class="deal-title">Sample Product Name</h2>
                        <p class="deal-price">Rs. 1,234</p>
                        <p class="deal-desc">Short description of the product goes here. Highlight features or promos.
                        </p>
                    </div>

                    <div class="deal-rating">
                        <span class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </span>
                        <span class="review-count">(124)</span>
                    </div>

                    <div class="actions">
                        <button class="add-to-cart">Add to Cart</button>
                        <button class="view-details">View Details</button>
                    </div>
                </div>
            </div>
            <div class = "today-deal" id="deal-6">

                <div class="deal-image-wrapper">
                    <img src="{{ asset('images/Sweaters.png') }}" alt="Sample product" class="deal-image">
                    <span class="deal-discount">-20% off</span>
                </div>

                <div class="details">
                    <div class="deal-info">
                        <h2 class="deal-title">Sample Product Name</h2>
                        <p class="deal-price">Rs. 1,234</p>
                        <p class="deal-desc">Short description of the product goes here. Highlight features or promos.
                        </p>
                    </div>

                    <div class="deal-rating">
                        <span class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </span>
                        <span class="review-count">(124)</span>
                    </div>

                    <div class="actions">
                        <button class="add-to-cart">Add to Cart</button>
                        <button class="view-details">View Details</button>
                    </div>
                </div>
            </div>
            <div class = "today-deal" id="deal-7">

                <div class="deal-image-wrapper">
                    <img src="{{ asset('images/Sweaters.png') }}" alt="Sample product" class="deal-image">
                    {{-- <span class="deal-discount">-20% off</span> --}}
                </div>

                <div class="details">
                    <div class="deal-info">
                        <h2 class="deal-title">Sample Product Name</h2>
                        <p class="deal-price">Rs. 1,234</p>
                        <p class="deal-desc">Short description of the product goes here. Highlight features or promos.
                        </p>
                    </div>

                    <div class="deal-rating">
                        <span class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </span>
                        <span class="review-count">(124)</span>
                    </div>

                    <div class="actions">
                        <button class="add-to-cart">Add to Cart</button>
                        <button class="view-details">View Details</button>
                    </div>
                </div>
            </div>
            <div class = "today-deal" id="deal-8">

                <div class="deal-image-wrapper">
                    <img src="{{ asset('images/Sweaters.png') }}" alt="Sample product" class="deal-image">
                    {{-- <span class="deal-discount">-20% off</span> --}}
                </div>

                <div class="details">
                    <div class="deal-info">
                        <h2 class="deal-title">Sample Product Name</h2>
                        <p class="deal-price">Rs. 1,234</p>
                        <p class="deal-desc">Short description of the product goes here. Highlight features or promos.
                        </p>
                    </div>

                    <div class="deal-rating">
                        <span class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </span>
                        <span class="review-count">(124)</span>
                    </div>

                    <div class="actions">
                        <button class="add-to-cart">Add to Cart</button>
                        <button class="view-details">View Details</button>
                    </div>
                </div>
            </div>
            <div class = "today-deal" id="deal-9">

                <div class="deal-image-wrapper">
                    <img src="{{ asset('images/Sweaters.png') }}" alt="Sample product" class="deal-image">
                    {{-- <span class="deal-discount">-20% off</span> --}}
                </div>

                <div class="details">
                    <div class="deal-info">
                        <h2 class="deal-title">Sample Product Name</h2>
                        <p class="deal-price">Rs. 1,234</p>
                        <p class="deal-desc">Short description of the product goes here. Highlight features or promos.
                        </p>
                    </div>

                    <div class="deal-rating">
                        <span class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </span>
                        <span class="review-count">(124)</span>
                    </div>

                    <div class="actions">
                        <button class="add-to-cart">Add to Cart</button>
                        <button class="view-details">View Details</button>
                    </div>
                </div>
            </div>
            <div class = "today-deal" id="deal-10">

                <div class="deal-image-wrapper">
                    <img src="{{ asset('images/Pottery.png') }}" alt="Sample product" class="deal-image">
                    <span class="deal-discount">-20% off</span>
                </div>

                <div class="details">
                    <div class="deal-info">
                        <h2 class="deal-title">Sample Product Name</h2>
                        <p class="deal-price">Rs. 1,234</p>
                        <p class="deal-desc">Short description of the product goes here. Highlight features or promos.
                        </p>
                    </div>

                    <div class="deal-rating">
                        <span class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </span>
                        <span class="review-count">(124)</span>
                    </div>

                    <div class="actions">
                        <button class="add-to-cart">Add to Cart</button>
                        <button class="view-details">View Details</button>
                    </div>
                </div>
            </div>
            <div class = "today-deal" id="deal-11">

                <div class="deal-image-wrapper">
                    <img src="{{ asset('images/Pottery.png') }}" alt="Sample product" class="deal-image">
                    <span class="deal-discount">-20% off</span>
                </div>

                <div class="details">
                    <div class="deal-info">
                        <h2 class="deal-title">Sample Product Name</h2>
                        <p class="deal-price">Rs. 1,234</p>
                        <p class="deal-desc">Short description of the product goes here. Highlight features or promos.
                        </p>
                    </div>

                    <div class="deal-rating">
                        <span class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </span>
                        <span class="review-count">(124)</span>
                    </div>

                    <div class="actions">
                        <button class="add-to-cart">Add to Cart</button>
                        <button class="view-details">View Details</button>
                    </div>
                </div>
            </div>
            <div class = "today-deal" id="deal-12">

                <div class="deal-image-wrapper">
                    <img src="{{ asset('images/Pottery.png') }}" alt="Sample product" class="deal-image">
                    <span class="deal-discount">-20% off</span>
                </div>

                <div class="details">
                    <div class="deal-info">
                        <h2 class="deal-title">Sample Product Name</h2>
                        <p class="deal-price">Rs. 1,234</p>
                        <p class="deal-desc">Short description of the product goes here. Highlight features or promos.
                        </p>
                    </div>

                    <div class="deal-rating">
                        <span class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </span>
                        <span class="review-count">(124)</span>
                    </div>

                    <div class="actions">
                        <button class="add-to-cart">Add to Cart</button>
                        <button class="view-details">View Details</button>
                    </div>
                </div>
            </div>
            <div class = "today-deal" id="deal-13">

                <div class="deal-image-wrapper">
                    <img src="{{ asset('images/Pottery.png') }}" alt="Sample product" class="deal-image">
                    <span class="deal-discount">-20% off</span>
                </div>

                <div class="details">
                    <div class="deal-info">
                        <h2 class="deal-title">Sample Product Name</h2>
                        <p class="deal-price">Rs. 1,234</p>
                        <p class="deal-desc">Short description of the product goes here. Highlight features or promos.
                        </p>
                    </div>

                    <div class="deal-rating">
                        <span class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </span>
                        <span class="review-count">(124)</span>
                    </div>

                    <div class="actions">
                        <button class="add-to-cart">Add to Cart</button>
                        <button class="view-details">View Details</button>
                    </div>
                </div>
            </div>



        </div>
    </main>
</x-frontend-layout>
