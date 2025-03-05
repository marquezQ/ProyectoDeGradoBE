<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trabajador extends Model
{
    protected $fillable = [
        'user_id',
        'description',
        'workshop',
        'latitud',
        'longitud',
        'address',
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

    public function reseñas()
    {
        return $this->hasManyThrough(
            Reseña::class,   // Modelo final al que queremos llegar (reseñas)
            Contrato::class, // Modelo intermedio (contratos)
            'trabajador_id', // Clave foránea en la tabla intermedia (contratos) que apunta a trabajadors
            'contrato_id',   // Clave foránea en la tabla destino (reseñas) que apunta a contratos
            'id',            // Clave primaria en la tabla origen (trabajadors)
            'id'             // Clave primaria en la tabla intermedia (contratos)
        )->with(['calificacion', 'contrato.user']);
    }
}
