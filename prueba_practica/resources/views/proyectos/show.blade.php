@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detalles del Proyecto</h2>
    
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $proyecto['nombre'] }}</h5>
            <p class="card-text">{{ $proyecto['descripcion'] }}</p>
            <a href="{{ route('proyectos.index') }}" class="btn btn-primary">Volver</a>
        </div>
    </div>
</div>
@endsection
