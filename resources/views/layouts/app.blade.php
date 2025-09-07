<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Mi CRUD Laravel')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            display: flex;
            min-height: 100vh;
            margin: 0;
        }
        .sidebar {
            width: 220px;
            background-color: #343a40;
            color: white;
            padding: 1rem;
        }
        .sidebar h4 {
            color: #f8f9fa;
        }
        .sidebar a {
            color: #f8f9fa;
            text-decoration: none;
            display: block;
            padding: .5rem 0;
        }
        .sidebar a:hover {
            background: #495057;
            border-radius: 5px;
            padding-left: .5rem;
        }
        .content {
            flex: 1;
            padding: 2rem;
        }
    </style>
</head>
<body>

    <!-- Menú lateral -->
    <div class="sidebar">
        <h4>Menú</h4>
        <a href="{{ route('clientes.index') }}">👥 Clientes</a>
        <a href="{{ route('vehiculos.index') }}">🚗 Vehículos</a>
    </div>

    <!-- Contenido dinámico -->
    <div class="content">
        @yield('content')
    </div>

</body>
</html>
