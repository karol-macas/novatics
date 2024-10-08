@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Error en el servidor (500)</h1>
        <p class="text-center">Ha ocurrido un error en el servidor. Por favor, inténtalo más tarde.</p>
        <a href="{{ url('/') }}" class="btn btn-primary">Volver al inicio</a>
    </div>
@endsection
