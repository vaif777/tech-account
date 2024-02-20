<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class TelecommunicationCabinet extends Model
{
    use HasFactory;
    protected $fillable = [
        'building_id',
        'floor_id',
        'room_id',
        'storeroom_accounting_id',
        'manufacturer_id',
        'model_id',
        'width',
        'height',
        'depth',
        'unit',
        'name',
    ];

    public function location(): MorphOne
    {
        return $this->morphOne(Location::class, 'locatable');
    }

    public function patchPanelsNames (){
        
        $patchPanelIdArray = Location::query()->select()->where(['telecommunication_cabinet_id' => $this->id, 'locatable_type' => 'App\Models\PatchPanel'])->pluck('locatable_id')->toArray();

        return implode(', ', PatchPanel::query()->select()->whereIn('id',  $patchPanelIdArray)->pluck('name')->toArray());
    }

    public function networkEquipmentNames (){
        
        $networkEquipmentIdArray = Location::query()->select()->where(['telecommunication_cabinet_id' => $this->id, 'locatable_type' => 'App\Models\NetworkEquipment'])->pluck('locatable_id')->toArray();

        return implode(', ', NetworkEquipment::query()->select()->whereIn('id',  $networkEquipmentIdArray)->pluck('name')->toArray());
    }   
}