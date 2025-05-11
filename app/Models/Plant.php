<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'plant_family_id',
    ];
     
    public function plantFamily()
    {
        return $this->belongsTo(PlantFamily::class, 'plant_family_id');
    }
    
}
