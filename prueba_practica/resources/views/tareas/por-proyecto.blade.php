@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Tareas del Proyecto</h2>
            <h4 class="text-primary mb-0">{{ $proyecto['nombre'] ?? 'Proyecto' }}</h4>
            <small class="text-muted">{{ $proyecto['descripcion'] ?? 'Sin descripción' }}</small>
        </div>
        <div>
            <a href="{{ route('tareas.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>Nueva Tarea
            </a>
            <a href="{{ route('proyectos.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i>Volver a Proyectos
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success shadow-sm rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow">
        <div class="card-header bg-light">
            <h5 class="mb-0">
                <i class="fas fa-tasks me-2"></i>
                {{ count($tareasProyecto) }} Tareas en este proyecto
            </h5>
        </div>
        <div class="card-body p-0">
            @if(count($tareasProyecto) > 0)
                <ul class="list-group list-group-flush">
                    @foreach ($tareasProyecto as $tarea)
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="mb-1">{{ $tarea['titulo'] ?? 'Sin título' }}</h5>
                                    @php
                                        $estado = $tarea['estado'] ?? 'pendiente';
                                        $estadoClass = $estado === 'completada' ? 'bg-success' : ($estado === 'en progreso' ? 'bg-warning' : 'bg-secondary');
                                    @endphp
                                    <span class="badge {{ $estadoClass }} rounded-pill">
                                        {{ ucfirst($estado) }}
                                    </span>
                                </div>
                                <p class="mb-2 text-muted">{{ $tarea['descripcion'] ?? 'Sin descripción' }}</p>
                                <div class="d-flex gap-3 text-sm">
                                    <span class="text-primary">
                                        <i class="fas fa-user me-1"></i>
                                        <strong>Asignado a:</strong> {{ $tarea['usuario_nombre'] ?? 'Sin asignar' }}
                                    </span>
                                </div>
                            </div>
                            <div class="ms-3">
                                <a href="{{ route('tareas.edit', $tarea['id']) }}" class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-edit me-1"></i>Editar
                                </a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-clipboard-list fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No hay tareas en este proyecto</h5>
                    <p class="text-muted">Crea la primera tarea para comenzar a trabajar</p>
                    <a href="{{ route('tareas.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i>Crear Primera Tarea
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
