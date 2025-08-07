<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Proyectos</title>

    <!-- Bootstrap CSS desde public/lib -->
    <link rel="stylesheet" href="{{ asset('lib/bootstrap.min.css') }}">

    <!-- Estilos personalizados opcionales -->
    <style>
        body {
            padding-top: 70px;
            background-color: #f8f9fa;
        }
        footer {
            border-top: 1px solid #dee2e6;
            padding-top: 15px;
        }
        .navbar-brand {
            font-weight: bold;
            letter-spacing: 1px;
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top shadow">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">GestorProyectos</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menuNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('proyectos.index') }}">Proyectos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('tareas.index') }}">Tareas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('usuarios.index') }}">Usuarios</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- CONTENIDO PRINCIPAL -->
    <main class="container mt-4">
        @yield('content')
    </main>

    <!-- PIE DE PÁGINA -->
    <footer class="text-center text-muted mt-5 py-3">
        <div class="container">
            <small>&copy; {{ date('Y') }} - Sistema de Gestión de Proyectos Laravel</small>
        </div>
    </footer>

    <!-- Bootstrap JS desde public/lib -->
    <script src="{{ asset('lib/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
