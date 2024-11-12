<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trabajador extends Model
{
    protected $fillable = [
        'user_id',
        'description',
        'latitud',
        'longitud',
        'images'
    ];

    //relacion inversa a partir de un trabajador conseguir sus datos de usuario
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function contratos(){
        return $this->hasMany(Contrato::class);
    }

    public function productos(){
        return $this->hasMany(Producto::class);
    }
}
