@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Proyecto</h1>

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

        <form action="{{ route('proyectos.update', $id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del Proyecto</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $proyecto['nombre']) }}">
                @error('nombre')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control">{{ old('descripcion', $proyecto['descripcion']) }}</textarea>
                @error('descripcion')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('proyectos.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
