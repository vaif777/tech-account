<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Device extends Model
{
    use HasFactory;
    protected $fillable = [
        
        'name',
        'subscriber_id',
        'reference_device_id',
        'name',
        'mac_address',
    ];

    public function location(): MorphOne
    {
        return $this->morphOne(Location::class, 'locatable');
    }

    public function referenceDevice(){
        return $this->belongsTo(ReferenceDevice::class);
    }

    public function subscriber(){
        return $this->belongsTo(Subscriber::class);
    }
}
