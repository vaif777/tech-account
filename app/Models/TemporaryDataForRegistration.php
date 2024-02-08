<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemporaryDataForRegistration extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'add',
        'edit',
        'delite',
        'activated',
        'activated_user',
        'SCS',
        'telephony',
        'storage',
        'common_elements',
        'users',
        'settings',
    ];
}
