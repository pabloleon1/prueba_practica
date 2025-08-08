@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Lista de Proyectos</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('proyectos.create') }}" class="btn btn-primary mb-3">+ Nuevo Proyecto</a>

        <ul class="list-group">
            @foreach ($proyectos as $id => $proyecto)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $proyecto['nombre'] }}</strong><br>
                        <small>{{ $proyecto['descripcion'] }}</small>
                    </div>
                    <div>
                        <a href="{{ route('proyectos.tareas', $id) }}" class="btn btn-sm btn-info">
                            <i class="fas fa-tasks me-1"></i>Tareas
                        </a>
                        <a href="{{ route('proyectos.show', $id) }}" class="btn btn-sm btn-info">Ver</a>
                        <a href="{{ route('proyectos.edit', $id) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('proyectos.destroy', $id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este proyecto?')">Eliminar</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
