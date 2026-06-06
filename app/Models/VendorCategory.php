<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VendorCategory extends Model
{
    public $timestamps = false; // only has created_at, no updated_at

    const CREATED_AT = 'created_at';

    const UPDATED_AT = null;

    protected $fillable = [
        'vendor_id',
        'category_id',
    ];

    protected $casts = [
        'vendor_id' => 'integer',
        'category_id' => 'integer',
        'created_at' => 'datetime',
    ];

    // ─── Relationships ────────────────────────────────────────────────────────

    /**
     * The vendor this pivot row belongs to.
     */
    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    /**
     * The category this pivot row belongs to.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
