<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'building_id',
    ];

    public function rooms (){
        return $this->hasMany(Room::class);
    }

    public function building(){
        return $this->belongsTo(Building::class);
    }

    public function cabinets (){
        return $this->hasMany(TelecommunicationCabinet::class);
    }
}
