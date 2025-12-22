@extends('layouts.app')

@section('title', 'reportes')

@section('content')
<div class="d-flex justify-content-between align-items-center mt-3 mb-3">
    <h2>Reportes</h2>
</div>

<div class="card mb-3">
    <div class="card-body">
        <form id="formReporteOrdenes">
            <div class="row">
                <div class="col-md-3">
                    <label>Fecha Inicio</label>
                    <input type="date" name="fecha_inicio" class="form-control" required>
                </div>

                <div class="col-md-3">
                    <label>Fecha Fin</label>
                    <input type="date" name="fecha_fin" class="form-control" required>
                </div>

                <div class="col-md-3">
                    <label>Estado</label>
                    <select name="estado" class="form-select">
                        <option value="">Todos</option>
                        <option value="Pendiente">Pendiente</option>
                        <option value="En Proceso">En Proceso</option>
                        <option value="Finalizado">Finalizado</option>
                    </select>
                </div>

                <div class="col-md-3 d-flex align-items-end">
                    <button class="btn btn-primary w-100" id="btnGenerar">
                        Generar Reporte
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<table class="table table-bordered" id="tablaReporte">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Cliente</th>
            <th>Vehículo</th>
            <th>Estado</th>
            <th>Fecha</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>

<h5 class="mt-3">Total: S/ <span id="totalReporte">0.00</span></h5>


<script>
    $(document).ready(function() {
        $('#btnGenerar').on('click', function() {
            $.ajax({
                url: "{{ route('reportes.ordenes') }}",
                type: "POST",
                data: $('#formReporteOrdenes').serialize(),
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(res) {
                    let html = '';
                    let i = 1;

                    res.ordenes.forEach(o => {
                        html += `
                    <tr>
                        <td>${i++}</td>
                        <td>${o.cliente.nombre}</td>
                        <td>${o.vehiculo.modelo}</td>
                        <td>${o.estado}</td>
                        <td>${o.fecha_ingreso}</td>
                        <td>S/ ${parseFloat(o.total).toFixed(2)}</td>
                    </tr>
                `;
                    });

                    $('#tablaReporte tbody').html(html);
                    $('#totalReporte').text(res.total.toFixed(2));
                }
            });
        });

    });
</script>

@endsection