<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function telecommunication_cabinet(){
        return $this->belongsTo(TelecommunicationCabinet::class);
    }
    
    public function building(){
        return $this->belongsTo(Building::class);
    }

    public function floorName(){
        return $this->telecommunication_cabinet->floor->name;
    }

    public function roomName(){
        return $this->telecommunication_cabinet->room->name;
    }

    public function PatchPanelPorts (){
        return $this->hasMany(PatchPanelPort::class);
    }
    
}
