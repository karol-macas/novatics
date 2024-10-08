@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Página no encontrada</h1>
        <p class="text-center">Lo sentimos, la página que estás buscando no existe.</p>
        <a href="{{ url('/') }}" class="btn btn-primary">Volver al inicio</a>
    </div>
@endsection
