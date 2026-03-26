<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\ReseñaService;

class ReseñaController extends Controller
{
    protected $reseñaService;

    // Inyectamos el servicio
    public function __construct(ReseñaService $reseñaService)
    {
        $this->reseñaService = $reseñaService;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'contrato_id' => 'required',
            'comment' => 'required',
            'recommend' => 'required|boolean',
            'imagen1' => 'required|file|image|max:51200',
            'imagen2' => 'nullable|file|image|max:51200',
            'imagen3' => 'nullable|file|image|max:51200',
            'time' => 'required|integer|between:1,5',
            'quality' => 'required|integer|between:1,5',
            'communication' => 'required|integer|between:1,5',
            'price' => 'required|integer|between:1,5',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
            ], 400);
        }

        try {
            $files = $request->only(['imagen1', 'imagen2', 'imagen3']);
            $result = $this->reseñaService->createReseña($request->all(), $files);

            return response()->json([
                'reseña' => $result['reseña'],
                'calificacion' => $result['calificacion'],
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al crear reseña y calificación',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function getReseniaByTrabajId($id)
    {
        $reseñas = $this->reseñaService->getReseñasByTrabajadorId($id);
    
        if ($reseñas === null) {
            return response()->json(['message' => 'Trabajador no encontrado'], 404);
        }
    
        return response()->json([
            'reseñas' => $reseñas,
            'status' => 200
        ], 200);
    }
    
    public function getReseniaByUserId($userId)
    {
        $reseñas = $this->reseñaService->getReseñasByUserId($userId);

        if ($reseñas === null) {
            return response()->json([
                'message' => 'Usuario no encontrado',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'reseñas' => $reseñas,
            'status' => 200
        ], 200);
    }

    public function getReseniaById($id)
    {
        $reseña = $this->reseñaService->getReseñaById($id);

        if (!$reseña) {
            return response()->json([
                'message' => 'Reseña no encontrada',
                'status' => 404,
            ], 404);
        }

        return response()->json([
            'reseña' => $reseña,
            'status' => 200,
        ], 200);
    }
}