<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RndExchangeRate extends Model
{
    protected $table = 'rnd_exchange_rates';

    protected $fillable = [
        'rate',
        'notes',
        'updated_by',
    ];

    protected $casts = [
        'rate' => 'decimal:8',
    ];

    public function updatedBy()
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }

    public static function getCurrentRate()
    {
        return self::latest()->first()?->rate ?? 204;
    }

    public static function updateRate($rate, $notes = null, $updatedBy = null)
    {
        return self::create([
            'rate' => $rate,
            'notes' => $notes,
            'updated_by' => $updatedBy,
        ]);
    }
}
