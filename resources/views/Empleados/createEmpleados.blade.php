@extends('layouts.app')

@section('content')
    <div class="container mt-5 d-flex justify-content-center">
        <div class="card p-4" style="width: 45rem;">
            <h2 class="text-center mb-4">Registrar Nuevo Empleado</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('empleados.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <!-- Nombres y Apellidos -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombre1">Primer Nombre</label>
                            <input type="text" name="nombre1" class="form-control" placeholder="Primer nombre" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombre2">Segundo Nombre</label>
                            <input type="text" name="nombre2" class="form-control" placeholder="Segundo nombre" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mt-3">
                        <div class="form-group">
                            <label for="apellido1">Primer Apellido</label>
                            <input type="text" name="apellido1" class="form-control" placeholder="Primer apellido" required>
                        </div>
                    </div>
                    <div class="col-md-6 mt-3">
                        <div class="form-group">
                            <label for="apellido2">Segundo Apellido</label>
                            <input type="text" name="apellido2" class="form-control" placeholder="Segundo apellido" required>
                        </div>
                    </div>
                </div>

                <!-- Cédula y Fecha de Nacimiento -->
                <div class="row">
                    <div class="col-md-6 mt-3">
                        <div class="form-group">
                            <label for="cedula">Cédula</label>
                            <input type="text" class="form-control" id="cedula" name="cedula" placeholder="Ingrese cédula" value="{{ old('cedula') }}">
                            @error('cedula')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 mt-3">
                        <div class="form-group">
                            <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                            <input type="date" name="fecha_nacimiento" class="form-control" required>
                        </div>
                    </div>
                </div>

                <!-- Teléfonos -->
                <div class="row">
                    <div class="col-md-6 mt-3">
                        <div class="form-group">
                            <label for="telefono">Teléfono</label>
                            <input type="text" name="telefono" class="form-control" placeholder="Teléfono">
                        </div>
                    </div>
                    <div class="col-md-6 mt-3">
                        <div class="form-group">
                            <label for="celular">Celular</label>
                            <input type="text" name="celular" class="form-control" placeholder="Celular" required>
                        </div>
                    </div>
                </div>

                <!-- Correo y Departamento -->
                <div class="row">
                    <div class="col-md-6 mt-3">
                        <div class="form-group">
                            <label for="correo_institucional">Correo Institucional</label>
                            <input type="email" name="correo_institucional" class="form-control" placeholder="correo@empresa.com" required>
                        </div>
                    </div>
                    <div class="col-md-6 mt-3">
                        <div class="form-group">
                            <label for="departamento">Departamento</label>
                            <select name="departamento_id" id="departamento" class="form-control" required>
                                <option value="">Selecciona un Departamento</option>
                                @foreach ($departamentos as $departamento)
                                    <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
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
                            <input type="file" name="curriculum" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 mt-3">
                        <div class="form-group">
                            <label for="contrato">Contrato</label>
                            <input type="file" name="contrato" class="form-control">
                        </div>
                    </div>
                </div>

                <!-- Contratos adicionales -->
                <div class="row">
                    <div class="col-md-6 mt-3">
                        <div class="form-group">
                            <label for="contrato_confidencialidad">Contrato de Confidencialidad</label>
                            <input type="file" name="contrato_confidencialidad" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 mt-3">
                        <div class="form-group">
                            <label for="contrato_consentimiento">Contrato de Consentimiento de Datos</label>
                            <input type="file" name="contrato_consentimiento" class="form-control">
                        </div>
                    </div>
                </div>

                <!-- Fecha de ingreso -->
                <div class="form-group mt-3">
                    <label for="fecha_ingreso">Fecha de Ingreso</label>
                    <input type="date" name="fecha_ingreso" class="form-control" required>
                </div>

                <!-- Botones -->
                <div class="d-flex justify-content-between mt-4">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="{{ route('empleados.indexEmpleados') }}" class="btn btn-secondary">Volver</a>
                </div>
            </form>
        </div>
    </div>
@endsection
