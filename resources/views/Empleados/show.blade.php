@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles del Empleado</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $empleados->nombres }} {{ $empleados->apellidos }}</h5>
            <p class="card-text"><strong>Fecha de Nacimiento:</strong> {{ $empleados->fecha_nacimiento }}</p>
            <p class="card-text"><strong>Teléfono:</strong> {{ $empleados->telefono }}</p>
            <p class="card-text"><strong>Celular:</strong> {{ $empleados->celular }}</p>
            <p class="card-text"><strong>Correo Institucional:</strong> {{ $empleados->correo_institucional }}</p>
            <p class="card-text"><strong>Departamento:</strong> {{ $empleados->departamento->nombre }}</p>
            <p class="card-text"><strong>Fecha de Ingreso:</strong> {{ $empleados->fecha_ingreso }}</p>
            @if ($empleados->curriculum)
                <p class="card-text"><strong>Curriculum:</strong> <a href="{{ asset('storage/' . $empleados->curriculum) }}" target="_blank">Ver Curriculum</a></p>
            @endif
            @if ($empleados->contrato)
                <p class="card-text"><strong>Contrato:</strong> <a href="{{ asset('storage/' . $empleados->contrato) }}" target="_blank">Ver Contrato</a></p>
            @endif
            <a href="{{ route('empleados.indexEmpleados') }}" class="btn btn-primary">Volver</a>
        </div>
    </div>
</div>
@endsection
