<?php

namespace Database\Seeders;

use App\Models\Trabajador;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrabajadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $trabajador = new Trabajador();
        $trabajador->user_id = '1';
        $trabajador->description = 'Carpintero hábil y apasionado con más de 10 años de experiencia en construcción residencial y comercial. Reputación positiva por la calidad del trabajo, la puntualidad en la construcción y los proyectos finalizados en su presupuesto o por debajo. Excelente capacidad para comunicarse con los clientes y hacer que sus visiones y sueños cobren vida.';
        $trabajador->latitud = '-17.378765';
        $trabajador->longitud = '-66.142292';
        $trabajador->images = json_encode([
            "image1" => "imagesTrabajador/carp1_1.jpg",
            "image2" => "imagesTrabajador/carp1_2.jpg",
            "image3" => "imagesTrabajador/carp1_3.jpg",
        ]);
        $trabajador->save();

        $trabajador = new Trabajador();
        $trabajador->user_id = '2';
        $trabajador->description = 'Carpintero hábil y apasionado con más de 10 años de experiencia en construcción residencial y comercial. Reputación positiva por la calidad del trabajo, la puntualidad en la construcción y los proyectos finalizados en su presupuesto o por debajo. Excelente capacidad para comunicarse con los clientes y hacer que sus visiones y sueños cobren vida.';
        $trabajador->latitud = '-17.378765';
        $trabajador->longitud = '-66.142292';
        $trabajador->images = json_encode([
            "image1" => "imagesTrabajador/carp2_1.jpg",
            "image2" => "imagesTrabajador/carp2_2.jpg",
            "image3" => "imagesTrabajador/carp2_3.jpg",
        ]);
        $trabajador->save();

        $trabajador = new Trabajador();
        $trabajador->user_id = '3';
        $trabajador->description = 'Carpintero hábil y apasionado con más de 10 años de experiencia en construcción residencial y comercial. Reputación positiva por la calidad del trabajo, la puntualidad en la construcción y los proyectos finalizados en su presupuesto o por debajo. Excelente capacidad para comunicarse con los clientes y hacer que sus visiones y sueños cobren vida.';
        $trabajador->latitud = '-17.378765';
        $trabajador->longitud = '-66.142292';
        $trabajador->images = json_encode([
            "image1" => "imagesTrabajador/carp3_1.jpg",
            "image2" => "imagesTrabajador/carp3_2.jpg",
            "image3" => "imagesTrabajador/carp3_2.jpg",
        ]);
        $trabajador->save();

        $trabajador = new Trabajador();
        $trabajador->user_id = '4';
        $trabajador->description = 'Carpintero hábil y apasionado con más de 10 años de experiencia en construcción residencial y comercial. Reputación positiva por la calidad del trabajo, la puntualidad en la construcción y los proyectos finalizados en su presupuesto o por debajo. Excelente capacidad para comunicarse con los clientes y hacer que sus visiones y sueños cobren vida.';
        $trabajador->latitud = '-17.378765';
        $trabajador->longitud = '-66.142292';
        $trabajador->images = json_encode([
            "image1" => "imagesTrabajador/carp4_1.jpg",
            "image2" => "imagesTrabajador/carp4_2.jpg",
            "image3" => "imagesTrabajador/carp4_3.jpg",
        ]);
        $trabajador->save();
    
        $trabajador = new Trabajador();
        $trabajador->user_id = '5';
        $trabajador->description = 'Carpintero hábil y apasionado con más de 10 años de experiencia en construcción residencial y comercial. Reputación positiva por la calidad del trabajo, la puntualidad en la construcción y los proyectos finalizados en su presupuesto o por debajo. Excelente capacidad para comunicarse con los clientes y hacer que sus visiones y sueños cobren vida.';
        $trabajador->latitud = '-17.378765';
        $trabajador->longitud = '-66.142292';
        $trabajador->images = json_encode([
            "image1" => "imagesTrabajador/carp5_1.jpg",
            "image2" => "imagesTrabajador/carp5_2.jpg",
            "image3" => "imagesTrabajador/carp5_3.jpg",
        ]);
        $trabajador->save();
    }
}
