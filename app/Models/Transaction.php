<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $casts = [
        'date' => 'datetime:d-m-Y', // Change your format
        
    ];

    public function setTransactionDateAttribute($value)
    {
    $this->attributes['date'] = Carbon::createFromFormat('Y-m-d', $value)->format('d-m-Y');
    }
}
