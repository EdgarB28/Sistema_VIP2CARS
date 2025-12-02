<?php

namespace App\Http\Controllers;


use App\Models\Cliente;
use App\Models\Vehiculo;
use App\Models\OrdenServicio;
use Illuminate\Http\Request;

class OrdenServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orden_servicio = OrdenServicio::with('vehiculo', 'cliente')->get();
        $vehiculo = Vehiculo::get();
        $cliente = Cliente::get();

        return view('ordenes_servicio.index', compact('orden_servicio', 'vehiculo', 'cliente'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $orden = OrdenServicio::with('cliente', 'vehiculo')->findOrFail($id);

        return response()->json([
            'id' => $orden->id,
            'descripcion' => $orden->descripcion,
            'estado' => $orden->estado,
            'fecha_ingreso' => $orden->fecha_ingreso,
            'fecha_ingreso_formato' => $orden->fecha_ingreso ? date('Y-m-d\TH:i', strtotime($orden->fecha_ingreso)) : null,
            'fecha_salida' => $orden->fecha_salida,
            'total' => $orden->total,
            'cliente' => $orden->cliente,
            'vehiculo' => $orden->vehiculo
        ]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
