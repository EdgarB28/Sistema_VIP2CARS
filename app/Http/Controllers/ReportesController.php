<?php

namespace App\Http\Controllers;

use App\Models\OrdenServicio;
use Illuminate\Http\Request;

class ReportesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('reportes.ordenes');
    }

    public function ordenes(Request $request)
    {
        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin'    => 'required|date',
            'estado'       => 'nullable|string'
        ]);

        $query = OrdenServicio::with(['cliente', 'vehiculo'])
            ->whereBetween('fecha_ingreso', [
                $request->fecha_inicio,
                $request->fecha_fin
            ]);

        if ($request->estado) {
            $query->where('estado', $request->estado);
        }

        $ordenes = $query->get();

        $total = $ordenes->sum('total');

        return response()->json([
            'ordenes' => $ordenes,
            'total'   => $total
        ]);
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
