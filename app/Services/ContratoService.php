<?php

namespace App\Services;

use App\Models\Contrato;
use App\Models\Trabajador;

class ContratoService
{
    public function getAllContratos()
    {
        return Contrato::all();
    }

    public function createContrato(array $data)
    {
        return Contrato::create([
            'trabajador_id' => $data['trabajador_id'],
            'user_id' => $data['user_id'],
            'title' => $data['title'],
            'status' => $data['status'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'details' => json_encode($data['details'])
        ]);
    }

    public function updateContrato($id, array $data)
    {
        $contrato = Contrato::find($id);

        if (!$contrato) {
            return null;
        }

        $contrato->trabajador_id = $data['trabajador_id'];
        $contrato->user_id = $data['user_id'];
        $contrato->title = $data['title'];
        $contrato->status = $data['status'];
        $contrato->start_date = $data['start_date'];
        $contrato->end_date = $data['end_date'];
        $contrato->details = json_encode($data['details'], JSON_UNESCAPED_UNICODE);

        $contrato->save();

        return $contrato;
    }

    public function updatePartialContrato($id, array $data)
    {
        $contrato = Contrato::find($id);

        if (!$contrato) {
            return null;
        }

        $contrato->status = $data['status'];
        if ($data['status'] === 'rechazado' && isset($data['reason'])) {
            $contrato->reason_rejected = $data['reason'];
        }
        $contrato->save();

        return $contrato;
    }

    public function getContratosByTrabajadorAndCliente($trabajador_id, $cliente_id)
    {
        return Contrato::with([
            'user' => function ($query) {
                $query->select('id', 'name', 'lastname', 'phone_number', 'email');
            },
            'trabajador' => function ($query) {
                $query->select('id', 'user_id', 'latitud', 'longitud', 'description', 'address', 'workshop');
            },
            'trabajador.user' => function ($query) {
                $query->select('id', 'name', 'lastname', 'phone_number', 'email');
            }
        ])
            ->where('trabajador_id', $trabajador_id)
            ->where('user_id', $cliente_id)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getContratosByTrabajador($trabajador_id)
    {
        $trabajador = Trabajador::find($trabajador_id);
        
        if (!$trabajador) {
            return null;
        }

        return Contrato::with([
            'user' => function ($query) {
                $query->select('id', 'name', 'lastname', 'phone_number');
            },
            'trabajador' => function ($query) {
                $query->select('id', 'user_id', 'latitud', 'longitud', 'description', 'address', 'workshop');
            },
            'trabajador.user' => function ($query) {
                $query->select('id', 'name', 'lastname', 'phone_number', 'email');
            }
        ])
        ->where('trabajador_id', $trabajador_id)
        ->orderBy('created_at', 'desc')
        ->get();
    }

    public function deleteContrato($id)
    {
        $contract = Contrato::find($id);

        if (!$contract) {
            return false;
        }

        return $contract->delete();
    }
}
