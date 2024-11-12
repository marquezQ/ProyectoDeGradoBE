<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Trabajador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductoController extends Controller
{
    public function index(){
        $products = Producto::all();
        $data = [
            'products' => $products,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function productsByTrabajadorId($id){
        $trabajador = Trabajador::find($id);

        if (!$trabajador) {
            $data = [
                'error' => 'Trabajador no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $productos = $trabajador->productos;
        $data = [
            'products' => $productos,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'trabajador_id' => 'required',
            'stock' => 'required',
            'price' => 'required',
            'image' => 'required|file'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400,
            ], 400);
        }

        $filePath = '';
        if($request->hasFile('image')){
            $file = $request->file('image');
            $filePath = $file->store('products', 'public');
        }
        $product = Producto::create([
            'trabajador_id' => $request->trabajador_id,
            'stock' => $request->stock,
            'price' => $request->price,
            'image' => $filePath
        ]);

        if(!$product){
            $data = [
                'message' => 'Error al crear producto',
                'status' => 500
            ];
            return response()->json($data, 500);
        }
        
        $data = [
            'product' => $product,
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
