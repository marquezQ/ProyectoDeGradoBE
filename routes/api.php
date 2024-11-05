<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\ReseñaController;
use App\Http\Controllers\TrabajadorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/ping', function(Request $request){
    return 'pong';
});


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::post('/trabajador', [TrabajadorController::class, 'store']);
Route::get('/trabajador', [TrabajadorController::class, 'index']);

Route::get('/userTrabajador', [AuthController::class, 'isTrabajador']);

Route::get('/contrato', [ContratoController::class, 'index']);
Route::post('/contrato', [ContratoController::class, 'store']);

Route::post('/resenia', [ReseñaController::class, 'store']);