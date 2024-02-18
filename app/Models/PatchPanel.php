<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class PatchPanel extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'building_id',
        'telecommunication_cabinet_id',
        'manufacturer_id',
        'model_id',
        'unit',
        'count_port',
    ];

    public function location(): MorphOne
    {
        return $this->morphOne(Location::class, 'locatable');
    }
    
}
