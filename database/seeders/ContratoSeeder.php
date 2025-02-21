<?php

namespace Database\Seeders;

use App\Models\Contrato;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContratoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contrato = new Contrato();
        $contrato->trabajador_id = '1';
        $contrato->user_id = '6';
        $contrato->title = 'el mejor titulo 111';
        $contrato->status = 'pendiente';
        $contrato->start_date = '2024-11-01 10:00:00';
        $contrato->end_date = '2024-11-01 18:00:00';
        $contrato->details = json_encode([
            'aqui'=> 'los detalees'
        ]);
        $contrato->save();

        $contrato = new Contrato();
        $contrato->trabajador_id = '1';
        $contrato->user_id = '6';
        $contrato->title = 'Contrato de fabricacion de juego de dormitorio';
        $contrato->status = 'aceptado';
        $contrato->start_date = '2024-11-01 10:00:00';
        $contrato->end_date = '2024-11-01 18:00:00';
        $contrato->details = json_encode([
            'aqui'=> 'los detalees'
        ]);
        $contrato->save();

        $contrato = new Contrato();
        $contrato->trabajador_id = '1';
        $contrato->user_id = '7';
        $contrato->title = 'el mejor titulo 222';
        $contrato->status = 'aceptado';
        $contrato->start_date = '2024-11-01 10:00:00';
        $contrato->end_date = '2024-11-01 18:00:00';
        $contrato->details = json_encode([
            'aqui'=> 'los detalles222'
        ]);
        $contrato->save();
    }
}
