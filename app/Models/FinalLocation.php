<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class FinalLocation extends Model
{
    use HasFactory;
    protected $fillable = [
        'final_building_id',
        'final_floor_id',
        'final_room_id',
        'final_telecommunication_cabinet_id',
        'locatable_id',
        'locatable_type',
    ];

    public function locatable(): MorphTo
    {
        return $this->morphTo();
    }

    static public function searchIdArray ($arguments, $type)
    {
        if ($type == 'App\Models\TelecommunicationCabinet') unset($arguments['telecommunication_cabinet_id']); 
        $arguments['locatable_type'] = $type;

        return self::query()->select()->where($arguments)->pluck('locatable_id')->toArray();
    }

    public function telecommunicationCabinet (){
        return $this->belongsTo(TelecommunicationCabinet::class, 'final_telecommunication_cabinet_id');
    }

    public function building (){
        return $this->belongsTo(Building::class, 'final_building_id');
    }

    public function floor (){
        return $this->belongsTo(Floor::class, 'final_floor_id');
    }

    public function room (){
        return $this->belongsTo(Room::class, 'final_room_id');
    }
}
 