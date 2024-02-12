<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatchPanelPort extends Model
{
    use HasFactory;
    protected $fillable = [
        'number',
        'patch_panel_id',
    ];
}
