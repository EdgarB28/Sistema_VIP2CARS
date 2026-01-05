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
        return view('reportes.index');
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

    public function exportExcel(Request $request)
    {
        $ordenes = OrdenServicio::with(['cliente', 'vehiculo'])
            ->whereBetween('fecha_ingreso', [
                $request->fecha_inicio,
                $request->fecha_fin
            ])
            ->when($request->estado, function ($q) use ($request) {
                $q->where('estado', $request->estado);
            })
            ->get();

        return response()
            ->view('reportes.ordenes_excel', compact('ordenes'))
            ->header('Content-Type', 'application/vnd.ms-excel')
            ->header('Content-Disposition', 'attachment; filename="reporte_ordenes.xls"');
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
