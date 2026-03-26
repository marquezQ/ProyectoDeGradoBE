<?php

namespace App\Services;

use App\Models\Producto;
use App\Models\Trabajador;
use Illuminate\Support\Facades\Storage;

class ProductoService
{
    /**
     * Obtener todos los productos.
     */
    public function getAllProducts()
    {
        return Producto::all();
    }

    /**
     * Obtener productos de un trabajador por su ID y transformar las imágenes.
     */
    public function getProductsByTrabajador($id)
    {
        $trabajador = Trabajador::find($id);

        if (!$trabajador) {
            return null; // Retornamos null para que el controlador decida qué error devolver
        }

        $productos = $trabajador->productos;

        $productos->transform(function ($producto) {
            if ($producto->image) {
                $producto->image = asset(Storage::url($producto->image));
            }
            return $producto;
        });

        return $productos;
    }

    /**
     * Crear un nuevo producto y guardar su imagen si viene incluida.
     */
    public function createProduct(array $data, $imageFile = null)
    {
        $filePath = '';
        if ($imageFile) {
            $filePath = $imageFile->store('products', 'public');
        }

        return Producto::create([
            'trabajador_id' => $data['trabajador_id'],
            'name' => $data['name'],
            'stock' => $data['stock'],
            'price' => $data['price'],
            'image' => $filePath
        ]);
    }

    /**
     * Actualizar un producto existente y reemplazar su imagen si aplica.
     */
    public function updateProduct($id, array $data, $imageFile = null)
    {
        $product = Producto::find($id);

        if (!$product) {
            return null;
        }

        $product->trabajador_id = $data['trabajador_id'];
        $product->name = $data['name'];
        $product->stock = $data['stock'];
        $product->price = $data['price'];

        // Solo reemplazamos imagen si se proporcionó una nueva
        if ($imageFile) {
            // Eliminar la imagen anterior si existe en el Storage
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            // Guardar la nueva
            $product->image = $imageFile->store('products', 'public');
        }

        $product->save();

        return $product;
    }

    /**
     * Eliminar producto y su imagen asociada del disco.
     */
    public function deleteProduct($id)
    {
        $product = Producto::find($id);

        if (!$product) {
            return false;
        }

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        return $product->delete();
    }
}
