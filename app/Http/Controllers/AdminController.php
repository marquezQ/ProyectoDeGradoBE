<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AdminService;

class AdminController extends Controller
{
    protected $adminService;

    // Inyectamos el servicio
    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function getAllUsers()
    {
        $users = $this->adminService->getAllUsers();
        return response()->json($users);
    }

    public function getAllCarpinteros()
    {
        $carpinteros = $this->adminService->getAllCarpinteros();
        return response()->json($carpinteros);
    }

    public function getAllProductos()
    {
        $productos = $this->adminService->getAllProductos();
        return response()->json($productos);
    }

    public function getAllReseñas()
    {
        $reseñas = $this->adminService->getAllResenas();
        return response()->json($reseñas);
    }

    public function getAllContratos()
    {
        $contratos = $this->adminService->getAllContratos();
        return response()->json($contratos);
    }

    public function deleteUser($id)
    {
        $result = $this->adminService->deleteUser($id);

        if ($result['status'] === 404) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        if ($result['status'] === 403) {
            return response()->json(['message' => $result['message']], 403);
        }

        return response()->json(['message' => $result['message']]);
    }

    public function deleteCarpintero($id)
    {
        $deleted = $this->adminService->deleteCarpintero($id);

        if (!$deleted) {
            return response()->json(['message' => 'Carpintero no encontrado'], 404); // Respetando mensaje original implicitamente
        }

        return response()->json(['message' => 'Carpintero eliminado correctamente']);
    }

    public function deleteProducto($id)
    {
        $deleted = $this->adminService->deleteProducto($id);

        if (!$deleted) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        return response()->json(['message' => 'Producto eliminado correctamente']);
    }

    public function deleteReseña($id)
    {
        $deleted = $this->adminService->deleteResena($id);

        if (!$deleted) {
            return response()->json(['message' => 'Reseña no encontrada'], 404);
        }

        return response()->json(['message' => 'Reseña eliminada correctamente']);
    }

    public function deleteContrato($id)
    {
        $deleted = $this->adminService->deleteContrato($id);

        if (!$deleted) {
            return response()->json(['message' => 'Contrato no encontrado'], 404);
        }

        return response()->json(['message' => 'Contrato eliminado correctamente']);
    }

    public function getDashboardStats()
    {
        $stats = $this->adminService->getDashboardStats();
        return response()->json($stats);
    }
}