<?php

namespace App\Services;

use App\Models\Trabajador;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class TrabajadorService
{
    public function getAllTrabajadores()
    {
        $trabajadors = Trabajador::with([
                'user',
                'contratos.reseña.calificacion'
            ])
            ->withCount(['reseñas as totalReviews'])
            ->orderByDesc('totalReviews')
            ->get();

        return $trabajadors->map(function ($trabajador) {
            $imagesJson = $trabajador->getRawOriginal('images');
            $images = $imagesJson ? json_decode($imagesJson, true) : null;
            if (is_array($images)) {
                $images = array_map(fn($path) => asset(Storage::url($path)), $images);
            } else {
                $images = null;
            }
            $trabajador->images = $images;

            if ($trabajador->user && $trabajador->user->profile_picture) {
                $trabajador->user->profile_picture = asset(Storage::url($trabajador->user->profile_picture));
            }

            $ratings = [];
            foreach ($trabajador->contratos as $contrato) {
                if (
                    isset($contrato->reseña) &&
                    isset($contrato->reseña->calificacion) &&
                    isset($contrato->reseña->calificacion->final)
                ) {
                    $ratings[] = (float) $contrato->reseña->calificacion->final;
                }
            }
            $trabajador->averageRating = count($ratings) ? round(array_sum($ratings) / count($ratings), 2) : 0;

            return $trabajador;
        });
    }

    public function createTrabajador(array $data, array $files)
    {
        $addressLiteral = $data['address'] ?? $this->getAddress($data['latitud'], $data['longitud']);

        $imagenesPaths = [];
        $keys = ['imagen1', 'imagen2', 'imagen3', 'imagen4', 'imagen5'];
        foreach ($keys as $index => $imagen) {
            if (isset($files[$imagen])) {
                $path = $files[$imagen]->store('imagesTrabajador', 'public');
                $imagenesPaths["image" . ($index + 1)] = $path;
            }
        }

        return Trabajador::create([
            'user_id' => $data['user_id'],
            'description' => $data['description'],
            'workshop' => $data['workshop'],
            'latitud' => $data['latitud'],
            'longitud' => $data['longitud'],
            'address' => $addressLiteral,
            'images' => json_encode($imagenesPaths),
        ]);
    }

    public function getTrabajadorById($id)
    {
        $trabajador = Trabajador::with('user')->find($id);
        
        if($trabajador){
            $images = json_decode($trabajador->images, true);
            if($images){
                $images = array_map(function ($path) {
                    return asset(Storage::url($path));
                }, $images);
            }
            $trabajador->images = $images;

            if ($trabajador->user) {
                $trabajador->user->profile_picture = $trabajador->user->profile_picture
                    ? asset(Storage::url($trabajador->user->profile_picture))
                    : null;
            }
            $totalReviews = $trabajador->contratos()->has('reseña')->count();
            
            $averageRating = $trabajador->contratos()
                ->join('reseñas', 'contratos.id', '=', 'reseñas.contrato_id')
                ->join('calificacions', 'reseñas.id', '=', 'calificacions.reseña_id')
                ->avg('calificacions.final');
                
            $trabajador->totalReviews = $totalReviews;
            $trabajador->averageRating = round($averageRating, 2);
        }
        
        return $trabajador;
    }

    public function updateTrabajadorInfo($id, array $data)
    {
        $trabajador = Trabajador::find($id);

        if (!$trabajador) {
            return null;
        }

        $trabajador->description = $data['description'];
        $trabajador->workshop = $data['workshop'];
        $trabajador->latitud = $data['latitud'];
        $trabajador->longitud = $data['longitud'];
        $trabajador->address = $data['address'] ?? $this->getAddress($data['latitud'], $data['longitud']);

        $trabajador->save();

        return $trabajador;
    }

    public function updateTrabajadorImages($id, array $files)
    {
        $trabajador = Trabajador::findOrFail($id);

        $existingImages = json_decode($trabajador->images, true) ?? [
            'image1' => null,
            'image2' => null,
            'image3' => null,
            'image4' => null,
            'image5' => null,
        ];

        foreach (['image1', 'image2', 'image3', 'image4', 'image5'] as $key) {
            if (isset($files[$key])) {
                if (!empty($existingImages[$key])) {
                    Storage::disk('public')->delete($existingImages[$key]);
                }
                $path = $files[$key]->store('imagesTrabajador', 'public');
                $existingImages[$key] = $path;
            }
        }

        $trabajador->images = json_encode($existingImages);
        $trabajador->save();

        return collect($existingImages)->map(function ($path) {
            return $path ? asset(Storage::url($path)) : null;
        })->toArray();
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

        $parts = explode(',', $fullAddress);

        return count($parts) >= 3 ? implode(',', array_slice($parts, 0, 3)) : $fullAddress;
    }
}
