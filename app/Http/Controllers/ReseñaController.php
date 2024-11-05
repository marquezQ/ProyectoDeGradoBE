<?php

namespace App\Http\Controllers;

use App\Models\Calificacion;
use App\Models\Reseña;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReseñaController extends Controller
{
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'contrato_id' => 'required',
            'comment' => 'required',
            'recommend' => 'required',
            'imagen1' => 'required|file|image|max:20048',
            'imagen2' => 'file|image|max:20048',
            'imagen3' => 'file|image|max:20048',
            //calification fields
            'time' => 'required|integer|between:1,5',
            'quality' => 'required|integer|between:1,5',
            'communication' => 'required|integer|between:1,5',
            'price' => 'required|integer|between:1,5',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400,
            ], 400);
        }

        $imagenesPaths = [];
        foreach (['imagen1', 'imagen2', 'imagen3'] as $index => $imagen) {
            if ($request->hasFile($imagen)) {
                $path = $request->file($imagen)->store('imagesReseña', 'public');
                $imagenesPaths["image" . ($index + 1)] = $path;
            }
        }

        $reseña = Reseña::create([
            'contrato_id' => $request->contrato_id,
            'comment' => $request->comment,
            'recommend' => $request->recommend,
            'images' => json_encode($imagenesPaths)
        ]);
        if (!$reseña) {
            return response()->json([
                'message' => 'Error al crear reseña',
                'status' => 500,
            ], 500);
        }

        $calificacion = Calificacion::create([
            'reseña_id' => $reseña->id,
            'time' => $request->time,
            'quality' => $request->quality,
            'communication' => $request->communication,
            'price' => $request->price,
            'final' => array_sum([$request->time, $request->quality, $request->communication, $request->price])/4 ,
        ]);

        if(!$calificacion){
            $reseña->delete();
            return response()->json([
                'message' => 'Error al crear califiacion.. se elimino la reseña',
                'status' => 500,
            ], 500);
        }

        return response()->json([
            'reseña' => $reseña,
            'calificacion' => $calificacion,
            'status' => 201,
        ], 201);
    }
}
