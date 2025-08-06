@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Miembros del Proyecto</h1>

    @if(session('mensaje'))
        <div class="alert alert-success">{{ session('mensaje') }}</div>
    @endif

    <a href="{{ route('usuarios.create') }}" class="btn btn-primary mb-3">Nuevo Usuario</a>

    <ul class="list-group">
        @foreach($usuarios as $usuario)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $usuario['nombre'] }} - {{ $usuario['email'] }}
                <span>
                    <a href="{{ route('usuarios.edit', $usuario['id']) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('usuarios.destroy', $usuario['id']) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar?')">Eliminar</button>
                    </form>
                </span>
            </li>
        @endforeach
    </ul>
</div>
@endsection
