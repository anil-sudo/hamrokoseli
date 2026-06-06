<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Image extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'images';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'imageable_id',
        'imageable_type',
        'type',
        'path',
        'is_primary',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'is_primary' => 'boolean',
    ];

    // -------------------------------------------------------------------------
    // Relationships
    // -------------------------------------------------------------------------

    /**
     * Polymorphic owner — can be a Product, Vendor, Category, etc.
     */
    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }

    // -------------------------------------------------------------------------
    // Scopes
    // -------------------------------------------------------------------------

    /**
     * Scope to only primary images.
     */
    public function scopePrimary($query)
    {
        return $query->where('is_primary', true);
    }

    /**
     * Scope by image type label (e.g. 'banner', 'thumbnail').
     */
    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type);
    }
}