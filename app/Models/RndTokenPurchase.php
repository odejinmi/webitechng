<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;

class RndTokenPurchase extends Model
{
    use Searchable;

    protected $table = 'rnd_token_purchases';

    protected $fillable = [
        'user_id',
        'rnd_amount',
        'exchange_rate',
        'total_amount',
        'vendor_name',
        'vendor_payment_details',
        'payment_proof',
        'receipt',
        'status',
        'admin_note',
    ];

    protected $casts = [
        'rnd_amount' => 'decimal:8',
        'exchange_rate' => 'decimal:8',
        'total_amount' => 'decimal:8',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeProcessing($query)
    {
        return $query->where('status', 'processing');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeDeclined($query)
    {
        return $query->where('status', 'declined');
    }

    public function getStatusBadgeAttribute()
    {
        return \App\Constants\RndPurchaseStatus::getBadge($this->status);
    }
}
