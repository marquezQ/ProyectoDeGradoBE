<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\ProductoService;

class ProductoController extends Controller
{
    protected $productoService;

    // Inyectamos el Servicio a través del constructor (Inyección de Dependencias)
    public function __construct(ProductoService $productoService)
    {
        $this->productoService = $productoService;
    }

    public function index()
    {
        // El controlador ya no hace "Producto::all()", se lo pide al servicio
        $products = $this->productoService->getAllProducts();
        
        return response()->json([
            'products' => $products,
            'status' => 200
        ], 200);
    }

    public function productsByTrabajadorId($id)
    {
        $productos = $this->productoService->getProductsByTrabajador($id);

        if ($productos === null) {
            return response()->json([
                'error' => 'Trabajador no encontrado',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'products' => $productos,
            'status' => 200
        ], 200);
    }

    public function store(Request $request)
    {
        // 1. El controlador es responsable de validar
        $validator = Validator::make($request->all(), [
            'trabajador_id' => 'required',
            'name' => 'required',
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

        // 2. Delegamos la lógica de guardar archivo y crear en Base de Datos al Servicio
        $product = $this->productoService->createProduct(
            $request->except('image'), 
            $request->file('image')    
        );

        if (!$product) {
            return response()->json([
                'message' => 'Error al crear producto',
                'status' => 500
            ], 500);
        }
        
        // 3. Devolvemos la respuesta
        return response()->json([
            'product' => $product,
            'status' => 200
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'trabajador_id' => 'required',
            'name' => 'required',
            'stock' => 'required',
            'price' => 'required',
            'image' => 'nullable|file'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        // El servicio se encarga de buscar, borrar imagen vieja, guardar nueva y actualizar DB
        $product = $this->productoService->updateProduct(
            $id,
            $request->except('image'),
            $request->file('image')
        );

        if (!$product) {
            return response()->json([
                'message' => 'Producto no encontrado',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'message' => 'Producto actualizado correctamente',
            'product' => $product,
            'status' => 200
        ], 200);
    }

    public function destroy($id)
    {
        // El servicio se encarga de borrar la imagen del Storage y el registro en BD
        $deleted = $this->productoService->deleteProduct($id);

        if (!$deleted) {
            return response()->json([
                'message' => 'Producto no encontrado',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'message' => 'Producto eliminado correctamente',
            'status' => 200
        ], 200);
    }
}
