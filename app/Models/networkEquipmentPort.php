<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class networkEquipmentPort extends Model
{
    use HasFactory;
    protected $fillable = [
        
        'number',
        'network_equipment_id',
        'bandwidth',
        'connection_interfaces',
        'port_functionality',
        'network_architecture_port',
        'power',
    ];
}
