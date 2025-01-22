<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'trabajador_id',
        'name',
        'stock',
        'price',
        'image'
    ];

    public function trabajador(){
        return $this->belongsTo(Trabajador::class);
    }
}
