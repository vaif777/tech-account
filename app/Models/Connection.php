<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Connection extends Model
{
    use HasFactory;
    protected $fillable = [

        'status',
        'distribution_id',
        'network_equipment_id',
        'port',
        'secondary_network_equipment_id',
        'secondary_port',
        'device_id',
        'login',
        'password',
        'vlan',
        'ip_address_network',
        'ip_address_device',
    ];

    public function distribution(){
        return $this->belongsTo(Distribution::class);
    }

    public function  networkEquipment(){
        return $this->belongsTo(NetworkEquipment::class);
    }

    public function  secondaryNetworkEquipment(){
        return $this->belongsTo(NetworkEquipment::class, 'secondary_network_equipment_id');
    }

    public function  device(){
        return $this->belongsTo(Device::class);
    }
}
