<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Location extends Model
{
    use HasFactory;
    protected $fillable = [
        'building_id',
        'floor_id',
        'room_id',
        'telecommunication_cabinet_id',
        'locatable_id',
        'locatable_type',
    ];

    public function locatable(): MorphTo
    {
        return $this->morphTo();
    }

    static public function searchIdArray ($arguments, $type, $isNull = [])
    {
        if ($type == 'App\Models\TelecommunicationCabinet') unset($arguments['telecommunication_cabinet_id']); 
        $arguments['locatable_type'] = $type;

        return self::query()->select()->where($arguments)->whereNull($isNull)->pluck('locatable_id')->toArray();
    }

    public function telecommunicationCabinet (){
        return $this->belongsTo(TelecommunicationCabinet::class);
    }

    public function building (){
        return $this->belongsTo(Building::class);
    }

    public function floor (){
        return $this->belongsTo(Floor::class);
    }

    public function room (){
        return $this->belongsTo(Room::class);
    }

}
