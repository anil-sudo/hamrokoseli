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
        'vendor_id',
        'category_id',
        'name',
        'description',
        'price',
        'discount_price',
        'stock',
        'image',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'price'          => 'decimal:2',
            'discount_price' => 'decimal:2',
            'stock'          => 'integer',
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
     */
    public function effectivePrice(): float
    {
        return $this->discount_price ?? $this->price;
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function inStock(): bool
    {
        return $this->stock > 0;
    }
}