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
        // contrato 1 carp1
        $contrato = new Contrato();
        $contrato->trabajador_id = '1';
        $contrato->user_id = '12';
        $contrato->title = 'Cocina en Melamina';
        $contrato->status = 'finalizado';
        $contrato->start_date = '2025-01-30 10:00:00';
        $contrato->end_date = '2025-04-01 18:00:00';
        $contrato->details = json_encode([
            'aqui'=> 'los detalees'
        ]);
        $contrato->save();

        //contrato 2 carp1
        $contrato = new Contrato();
        $contrato->trabajador_id = '1';
        $contrato->user_id = '11';
        $contrato->title = 'Ropero de melamina, vestidor y mesas';
        $contrato->status = 'finalizado';
        $contrato->start_date = '2025-04-03 10:00:00';
        $contrato->end_date = '2025-06-29 18:00:00';
        $contrato->details = json_encode([
            'aqui'=> 'los detalees'
        ]);
        $contrato->save();

        //contrato3 carp2
        $contrato = new Contrato();
        $contrato->trabajador_id = '2';
        $contrato->user_id = '14';
        $contrato->title = 'Roperos en madera';
        $contrato->status = 'finalizado';
        $contrato->start_date = '2025-01-30 10:00:00';
        $contrato->end_date = '2024-04-01 18:00:00';
        $contrato->details = json_encode([
            'aqui'=> 'los detalees'
        ]);
        $contrato->save();

        //contrato 4 carp2 
        $contrato = new Contrato();
        $contrato->trabajador_id = '2';
        $contrato->user_id = '15';
        $contrato->title = 'Cajoneria cocina en madera';
        $contrato->status = 'finalizado';
        $contrato->start_date = '2025-02-20 10:00:00';
        $contrato->end_date = '2024-05-01 18:00:00';
        $contrato->details = json_encode([
            'aqui'=> 'los detalees'
        ]);
        $contrato->save();

        //contrato 5 carp2
        $contrato = new Contrato();
        $contrato->trabajador_id = '2';
        $contrato->user_id = '18';
        $contrato->title = 'Cajoneria cocina en melamina';
        $contrato->status = 'finalizado';
        $contrato->start_date = '2025-04-05 10:00:00';
        $contrato->end_date = '2024-06-08 18:00:00';
        $contrato->details = json_encode([
            'aqui'=> 'los detalees'
        ]);
        $contrato->save();

        //contrato 6 carp 5
        $contrato = new Contrato();
        $contrato->trabajador_id = '5';
        $contrato->user_id = '19';
        $contrato->title = 'Cajoneria alta y baja';
        $contrato->status = 'finalizado';
        $contrato->start_date = '2025-04-05 10:00:00';
        $contrato->end_date = '2024-06-08 18:00:00';
        $contrato->details = json_encode([
            'aqui'=> 'los detalees'
        ]);
        $contrato->save();

        //contrato 7 carp 6
        $contrato = new Contrato();
        $contrato->trabajador_id = '6';
        $contrato->user_id = '14';
        $contrato->title = 'Marco tallado clasico en madera';
        $contrato->status = 'finalizado';
        $contrato->start_date = '2025-04-05 10:00:00';
        $contrato->end_date = '2024-06-08 18:00:00';
        $contrato->details = json_encode([
            'aqui'=> 'los detalees'
        ]);
        $contrato->save();

        //contrato 8 carp 7
        $contrato = new Contrato();
        $contrato->trabajador_id = '7';
        $contrato->user_id = '17';
        $contrato->title = 'Rebarnizado de porton y grada';
        $contrato->status = 'finalizado';
        $contrato->start_date = '2025-04-05 10:00:00';
        $contrato->end_date = '2024-06-08 18:00:00';
        $contrato->details = json_encode([
            'aqui'=> 'los detalees'
        ]);
        $contrato->save();

        //juan rosales
        //contrato 9 carp 10
        $contrato = new Contrato();
        $contrato->trabajador_id = '10';
        $contrato->user_id = '11';
        $contrato->title = 'Vitrina y cama portable';
        $contrato->status = 'finalizado';
        $contrato->start_date = '2024-01-05 10:00:00';
        $contrato->end_date = '2024-03-30 18:00:00';
        $contrato->details = json_encode([
            'aqui'=> 'los detalees'
        ]);
        $contrato->save();

        //contrato 10 carp 10
        $contrato = new Contrato();
        $contrato->trabajador_id = '10';
        $contrato->user_id = '12';
        $contrato->title = 'Puerta y porton principal';
        $contrato->status = 'finalizado';
        $contrato->start_date = '2024-04-05 10:00:00';
        $contrato->end_date = '2024-06-30 18:00:00';
        $contrato->details = json_encode([
            'aqui'=> 'los detalees'
        ]);
        $contrato->save();

        //contrato 11 carp 10
        $contrato = new Contrato();
        $contrato->trabajador_id = '10';
        $contrato->user_id = '13';
        $contrato->title = 'Juego de dormitorio completo';
        $contrato->status = 'finalizado';
        $contrato->start_date = '2023-04-05 10:00:00';
        $contrato->end_date = '2023-06-30 18:00:00';
        $contrato->details = json_encode([
            'aqui'=> 'los detalees'
        ]);
        $contrato->save();

        //contrato 12 carp 10
        $contrato = new Contrato();
        $contrato->trabajador_id = '10';
        $contrato->user_id = '14';
        $contrato->title = 'Muro de tablones decorativo';
        $contrato->status = 'finalizado';
        $contrato->start_date = '2024-06-05 10:00:00';
        $contrato->end_date = '2024-07-30 18:00:00';
        $contrato->details = json_encode([
            'aqui'=> 'los detalees'
        ]);
        $contrato->save();

        //contrato 13 carp 10
        $contrato = new Contrato();
        $contrato->trabajador_id = '10';
        $contrato->user_id = '15';
        $contrato->title = 'Escritorios en esquina';
        $contrato->status = 'finalizado';
        $contrato->start_date = '2024-07-05 10:00:00';
        $contrato->end_date = '2024-08-30 18:00:00';
        $contrato->details = json_encode([
            'aqui'=> 'los detalees'
        ]);
        $contrato->save();

        //contrato 14 carp 10
        $contrato = new Contrato();
        $contrato->trabajador_id = '10';
        $contrato->user_id = '16';
        $contrato->title = 'Pasamanos de madera';
        $contrato->status = 'finalizado';
        $contrato->start_date = '2024-08-05 10:00:00';
        $contrato->end_date = '2024-09-30 18:00:00';
        $contrato->details = json_encode([
            'aqui'=> 'los detalees'
        ]);
        $contrato->save();

        //contrato 15 carp 10
        $contrato = new Contrato();
        $contrato->trabajador_id = '10';
        $contrato->user_id = '17';
        $contrato->title = 'Cajoneria de Cocina completa mas meson en marmol sintetico';
        $contrato->status = 'finalizado';
        $contrato->start_date = '2024-09-05 10:00:00';
        $contrato->end_date = '2024-10-30 18:00:00';
        $contrato->details = json_encode([
            'aqui'=> 'los detalees'
        ]);
        $contrato->save();
    }
}