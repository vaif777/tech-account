<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function Building(){
        return $this->belongsTo(Building::class);
    }

    public function floor(){
        return $this->belongsTo(Floor::class);
    }

    public function room(){
        return $this->belongsTo(Room::class);
    }
    
}