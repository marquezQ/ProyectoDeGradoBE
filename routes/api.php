<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ReseñaController;
use App\Http\Controllers\TrabajadorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// RUTAS PÚBLICAS 
Route::get('/ping', fn() => 'pong');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/verify-email', [AuthController::class, 'verifyEmail']);
Route::get('/user/{id}', [AuthController::class, 'getUser']);
Route::get('/userTrabajador/{id}', [AuthController::class, 'isTrabajador']);
Route::get('/trabajador', [TrabajadorController::class, 'index']);


// RUTAS PROTEGIDAS CON SANCTUM
Route::middleware(['auth:sanctum'])->group(function () {

    // Usuario autenticado
    Route::get('/user', fn(Request $request) => $request->user());
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/user/{id}', [AuthController::class, 'updateUser']);

    // Trabajadores
    Route::post('/trabajador', [TrabajadorController::class, 'store']);
    Route::get('/trabajador/{id}', [TrabajadorController::class, 'getTrabajador']);
    Route::patch('/trabajador/{id}/info', [TrabajadorController::class, 'updateInfo']);
    Route::post('/trabajador/{id}/images', [TrabajadorController::class, 'updateImages']);

    // Contratos
    Route::get('/contrato', [ContratoController::class, 'index']);
    Route::post('/contrato', [ContratoController::class, 'store']);
    Route::get('/contrato/{trabajador_id}/{cliente_id}', [ContratoController::class, 'getContratosByTrabajadorAndCliente']);
    Route::get('/contrato/{trabajador_id}', [ContratoController::class, 'getContratosByTrabajador']);
    Route::put('/contrato/{id}', [ContratoController::class, 'update']);
    Route::patch('/contrato/{id}/status', [ContratoController::class, 'updatePartial']);
    Route::delete('/contrato/{id}', [ContratoController::class, 'destroy']);

    // Reseñas
    Route::post('/resenia', [ReseñaController::class, 'store']);
    Route::get('/resenia/trabajador/{id}', [ReseñaController::class, 'getReseniaByTrabajId']);
    Route::get('/resenia/user/{id}', [ReseñaController::class, 'getReseniaByUserId']);
    Route::get('/resenia/{id}', [ReseñaController::class, 'getReseniaById']);

    // Productos
    Route::get('/productos', [ProductoController::class, 'index']);
    Route::post('/productos', [ProductoController::class, 'store']);
    Route::get('/productos/{id}', [ProductoController::class, 'productsByTrabajadorId']);
    Route::put('/productos/{id}', [ProductoController::class, 'update']);
    Route::delete('/productos/{id}', [ProductoController::class, 'destroy']);
});

