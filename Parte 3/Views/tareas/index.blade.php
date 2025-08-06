@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">📋 Lista de Tareas</h2>

    <a href="{{ route('tareas.create') }}" class="btn btn-success mb-3">+ Nueva Tarea</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <ul class="list-group">
        @forelse ($tareas as $tarea)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <strong>{{ $tarea['titulo'] }}</strong><br>
                    <small>{{ $tarea['descripcion'] }}</small>
                </div>
                <a href="{{ route('tareas.edit', $tarea['id']) }}" class="btn btn-sm btn-outline-primary">Editar</a>
            </li>
        @empty
            <li class="list-group-item">No hay tareas registradas.</li>
        @endforelse
    </ul>
</div>
@endsection
