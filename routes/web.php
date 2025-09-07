<?php

use Illuminate\Support\Facades\Route;

/*Route::get('/clientes', function () {
    return view('clientes.index');
})->name('clientes.index');
    

Route::get('/vehiculos', function () {
    return view('vehiculos.index');
})->name('vehiculos.index');*/

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VehiculoController;

Route::resource('clientes', ClienteController::class);
Route::resource('vehiculos', VehiculoController::class);