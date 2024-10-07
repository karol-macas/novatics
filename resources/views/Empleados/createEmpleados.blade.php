@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white text-center">
                        <h2 class="mb-0"><i class="fas fa-user-plus"></i> Registrar Nuevo Empleado</h2>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger m-3">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('empleados.store') }}" method="POST" enctype="multipart/form-data" class="p-4">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nombre1" class="form-label">Primer Nombre</label>
                                <input type="text" name="nombre1" class="form-control" placeholder="Primer nombre" required>
                            </div>
                            <div class="col-md-6">
                                <label for="nombre2" class="form-label">Segundo Nombre</label>
                                <input type="text" name="nombre2" class="form-control" placeholder="Segundo nombre" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="apellido1" class="form-label">Primer Apellido</label>
                                <input type="text" name="apellido1" class="form-control" placeholder="Primer apellido" required>
                            </div>
                            <div class="col-md-6">
                                <label for="apellido2" class="form-label">Segundo Apellido</label>
                                <input type="text" name="apellido2" class="form-control" placeholder="Segundo apellido" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="cedula" class="form-label">Cédula</label>
                                <input type="text" class="form-control" id="cedula" name="cedula" placeholder="Ingrese cédula">
                                @error('cedula')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                                <input type="date" name="fecha_nacimiento" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="text" name="telefono" class="form-control" placeholder="Teléfono">
                            </div>
                            <div class="col-md-6">
                                <label for="celular" class="form-label">Celular</label>
                                <input type="text" name="celular" class="form-control" placeholder="Celular" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="correo_institucional" class="form-label">Correo Institucional</label>
                                <input type="email" name="correo_institucional" class="form-control" placeholder="correo@empresa.com" required>
                            </div>
                            <div class="col-md-6">
                                <label for="departamento" class="form-label">Departamento</label>
                                <select name="departamento_id" id="departamento" class="form-control" required>
                                    <option value="">Selecciona un Departamento</option>
                                    @foreach ($departamentos as $departamento)
                                        <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <h5 class="mt-4">Documentos</h5>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="curriculum" class="form-label">Currículum</label>
                                <input type="file" name="curriculum" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="contrato" class="form-label">Contrato</label>
                                <input type="file" name="contrato" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="contrato_confidencialidad" class="form-label">Contrato de Confidencialidad</label>
                                <input type="file" name="contrato_confidencialidad" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="contrato_consentimiento" class="form-label">Contrato de Consentimiento de Datos</label>
                                <input type="file" name="contrato_consentimiento" class="form-control">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="fecha_ingreso" class="form-label">Fecha de Ingreso</label>
                            <input type="date" name="fecha_ingreso" class="form-control" required>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a href="{{ route('empleados.indexEmpleados') }}" class="btn btn-secondary">Volver</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
