<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use App\Models\Cliente;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehiculos = Vehiculo::with('cliente')->where('estado', 1)->get();
        $clientes = Cliente::where('estado', 1)->get();

        return view('vehiculos.index', compact('vehiculos', 'clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_cliente' => 'required|exists:clientes,id_cliente',
            'marca' => 'required|string|max:50',
            'modelo' => 'required|string|max:50',
            'anio_fabricacion' => 'required|integer|min:1900|max:' . date('Y'),
            'placa' => 'required|string|max:10|unique:vehiculos,placa',
        ]);

        // Crear vehículo
        Vehiculo::create([
            'id_cliente' => $request->id_cliente,
            'marca' => $request->marca,
            'modelo' => $request->modelo,
            'anio_fabricacion' => $request->anio_fabricacion,
            'placa' => $request->placa,
            'estado' => 1,
            'f_creacion' => now(),
        ]);

        // Redirigir con mensaje
        return redirect()->route('vehiculos.index')->with('success', 'Vehiculo creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $vehiculos = Vehiculo::findOrFail($id);
        $vehiculos->marca = $request->marca;
        $vehiculos->modelo = $request->modelo;
        $vehiculos->save();

        return redirect()->route('vehiculos.index')->with('success', 'Vehiculo actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vehiculos = Vehiculo::findOrFail($id);
        $vehiculos->estado = 0;
        $vehiculos->save();

        return redirect()->route('vehiculos.index')->with('success', 'Vehiculo eliminado correctamente');
    }
}
