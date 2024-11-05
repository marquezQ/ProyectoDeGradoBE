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
        $user = new User();

        $user->name = 'Juan';
        $user->lastname = 'Marquez';
        $user->email = "juan@gmail.com";
        $user->phone_number = '60606060';
        $user->profile_picture = 'profile_pictures/foto1.jpeg';
        $user->password = '123456';
        $user->save();

        $user = new User();

        $user->name = 'Pablo';
        $user->lastname = 'Perez';
        $user->email = "pablo@gmail.com";
        $user->phone_number = '67676767';
        $user->profile_picture = 'profile_pictures/foto2.jpeg';
        $user->password = '123456';
        $user->save();

        $user = new User();

        $user->name = 'Diego';
        $user->lastname = 'Martinez';
        $user->email = "diego@gmail.com";
        $user->phone_number = '61616161';
        $user->profile_picture = 'profile_pictures/foto3.jpeg';
        $user->password = '123456';
        $user->save();

        $user = new User();

        $user->name = 'Jonas';
        $user->lastname = 'Alcocer';
        $user->email = "jonas@gmail.com";
        $user->phone_number = '69758696';
        $user->profile_picture = 'profile_pictures/foto4.jpeg';
        $user->password = '123456';
        $user->save();

        $user = new User();

        $user->name = 'Richar';
        $user->lastname = 'mago';
        $user->email = "mago@gmail.com";
        $user->phone_number = '61234567';
        $user->profile_picture = 'profile_pictures/foto5.jpeg';
        $user->password = '123456';
        $user->save();

        $user = new User();

        $user->name = 'Cliente';
        $user->lastname = 'uno';
        $user->email = "clienteuno@gmail.com";
        $user->phone_number = '67456123';
        $user->profile_picture = 'aqui el path de su imagen';
        $user->password = '123456';
        $user->save();
        
        $user = new User();
        $user->name = 'Cliente';
        $user->lastname = 'dos';
        $user->email = "clientedos@gmail.com";
        $user->phone_number = '694958863';
        $user->profile_picture = 'aqui el path de su imagen';
        $user->password = '123456';
        $user->save();

        $user = new User();
        $user->name = 'Cliente';
        $user->lastname = 'tres';
        $user->email = "clientetres@gmail.com";
        $user->phone_number = '69558863';
        $user->profile_picture = 'aqui el path de su imagen';
        $user->password = '123456';
        $user->save();

    }
}
