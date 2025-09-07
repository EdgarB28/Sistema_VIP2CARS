@extends('layouts.app')

@section('title', 'Clientes')

@section('content')
<div class="d-flex justify-content-between align-items-center mt-3 mb-3">
    <h2>Gestión de Clientes</h2>
    <a href="#" class="btn btn-primary" id="btnNuevoCliente">+ Nuevo Cliente</a>
</div>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>N° Documento</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Email</th>
            <th>Teléfono</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($clientes as $cliente)
        <tr>
            <td>{{ $cliente->nro_documento }}</td>
            <td>{{ $cliente->nombre }}</td>
            <td>{{ $cliente->apellidos }}</td>
            <td>{{ $cliente->correo }}</td>
            <td>{{ $cliente->telefono }}</td>
            <td>
                <button class="btn btn-sm btn-warning btn-editar"
                    data-id="{{ $cliente->id_cliente }}"
                    data-correo="{{ $cliente->correo }}"
                    data-telefono="{{ $cliente->telefono }}">
                    Editar
                </button>

                <form action="{{ route('clientes.destroy', $cliente->id_cliente) }}" method="POST" class="form-eliminar" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5">No hay clientes registrados.</td>
        </tr>
        @endforelse
    </tbody>
</table>

<!-- Modal Editar Cliente -->
<div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formEditar" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditarLabel">Editar Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo</label>
                        <input type="email" class="form-control" id="correo" name="correo" required>
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" required>
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

<!-- Modal Nuevo Cliente -->
<div class="modal fade" id="modalNuevo" tabindex="-1" aria-labelledby="modalNuevoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formNuevo" method="POST" action="{{ route('clientes.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalNuevoLabel">Nuevo Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="apellidos" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                    </div>
                    <div class="mb-3">
                        <label for="nro_documento" class="form-label">Nro. Documento</label>
                        <input type="text" class="form-control" id="nro_documento" name="nro_documento" required>
                    </div>
                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo</label>
                        <input type="email" class="form-control" id="correo" name="correo">
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cliente</button>
                </div>
            </div>
        </form>
    </div>
</div>


<script>
    $(document).ready(function() {

        $('.btn-editar').click(function() {
            let id = $(this).data('id');
            let correo = $(this).data('correo');
            let telefono = $(this).data('telefono');

            $('#correo').val(correo);
            $('#telefono').val(telefono);

            $('#formEditar').attr('action', '/clientes/' + id);

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

        $('#btnNuevoCliente').click(function() {
            $('#formNuevo')[0].reset(); 
            var modalNuevo = new bootstrap.Modal(document.getElementById('modalNuevo'));
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