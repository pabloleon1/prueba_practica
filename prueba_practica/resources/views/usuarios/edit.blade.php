@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Usuario</h1>

    <!-- Mostrar errores generales -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Revisa los siguientes errores:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('usuarios.update', $usuario['id']) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" value="{{ old('nombre', $usuario['nombre']) }}" class="form-control" required>
            @error('nombre')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email', $usuario['email']) }}" class="form-control" required>
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
