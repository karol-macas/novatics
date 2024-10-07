@extends('layouts.app')

@section('content')
    <div class="container mt-5 d-flex justify-content-center">
        <div class="card p-4" style="width: 45rem;">
            <h2 class="text-center mb-4">Editar Empleado</h2>

            <form action="{{ route('empleados.update', $empleados->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Nombres y Apellidos -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombre1">Primer Nombre</label>
                            <input type="text" class="form-control" id="nombre1" name="nombre1" value="{{ $empleados->nombre1 }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombre2">Segundo Nombre</label>
                            <input type="text" class="form-control" id="nombre2" name="nombre2" value="{{ $empleados->nombre2 }}" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="apellido1">Primer Apellido</label>
                            <input type="text" class="form-control" id="apellido1" name="apellido1" value="{{ $empleados->apellido1 }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="apellido2">Segundo Apellido</label>
                            <input type="text" class="form-control" id="apellido2" name="apellido2" value="{{ $empleados->apellido2 }}" required>
                        </div>
                    </div>
                </div>

                <!-- Fecha de Nacimiento y Cédula -->
                <div class="row">
                    <div class="col-md-6 mt-3">
                        <div class="form-group">
                            <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ $empleados->fecha_nacimiento }}" required>
                        </div>
                    </div>
                    <div class="col-md-6 mt-3">
                        <div class="form-group">
                            <label for="cedula">Cédula</label>
                            <input type="text" class="form-control" id="cedula" name="cedula" value="{{ $empleados->cedula }}" required>
                        </div>
                    </div>
                </div>

                <!-- Teléfono y Celular -->
                <div class="row">
                    <div class="col-md-6 mt-3">
                        <div class="form-group">
                            <label for="telefono">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $empleados->telefono }}">
                        </div>
                    </div>
                    <div class="col-md-6 mt-3">
                        <div class="form-group">
                            <label for="celular">Celular</label>
                            <input type="text" class="form-control" id="celular" name="celular" value="{{ $empleados->celular }}" required>
                        </div>
                    </div>
                </div>

                <!-- Correo Institucional y Departamento -->
                <div class="row">
                    <div class="col-md-6 mt-3">
                        <div class="form-group">
                            <label for="correo_institucional">Correo Institucional</label>
                            <input type="email" class="form-control" id="correo_institucional" name="correo_institucional" value="{{ $empleados->correo_institucional }}" required>
                        </div>
                    </div>
                    <div class="col-md-6 mt-3">
                        <div class="form-group">
                            <label for="departamento_id">Departamento</label>
                            <select class="form-control" id="departamento_id" name="departamento_id" required>
                                @foreach ($departamentos as $departamento)
                                    <option value="{{ $departamento->id }}" {{ $empleados->departamento_id == $departamento->id ? 'selected' : '' }}>
                                        {{ $departamento->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Documentos -->
                <h5 class="mt-4">Documentos</h5>
                <div class="row">
                    <div class="col-md-6 mt-3">
                        <div class="form-group">
                            <label for="curriculum">Currículum</label>
                            <input type="file" class="form-control" id="curriculum" name="curriculum">
                            @if ($empleados->curriculum)
                                <small class="form-text text-muted">Archivo actual: <a href="{{ asset('storage/' . $empleados->curriculum) }}" target="_blank">Ver Currículum</a></small>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6 mt-3">
                        <div class="form-group">
                            <label for="contrato">Contrato</label>
                            <input type="file" class="form-control" id="contrato" name="contrato">
                            @if ($empleados->contrato)
                                <small class="form-text text-muted">Archivo actual: <a href="{{ asset('storage/' . $empleados->contrato) }}" target="_blank">Ver Contrato</a></small>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Contratos adicionales -->
                <div class="row">
                    <div class="col-md-6 mt-3">
                        <div class="form-group">
                            <label for="contrato_confidencialidad">Contrato de Confidencialidad</label>
                            <input type="file" class="form-control" id="contrato_confidencialidad" name="contrato_confidencialidad">
                            @if ($empleados->contrato_confidencialidad)
                                <small class="form-text text-muted">Archivo actual: <a href="{{ asset('storage/' . $empleados->contrato_confidencialidad) }}" target="_blank">Ver Contrato de Confidencialidad</a></small>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6 mt-3">
                        <div class="form-group">
                            <label for="contrato_consentimiento">Contrato de Consentimiento de Datos</label>
                            <input type="file" class="form-control" id="contrato_consentimiento" name="contrato_consentimiento">
                            @if ($empleados->contrato_consentimiento)
                                <small class="form-text text-muted">Archivo actual: <a href="{{ asset('storage/' . $empleados->contrato_consentimiento) }}" target="_blank">Ver Contrato de Consentimiento de Datos</a></small>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Fecha de Ingreso -->
                <div class="form-group mt-3">
                    <label for="fecha_ingreso">Fecha de Ingreso</label>
                    <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso" value="{{ $empleados->fecha_ingreso }}" required>
                </div>

                <!-- Botones -->
                <div class="d-flex justify-content-between mt-4">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="{{ route('empleados.indexEmpleados') }}" class="btn btn-secondary">Volver</a>
                </div>
            </form>
        </div>
    </div>
@endsection
