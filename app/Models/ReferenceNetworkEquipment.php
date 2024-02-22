<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class ReferenceNetworkEquipment extends Model
{
    use HasFactory;
    protected $fillable = [
        
        'manufacturer',
        'model',
        'parameter',
        'device_type',
        'count_port',
        'unit',
    ];

    public function networkEquipmentPorts(){
        return $this->hasMany(ReferenceNetworkEquipmentPort::class);
    }
}
