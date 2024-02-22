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
        'reference_network_equipment_id',
        'login',
        'password',
        'ip_address',
        'mac_address',
    ];

    public function referenceNetworkEquipment(){
        return $this->belongsTo(ReferenceNetworkEquipment::class);
    }

    public function location(): MorphOne
    {
        return $this->morphOne(Location::class, 'locatable');
    }
}
