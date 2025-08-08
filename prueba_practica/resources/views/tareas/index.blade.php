@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Lista de Tareas</h2>

    @if (session('success'))
        <div class="alert alert-success shadow-sm rounded">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('tareas.create') }}" class="btn btn-primary mb-3 shadow-sm">
        <i class="fas fa-plus me-1"></i>Nueva Tarea
    </a>

    <div class="card shadow">
        <div class="card-body p-0">
            <ul class="list-group list-group-flush">
                @foreach ($tareas as $tarea)
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
                                <span class="text-info">
                                    <i class="fas fa-project-diagram me-1"></i>
                                    <strong>Proyecto:</strong> {{ $tarea['proyecto_nombre'] ?? 'Sin proyecto' }}
                                </span>
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
        </div>
    </div>
</div>
@endsection
