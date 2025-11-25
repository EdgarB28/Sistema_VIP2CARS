@extends('layouts.app')

@section('title', 'ordenes')

@section('content')
<div class="d-flex justify-content-between align-items-center mt-3 mb-3">
    <h2>Ordenes de Servicios</h2>
    <a href="#" class="btn btn-primary" id="btnNuevaOrden">+ Nueva Orden</a>
</div>

<table id="tablaListaOrdenes" class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>N°</th>
            <th>Cliente</th>
            <th>Vehiculo</th>
            <th>Fec. Ingreso</th>
            <th>Fec. Salida</th>
            <th>Estado</th>
            <th>Imp. Total</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($orden_servicio as $ordenes)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $ordenes->cliente->nombre }}</td>
            <td>{{ $ordenes->vehiculo->modelo }}</td>
            <td>{{ $ordenes->fecha_ingreso }}</td>
            <td>{{ $ordenes->fecha_salida }}</td>
            <td>{{ $ordenes->estado }}</td>
            <td>{{ $ordenes->total }}</td>        
            <td>
                <button class="btn btn-sm btn-warning btn-editar"
                    >
                    Editar
                </button>

                 <button class="btn btn-sm btn-success btn-editar"
                    >
                    Detalle
                </button>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5">No hay Vehiculo registrados.</td>
        </tr>
        @endforelse


    </tbody>
</table>

<script>
    $(document).ready(function() {

        tablaListaOrdenes = $('#tablaListaOrdenes').DataTable({
            pageLength: 10,
            paging: false,
            info: false,
            searching: false,
            lengthChange: false,
            ordering: true,
            language: {
                url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
            }
        });



    });
</script>

@endsection