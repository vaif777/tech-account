<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferenceNetworkEquipmentPort extends Model
{
    use HasFactory;
    protected $fillable = [
        
        'reference_network_equipment_id',
        'from',
        'before',
        'bandwidth',
        'connection_interfaces',
        'port_functionality',
        'network_architecture_port',
        'power',
    ];
}
