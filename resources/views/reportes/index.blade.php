@extends('layouts.app')

@section('title', 'reportes')

@section('content')
<div class="d-flex justify-content-between align-items-center mt-3 mb-3">
    <h2>Reportes</h2>
</div>

<div class="card mb-3">
    <div class="card-body">

        <div class="row align-items-end">

            {{-- FORM FILTROS --}}
            <form id="formReporteOrdenes" class="row col-md-7">
                @csrf

                <div class="col-md-4">
                    <label>Fecha Inicio</label>
                    <input type="date" name="fecha_inicio" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label>Fecha Fin</label>
                    <input type="date" name="fecha_fin" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label>Estado</label>
                    <select name="estado" class="form-select">
                        <option value="">Todos</option>
                        <option value="Pendiente">Pendiente</option>
                        <option value="En Proceso">En Proceso</option>
                        <option value="Finalizado">Finalizado</option>
                    </select>
                </div>
            </form>

            {{-- BOTÓN GENERAR --}}
            <div class="col-md-2">
                <button type="button"
                    id="btnGenerar"
                    class="btn btn-primary w-100">
                    <i class="bi bi-search"></i> Generar
                </button>
            </div>

            {{-- FORM EXCEL --}}
            <div class="col-md-3">
                <form method="POST" action="{{ route('reportes.export.excel') }}">
                    @csrf
                    <input type="hidden" name="fecha_inicio" id="excel_fecha_inicio">
                    <input type="hidden" name="fecha_fin" id="excel_fecha_fin">
                    <input type="hidden" name="estado" id="excel_estado">

                    <button type="submit"
                        id="btnExcel"
                        class="btn btn-success w-100"
                        disabled>
                        <i class="bi bi-file-earmark-excel"></i> Exportar
                    </button>
                </form>
            </div>

        </div>

        <small class="text-muted mt-2 d-block" id="msgExcel">
            Primero genera el reporte para habilitar la exportación
        </small>

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
            let form = $('#formReporteOrdenes');

            $('#excel_fecha_inicio').val(form.find('[name="fecha_inicio"]').val());
            $('#excel_fecha_fin').val(form.find('[name="fecha_fin"]').val());
            $('#excel_estado').val(form.find('[name="estado"]').val());


            $.ajax({
                url: "{{ route('reportes.ordenes') }}",
                type: "POST",
                data: form.serialize(),
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

                    if (res.ordenes.length > 0) {
                        $('#btnExcel').prop('disabled', false);
                        $('#msgExcel').text('Reporte listo para exportar');
                    } else {
                        $('#btnExcel').prop('disabled', true);
                        $('#msgExcel').text('No hay datos para exportar');
                    }

                }
            });
        });

    });
</script>

@endsection