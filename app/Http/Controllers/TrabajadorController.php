<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\TrabajadorService;

class TrabajadorController extends Controller
{
    protected $trabajadorService;

    // Inyectamos el servicio
    public function __construct(TrabajadorService $trabajadorService)
    {
        $this->trabajadorService = $trabajadorService;
    }

    public function index()
    {
        $trabajadors = $this->trabajadorService->getAllTrabajadores();

        return response()->json([
            'trabajadors' => $trabajadors,
            'status' => 200,
        ], 200);
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
            'imagen1' => 'required|file|image|max:30720',
            'imagen2' => 'nullable|file|image|max:30720',
            'imagen3' => 'nullable|file|image|max:30720',
            'imagen4' => 'nullable|file|image|max:30720',
            'imagen5' => 'nullable|file|image|max:30720',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400,
            ], 400);
        }

        $files = $request->only(['imagen1', 'imagen2', 'imagen3', 'imagen4', 'imagen5']);
        $trabajador = $this->trabajadorService->createTrabajador($request->all(), $files);

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

    public function getTrabajador($id)
    {
        $trabajador = $this->trabajadorService->getTrabajadorById($id);
        
        if($trabajador){
            return response()->json([   
                'trabajador' => $trabajador,
                'status' => 201,
            ]);
        }
        
        return response()->json([
            'message' => 'no existe',
        ]);
    }

    public function updateInfo(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required|string',
            'workshop' => 'required|string',
            'latitud' => 'required|numeric',
            'longitud' => 'required|numeric',
            'address' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación',
                'errors' => $validator->errors(),
                'status' => 400,
            ], 400);
        }

        $trabajador = $this->trabajadorService->updateTrabajadorInfo($id, $request->all());

        if (!$trabajador) {
            return response()->json([
                'message' => 'Trabajador no encontrado',
                'status' => 404,
            ], 404);
        }

        return response()->json([
            'message' => 'Información actualizada correctamente',
            'trabajador' => $trabajador,
            'status' => 200,
        ]);
    }

    public function updateImages(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'image1' => 'nullable|file|image|mimes:jpeg,png,jpg,gif,webp|max:30720',
            'image2' => 'nullable|file|image|mimes:jpeg,png,jpg,gif,webp|max:30720',
            'image3' => 'nullable|file|image|mimes:jpeg,png,jpg,gif,webp|max:30720',
            'image4' => 'nullable|file|image|mimes:jpeg,png,jpg,gif,webp|max:30720',
            'image5' => 'nullable|file|image|mimes:jpeg,png,jpg,gif,webp|max:30720',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de imágenes',
                'errors' => $validator->errors(),
                'status' => 400,
            ], 400);
        }

        $files = $request->only(['image1', 'image2', 'image3', 'image4', 'image5']);
        $imagesWithUrls = $this->trabajadorService->updateTrabajadorImages($id, $files);

        return response()->json([
            'message' => 'Imágenes actualizadas correctamente',
            'images' => $imagesWithUrls,
            'status' => 200,
        ], 200);
    }
}
