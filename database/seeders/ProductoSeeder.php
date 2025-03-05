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
        $product = new Producto();
        $product->trabajador_id = '1';
        $product->name = 'casa perro';
        $product->stock = 2;
        $product-> price = 400;
        $product->image = 'products/product1.jpg';
        $product->save();

        $product = new Producto();
        $product->trabajador_id = '1';
        $product->name = 'porta celular';
        $product->stock = 10;
        $product-> price = 35;
        $product->image = 'products/product2.jpg';
        $product->save();

        $product = new Producto();
        $product->trabajador_id = '1';
        $product->name = 'vinera';
        $product->stock = 20;
        $product-> price = 129;
        $product->image = 'products/product3.jpg';
        $product->save();

        $product = new Producto();
        $product->trabajador_id = '1';
        $product->name = 'Porta Retratos';
        $product->stock = 8;
        $product-> price = 30;
        $product->image = 'products/product4.jpg';
        $product->save();
    }
}
