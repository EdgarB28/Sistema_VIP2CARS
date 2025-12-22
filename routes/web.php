<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\usuariosController;
use App\Http\Controllers\OrdenServicioController;
use App\Http\Controllers\reportesController;

// Rutas públicas
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas protegidas por login
Route::middleware('auth')->group(function () {
    Route::resource('clientes', ClienteController::class);
    Route::resource('vehiculos', VehiculoController::class);
    Route::resource('usuarios', usuariosController::class);
    Route::resource('ordenes_servicio', OrdenServicioController::class);


    Route::get('/reportes', [ReportesController::class, 'index'])
        ->name('reportes.index');

    Route::post('/reportes/ordenes', [ReportesController::class, 'ordenes'])
        ->name('reportes.ordenes');
});
