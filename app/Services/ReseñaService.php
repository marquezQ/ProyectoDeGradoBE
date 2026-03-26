<?php

namespace App\Services;

use App\Models\Calificacion;
use App\Models\Contrato;
use App\Models\Reseña;
use App\Models\Trabajador;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ReseñaService
{
    public function createReseña(array $data, array $files)
    {
        $imagenesPaths = [];
        foreach (['imagen1', 'imagen2', 'imagen3'] as $index => $imagen) {
            if (isset($files[$imagen])) {
                $path = $files[$imagen]->store('imagesReseña', 'public');
                $imagenesPaths["image" . ($index + 1)] = $path;
            }
        }

        DB::beginTransaction();
        try {
            $reseña = Reseña::create([
                'contrato_id' => $data['contrato_id'],
                'comment' => $data['comment'],
                'recommend' => $data['recommend'],
                'images' => json_encode($imagenesPaths),
            ]);

            $calificacion = Calificacion::create([
                'reseña_id' => $reseña->id,
                'time' => $data['time'],
                'quality' => $data['quality'],
                'communication' => $data['communication'],
                'price' => $data['price'],
                'final' => array_sum([$data['time'], $data['quality'], $data['communication'], $data['price']]) / 4,
            ]);

            $contrato = Contrato::find($data['contrato_id']);
            if ($contrato) {
                $contrato->status = 'finalizado';
                $contrato->save();
            }
            
            DB::commit();

            return ['reseña' => $reseña, 'calificacion' => $calificacion];

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function getReseñasByTrabajadorId($id)
    {
        $trabajador = Trabajador::with([
            'reseñas' => function ($query) {
                $query->orderBy('created_at', 'desc');
            },
            'reseñas.calificacion', 
            'reseñas.contrato.user'
        ])->find($id);
    
        if (!$trabajador) {
            return null;
        }
    
        return $trabajador->reseñas->map(function ($reseña) {
            $images = json_decode($reseña->images, true);
    
            if ($images && is_array($images)) {
                foreach ($images as $key => $image) {
                    $images[$key] = asset(Storage::url($image));
                }
                $reseña->images = $images;
            }

            if ($reseña->contrato && $reseña->contrato->user && $reseña->contrato->user->profile_picture) {
                $profile = $reseña->contrato->user->profile_picture;
                if ($profile && !str_starts_with($profile, 'http')) {
                    $reseña->contrato->user->profile_picture = asset(Storage::url($profile));
                }
            }

            return $reseña;
        });
    }

    public function getReseñasByUserId($userId)
    {
        $usuario = User::find($userId);
        if (!$usuario) {
            return null;
        }

        return $usuario->reseñas->map(function ($reseña) {
            $images = json_decode($reseña->images, true);
            if ($images && is_array($images)) {
                foreach ($images as $key => $image) {
                    $images[$key] = asset(Storage::url($image));
                }
                $reseña->images = $images;
            }

            if ($reseña->contrato && $reseña->contrato->trabajador) {
                $profile = $reseña->contrato->trabajador->user->profile_picture;
                if ($profile && !str_starts_with($profile, 'http')) {
                    $reseña->contrato->trabajador->user->profile_picture = asset(Storage::url($profile));
                }
            }
            if ($reseña->contrato && $reseña->contrato->user) {
                $reseña->contrato->user->profile_picture = $reseña->contrato->user->profile_picture
                    ? asset(Storage::url($reseña->contrato->user->profile_picture))
                    : null;
            }

            return $reseña;
        });
    }

    public function getReseñaById($id)
    {
        $reseña = Reseña::with(['calificacion', 'contrato.user', 'contrato.trabajador.user'])
            ->find($id);

        if (!$reseña) {
            return null;
        }

        $images = json_decode($reseña->images, true);
        if ($images && is_array($images)) {
            foreach ($images as $key => $image) {
                $images[$key] = asset(Storage::url($image));
            }
            $reseña->images = $images;
        }

        if ($reseña->contrato && $reseña->contrato->user && $reseña->contrato->user->profile_picture) {
            $profile = $reseña->contrato->user->profile_picture;
            if ($profile && !str_starts_with($profile, 'http')) {
                $reseña->contrato->user->profile_picture = asset(Storage::url($profile));
            }
        }

        if ($reseña->contrato && $reseña->contrato->trabajador && $reseña->contrato->trabajador->user) {
            $workerProfile = $reseña->contrato->trabajador->user->profile_picture;
            if ($workerProfile && !str_starts_with($workerProfile, 'http')) {
                $reseña->contrato->trabajador->user->profile_picture = asset(Storage::url($workerProfile));
            }
        }

        return $reseña;
    }
}
