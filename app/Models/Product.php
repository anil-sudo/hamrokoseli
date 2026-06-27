<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id', 'category_id', 'name', 'slug',
        'product_type', 'description', 'specifications',
        'price', 'discount_price', 'stock', 'sku',
        'image', 'status',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'discount_price' => 'decimal:2',
            'stock' => 'integer',
            'specifications' => 'array',
        ];
    }

    // -------------------------------------------------------------------------
    // Relationships
    // -------------------------------------------------------------------------

    /**
     * Many-to-One: Each product belongs to one vendor.
     */
    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    /**
     * Many-to-One: Each product belongs to one category.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * One-to-Many: A product can have many variants (size, color, SKU).
     */
    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    /**
     * One-to-Many: A product can appear in many order items.
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * One-to-Many: A product can be in many cart items.
     */
    public function cartItems(): HasMany
    {
        return $this->hasMany(Cart::class);
    }

    /**
     * One-to-Many: A product can be in many wishlists.
     */
    public function wishlistItems(): HasMany
    {
        return $this->hasMany(Wishlist::class);
    }

    /**
     * One-to-Many: A product can have many reviews.
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Polymorphic: A product can have many images.
     */
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    // -------------------------------------------------------------------------
    // Helper Methods
    // -------------------------------------------------------------------------

    /**
     * Returns the effective selling price (discount price if set, otherwise base price).
     * For variant products, returns the lowest final variant price.
     */
    public function effectivePrice(): float
    {
        if ($this->variants->isNotEmpty()) {
            return (float) $this->variants
                ->map(fn ($variant) => (! is_null($variant->discount_price) && $variant->discount_price > 0)
                    ? $variant->discount_price
                    : $variant->price)
                ->min();
        }

        return (! is_null($this->discount_price) && $this->discount_price > 0)
            ? (float) $this->discount_price
            : (float) $this->price;
    }

    public function originalPrice(): float
    {
        if ($this->variants->isNotEmpty()) {
            $discountedVariant = $this->variants
                ->filter(fn ($variant) => ! is_null($variant->discount_price) && $variant->discount_price > 0)
                ->sortBy('discount_price')
                ->first();

            if ($discountedVariant) {
                return (float) $discountedVariant->price;
            }

            return (float) $this->variants->min('price');
        }

        return (float) $this->price;
    }

    /**
     * Returns the resolved discount price.
     * For variant products, returns the lowest non-zero discount_price across all variants.
     * For normal products, returns the product-level discount_price.
     */
    public function resolvedDiscountPrice(): ?float
    {
        if ($this->variants->isNotEmpty()) {
            $discountPrice = $this->variants
                ->filter(fn ($variant) => ! is_null($variant->discount_price) && $variant->discount_price > 0)
                ->min('discount_price');

            return $discountPrice ? (float) $discountPrice : null;
        }

        return (! is_null($this->discount_price) && $this->discount_price > 0)
            ? (float) $this->discount_price
            : null;
    }

    /**
     * Whether this product (or any of its variants) has a discount.
     */
    public function hasDiscount(): bool
    {
        if ($this->variants->isNotEmpty()) {
            return $this->variants->contains(fn ($variant) => ! is_null($variant->discount_price)
                && $variant->discount_price > 0
                && $variant->discount_price < $variant->price
            );
        }

        return ! is_null($this->discount_price)
            && $this->discount_price > 0
            && $this->discount_price < $this->price;
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function inStock(): bool
    {
        return $this->stock > 0;
    }

    /**
     * Returns the URL of this product's primary image, falling back to the
     * first uploaded image, then to a placeholder if none exist.
     *
     * NOTE: the `image` column on `products` is legacy/unused — vendor
     * uploads are stored in the polymorphic `images` table instead. Make
     * sure to eager-load `images` (e.g. ->with('images')) before calling
     * this in a loop, or it will trigger an N+1 query per product.
     */
    public function primaryImageUrl(): string
    {
        $image = $this->images->firstWhere('is_primary', true)
            ?? $this->images->first();

        return $image
            ? asset('storage/'.$image->path)
            : asset('images/placeholder.png');
    }

    public function getImageAttribute(?string $value): ?string
    {
        if (filled($value)) {
            return $value;
        }

        return $this->images->firstWhere('is_primary', true)?->path
            ?? $this->images->first()?->path;
    }

    public function getPrimaryImagePathAttribute(): ?string
    {
        return $this->images->firstWhere('is_primary', true)?->path
            ?? $this->images->first()?->path;
    }
}
