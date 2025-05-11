<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlantFamily extends Model
{
    protected $fillable = [
        'name',
    ];

    public function plants()
    {
        return $this->hasMany(Plant::class);
    }
}