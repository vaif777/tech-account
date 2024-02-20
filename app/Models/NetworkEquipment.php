<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class NetworkEquipment extends Model
{
    use HasFactory;
    protected $fillable = [
        
        'name',
        'manufacturer_id',
        'model_id',
        'IP_address',
        'MAC_address',
        'count_port',
        'pattern',
        'unit',
    ];

    public function location(): MorphOne
    {
        return $this->morphOne(Location::class, 'locatable');
    }

    public function networkEquipmentPorts(){
        return $this->hasMany(networkEquipmentPort::class);
    }
}
