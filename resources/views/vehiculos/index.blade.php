@extends('layouts.app')

@section('title', 'Vehículos')

@section('content')
<div class="d-flex justify-content-between align-items-center mt-3 mb-3">
    <h2>Gestión de Vehículos</h2>
    <a href="#" class="btn btn-primary" id ="btnNuevoVehiculo">+ Nuevo Vehiculo</a>
</div>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>Cliente</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Año Fac.</th>
            <th>Placa</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($vehiculos as $vehiculo)
        <tr>
            <td>{{ $vehiculo->cliente->nro_documento }} - {{ $vehiculo->cliente->nombre }} {{ $vehiculo->cliente->apellidos }}</td>
            <td>{{ $vehiculo->marca }}</td>
            <td>{{ $vehiculo->modelo }}</td>
            <td>{{ $vehiculo->anio_fabricacion }}</td>
            <td>{{ $vehiculo->placa }}</td>

            <td>
                <button class="btn btn-sm btn-warning btn-editar"
                    data-id="{{ $vehiculo->id_vehiculo }}"
                    data-marca="{{ $vehiculo->marca }}"
                    data-modelo="{{ $vehiculo->modelo }}">
                    Editar
                </button>

                <form action="{{ route('vehiculos.destroy', $vehiculo->id_vehiculo) }}" method="POST" class="form-eliminar" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5">No hay Vehiculo registrados.</td>
        </tr>
        @endforelse
    </tbody>
</table>
<!-- Modal Editar Vehiculo -->
<div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formEditar" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditarLabel">Editar Vehiculo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="marca" class="form-label">Marca</label>
                        <input type="text" class="form-control" id="marca" name="marca" required>
                    </div>
                    <div class="mb-3">
                        <label for="modelo" class="form-label">Modelo</label>
                        <input type="text" class="form-control" id="modelo" name="modelo" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Nuevo Vehículo -->
<div class="modal fade" id="modalNuevoVehiculo" tabindex="-1" aria-labelledby="modalNuevoVehiculoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formNuevoVehiculo" method="POST" action="{{ route('vehiculos.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalNuevoVehiculoLabel">Nuevo Vehículo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="id_cliente" class="form-label">Cliente</label>
                        <select name="id_cliente" id="id_cliente" class="form-control" required>
                            <option value="">Selecciona un cliente</option>
                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id_cliente }}">
                                    {{ $cliente->nombre }} {{ $cliente->apellidos }} - {{ $cliente->nro_documento }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="marca" class="form-label">Marca</label>
                        <input type="text" class="form-control" id="marca" name="marca" required>
                    </div>
                    <div class="mb-3">
                        <label for="modelo" class="form-label">Modelo</label>
                        <input type="text" class="form-control" id="modelo" name="modelo" required>
                    </div>
                    <div class="mb-3">
                        <label for="anio_fabricacion" class="form-label">Año de Fabricación</label>
                        <input type="number" class="form-control" id="anio_fabricacion" name="anio_fabricacion" min="1900" max="{{ date('Y') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="placa" class="form-label">Placa</label>
                        <input type="text" class="form-control" id="placa" name="placa" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Vehículo</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {

        $('.btn-editar').click(function() {
            let id = $(this).data('id');
            let marca = $(this).data('marca');
            let modelo = $(this).data('modelo');

            $('#marca').val(marca);
            $('#modelo').val(modelo);

            $('#formEditar').attr('action', '/vehiculos/' + id);

            $('#modalEditar').modal('show');
        });

        $('.form-eliminar').submit(function(e) {
            e.preventDefault();
            const form = $(this);

            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, continuar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.off('submit');
                    form.submit();
                }
            });
        });

        $('#btnNuevoVehiculo').click(function() {
            $('#formNuevoVehiculo')[0].reset();  
            var modalNuevo = new bootstrap.Modal(document.getElementById('modalNuevoVehiculo'));
            modalNuevo.show();
        });

    });
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