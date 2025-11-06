@extends('layouts.app')

@section('title', 'Usuarios')

@section('content')
<div class="d-flex justify-content-between align-items-center mt-3 mb-3">
    <h2>Gestión de Usuarios</h2>
    <a href="#" class="btn btn-primary" id="btnNuevoUsuario">+ Nuevo Usuario</a>
</div>

<table id="tablaListaUsuarios" class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>N°</th>
            <th>Nombre Completo</th>
            <th>Correo</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($usuarios as $usuario)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $usuario->name }}</td>
            <td>{{ $usuario->email }}</td>
            <td>{{ $usuario->estado = 1 ? 'Activo' : 'Inactivo' }}</td>
            <td>-</td>

        </tr>
        @empty
        <tr>
            <td colspan="5">No hay Usuarios registrados.</td>
        </tr>
        @endforelse
    </tbody>
</table>

<!-- Modal Nuevo Usuario -->

<div class="modal fade" id="modalNuevoUsuario" tabindex="-1" aria-labelledby="modalNuevoUsuarioLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formNuevoUsuario" method="POST" action="{{ route('usuarios.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nuevo Usuario</h5>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="nomUsu" class="form-label">NOMBRES:</label>
                            <input type="text" class="form-control" id="nomUsu" name="nomUsu" required>
                        </div>

                        <div class="col-12">
                            <label for="correo" class="form-label">CORREO:</label>
                            <input type="text" class="form-control" id="correo" name="correo" required>
                        </div>

                        <div class="col-md-6">
                            <label for="password" class="form-label">CONTRASEÑA:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label">CONFIRMAR:</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>
                        <div class="col-12">
                            <label for="role" class="form-label">Rol:</label>
                            <select id="role" name="role" class="form-select" required>
                                <option value="" disabled selected>Seleccione un rol</option>
                                <option value="admin">Administrador</option>
                                <option value="user">Empleado</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCELAR</button>
                    <button type="submit" class="btn btn-primary">GUARDAR</button>
                </div>
            </div>

        </form>
    </div>
</div>

<script>
    $(document).ready(function() {

        tablaListaUsuarios = $('#tablaListaUsuarios').DataTable({
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

        $('#btnNuevoUsuario').click(function(){
            $('#modalNuevoUsuario').modal('show');
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

@if ($errors->any())
<script>
Swal.fire({
    icon: 'error',
    title: 'Corriga los Datos Ingresados',
    confirmButtonText: 'Entendido'
}); 

</script>
@endif
@endsection



