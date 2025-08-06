@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Crear Nueva Tarea</h2>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('tareas.store') }}" method="POST">
                @csrf

                <div class="form-floating mb-3">
                    <input type="text" name="titulo" class="form-control" placeholder="Título">
                    <label for="titulo">Título</label>
                </div>

                <div class="form-floating mb-3">
                    <textarea name="descripcion" class="form-control" placeholder="Descripción" style="height: 120px"></textarea>
                    <label for="descripcion">Descripción</label>
                </div>

                <button type="submit" class="btn btn-success">Guardar Tarea</button>
            </form>
        </div>
    </div>
</div>
@endsection
