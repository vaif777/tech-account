<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Distribution extends Model
{
    use HasFactory;

    protected $fillable = [
        'patch_panel_id',
        'patch_panel_port',
        'final_patch_panel_id',
        'final_patch_panel_port',
        'patch_cord_number',
    ];


    public function location(): MorphOne
    {
        return $this->morphOne(Location::class, 'locatable');
    }

    public function finalLocation(): MorphOne
    {
        return $this->morphOne(FinalLocation::class, 'locatable');
    }

    public function PatchPanel(){
        return $this->belongsTo(PatchPanel::class);
    }

    public function finalPatchPanel(){
        return $this->belongsTo(PatchPanel::class, 'final_patch_panel_id',);
    }

}
