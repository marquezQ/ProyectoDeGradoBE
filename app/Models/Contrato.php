<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    protected $fillable = [
        'trabajador_id',
        'user_id',
        'start_date',
        'end_date',
        'details',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function trabajador(){
        return $this->belongsTo(Trabajador::class);
    }

    public function reseña(){
        return $this->hasOne(Reseña::class);
    }
}
