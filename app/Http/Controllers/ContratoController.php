<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContratoController extends Controller
{
    public function index(){
        $contratos = Contrato::all();
        return $contratos;
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'trabajador_id' => 'required',
            'user_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'details' => 'required|array'
        ]);

        if($validator->fails()){
            return response()->json([
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400,
            ], 400);
        }

        $contrato = Contrato::create([
            'trabajador_id' => $request->trabajador_id,
            'user_id' => $request->user_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'details' => json_encode($request->details)
        ]);

        if (!$contrato) {
            return response()->json([
                'message' => 'Error al crear contrato',
                'status' => 500,
            ], 500);
        }

        return response()->json([
            'Contrato' => $contrato,
            'status' => 201,
        ], 201);
    }
}
