<x-frontend-layout>
    <div class="bg-[#FFF7EF] text-[#3A2A1F] min-h-screen py-8 sm:py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">

            <!-- Section Header -->
            <div class="mb-10">
                <h1 class="text-4xl md:text-5xl font-serif font-extrabold text-[#1F3D2E] tracking-tight mb-4">
                    New Arrivals
                </h1>
                <p class="text-[#3A2A1F]/70 text-sm md:text-base leading-relaxed">
                    The newest handmade pieces added to Hamro Koseli.
                </p>
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

                @forelse ($products as $product)
                    <div
                        data-category="{{ $product->category?->slug ?? 'uncategorized' }}"
                        class="product-card bg-[#FDFBF7] rounded-xl sm:rounded-2xl border border-amber-900/5 overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 group flex flex-col">

                        <div class="relative">
                            <img src="{{ $product->primaryImageUrl() }}" alt="{{ $product->name }}"
                                class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300">

                            <span class="absolute top-3 left-3 bg-[#e5b842] text-black text-xs font-bold px-3 py-1 rounded-full">
                                New !!!
                            </span>

                            <button
                                class="wishlist-btn absolute bottom-3 right-3 text-[#C65A3A] hover:text-[#b04a2c] transition-colors text-xl drop-shadow"
                                data-product-id="{{ $product->id }}"
                                data-product-name="{{ $product->name }}"
                                data-product-price="{{ $product->effectivePrice() }}"
                                data-product-image="{{ $product->primaryImageUrl() }}"
                                data-product-desc="{{ $product->description }}"
                                data-product-category="{{ $product->category?->cat_name }}">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>

                        <div class="p-5 flex-grow flex flex-col justify-between">
                            <div>
                                <span class="text-[10px] font-bold uppercase tracking-wider text-[#3A2A1F]/50 block mb-1">
                                    {{ $product->category?->cat_name ?? 'General' }}
                                </span>

                                <h3 class="font-semibold text-lg mb-1 leading-tight line-clamp-1">
                                    {{ $product->name }}
                                </h3>
                                <p class="text-sm text-gray-600 mb-3 line-clamp-2">
                                    {{ $product->description }}
                                </p>

                                <div class="flex items-center justify-between mb-4">
                                    <span class="text-2xl font-bold text-[#1a3c34]">
                                        Rs. {{ number_format($product->effectivePrice(), 2) }}
                                    </span>
                                </div>
                            </div>

                            <div class="flex gap-2 mt-auto">
                                <a href="{{ route('viewdetails', $product->id) }}"
                                   class="view-details-btn flex-1 flex items-center justify-center gap-2 bg-[#1F3D2E] hover:bg-[#16301f] text-white text-sm font-semibold py-3 px-3 rounded-xl shadow-sm hover:shadow transition duration-300"
                                   data-id="{{ $product->id }}"
                                   data-name="{{ $product->name }}"
                                   data-price="{{ $product->effectivePrice() }}"
                                   data-original-price="{{ $product->originalPrice() }}"
                                   data-discount="{{ $product->hasDiscount() ? 'true' : 'false' }}"
                                   data-discount-price="{{ $product->resolvedDiscountPrice() ?? '' }}"
                                   data-image="{{ $product->primaryImageUrl() }}"
                                   data-category="{{ $product->category?->cat_name ?? 'Crafts' }}"
                                   data-vendor="{{ $product->vendor->business_name ?? $product->vendor->vendor_name ?? 'Local Artisan' }}"
                                   data-desc="{{ $product->description }}"
                                   data-rating="{{ $product->rating ?? 5 }}"
                                   data-reviews="{{ $product->reviews_count ?? 0 }}"
                                   data-stock="{{ $product->stock ?? 0 }}">
                                    <i class="fa-solid fa-circle-info text-xs"></i>
                                    Details
                                </a>

                                <button
                                    type="button"
                                    class="add-to-cart-btn flex-1 flex items-center justify-center gap-2 bg-[#C65A3A] hover:bg-[#b04a2c] text-white font-medium py-3 rounded-xl disabled:opacity-60 disabled:cursor-not-allowed transition-colors"
                                    data-product-id="{{ $product->id }}"
                                    data-product-name="{{ $product->name }}"
                                    data-product-price="{{ $product->effectivePrice() }}"
                                    data-product-image="{{ $product->primaryImageUrl() }}"
                                    data-product-desc="{{ $product->description }}"
                                    data-product-category="{{ $product->category?->cat_name ?? 'Crafts' }}"
                                    {{ ($product->stock ?? 0) < 1 ? 'disabled' : '' }}>
                                    <i class="fas fa-shopping-cart"></i>
                                    {{ ($product->stock ?? 0) < 1 ? 'Sold Out' : 'Add to Cart' }}
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-20 bg-white/40 rounded-3xl">
                        <h2 class="text-xl font-bold text-[#1F3D2E]">No new arrivals just yet</h2>
                        <p class="text-[#3A2A1F]/60 text-sm mt-2">Check back soon — artisans add new pieces all the time.</p>
                        <a href="{{ route('shop') }}" class="text-[#C65A3A] font-bold mt-4 inline-block">
                            Browse the Shop
                        </a>
                    </div>
                @endforelse

            </div>

            @if ($products->hasPages())
                <div class="mt-10">
                    {{ $products->links() }}
                </div>
            @endif

        </div>
    </div>
</x-frontend-layout>