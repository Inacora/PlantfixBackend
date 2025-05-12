<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderPlant extends Model
{
    protected $fillable = [
        'order_id',
        'plant_id',
        'quantity',
        'price_at_time',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function plant()
    {
        return $this->belongsTo(Plant::class);
    }
}
