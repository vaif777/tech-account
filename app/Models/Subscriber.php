<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;
    protected $fillable = [
        
        'name',
        'department_id',
        'surname',
        'patronymic',
        'phone',
        'second_phone',
    ];

    public function department(){
        return $this->belongsTo(Department::class);
    }
}
