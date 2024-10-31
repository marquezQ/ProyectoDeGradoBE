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
        $trabajador->latitud = '-17.378765';
        $trabajador->longitud = '-66.142292';
        $trabajador->images = json_encode([
            "image1" => "path1",
            "image2" => "path2",
            "image3" => "path3",
        ]);
        $trabajador->save();

        $trabajador = new Trabajador();
        $trabajador->user_id = '2';
        $trabajador->latitud = '-17.378765';
        $trabajador->longitud = '-66.142292';
        $trabajador->images = json_encode([
            "image1" => "path1",
            "image2" => "path2",
            "image3" => "path3",
        ]);
        $trabajador->save();

        $trabajador = new Trabajador();
        $trabajador->user_id = '3';
        $trabajador->latitud = '-17.378765';
        $trabajador->longitud = '-66.142292';
        $trabajador->images = json_encode([
            "image1" => "path1",
            "image2" => "path2",
            "image3" => "path3",
        ]);
        $trabajador->save();

    }
}
