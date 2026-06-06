<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VendorReview extends Model
{
    protected $fillable = [
        'user_id',
        'vendor_id',
        'rating',
        'comment',
    ];

    protected $casts = [
        'rating' => 'integer',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * The user who wrote this review.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The vendor being reviewed.
     */
    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    /**
     * Filter reviews for a specific vendor.
     */
    public function scopeForVendor($query, int $vendorId)
    {
        return $query->where('vendor_id', $vendorId);
    }

    /**
     * Filter reviews by a specific star rating.
     */
    public function scopeWithRating($query, int $rating)
    {
        return $query->where('rating', $rating);
    }

    /**
     * Order reviews from most recent to oldest.
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    /**
     * Calculate the average rating for a given vendor.
     */
    public static function averageRatingFor(int $vendorId): float
    {
        return round(
            static::where('vendor_id', $vendorId)->avg('rating') ?? 0,
            2
        );
    }

    /**
     * Get the rating breakdown (count per star) for a given vendor.
     * Returns an array like [1 => 1, 2 => 3, 3 => 5, 4 => 12, 5 => 25]
     */
    public static function ratingBreakdownFor(int $vendorId): array
    {
        $counts = static::where('vendor_id', $vendorId)
            ->selectRaw('rating, COUNT(*) as count')
            ->groupBy('rating')
            ->pluck('count', 'rating')
            ->toArray();

        // Ensure all stars 1–5 are present even if count is 0
        return array_replace(array_fill(1, 5, 0), $counts);
    }

    /**
     * Check if a user has already reviewed a vendor.
     */
    public static function hasReviewed(int $userId, int $vendorId): bool
    {
        return static::where('user_id', $userId)
            ->where('vendor_id', $vendorId)
            ->exists();
    }

    /**
     * Recalculate and sync the vendor's average rating in the vendors table.
     * Call this after creating or deleting a vendor review.
     */
    public static function syncVendorRating(int $vendorId): void
    {
        $avg = static::averageRatingFor($vendorId);

        Vendor::where('id', $vendorId)->update(['rating' => $avg]);
    }
}
