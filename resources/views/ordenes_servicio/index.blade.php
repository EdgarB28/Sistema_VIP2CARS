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
                    data-id="{{ $ordenes->id}}">
                    Editar
                </button>


                <button class="btn btn-sm btn-success btn-detalle"
                    data-id="{{ $ordenes->id }}">
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


<!-- Modal Crear Orden de Servicio -->
<div class="modal fade" id="modalCrearOrden" tabindex="-1" aria-labelledby="modalCrearOrdenLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalCrearOrdenLabel">Nueva Orden de Servicio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="formCrearOrden">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-6">
                            <label class="form-label">Cliente</label>
                            <select class="form-select" name="id_cliente" required>
                                <option value="">Seleccione Cliente</option>
                                @foreach($cliente as $c)
                                <option value="{{ $c->id }}">{{ $c->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-6">
                            <label class="form-label">Vehículo</label>
                            <select class="form-select" name="id_vehiculo" required>
                                <option value="">Seleccione Vehículo</option>
                                @foreach($vehiculo as $v)
                                <option value="{{ $v->id }}">{{ $v->marca }} - {{ $v->placa }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea class="form-control" name="descripcion" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Estado</label>
                        <select class="form-select" name="estado" required>
                            <option value="Pendiente">Pendiente</option>
                            <option value="En Proceso">En Proceso</option>
                            <option value="Finalizado">Finalizado</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label class="form-label">Fecha de Ingreso</label>
                            <input type="datetime-local" class="form-control" name="fecha_ingreso" required>
                        </div>

                        <div class="col-6">
                            <label class="form-label">Fecha de Salida</label>
                            <input type="datetime-local" class="form-control" name="fecha_salida">
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-4">
                            <label class="form-label">Total Mano de Obra</label>
                            <input type="number" step="0.01" class="form-control" name="total_mano_obra" required>
                        </div>

                        <div class="col-4">
                            <label class="form-label">Total Repuestos</label>
                            <input type="number" step="0.01" class="form-control" name="total_repuestos" required>
                        </div>

                        <div class="col-4">
                            <label class="form-label">Total Final</label>
                            <input type="number" step="0.01" class="form-control" name="total" required>
                        </div>
                    </div>
                    <div id="erroresCrearOrden" class="text-danger mt-2"></div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Orden</button>
                </div>

            </form>

        </div>
    </div>
</div>

<!-- Modal Editar Orden -->
<div class="modal fade" id="modalEditarOrden" tabindex="-1" aria-labelledby="modalEditarOrden" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title" id="modalEditarOrdenLabel">Editar Orden de Servicio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formEditarOrden">
                <input type="hidden" id="id_orden" name="id_orden">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label">Estado</label>
                            <select class="form-select" name="estado" id="estado" required>
                                <option value="Pendiente">Pendiente</option>
                                <option value="En Proceso">En Proceso</option>
                                <option value="Finalizado">Finalizado</option>
                            </select>
                        </div>

                        <div class="col-6 mb-3">
                            <label class="form-label">Fecha de Ingreso</label>
                            <input type="datetime-local" class="form-control" name="fecha_ingreso" id="fecha_ingreso" required>
                        </div>

                        <div class="col-6" id="div_fecha_salida" style="display:none;">
                            <label class="form-label">Fecha de Salida</label>
                            <input type="datetime-local" class="form-control" name="fecha_salida" id="fecha_salida">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Descripción</label>
                            <textarea class="form-control" name="descripcion" id="descripcion" rows="3" required></textarea>
                        </div>

                    </div>

                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label">Total Mano Obra</label>
                            <input type="number" min="0" class="form-control" name="total_mano_obra"
                                id="totManoObra">
                        </div>

                        <div class="col-6">
                            <label class="form-label">Total Repuestos</label>
                            <input type="number" min="0" class="form-control" name="total_repuestos"
                                id="totRepuestos">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Editar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Detalle Orden -->
<div class="modal fade" id="modalDetalleOrden" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">Detalle Orden de Servicio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="row">

                    <div class="col-6 mb-3">
                        <label class="form-label">Estado</label>
                        <select class="form-select" id="det_estado" disabled>
                            <option value="Pendiente">Pendiente</option>
                            <option value="En Proceso">En Proceso</option>
                            <option value="Finalizado">Finalizado</option>
                        </select>
                    </div>

                    <div class="col-6 mb-3">
                        <label class="form-label">Fecha de Ingreso</label>
                        <input type="datetime-local" class="form-control" id="det_fecha_ingreso" readonly>
                    </div>

                    <div class="col-6 mb-3" id="det_div_fecha_salida" style="display:none;">
                        <label class="form-label">Fecha de Salida</label>
                        <input type="datetime-local" class="form-control" id="det_fecha_salida" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea class="form-control" id="det_descripcion" rows="3" readonly></textarea>
                    </div>

                </div>

                <div class="row mb-3">
                    <div class="col-6">
                        <label class="form-label">Total Mano Obra</label>
                        <input type="number" class="form-control" id="det_mano_obra" readonly>
                    </div>

                    <div class="col-6">
                        <label class="form-label">Total Repuestos</label>
                        <input type="number" class="form-control" id="det_repuestos" readonly>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>



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

        $('#btnNuevaOrden').click(function() {
            $('#modalCrearOrden').modal('show');
        });

        $(document).on('click', '.btn-editar', function() {
            let codigo = $(this).data('id');
            $.ajax({
                url: `/ordenes_servicio/${codigo}`,
                type: "GET",
                success: function(res) {
                    let estado = res.estado;

                    if (estado == 'Finalizado') {
                        msjFinal('2', 'LA ORDEN SE ENCUENTRA FINALIZADA');
                        return;
                    }
                    $('#fecha_ingreso').val(res.fecha_ingreso_formato);
                    $('#estado').val(res.estado);
                    $('#descripcion').val(res.descripcion || 0);
                    $('#totManoObra').val(res.total_mano_obra || 0);
                    $('#totRepuestos').val(res.total_repuestos || 0);
                    $('#id_orden').val(res.id);

                    $('#modalEditarOrden').modal('show');

                }
            });
        });

        $(document).on('change', '#estado', function() {
            if ($(this).val() === 'Finalizado') {
                $('#div_fecha_salida').show();
                $('#fecha_salida').attr('required', true);
            } else {
                $('#div_fecha_salida').hide();
                $('#fecha_salida').removeAttr('required').val('');
            }
        });


        $('#formEditarOrden').on('submit', function(e) {
            e.preventDefault();

            let id = $('#id_orden').val();

            $.ajax({
                url: `/ordenes_servicio/${id}`,
                type: "PUT",
                data: $(this).serialize() + "&_token={{ csrf_token() }}",
                success: function(res) {
                    Swal.fire('OK', res.message, 'success');
                    setTimeout(() => location.reload(), 1200);
                }
            });
        });

        $(document).on('click', '.btn-detalle', function() {

            let id = $(this).data('id');

            $.ajax({
                url: `/ordenes_servicio/${id}`,
                type: 'GET',
                success: function(res) {

                    $('#det_estado').val(res.estado);
                    $('#det_fecha_ingreso').val(res.fecha_ingreso_formato);
                    $('#det_descripcion').val(res.descripcion);
                    $('#det_mano_obra').val(res.total_mano_obra ?? 0);
                    $('#det_repuestos').val(res.total_repuestos ?? 0);

                    if (res.estado === 'Finalizado' && res.fecha_salida) {
                        $('#det_div_fecha_salida').show();
                        $('#det_fecha_salida').val(res.fecha_salida.replace(' ', 'T'));
                    } else {
                        $('#det_div_fecha_salida').hide();
                    }

                    $('#modalDetalleOrden').modal('show');
                }
            });
        });


    });


    function msjFinal(codigo, text) {
        let icon = 'warning';

        if (codigo == 1) {
            icon = 'success';
        }
        Swal.fire({
            title: 'MENSAJE',
            text: text,
            icon: icon
        })
    }
</script>

@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: "{{ session('success') }}",
        showConfirmButton: false,
        timer: 2000
    });
</script>
@endif

@endsection