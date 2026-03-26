<?php

namespace App\Services;

use App\Models\User;
use App\Models\Trabajador;
use App\Models\Producto;
use App\Models\Reseña;
use App\Models\Contrato;
use Illuminate\Support\Facades\Storage;

class AdminService
{
    public function getAllUsers()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        
        $users->transform(function ($user) {
            if ($user->profile_picture) {
                $user->profile_picture = asset(Storage::url($user->profile_picture));
            }
            return $user;
        });
        
        return $users;
    }

    public function getAllCarpinteros()
    {
        $carpinteros = Trabajador::with('user')->orderBy('created_at', 'desc')->get();
        
        $carpinteros->transform(function ($carpintero) {
            if ($carpintero->user && $carpintero->user->profile_picture) {
                $carpintero->user->profile_picture = asset(Storage::url($carpintero->user->profile_picture));
            }
            return $carpintero;
        });
        
        return $carpinteros;
    }

    public function getAllProductos()
    {
        $productos = Producto::with('trabajador.user')->orderBy('created_at', 'desc')->get();
        
        $productos->transform(function ($producto) {
            if ($producto->image) {
                $producto->image = asset(Storage::url($producto->image));
            }
            if ($producto->trabajador && $producto->trabajador->user && $producto->trabajador->user->profile_picture) {
                $producto->trabajador->user->profile_picture = asset(Storage::url($producto->trabajador->user->profile_picture));
            }
            return $producto;
        });
        
        return $productos;
    }

    public function getAllResenas()
    {
        $reseñas = Reseña::with([
            'contrato.user',
            'contrato.trabajador.user',
            'calificacion'
        ])->orderBy('created_at', 'desc')->get();
        
        $reseñas->transform(function ($reseña) {
            if ($reseña->contrato && $reseña->contrato->user && $reseña->contrato->user->profile_picture) {
                $reseña->contrato->user->profile_picture = asset(Storage::url($reseña->contrato->user->profile_picture));
            }
            if ($reseña->contrato && $reseña->contrato->trabajador && $reseña->contrato->trabajador->user && $reseña->contrato->trabajador->user->profile_picture) {
                $reseña->contrato->trabajador->user->profile_picture = asset(Storage::url($reseña->contrato->trabajador->user->profile_picture));
            }
            if ($reseña->images) {
                $images = is_string($reseña->images) ? json_decode($reseña->images, true) : $reseña->images;
                if (is_array($images)) {
                    foreach ($images as $key => $image) {
                        if ($image) {
                            $images[$key] = asset(Storage::url($image));
                        }
                    }
                    $reseña->images = $images;
                }
            }
            return $reseña;
        });
        
        return $reseñas;
    }

    public function getAllContratos()
    {
        $contratos = Contrato::with(['trabajador.user', 'user'])->orderBy('created_at', 'desc')->get();
        
        $contratos->transform(function ($contrato) {
            if ($contrato->user && $contrato->user->profile_picture) {
                $contrato->user->profile_picture = asset(Storage::url($contrato->user->profile_picture));
            }
            if ($contrato->trabajador && $contrato->trabajador->user && $contrato->trabajador->user->profile_picture) {
                $contrato->trabajador->user->profile_picture = asset(Storage::url($contrato->trabajador->user->profile_picture));
            }
            return $contrato;
        });
        
        return $contratos;
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        
        if (!$user) {
            return ['status' => 404, 'message' => 'Usuario no encontrado'];
        }

        if ($user->role === 'admin') {
            return ['status' => 403, 'message' => 'No se puede eliminar un administrador'];
        }
        
        if ($user->profile_picture) {
            Storage::delete($user->profile_picture);
        }
        
        $user->delete();
        return ['status' => 200, 'message' => 'Usuario eliminado correctamente'];
    }

    public function deleteCarpintero($id)
    {
        $carpintero = Trabajador::find($id);

        if (!$carpintero) {
            return false;
        }
        
        if ($carpintero->images) {
            $images = is_string($carpintero->images) ? json_decode($carpintero->images, true) : $carpintero->images;
            if (is_array($images)) {
                foreach ($images as $image) {
                    if ($image) {
                        Storage::delete($image);
                    }
                }
            }
        }
        
        $carpintero->delete();
        return true;
    }

    public function deleteProducto($id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return false;
        }
        
        if ($producto->image) {
            Storage::delete($producto->image);
        }
        
        $producto->delete();
        return true;
    }

    public function deleteResena($id)
    {
        $reseña = Reseña::find($id);

        if (!$reseña) {
            return false;
        }
        
        if ($reseña->images) {
            $images = is_string($reseña->images) ? json_decode($reseña->images, true) : $reseña->images;
            if (is_array($images)) {
                foreach ($images as $image) {
                    if ($image) {
                        Storage::delete($image);
                    }
                }
            }
        }
        
        if ($reseña->calificacion) {
            $reseña->calificacion->delete();
        }
        
        $reseña->delete();
        return true;
    }

    public function deleteContrato($id)
    {
        $contrato = Contrato::find($id);

        if (!$contrato) {
            return false;
        }
        
        if ($contrato->reseña) {
            if ($contrato->reseña->images) {
                $images = is_string($contrato->reseña->images) ? json_decode($contrato->reseña->images, true) : $contrato->reseña->images;
                if (is_array($images)) {
                    foreach ($images as $image) {
                        if ($image) {
                            Storage::delete($image);
                        }
                    }
                }
            }
            if ($contrato->reseña->calificacion) {
                $contrato->reseña->calificacion->delete();
            }
            $contrato->reseña->delete();
        }
        
        $contrato->delete();
        return true;
    }

    public function getDashboardStats()
    {
        $recent_users = User::orderBy('created_at', 'desc')->take(5)->get();
        $recent_reseñas = Reseña::with([
            'contrato.user',
            'contrato.trabajador.user',
            'calificacion'
        ])->orderBy('created_at', 'desc')->take(5)->get();
        
        $recent_users->transform(function ($user) {
            if ($user->profile_picture) {
                $user->profile_picture = asset(Storage::url($user->profile_picture));
            }
            return $user;
        });
        
        $recent_reseñas->transform(function ($reseña) {
            if ($reseña->contrato && $reseña->contrato->user && $reseña->contrato->user->profile_picture) {
                $reseña->contrato->user->profile_picture = asset(Storage::url($reseña->contrato->user->profile_picture));
            }
            if ($reseña->contrato && $reseña->contrato->trabajador && $reseña->contrato->trabajador->user && $reseña->contrato->trabajador->user->profile_picture) {
                $reseña->contrato->trabajador->user->profile_picture = asset(Storage::url($reseña->contrato->trabajador->user->profile_picture));
            }
            return $reseña;
        });
        
        return [
            'total_users' => User::count(),
            'total_carpinteros' => Trabajador::count(),
            'total_productos' => Producto::count(),
            'total_reseñas' => Reseña::count(),
            'total_contratos' => Contrato::count(),
            'recent_users' => $recent_users,
            'recent_reseñas' => $recent_reseñas,
        ];
    }
}
