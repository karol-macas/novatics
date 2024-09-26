@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Empleado</h1>
        <form action="{{ route('empleados.update', $empleados->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nombre1">Nombres</label>
                <input type="text" class="form-control" id="nombre1" name="nombre1" value="{{ $empleados->nombre1 }}"
                    required>
            </div>

            <div class="form-group">
                <label for="apellido1">Apellidos</label>
                <input type="text" class="form-control" id="apellido1" name="apellido1"
                    value="{{ $empleados->apellido1 }}" required>
            </div>
            <div class="form-group">
                <label for="nombre2">Nombres</label>
                <input type="text" class="form-control" id="nombre2" name="nombre2" value="{{ $empleados->nombre2 }}"
                    required>
            </div>

            <div class="form-group">
                <label for="apellido2">Apellidos</label>
                <input type="text" class="form-control" id="apellido2" name="apellido2"
                    value="{{ $empleados->apellido2 }}" required>
            </div>
            <div class="form-group">
                <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento"
                    value="{{ $empleados->fecha_nacimiento }}" required>
            </div>
            <div class="form-group">
                <label for="cedula">Cédula</label>
                <input type="text" class="form-control" id="cedula" name="cedula" value="{{ $empleados->cedula }}"
                    required>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono"
                    value="{{ $empleados->telefono }}">
            </div>

            <div class="form-group">
                <label for="celular">Celular</label>
                <input type="text" class="form-control" id="celular" name="celular" value="{{ $empleados->celular }}"
                    required>
            </div>

            <div class="form-group">
                <label for="correo_institucional">Correo Institucional</label>
                <input type="email" class="form-control" id="correo_institucional" name="correo_institucional"
                    value="{{ $empleados->correo_institucional }}" required>
            </div>

            <div class="form-group">
                <label for="departamento_id">Departamento</label>
                <select class="form-control" id="departamento_id" name="departamento_id" required>
                    @foreach ($departamentos as $departamento)
                        <option value="{{ $departamento->id }}"
                            {{ $empleados->departamento_id == $departamento->id ? 'selected' : '' }}>
                            {{ $departamento->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="curriculum">Curriculum</label>
                <input type="file" class="form-control" id="curriculum" name="curriculum">
                @if ($empleados->curriculum)
                    <p>Archivo actual: <a href="{{ asset('storage/' . $empleados->curriculum) }}" target="_blank">Ver
                            Curriculum</a></p>
                @endif
            </div>

            <div class="form-group">
                <label for="contrato">Contrato</label>
                <input type="file" class="form-control" id="contrato" name="contrato">
                @if ($empleados->contrato)
                    <p>Archivo actual: <a href="{{ asset('storage/' . $empleados->contrato) }}" target="_blank">Ver
                            Contrato</a></p>
                @endif
            </div>

            <div class="form-group">
                <label for="contrato_confidencialidad">Contrato de Confidencialidad</label>
                <input type="file" class="form-control" id="contrato_confidencialidad" name="contrato_confidencialidad">
                @if ($empleados->contrato_confidencialidad)
                    <p>Archivo actual: <a href="{{ asset('storage/' . $empleados->contrato_confidencialidad) }}"
                            target="_blank">Ver Contrato de Confidencialidad</a></p>
                @endif
            </div>

            <div class="form-group">
                <label for="contrato_consentimiento">Contrato de Consentimiento de Datos</label>
                <input type="file" class="form-control" id="contrato_consentimiento" name="contrato_consentimiento">
                @if ($empleados->contrato_consentimiento)
                    <p>Archivo actual: <a href="{{ asset('storage/' . $empleados->contrato_consentimiento) }}"
                            target="_blank">Ver Contrato de Consentimiento de Datos</a></p>
                @endif
            </div>


            <div class="form-group">
                <label for="fecha_ingreso">Fecha de Ingreso</label>
                <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso"
                    value="{{ $empleados->fecha_ingreso }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>

            <a href="{{ route('empleados.indexEmpleados') }}" class="btn btn-secondary">Volver</a>
        </form>
    </div>
@endsection
