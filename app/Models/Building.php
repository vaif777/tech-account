<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
    ];

    public function floors (){
        return $this->hasMany(Floor::class);
    }

    public function cabinets (){
        return $this->hasMany(TelecommunicationCabinet::class);
    }

    public function patchPanels (){
        return $this->hasMany(PatchPanel::class);
    }
}
