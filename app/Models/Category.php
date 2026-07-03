<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'cat_name',
        'image',
        'slug',
        'parent_cat_id',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'parent_cat_id' => 'integer',
        ];
    }

    // -------------------------------------------------------------------------
    // Relationships
    // -------------------------------------------------------------------------

    /**
     * Self-referencing: belongs to a parent category (NULL = root category).
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_cat_id');
    }

    /**
     * Self-referencing: a category can have many child categories.
     */
    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_cat_id');
    }

    /**
     * One-to-Many: A category can have many products.
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Many-to-Many: A category can be linked to many vendors via vendor_categories pivot.
     */
    public function vendors(): BelongsToMany
    {
        return $this->belongsToMany(Vendor::class, 'vendor_categories');
    }

    /**
     * Polymorphic: A category can have many images.
     */
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    // -------------------------------------------------------------------------
    // Helper Methods
    // -------------------------------------------------------------------------

    public function isRoot(): bool
    {
        return is_null($this->parent_cat_id);
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }
}
