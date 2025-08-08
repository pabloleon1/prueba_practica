@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Editar Tarea</h2>

    @if ($errors->any())
        <div class="alert alert-danger shadow-sm rounded">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('tareas.update', $tarea['id']) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="titulo" class="form-label">Título de la Tarea</label>
                    <input type="text" class="form-control @error('titulo') is-invalid @enderror" 
                           id="titulo" name="titulo" value="{{ old('titulo', $tarea['titulo']) }}" required>
                    @error('titulo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea class="form-control @error('descripcion') is-invalid @enderror" 
                              id="descripcion" name="descripcion" rows="3" required>{{ old('descripcion', $tarea['descripcion']) }}</textarea>
                    @error('descripcion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="proyecto_id" class="form-label">Proyecto</label>
                            <select class="form-select @error('proyecto_id') is-invalid @enderror" 
                                    id="proyecto_id" name="proyecto_id" required>
                                <option value="">Seleccionar proyecto</option>
                                @foreach($proyectos as $id => $proyecto)
                                    <option value="{{ $id }}" {{ old('proyecto_id', $tarea['proyecto_id']) == $id ? 'selected' : '' }}>
                                        {{ $proyecto['nombre'] }}
                                    </option>
                                @endforeach
                            </select>
                            @error('proyecto_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="usuario_asignado" class="form-label">Asignar a</label>
                            <select class="form-select @error('usuario_asignado') is-invalid @enderror" 
                                    id="usuario_asignado" name="usuario_asignado" required>
                                <option value="">Seleccionar usuario</option>
                                @foreach($usuarios as $usuario)
                                    <option value="{{ $usuario['id'] }}" {{ old('usuario_asignado', $tarea['usuario_asignado']) == $usuario['id'] ? 'selected' : '' }}>
                                        {{ $usuario['nombre'] }}
                                    </option>
                                @endforeach
                            </select>
                            @error('usuario_asignado')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select class="form-select @error('estado') is-invalid @enderror" 
                                    id="estado" name="estado" required>
                                <option value="">Seleccionar estado</option>
                                <option value="pendiente" {{ old('estado', $tarea['estado']) == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                <option value="en progreso" {{ old('estado', $tarea['estado']) == 'en progreso' ? 'selected' : '' }}>En Progreso</option>
                                <option value="completada" {{ old('estado', $tarea['estado']) == 'completada' ? 'selected' : '' }}>Completada</option>
                            </select>
                            @error('estado')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>Actualizar Tarea
                    </button>
                    <a href="{{ route('tareas.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i>Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
