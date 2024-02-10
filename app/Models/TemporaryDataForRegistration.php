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
        'delete',
        'activated',
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
