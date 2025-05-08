<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\Trabajador;
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
            'title' => 'required',
            'status' => 'required|in:pendiente,aceptado,rechazado',
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
            'title' => $request->title,
            'status' => $request->status,
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
            'contrato' => $contrato,
            'status' => 201,
        ], 201);
    }
    public function update(Request $request, $id)
    {
    $contrato = Contrato::find($id);

    if (!$contrato) {
        return response()->json([
            'message' => 'Producto no encontrado',
            'status' => 404
        ], 404);
    }

    $validator = Validator::make($request->all(), [
        'trabajador_id' => 'required',
        'user_id' => 'required',
        'title' => 'required',
        'status' => 'required|in:pendiente,aceptado,rechazado,finalizado',
        'start_date' => 'required',
        'end_date' => 'required',
        'details' => 'required|array'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'message' => 'Error en la validación de datos',
            'errors' => $validator->errors(),
            'status' => 400
        ], 400);
    }

    $contrato->trabajador_id = $request->trabajador_id;
    $contrato->user_id = $request->user_id;
    $contrato->title = $request->title;
    $contrato->status = $request->status;
    $contrato->start_date = $request->start_date;
    $contrato->end_date = $request->end_date;
    $contrato->details = json_encode($request->details, JSON_UNESCAPED_UNICODE);

    $contrato->save();

    return response()->json([
        'contrato' => $contrato,
        'status' => 200
    ], 200);
}

    public function updatePartial(Request $request, $id)
    {
        $contrato = Contrato::find($id);

        if (!$contrato) {
            return response()->json([
                'message' => 'Contrato no encontrado',
                'status' => 404
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'status' => 'required|in:pendiente,aceptado,rechazado,finalizado'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $contrato->status = $request->status;
        $contrato->save();

        return response()->json([
            'contract' => $contrato,
            'status' => 200
        ], 200);
    }

    public function getContratosByTrabajadorAndCliente($trabajador_id, $cliente_id){
        $contratos = Contrato::with([
            // Para el cliente (modelo User) obtenemos solo los campos deseados
            'user' => function ($query) {
                $query->select('id', 'name', 'lastname', 'phone_number', 'email');
            },
            // Para el trabajador, obtenemos únicamente latitud, longitud y description, además de user_id (para la relación)
            'trabajador' => function ($query) {
                $query->select('id', 'user_id', 'latitud', 'longitud', 'description', 'address', 'workshop');
            },
            // Y de la información del usuario asociado al trabajador, también limitamos los campos
            'trabajador.user' => function ($query) {
                $query->select('id', 'name', 'lastname', 'phone_number', 'email');
            }
        ])
            ->where('trabajador_id', $trabajador_id)
            ->where('user_id', $cliente_id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'contratos' => $contratos,
            'status' => 200,
        ], 200);
    }

    public function getContratosByTrabajador($trabajador_id){
        $trabajador = Trabajador::find($trabajador_id);
        if (!$trabajador) {
            return response()->json([
                'message' => 'El trabajador no existe',
                'status'  => 404,
            ], 404);
        }
        $contratos = Contrato::with([
            // Carga del cliente (modelo User) con la información requerida
            'user' => function ($query) {
                $query->select('id', 'name', 'lastname', 'phone_number');
            },
            // Carga del trabajador con sus campos específicos y el user_id para la relación
            'trabajador' => function ($query) {
                $query->select('id', 'user_id', 'latitud', 'longitud', 'description', 'address', 'workshop');
            },
            // Carga de la información del usuario asociado al trabajador
            'trabajador.user' => function ($query) {
                $query->select('id', 'name', 'lastname', 'phone_number', 'email');
            }
        ])
        ->where('trabajador_id', $trabajador_id)
        ->orderBy('created_at', 'desc')
        ->get();

        return response()->json([
            'contratos' => $contratos,
            'status' => 200,
        ], 200);
    }

    public function destroy($id)
    {
    $contract = Contrato::find($id);

    if (!$contract) {
        return response()->json([
            'message' => 'contrato no encontrado',
            'status' => 404
        ], 404);
    }

    $contract->delete();

    return response()->json([
        'message' => 'Contrato eliminado correctamente',
        'status' => 200
    ], 200);
    }
}
