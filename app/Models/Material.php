<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;
    protected $fillable = [
        'materials_references_id',
        'manufacturer_id',
        'model_id',
        'width',
        'height',
        'depth',
        'diameter',
        'total_length',
        'count_ports',
        'amount_in_package',
        'count_package',
        'diameter',
    ];


}
