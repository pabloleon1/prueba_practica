@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Lista de Tareas</h2>

    @if (session('success'))
        <div class="alert alert-success shadow-sm rounded">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('tareas.create') }}" class="btn btn-primary mb-3 shadow-sm">+ Nueva Tarea</a>

    <div class="card shadow">
        <div class="card-body p-0">
            <ul class="list-group list-group-flush">
                @foreach ($tareas as $tarea)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-1">{{ $tarea['titulo'] }}</h5>
                            <p class="mb-0 text-muted">{{ $tarea['descripcion'] }}</p>
                        </div>
                        <a href="{{ route('tareas.edit', $tarea['id']) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
