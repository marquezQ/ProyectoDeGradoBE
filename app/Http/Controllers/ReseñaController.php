<?php

namespace App\Http\Controllers;

use App\Models\Calificacion;
use App\Models\Contrato;
use App\Models\Reseña;
use App\Models\Trabajador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ReseñaController extends Controller
{
    // public function store(Request $request){
    //     $validator = Validator::make($request->all(), [
    //         'contrato_id' => 'required',
    //         'comment' => 'required',
    //         'recommend' => 'required',
    //         'imagen1' => 'required|file|image|max:20048',
    //         'imagen2' => 'file|image|max:20048',
    //         'imagen3' => 'file|image|max:20048',
    //         //calification fields
    //         'time' => 'required|integer|between:1,5',
    //         'quality' => 'required|integer|between:1,5',
    //         'communication' => 'required|integer|between:1,5',
    //         'price' => 'required|integer|between:1,5',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'message' => 'Error en la validación de datos',
    //             'errors' => $validator->errors(),
    //             'status' => 400,
    //         ], 400);
    //     }

    //     $imagenesPaths = [];
    //     foreach (['imagen1', 'imagen2', 'imagen3'] as $index => $imagen) {
    //         if ($request->hasFile($imagen)) {
    //             $path = $request->file($imagen)->store('imagesReseña', 'public');
    //             $imagenesPaths["image" . ($index + 1)] = $path;
    //         }
    //     }

    //     $reseña = Reseña::create([
    //         'contrato_id' => $request->contrato_id,
    //         'comment' => $request->comment,
    //         'recommend' => $request->recommend,
    //         'images' => json_encode($imagenesPaths)
    //     ]);
    //     if (!$reseña) {
    //         return response()->json([
    //             'message' => 'Error al crear reseña',
    //             'status' => 500,
    //         ], 500);
    //     }

    //     $calificacion = Calificacion::create([
    //         'reseña_id' => $reseña->id,
    //         'time' => $request->time,
    //         'quality' => $request->quality,
    //         'communication' => $request->communication,
    //         'price' => $request->price,
    //         'final' => array_sum([$request->time, $request->quality, $request->communication, $request->price])/4 ,
    //     ]);

    //     if(!$calificacion){
    //         $reseña->delete();
    //         return response()->json([
    //             'message' => 'Error al crear califiacion.. se elimino la reseña',
    //             'status' => 500,
    //         ], 500);
    //     }

    //     return response()->json([
    //         'reseña' => $reseña,
    //         'calificacion' => $calificacion,
    //         'status' => 201,
    //     ], 201);
    // }


    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'contrato_id' => 'required',
            'comment' => 'required',
            'recommend' => 'required|boolean',
            'imagen1' => 'required|file|image|max:51200',
            'imagen2' => 'file|image|max:51200',
            'imagen3' => 'file|image|max:51200',
            // Campos de calificación
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

        // Almacenar rutas de imágenes
        $imagenesPaths = [];
        foreach (['imagen1', 'imagen2', 'imagen3'] as $index => $imagen) {
            if ($request->hasFile($imagen)) {
                $path = $request->file($imagen)->store('imagesReseña', 'public');
                $imagenesPaths["image" . ($index + 1)] = $path;
            }
        }

        DB::beginTransaction();
        try {
            // Crear reseña
            $reseña = Reseña::create([
                'contrato_id' => $request->contrato_id,
                'comment' => $request->comment,
                'recommend' => $request->recommend,
                'images' => json_encode($imagenesPaths),
            ]);

            // Crear calificación asociada
            $calificacion = Calificacion::create([
                'reseña_id' => $reseña->id,
                'time' => $request->time,
                'quality' => $request->quality,
                'communication' => $request->communication,
                'price' => $request->price,
                'final' => array_sum([$request->time, $request->quality, $request->communication, $request->price]) / 4,
            ]);

            //  Actualiza el estado del contrato
            $contrato = Contrato::find($request->contrato_id);
            if ($contrato) {
                $contrato->status = 'finalizado';
                $contrato->save();
            }
            
            DB::commit();

            return response()->json([
                'reseña' => $reseña,
                'calificacion' => $calificacion,
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Error al crear reseña y calificación',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function getReseniaByTrabajId($id)
    {
        // Buscar al trabajador por su ID junto con sus reseñas, calificación e información del usuario
        $trabajador = Trabajador::with('reseñas.calificacion', 'reseñas.contrato.user')->find($id);
    
        // Verificar si el trabajador existe
        if (!$trabajador) {
            return response()->json(['message' => 'Trabajador no encontrado'], 404);
        }
    
        // Procesar reseñas para transformar el campo 'images' y 'profile_picture'
        $reseñas = $trabajador->reseñas->map(function ($reseña) {
            // Decodificar el JSON del campo 'images'
            $images = json_decode($reseña->images, true);
    
            // Si hay imágenes, transformarlas con asset(Storage::url(...))
            if ($images && is_array($images)) {
                foreach ($images as $key => $image) {
                    $images[$key] = asset(Storage::url($image));
                }
                $reseña->images = $images;
            }
    
            // // Transformar la URL de la imagen de perfil del usuario
            // if ($reseña->contrato && $reseña->contrato->user && $reseña->contrato->user->profile_picture) {
            if ($reseña->contrato->user->profile_picture) {
                $reseña->contrato->user->profile_picture = asset(Storage::url($reseña->contrato->user->profile_picture));
            }

            return $reseña;
        });
        // Retornar las reseñas del trabajador con las imágenes transformadas
        return response()->json([
            'reseñas' => $reseñas,
            'status' => 200
        ], 200);
        
    }
    

}