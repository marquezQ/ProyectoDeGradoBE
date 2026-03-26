<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\ContratoService;

class ContratoController extends Controller
{
    protected $contratoService;

    // Inyectamos el servicio
    public function __construct(ContratoService $contratoService)
    {
        $this->contratoService = $contratoService;
    }

    public function index()
    {
        $contratos = $this->contratoService->getAllContratos();
        return $contratos;
    }

    public function store(Request $request)
    {
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

        $contrato = $this->contratoService->createContrato($request->all());

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

        $contrato = $this->contratoService->updateContrato($id, $request->all());

        if (!$contrato) {
            return response()->json([
                'message' => 'Producto no encontrado', // Se mantiene igual
                'status' => 404
            ], 404);
        }

        return response()->json([
            'contrato' => $contrato,
            'status' => 200
        ], 200);
    }

    public function updatePartial(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:pendiente,aceptado,rechazado,finalizado',
            'reason' => 'required_if:status,rechazado|string|max:500'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $contrato = $this->contratoService->updatePartialContrato($id, $request->all());

        if (!$contrato) {
            return response()->json([
                'message' => 'Contrato no encontrado',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'contract' => $contrato,
            'status' => 200
        ], 200);
    }

    public function getContratosByTrabajadorAndCliente($trabajador_id, $cliente_id)
    {
        $contratos = $this->contratoService->getContratosByTrabajadorAndCliente($trabajador_id, $cliente_id);

        return response()->json([
            'contratos' => $contratos,
            'status' => 200,
        ], 200);
    }

    public function getContratosByTrabajador($trabajador_id)
    {
        $contratos = $this->contratoService->getContratosByTrabajador($trabajador_id);

        if ($contratos === null) {
            return response()->json([
                'message' => 'El trabajador no existe',
                'status'  => 404,
            ], 404);
        }

        return response()->json([
            'contratos' => $contratos,
            'status' => 200,
        ], 200);
    }

    public function destroy($id)
    {
        $deleted = $this->contratoService->deleteContrato($id);

        if (!$deleted) {
            return response()->json([
                'message' => 'contrato no encontrado',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'message' => 'Contrato eliminado correctamente',
            'status' => 200
        ], 200);
    }
}
