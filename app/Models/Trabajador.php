<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trabajador extends Model
{
    protected $fillable = [
        'user_id',
        'latitud',
        'longitud',
        'images'
    ];
}
