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
        'delite',
        'SCS',
        'telephony',
        'storage',
        'common_elements',
        'users',
        'settings',
    ];
}
