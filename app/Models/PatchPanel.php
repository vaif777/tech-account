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

    public function telecommunication_cabinet(){

        return $this->belongsTo(TelecommunicationCabinet::class);
    }
    
    public function building(){

        return $this->belongsTo(Building::class);
    }

    public function location(): MorphOne
    {
        return $this->morphOne(Location::class, 'locatable');
    }

    public function floorName(){

        if ($this->telecommunication_cabinet->floor_id)
            return $this->telecommunication_cabinet->floor->name;
    }

    public function roomName(){

        if ($this->telecommunication_cabinet->room_id)
            return $this->telecommunication_cabinet->room->name;
    }

    public function patchPanelPorts (){

        return $this->hasMany(PatchPanelPort::class);
    }

    static public function filterPatchPanel($arguments){

        $telecomCabinets = TelecommunicationCabinet::query()->select()->where($arguments)->get();
        $res = [];

       foreach($telecomCabinets as $cabinet) {
        
            $cabinet->patchPanels()->select('id', 'name')->first() ? $res[] = $cabinet->patchPanels()->select('id', 'name')->first() : '' ;
       }

       return collect($res);
    }
    
}
