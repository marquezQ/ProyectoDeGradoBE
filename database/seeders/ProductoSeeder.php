<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //vico carp2
        $product = new Producto();
        $product->trabajador_id = '2';
        $product->name = 'Puerta Madera Roble';
        $product->stock = 1;
        $product-> price = 1400;
        $product->image = 'products/product_carp2_1.jpg';
        $product->save();

        $product = new Producto();
        $product->trabajador_id = '2';
        $product->name = 'Separador de cubiertos';
        $product->stock = 10;
        $product-> price = 50;
        $product->image = 'products/product_carp2_2.jpg';
        $product->save();

        $product = new Producto();
        $product->trabajador_id = '2';
        $product->name = 'Velador Rebarnizado';
        $product->stock = 1;
        $product-> price = 250;
        $product->image = 'products/product_carp2_3.jpg';
        $product->save();

        $product = new Producto();
        $product->trabajador_id = '2';
        $product->name = 'Mesa Clasica';
        $product->stock = 1;
        $product-> price = 300;
        $product->image = 'products/product_carp2_4.jpg';
        $product->save();

        $product = new Producto();
        $product->trabajador_id = '2';
        $product->name = 'Par de veladores 3 espacios';
        $product->stock = 2;
        $product-> price = 600;
        $product->image = 'products/product_carp2_5.jpg';
        $product->save();

        //ibarra carp3
        $product = new Producto();
        $product->trabajador_id = '3';
        $product->name = 'Cuna de madera mara';
        $product->stock = 1;
        $product-> price = 600;
        $product->image = 'products/product_carp3_1.jpg';
        $product->save();
        
        $product = new Producto();
        $product->trabajador_id = '3';
        $product->name = 'Aparador para Gatos';
        $product->stock = 1;
        $product-> price = 250;
        $product->image = 'products/product_carp3_2.jpg';
        $product->save();

        $product = new Producto();
        $product->trabajador_id = '3';
        $product->name = 'Fresadora para moldura';
        $product->stock = 5;
        $product-> price = 300;
        $product->image = 'products/product_carp3_3.jpg';
        $product->save();

        $product = new Producto();
        $product->trabajador_id = '3';
        $product->name = 'Guarda Cubiertos';
        $product->stock = 2;
        $product-> price = 400;
        $product->image = 'products/product_carp3_4.jpg';
        $product->save();

        $product = new Producto();
        $product->trabajador_id = '3';
        $product->name = 'Banco rebarnizado';
        $product->stock = 1;
        $product-> price = 400;
        $product->image = 'products/product_carp3_5.jpg';
        $product->save();

        $product = new Producto();
        $product->trabajador_id = '3';
        $product->name = 'Mini Mesa + 3 asientos';
        $product->stock = 1;
        $product-> price = 600;
        $product->image = 'products/product_carp3_6.jpg';
        $product->save();

        //carpinteria jyb carp4
        $product = new Producto();
        $product->trabajador_id = '4';
        $product->name = 'Puerta madera blanca 82.5 x 210';
        $product->stock = 1;
        $product-> price = 700;
        $product->image = 'products/product_carp4_1.jpg';
        $product->save();

        $product = new Producto();
        $product->trabajador_id = '4';
        $product->name = 'Puerta mara macho + vidrio 82.5 x 210';
        $product->stock = 1;
        $product-> price = 1000;
        $product->image = 'products/product_carp4_2.jpg';
        $product->save();

        $product = new Producto();
        $product->trabajador_id = '4';
        $product->name = 'Puerta mara macho 82.5 x 210';
        $product->stock = 1;
        $product-> price = 900;
        $product->image = 'products/product_carp4_3.jpg';
        $product->save();


        //saturnino carp 5

        $product = new Producto();
        $product->trabajador_id = '5';
        $product->name = 'Escritorio en esquina';
        $product->stock = 1;
        $product-> price = 1900;
        $product->image = 'products/product_carp5_1.jpg';
        $product->save();
        
        $product = new Producto();
        $product->trabajador_id = '5';
        $product->name = 'Estractor de cocina GenLux';
        $product->stock = 1;
        $product-> price = 1900;
        $product->image = 'products/product_carp5_2.jpg';
        $product->save();


        //mobiliario mym carp8
        $product = new Producto();
        $product->trabajador_id = '8';
        $product->name = 'Velador en melamina';
        $product->stock = 1;
        $product-> price = 250;
        $product->image = 'products/product_carp8_1.jpg';
        $product->save();

        $product = new Producto();
        $product->trabajador_id = '8';
        $product->name = 'Tocador en melamina';
        $product->stock = 1;
        $product-> price = 500;
        $product->image = 'products/product_carp8_2.jpg';
        $product->save();
        

        //angelica sanches  carp9
        $product = new Producto();
        $product->trabajador_id = '9';
        $product->name = 'Accesorio para porton';
        $product->stock = 1;
        $product-> price = 700;
        $product->image = 'products/product_carp9_1.jpg';
        $product->save();

        $product = new Producto();
        $product->trabajador_id = '9';
        $product->name = 'Configuracion de accesorio';
        $product->stock = 1;
        $product-> price = 700;
        $product->image = 'products/product_carp9_2.jpg';
        $product->save();

        //juan rosales carp10
        $product = new Producto();
        $product->trabajador_id = '10';
        $product->name = 'Soporte para Celular';
        $product->stock = 1;
        $product-> price = 90;
        $product->image = 'products/productPa1.jpg';
        $product->save();

        $product = new Producto();
        $product->trabajador_id = '10';
        $product->name = 'Mueble para vinos';
        $product->stock = 1;
        $product-> price = 1100;
        $product->image = 'products/productPa2.jpg';
        $product->save();

        $product = new Producto();
        $product->trabajador_id = '10';
        $product->name = 'Sauna personal';
        $product->stock = 1;
        $product-> price = 3500;
        $product->image = 'products/productPa3.jpg';
        $product->save();

        $product = new Producto();
        $product->trabajador_id = '10';
        $product->name = 'Porta Vino de mesa';
        $product->stock = 8;
        $product-> price = 150;
        $product->image = 'products/productPa4.png';
        $product->save();

        $product = new Producto();
        $product->trabajador_id = '10';
        $product->name = 'Cama 2 plazas';
        $product->stock = 1;
        $product-> price = 2900;
        $product->image = 'products/productPa5.jpg';
        $product->save();
    }
}
