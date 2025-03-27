<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Searchable;

class Savings extends Model
{
    use Searchable;

    use HasFactory;
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
     
}
