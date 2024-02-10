<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'add',
        'edit',
        'delete',
        'to_activate',
        'network_infrastructure',
        'telephone_infrastructure',
        'storage',
        'reference',
        'facilities',
        'user',
        'setting',
    ];
}
