<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    protected $fillable = [
        'reseña_id',
        'time',
        'quality',
        'communication',
        'price',
        'final'
    ];

    public function reseña(){
        return $this->belongsTo(Reseña::class);
    }
}
