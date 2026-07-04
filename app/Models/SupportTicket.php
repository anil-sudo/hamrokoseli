<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{
    protected $fillable = [
        'vendor_id',
        'ticket_number',
        'category',
        'subject',
        'description',
        'status',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
