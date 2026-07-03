<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VendorEarning extends Model
{
    protected $table = 'vendor_earnings';

    protected $fillable = [
        'vendor_id',
        'order_item_id',
        'gross_amount',
        'commission',
        'net_amount',
        'quantity',
        'status',
    ];

    protected $casts = [
        'gross_amount' => 'decimal:2',
        'commission' => 'decimal:2',
        'net_amount' => 'decimal:2',
    ];

    /*
    |--------------------------------------------------------------------------
    | Status Constants
    |--------------------------------------------------------------------------
    */

    const STATUS_PENDING = 'pending';

    const STATUS_CLEARED = 'cleared';

    const STATUS_ON_HOLD = 'on_hold';

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * The vendor this earning belongs to.
     */
    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    /**
     * The order item that generated this earning.
     */
    public function orderItem(): BelongsTo
    {
        return $this->belongsTo(OrderItem::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    public function scopeCleared($query)
    {
        return $query->where('status', self::STATUS_CLEARED);
    }

    public function scopeOnHold($query)
    {
        return $query->where('status', self::STATUS_ON_HOLD);
    }

    public function scopeForVendor($query, int $vendorId)
    {
        return $query->where('vendor_id', $vendorId);
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    public function isPending(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    public function isCleared(): bool
    {
        return $this->status === self::STATUS_CLEARED;
    }

    public function markAsCleared(): bool
    {
        return $this->update(['status' => self::STATUS_CLEARED]);
    }

    public function markAsOnHold(): bool
    {
        return $this->update(['status' => self::STATUS_ON_HOLD]);
    }
}
