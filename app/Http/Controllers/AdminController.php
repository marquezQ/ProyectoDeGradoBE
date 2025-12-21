<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Trabajador;
use App\Models\Producto;
use App\Models\Reseña;
use App\Models\Contrato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // Obtener todos los usuarios
    public function getAllUsers()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        
        // Parsear imágenes de perfil
        $users->transform(function ($user) {
            if ($user->profile_picture) {
                $user->profile_picture = asset(Storage::url($user->profile_picture));
            }
            return $user;
        });
        
        return response()->json($users);
    }

    // Obtener todos los carpinteros
    public function getAllCarpinteros()
    {
        $carpinteros = Trabajador::with('user')->orderBy('created_at', 'desc')->get();
        
        // Parsear imágenes de usuarios
        $carpinteros->transform(function ($carpintero) {
            if ($carpintero->user && $carpintero->user->profile_picture) {
                $carpintero->user->profile_picture = asset(Storage::url($carpintero->user->profile_picture));
            }
            return $carpintero;
        });
        
        return response()->json($carpinteros);
    }

    // Obtener todos los productos
    public function getAllProductos()
    {
        $productos = Producto::with('trabajador.user')->orderBy('created_at', 'desc')->get();
        
        // Parsear imágenes de productos y usuarios
        $productos->transform(function ($producto) {
            if ($producto->image) {
                $producto->image = asset(Storage::url($producto->image));
            }
            if ($producto->trabajador && $producto->trabajador->user && $producto->trabajador->user->profile_picture) {
                $producto->trabajador->user->profile_picture = asset(Storage::url($producto->trabajador->user->profile_picture));
            }
            return $producto;
        });
        
        return response()->json($productos);
    }

    // Obtener todas las reseñas
    public function getAllReseñas()
    {
        $reseñas = Reseña::with([
            'contrato.user',           // Usuario que hizo el contrato (cliente)
            'contrato.trabajador.user', // Carpintero del contrato
            'calificacion'              // Calificación de la reseña
        ])->orderBy('created_at', 'desc')->get();
        
        // Parsear imágenes
        $reseñas->transform(function ($reseña) {
            // Imagen del cliente
            if ($reseña->contrato && $reseña->contrato->user && $reseña->contrato->user->profile_picture) {
                $reseña->contrato->user->profile_picture = asset(Storage::url($reseña->contrato->user->profile_picture));
            }
            // Imagen del carpintero
            if ($reseña->contrato && $reseña->contrato->trabajador && $reseña->contrato->trabajador->user && $reseña->contrato->trabajador->user->profile_picture) {
                $reseña->contrato->trabajador->user->profile_picture = asset(Storage::url($reseña->contrato->trabajador->user->profile_picture));
            }
            // Imágenes de la reseña (si las hay)
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
        
        return response()->json($reseñas);
    }

    // Obtener todos los contratos
    public function getAllContratos()
    {
        $contratos = Contrato::with(['trabajador.user', 'user'])->orderBy('created_at', 'desc')->get();
        
        // Parsear imágenes
        $contratos->transform(function ($contrato) {
            // Imagen del cliente
            if ($contrato->user && $contrato->user->profile_picture) {
                $contrato->user->profile_picture = asset(Storage::url($contrato->user->profile_picture));
            }
            // Imagen del carpintero
            if ($contrato->trabajador && $contrato->trabajador->user && $contrato->trabajador->user->profile_picture) {
                $contrato->trabajador->user->profile_picture = asset(Storage::url($contrato->trabajador->user->profile_picture));
            }
            return $contrato;
        });
        
        return response()->json($contratos);
    }

    // Eliminar usuario
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        
        // Verificar que no sea admin
        if ($user->role === 'admin') {
            return response()->json(['message' => 'No se puede eliminar un administrador'], 403);
        }
        
        // Eliminar imagen de perfil si existe
        if ($user->profile_picture) {
            Storage::delete($user->profile_picture);
        }
        
        $user->delete();
        return response()->json(['message' => 'Usuario eliminado correctamente']);
    }

    // Eliminar carpintero
    public function deleteCarpintero($id)
    {
        $carpintero = Trabajador::findOrFail($id);
        
        // Eliminar imágenes del carpintero si existen
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
        return response()->json(['message' => 'Carpintero eliminado correctamente']);
    }

    // Eliminar producto
    public function deleteProducto($id)
    {
        $producto = Producto::findOrFail($id);
        
        // Eliminar imagen del producto si existe
        if ($producto->image) {
            Storage::delete($producto->image);
        }
        
        $producto->delete();
        return response()->json(['message' => 'Producto eliminado correctamente']);
    }

    // Eliminar reseña
    public function deleteReseña($id)
    {
        $reseña = Reseña::findOrFail($id);
        
        // Eliminar imágenes de la reseña si existen
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
        
        // Eliminar también la calificación asociada si existe
        if ($reseña->calificacion) {
            $reseña->calificacion->delete();
        }
        
        $reseña->delete();
        return response()->json(['message' => 'Reseña eliminada correctamente']);
    }

    // Eliminar contrato
    public function deleteContrato($id)
    {
        $contrato = Contrato::findOrFail($id);
        
        // Eliminar la reseña asociada si existe (con sus imágenes)
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
        return response()->json(['message' => 'Contrato eliminado correctamente']);
    }

    // Obtener estadísticas del dashboard
    public function getDashboardStats()
    {
        $recent_users = User::orderBy('created_at', 'desc')->take(5)->get();
        $recent_reseñas = Reseña::with([
            'contrato.user',
            'contrato.trabajador.user',
            'calificacion'
        ])->orderBy('created_at', 'desc')->take(5)->get();
        
        // Parsear imágenes de usuarios recientes
        $recent_users->transform(function ($user) {
            if ($user->profile_picture) {
                $user->profile_picture = asset(Storage::url($user->profile_picture));
            }
            return $user;
        });
        
        // Parsear imágenes de reseñas recientes
        $recent_reseñas->transform(function ($reseña) {
            if ($reseña->contrato && $reseña->contrato->user && $reseña->contrato->user->profile_picture) {
                $reseña->contrato->user->profile_picture = asset(Storage::url($reseña->contrato->user->profile_picture));
            }
            if ($reseña->contrato && $reseña->contrato->trabajador && $reseña->contrato->trabajador->user && $reseña->contrato->trabajador->user->profile_picture) {
                $reseña->contrato->trabajador->user->profile_picture = asset(Storage::url($reseña->contrato->trabajador->user->profile_picture));
            }
            return $reseña;
        });
        
        return response()->json([
            'total_users' => User::count(),
            'total_carpinteros' => Trabajador::count(),
            'total_productos' => Producto::count(),
            'total_reseñas' => Reseña::count(),
            'total_contratos' => Contrato::count(),
            'recent_users' => $recent_users,
            'recent_reseñas' => $recent_reseñas,
        ]);
    }
}