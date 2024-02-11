<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'floor_id',
    ];

    public function floor(){
        return $this->belongsTo(Floor::class);
    }

    public function cabinets (){
        return $this->hasMany(TelecommunicationCabinet::class);
    }
}
