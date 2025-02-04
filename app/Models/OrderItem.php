<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $guarded = [];

    protected $casts = [
        'quantity' => 'int',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
