@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Header del Dashboard -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="display-6 mb-1">
                        <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                    </h1>
                    <p class="text-muted mb-0">Panel de control del sistema de gestión de proyectos</p>
                </div>
                <div class="text-end">
                    <a href="{{ route('proyectos.create') }}" class="btn btn-primary me-2">
                        <i class="fas fa-plus me-1"></i>Nuevo Proyecto
                    </a>
                    <a href="{{ route('tareas.create') }}" class="btn btn-success">
                        <i class="fas fa-tasks me-1"></i>Nueva Tarea
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Información del estado de datos -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="alert alert-info shadow-sm rounded">
                <div class="d-flex align-items-center">
                    <i class="fas fa-database me-2"></i>Estado de los Datos
                </div>
                <div class="row mt-2">
                    <div class="col-md-3">
                        <small><i class="fas fa-project-diagram me-1"></i>{{ $totalProyectos }} proyectos guardados</small>
                    </div>
                    <div class="col-md-3">
                        <small><i class="fas fa-tasks me-1"></i>{{ $totalTareas }} tareas registradas</small>
                    </div>
                    <div class="col-md-3">
                        <small><i class="fas fa-users me-1"></i>{{ $totalUsuarios }} usuarios registrados</small>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('dashboard.reset') }}" class="btn btn-sm btn-outline-warning" 
                           onclick="return confirm('¿Estás seguro? Esto eliminará todos los datos guardados y volverá al estado inicial.')">
                            <i class="fas fa-refresh me-1"></i>Resetear Datos
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Estadísticas principales -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="mb-0">{{ $totalProyectos }}</h4>
                            <small>Proyectos Activos</small>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-project-diagram fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="mb-0">{{ $totalTareas }}</h4>
                            <small>Total de Tareas</small>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-tasks fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="mb-0">{{ $totalUsuarios }}</h4>
                            <small>Miembros del Equipo</small>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="mb-0">{{ $tareasEnProgreso }}</h4>
                            <small>En Progreso</small>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-clock fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Estado de Tareas -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-light">
                    <h5 class="mb-0">
                        <i class="fas fa-chart-pie me-2"></i>Estado de Tareas
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-4">
                            <div class="border-end">
                                <h3 class="text-secondary">{{ $tareasPendientes }}</h3>
                                <p class="text-muted mb-0">Pendientes</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="border-end">
                                <h3 class="text-warning">{{ $tareasEnProgreso }}</h3>
                                <p class="text-muted mb-0">En Progreso</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div>
                                <h3 class="text-success">{{ $tareasCompletadas }}</h3>
                                <p class="text-muted mb-0">Completadas</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Proyectos Recientes -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card shadow h-100">
                <div class="card-header bg-light">
                    <h5 class="mb-0">
                        <i class="fas fa-project-diagram me-2"></i>Proyectos Activos
                    </h5>
                </div>
                <div class="card-body">
                    @if(count($proyectos) > 0)
                        <div class="list-group list-group-flush">
                            @foreach(array_slice($proyectos, 0, 3) as $id => $proyecto)
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">{{ $proyecto['nombre'] }}</h6>
                                        <small class="text-muted">{{ $proyecto['descripcion'] }}</small>
                                    </div>
                                    <div>
                                        <a href="{{ route('proyectos.tareas', $id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-tasks me-1"></i>Ver Tareas
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-3">
                            <i class="fas fa-folder-open fa-2x text-muted mb-2"></i>
                            <p class="text-muted mb-0">No hay proyectos registrados</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Tareas Recientes -->
        <div class="col-md-6">
            <div class="card shadow h-100">
                <div class="card-header bg-light">
                    <h5 class="mb-0">
                        <i class="fas fa-tasks me-2"></i>Tareas Recientes
                    </h5>
                </div>
                <div class="card-body">
                    @if(count($tareas) > 0)
                        <div class="list-group list-group-flush">
                            @foreach(array_slice($tareas, 0, 3) as $tarea)
                                <div class="list-group-item">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h6 class="mb-1">{{ $tarea['titulo'] ?? 'Sin título' }}</h6>
                                        @php
                                            $estado = $tarea['estado'] ?? 'pendiente';
                                            $estadoClass = $estado === 'completada' ? 'bg-success' : ($estado === 'en progreso' ? 'bg-warning' : 'bg-secondary');
                                        @endphp
                                        <span class="badge {{ $estadoClass }} rounded-pill">
                                            {{ ucfirst($estado) }}
                                        </span>
                                    </div>
                                    <p class="mb-1 text-muted small">{{ $tarea['descripcion'] ?? 'Sin descripción' }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-primary">
                                            <i class="fas fa-user me-1"></i>{{ $tarea['usuario_nombre'] ?? 'Sin asignar' }}
                                        </small>
                                        <small class="text-info">
                                            <i class="fas fa-project-diagram me-1"></i>{{ $tarea['proyecto_nombre'] ?? 'Sin proyecto' }}
                                        </small>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-3">
                            <i class="fas fa-clipboard-list fa-2x text-muted mb-2"></i>
                            <p class="text-muted mb-0">No hay tareas registradas</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Acciones Rápidas -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-light">
                    <h5 class="mb-0">
                        <i class="fas fa-bolt me-2"></i>Acciones Rápidas
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <a href="{{ route('proyectos.create') }}" class="btn btn-outline-primary w-100 mb-2">
                                <i class="fas fa-plus me-2"></i>Crear Proyecto
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('tareas.create') }}" class="btn btn-outline-success w-100 mb-2">
                                <i class="fas fa-tasks me-2"></i>Crear Tarea
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('usuarios.create') }}" class="btn btn-outline-info w-100 mb-2">
                                <i class="fas fa-user-plus me-2"></i>Agregar Usuario
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('tareas.index') }}" class="btn btn-outline-secondary w-100 mb-2">
                                <i class="fas fa-list me-2"></i>Ver Todas las Tareas
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

