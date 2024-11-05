<?php

namespace Database\Seeders;

use App\Models\Reseña;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReseniaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reseña = new Reseña();
        $reseña->contrato_id = '1';
        $reseña->comment = 'Buena atencion...bla bla bla';
        $reseña->recommend = true;
        $reseña->images = json_encode([
            "image1" => "imagesTrabajador/carp3_1.jpg",
            "image2" => "imagesTrabajador/carp3_2.jpg",
            "image3" => "imagesTrabajador/carp3_2.jpg",
        ]);
        $reseña->save();
    }
}
