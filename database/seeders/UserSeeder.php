<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            // 1. Belmonte Muebles
    $user = new User();
    $user->name = 'Jorge';
    $user->lastname = 'Belmonte Vargas';
    $user->email = "jorge.belmonte@gmail.com";
    $user->phone_number = '63439556';
    $user->profile_picture = 'profile_pictures/belmontePerfil.png';
    $user->password = '123456';
    $user->save();

    // 2. Carpintería Vico
    $user = new User();
    $user->name = 'Víctor';
    $user->lastname = 'Ramírez López';
    $user->email = "vico.ramirez@gmail.com";
    $user->phone_number = '70681088';
    $user->profile_picture = 'profile_pictures/perfilVico.jpg';
    $user->password = '123456';
    $user->save();

    // 3. Carpintería Ibarra
    $user = new User();
    $user->name = 'Cristóbal';
    $user->lastname = 'Ibarra Sánchez';
    $user->email = "cristobal.ibarra@gmail.com";
    $user->phone_number = '71462275';
    $user->profile_picture = 'profile_pictures/perfilRepuesto.png';
    $user->password = '123456';
    $user->save();

    // 4. Carpintería J&V
    $user = new User();
    $user->name = 'José';
    $user->lastname = 'Vargas';
    $user->email = "jose.vargas.jv@gmail.com";
    $user->phone_number = '65333877';
    $user->profile_picture = 'profile_pictures/perfilJyV.jpg';
    $user->password = '123456';
    $user->save();

    // 5. Mueblería Chávez
    $user = new User();
    $user->name = 'Saturnino';
    $user->lastname = 'Chávez Fernández';
    $user->email = "saturnino.chavez@gmail.com";
    $user->phone_number = '60450050';
    $user->profile_picture = 'profile_pictures/perfilrepuesto2.png';
    $user->password = '123456';
    $user->save();

    // 6. Tallador en madera
    $user = new User();
    $user->name = 'Ezequiel';
    $user->lastname = 'Rojas Pérez';
    $user->email = "ezequiel.rojas@gmail.com";
    $user->phone_number = '60564060';
    $user->profile_picture = 'profile_pictures/perfilTallador.jpg';
    $user->password = '123456';
    $user->save();

    // 7. BarnizFlash
    $user = new User();
    $user->name = 'Fernando';
    $user->lastname = 'Morales';
    $user->email = "fernando.morales@gmail.com";
    $user->phone_number = '68670070';
    $user->profile_picture = 'profile_pictures/perfilBarnizflash.jpg';
    $user->password = '123456';
    $user->save();

    // 8. MYM Mobiliario
    $user = new User();
    $user->name = 'Marcos';
    $user->lastname = 'Yépez Mendoza';
    $user->email = "mym.mobiliario@gmail.com";
    $user->phone_number = '77931033';
    $user->profile_picture = 'profile_pictures/perfilmobiliario.jpg';
    $user->password = '123456';
    $user->save();

    // 9. Portones de madera (publicidad por su esposa)
    $user = new User();
    $user->name = 'Ana';
    $user->lastname = 'Quispe Cárdenas';
    $user->email = "ana.portones@gmail.com";
    $user->phone_number = '70822424';
    $user->profile_picture = 'profile_pictures/perfilAngelicaSanches.jpg';
    $user->password = '123456';
    $user->save();

    
    //10 juan rosales
    $user = new User();
    $user->name = 'Juan Fernando';
    $user->lastname = 'Rosales Artemar';
    $user->email = "juan@gmail.com";
    $user->phone_number = '60740238';
    $user->profile_picture = 'profile_pictures/perfilPa.png';
    $user->password = '123456';
    $user->save();



        //clientes

    // 11. Daniel Valenzuela
    $user = new User();
    $user->name = 'Daniel';
    $user->lastname = 'Valenzuela';
    $user->email = "daniel.valenzuela@gmail.com";
    $user->phone_number = '70011011';
    $user->profile_picture = 'profile_pictures/clientePerfil1.png';
    $user->password = '123456';
    $user->save();

    // 12. Melvi Cabero
    $user = new User();
    $user->name = 'Melvi';
    $user->lastname = 'Cabero';
    $user->email = "melvi.cabero@gmail.com";
    $user->phone_number = '70112012';
    $user->profile_picture = 'profile_pictures/clientePerfil2.png';
    $user->password = '123456';
    $user->save();

    // 13. Raul Dominguez Lopez
    $user = new User();
    $user->name = 'Raul';
    $user->lastname = 'Dominguez Lopez';
    $user->email = "raul.dominguez@gmail.com";
    $user->phone_number = '70213013';
    $user->profile_picture = 'profile_pictures/clienteperfil3.png';
    $user->password = '123456';
    $user->save();

    // 14. Renato Perez Quisbert
    $user = new User();
    $user->name = 'Renato';
    $user->lastname = 'Perez Quisbert';
    $user->email = "renato.perez@gmail.com";
    $user->phone_number = '70314014';
    $user->profile_picture = 'profile_pictures/clientePerfil4.png';
    $user->password = '123456';
    $user->save();

    // 15. Sonia Sofia Vaca
    $user = new User();
    $user->name = 'Sonia Sofia';
    $user->lastname = 'Vaca';
    $user->email = "sonia.vaca@gmail.com";
    $user->phone_number = '70415015';
    $user->profile_picture = 'profile_pictures/clienteperfil5.png';
    $user->password = '123456';
    $user->save();

    // 16. Edwin Lazcano Justiniano
    $user = new User();
    $user->name = 'Edwin';
    $user->lastname = 'Lazcano Justiniano';
    $user->email = "edwin.lazcano@gmail.com";
    $user->phone_number = '70516016';
    $user->profile_picture = 'profile_pictures/clienteperfil6.png';
    $user->password = '123456';
    $user->save();

    // 17. Felipe Vargas
    $user = new User();
    $user->name = 'Felipe';
    $user->lastname = 'Vargas';
    $user->email = "felipe.vargas@gmail.com";
    $user->phone_number = '70617017';
    $user->profile_picture = 'profile_pictures/clienteperfil7.png';
    $user->password = '123456';
    $user->save();

    // 18. Teodoro Villa
    $user = new User();
    $user->name = 'Teodoro';
    $user->lastname = 'Villa';
    $user->email = "teodoro.villa@gmail.com";
    $user->phone_number = '70718018';
    $user->profile_picture = 'profile_pictures/clientePerfil8.png';
    $user->password = '123456';
    $user->save();

    // 19. Willian Cruz
    $user = new User();
    $user->name = 'Willian';
    $user->lastname = 'Cruz';
    $user->email = "willian.cruz@gmail.com";
    $user->phone_number = '70819019';
    $user->profile_picture = 'profile_pictures/clienteperfil9.png';
    $user->password = '123456';
    $user->save();

    }
}
