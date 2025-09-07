<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::where('estado', 1)->get();
        return view('clientes.index', compact('clientes'));
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
            'nombre' => 'required|string|max:100',
            'apellidos' => 'required|string|max:150',
            'nro_documento' => 'required|string|max:20|unique:clientes,nro_documento',
            'correo' => 'nullable|email|unique:clientes,correo',
            'telefono' => 'nullable|string|max:20',
        ]);

        Cliente::create([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'nro_documento' => $request->nro_documento,
            'correo' => $request->correo,
            'telefono' => $request->telefono,
            'estado' => 1,
            'f_creacion' => now(),
        ]);

        return redirect()->route('clientes.index')->with('success', 'Cliente creado correctamente');
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
        $cliente = Cliente::findOrFail($id);
        $cliente->correo = $request->correo;
        $cliente->telefono = $request->telefono;
        $cliente->save();

        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->estado = 0;
        $cliente->save();

        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado correctamente');
    }
}
