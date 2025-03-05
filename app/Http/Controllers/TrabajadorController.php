<?php

namespace App\Http\Controllers;

use App\Models\Trabajador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
class TrabajadorController extends Controller
{

    public function index(){
        $trabajadors = Trabajador::with('user')->get();

        $trabajadors = $trabajadors->map(function ($trabajador) {
            // Decodificar las imágenes almacenadas en formato JSON
            $images = json_decode($trabajador->images, true);

            // Construir las rutas completas para cada imagen
            if ($images) {
                $images = array_map(function ($path) {
                    return asset(Storage::url($path));
                }, $images);
            }

            // Agregar las rutas completas de las imágenes al trabajador
            $trabajador->images = $images;

            // Procesar la imagen de perfil del usuario si existe
            if ($trabajador->user && $trabajador->user->profile_picture) {
                $trabajador->user->profile_picture = asset(Storage::url($trabajador->user->profile_picture));
            }

            return $trabajador;
        });

        $data = [
            'trabajadors' => $trabajadors,
            'status' => 200,
        ];

        return response()->json($data, 200);
    }

    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'user_id' => 'required|unique:trabajadors',
        'description' => 'required',
        'workshop' => 'required',
        'latitud' => 'required',
        'longitud' => 'required',
        'address' => 'nullable|string',
        'imagen1' => 'required|file|image|max:20048',
        'imagen2' => '|file|image|max:20048',
        'imagen3' => '|file|image|max:20048',
        'imagen4' => '|file|image|max:20048',
        'imagen5' => '|file|image|max:20048',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'message' => 'Error en la validación de datos',
            'errors' => $validator->errors(),
            'status' => 400,
        ], 400);
    }
    $addressLiteral = $request->address ?? $this->getAddress($request->latitud, $request->longitud);

    // Crear un objeto JSON con claves individuales para cada imagen
    $imagenesPaths = [];
    foreach (['imagen1', 'imagen2', 'imagen3', 'imagen4', 'imagen5'] as $index => $imagen) {
        if ($request->hasFile($imagen)) {
            $path = $request->file($imagen)->store('imagesTrabajador', 'public');
            $imagenesPaths["image" . ($index + 1)] = $path;
        }
    }

    $trabajador = Trabajador::create([
        'user_id' => $request->user_id,
        'description' => $request->description,
        'workshop' => $request->workshop,
        'latitud' => $request->latitud,
        'longitud' => $request->longitud,
        'address' => $addressLiteral,
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
private function getAddress(float $lat, float $lng): string
{
    $response = Http::withHeaders([
        'User-Agent' => 'MiAplicacion/1.0 (contacto@ejemplo.com)'
    ])->get("https://nominatim.openstreetmap.org/reverse", [
        'lat' => $lat,
        'lon' => $lng,
        'format' => 'json'
    ]);

    if ($response->failed()) {
        return 'Ubicación desconocida';
    }

    $data = $response->json();
    $fullAddress = $data['display_name'] ?? 'Ubicación desconocida';

    // Dividir la dirección en partes separadas por coma
    $parts = explode(',', $fullAddress);

    // Tomar solo los primeros tres segmentos y unirlos de nuevo
    return count($parts) >= 3 ? implode(',', array_slice($parts, 0, 3)) : $fullAddress;
}

    public function getTrabajador($id){
        $trabajador = Trabajador::with('user')->find($id);
        
        if($trabajador){
            $images = json_decode($trabajador->images, true);
            if($images){
                $images = array_map(function ($path) {
                    return asset(Storage::url($path));
                }, $images);
            }
            $trabajador->images = $images;

            if($trabajador->user && $trabajador->user->profile_picture){
                $trabajador->user->profile_picture = asset(Storage::url($trabajador->user->profile_picture));
            }
            return response()->json([   
                'trabajador' => $trabajador,
                'status' => 201,
            ]);
        }
        return response()->json([
            'message' => 'no existe',
        ]);
    }

}
