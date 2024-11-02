<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reseña extends Model
{
    protected $fillable = [
        'contrato_id',
        'comment',
        'recommend',
        'images'
    ];

    public function contrato(){
        return $this->belongsTo(Contrato::class);
    }

    public function calificacion(){
        return $this->hasOne(Calificacion::class);
    }
}
