<?php

namespace Database\Seeders;

use App\Models\Calificacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CalificacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $calificacion = new Calificacion();
        $calificacion->reseña_id = '1';
        $calificacion->time = 2;
        $calificacion->quality = 2;
        $calificacion->communication = 2;
        $calificacion->price = 2;
        $calificacion->final = 5.0;
         
        $calificacion->save();

        $calificacion = new Calificacion();
        $calificacion->reseña_id = '2';
        $calificacion->time = 5;
        $calificacion->quality = 5;
        $calificacion->communication = 5;
        $calificacion->price = 1;
        $calificacion->final = 2.5;
         
        $calificacion->save();
    }
}
