<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;
    protected $fillable = [
        'open_registration',
        'mass_addition_by_mail',
        'confirm_each_new_registered_user',
    ];
}
