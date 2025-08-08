@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Usuario</h1>

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

    <form action="{{ route('usuarios.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
            @error('nombre')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection
