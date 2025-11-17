<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class usuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = Usuarios::get();
        return view('usuarios.index', compact('usuarios'));
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
            'nomUsu' => 'required|string|max:255',
            'correo' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'role' => 'required|string',
        ]);

        // Crear vehículo
        usuarios::create([
            'name' => $request->nomUsu,
            'email' => $request->correo,
            'role' => $request->role,
            'password' => Hash::make($request->password), 
            'estado' => 1,
            'created_at' => now(),
        ]);

        // Redirigir con mensaje
        return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente');
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
    public function update(Request $request, string $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        $usuarios = Usuarios::findOrFail($id);
        $usuarios->estado=0;
        $usuarios->save();
        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente');

    }
}
