@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $proyecto['nombre'] }}</h1>
        <p>{{ $proyecto['descripcion'] }}</p>

        <a href="{{ route('proyectos.index') }}" class="btn btn-secondary">Volver</a>
    </div>
@endsection
