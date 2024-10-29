<?php

namespace App\Http\Controllers;

use App\Models\Trabajador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TrabajadorController extends Controller
{
    
    public function index()
    {
        $trabajadors = Trabajador::all();
       
        $data = [
            'trabajadors' => $trabajadors,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'user_id' => 'required|unique:trabajadors',
        'latitud' => 'required',
        'longitud' => 'required',
        'imagen1' => 'required|file|image|max:2048',
        'imagen2' => 'required|file|image|max:2048',
        'imagen3' => 'required|file|image|max:2048',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'message' => 'Error en la validación de datos',
            'errors' => $validator->errors(),
            'status' => 400,
        ], 400);
    }

    // Crear un objeto JSON con claves individuales para cada imagen
    $imagenesPaths = [];
    foreach (['imagen1', 'imagen2', 'imagen3'] as $index => $imagen) {
        if ($request->hasFile($imagen)) {
            $path = $request->file($imagen)->store('imagesTrabajador', 'public');
            $imagenesPaths["image" . ($index + 1)] = $path;
        }
    }

    $trabajador = Trabajador::create([
        'user_id' => $request->user_id,
        'latitud' => $request->latitud,
        'longitud' => $request->longitud,
        'images' => json_encode($imagenesPaths), // Convertir el objeto a JSON
    ]);

    if (!$trabajador) {
        return response()->json([
            'message' => 'Error al crear trabajador',
            'status' => 500,
        ], 500);
    }

    return response()->json([
        'trabajador' => $trabajador,
        'status' => 201,
    ], 201);
}

}
