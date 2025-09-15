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
        //reseña 1
        $calificacion = new Calificacion();
        $calificacion->reseña_id = '1';
        $calificacion->time = 2;
        $calificacion->quality = 5;
        $calificacion->communication = 5;
        $calificacion->price = 4;
        $calificacion->final = 4;
         
        $calificacion->save();

        //reseña 2
        $calificacion = new Calificacion();
        $calificacion->reseña_id = '2';
        $calificacion->time = 4;
        $calificacion->quality = 3;
        $calificacion->communication = 4;
        $calificacion->price = 4;
        $calificacion->final = 3.75;
         
        $calificacion->save();

        //reseña 3
        $calificacion = new Calificacion();
        $calificacion->reseña_id = '3';
        $calificacion->time = 5;
        $calificacion->quality = 2;
        $calificacion->communication = 5;
        $calificacion->price = 5;
        $calificacion->final = 4.25;
         
        $calificacion->save();

        //reseña 4
        $calificacion = new Calificacion();
        $calificacion->reseña_id = '4';
        $calificacion->time = 5;
        $calificacion->quality = 4;
        $calificacion->communication = 5;
        $calificacion->price = 5;
        $calificacion->final = 4.75;
         
        $calificacion->save();

        //reseña 5
        $calificacion = new Calificacion();
        $calificacion->reseña_id = '5';
        $calificacion->time = 5;
        $calificacion->quality = 2;
        $calificacion->communication = 5;
        $calificacion->price = 5;
        $calificacion->final = 4.25;
         
        $calificacion->save();
        
        //reseña 6
        $calificacion = new Calificacion();
        $calificacion->reseña_id = '6';
        $calificacion->time = 5;
        $calificacion->quality = 5;
        $calificacion->communication = 1;
        $calificacion->price = 5;
        $calificacion->final = 4;
         
        $calificacion->save();

        //reseña 7
        $calificacion = new Calificacion();
        $calificacion->reseña_id = '7';
        $calificacion->time = 3;
        $calificacion->quality = 5;
        $calificacion->communication = 5;
        $calificacion->price = 3;
        $calificacion->final = 4;
         
        $calificacion->save();

        //reseña 8
        $calificacion = new Calificacion();
        $calificacion->reseña_id = '8';
        $calificacion->time = 1;
        $calificacion->quality = 5;
        $calificacion->communication = 3;
        $calificacion->price = 4;
        $calificacion->final = 3.25;
         
        $calificacion->save();

        //reseña 9
        $calificacion = new Calificacion();
        $calificacion->reseña_id = '9';
        $calificacion->time = 5;
        $calificacion->quality = 5;
        $calificacion->communication = 5;
        $calificacion->price = 5;
        $calificacion->final = 5;
         
        $calificacion->save();

        //reseña 10
        $calificacion = new Calificacion();
        $calificacion->reseña_id = '10';
        $calificacion->time = 5;
        $calificacion->quality = 5;
        $calificacion->communication = 5;
        $calificacion->price = 3;
        $calificacion->final = 4.5;
         
        $calificacion->save();

        //reseña 11
        $calificacion = new Calificacion();
        $calificacion->reseña_id = '11';
        $calificacion->time = 5;
        $calificacion->quality = 5;
        $calificacion->communication = 5;
        $calificacion->price = 5;
        $calificacion->final = 5;
         
        $calificacion->save();

        //reseña 12
        $calificacion = new Calificacion();
        $calificacion->reseña_id = '12';
        $calificacion->time = 5;
        $calificacion->quality = 5;
        $calificacion->communication = 5;
        $calificacion->price = 3;
        $calificacion->final = 4.5;
         
        $calificacion->save();

        //reseña 13
        $calificacion = new Calificacion();
        $calificacion->reseña_id = '13';
        $calificacion->time = 5;
        $calificacion->quality = 5;
        $calificacion->communication = 5;
        $calificacion->price = 4;
        $calificacion->final = 4.75;
         
        $calificacion->save();

        //reseña 14
        $calificacion = new Calificacion();
        $calificacion->reseña_id = '14';
        $calificacion->time = 5;
        $calificacion->quality = 4;
        $calificacion->communication = 5;
        $calificacion->price = 4;
        $calificacion->final = 4.5;
         
        $calificacion->save();

        //reseña 15
        $calificacion = new Calificacion();
        $calificacion->reseña_id = '15';
        $calificacion->time = 5;
        $calificacion->quality = 5;
        $calificacion->communication = 5;
        $calificacion->price = 5;
        $calificacion->final = 5;
         
        $calificacion->save();
    }
}
