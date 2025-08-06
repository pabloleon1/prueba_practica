@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center">📊 Dashboard General</h2>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">📁 Proyectos</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @foreach ($proyectos as $proyecto)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $proyecto['nombre'] }}
                                <span class="badge bg-secondary">{{ $proyecto['miembros'] }} miembros</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">📝 Tareas</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @foreach ($tareas as $tarea)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $tarea['titulo'] }}
                                <span class="badge bg-info text-dark">{{ $tarea['estado'] }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
