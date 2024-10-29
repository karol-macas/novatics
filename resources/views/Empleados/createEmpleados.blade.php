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

                    <div class="step-indicator mb-4">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link active" id="linkStep1" style="color: black;"
                                    onclick="showStep(1)">Información Personal</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="linkStep2" style="color: black;" onclick="showStep(2)">Encargado</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="linkStep3" style="color: black;"
                                    onclick="showStep(3)">Documentos</a>
                            </li>
                        </ul>
                    </div>

                    <form id="employeeForm" action="{{ route('empleados.store') }}" method="POST"
                        enctype="multipart/form-data" class="p-4">
                        @csrf

                        <!-- Step 1: Información Personal -->
                        <div class="step" id="step1">
                            <h4>Información Personal</h4>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="nombre1" class="form-label">Primer Nombre<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="nombre1" class="form-control" placeholder="Primer nombre"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label for="nombre2" class="form-label">Segundo Nombre<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="nombre2" class="form-control" placeholder="Segundo nombre"
                                        required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="apellido1" class="form-label">Primer Apellido<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="apellido1" class="form-control"
                                        placeholder="Primer apellido" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="apellido2" class="form-label">Segundo Apellido<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="apellido2" class="form-control"
                                        placeholder="Segundo apellido" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="cedula" class="form-label">Cédula<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="cedula" class="form-control" placeholder="Ingrese cédula"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento<span
                                            class="text-danger">*</span></label>
                                    <input type="date" name="fecha_nacimiento" class="form-control" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="telefono" class="form-label">Teléfono<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="telefono" class="form-control" placeholder="Teléfono"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label for="celular" class="form-label">Celular<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="celular" class="form-control" placeholder="Celular"
                                        required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="correo_institucional" class="form-label">Correo Institucional<span
                                            class="text-danger">*</span></label>
                                    <input type="email" name="correo_institucional" class="form-control"
                                        placeholder="correo@empresa.com" required>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary" onclick="nextStep(1)">Siguiente</button>
                        </div>

                        <!-- Step 2: Encargado -->
                        <div class="step d-none" id="step2">
                            <h4>Encargado</h4>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="departamento" class="form-label">Departamento<span
                                            class="text-danger">*</span></label>
                                    <select name="departamento_id" id="departamento" class="form-select" required>
                                        <option value="">Selecciona un Departamento</option>
                                        @foreach ($departamentos as $departamento)
                                            <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="fecha_ingreso" class="form-label">Fecha de Ingreso<span
                                            class="text-danger">*</span></label>
                                    <input type="date" name="fecha_ingreso" class="form-control" required>
                                </div>
                            </div>
                            <button type="button" class="btn btn-secondary" onclick="prevStep(1)">Anterior</button>
                            <button type="button" class="btn btn-primary" onclick="nextStep(2)">Siguiente</button>
                        </div>

                        <!-- Step 3: Documentos -->
                        <div class="step d-none" id="step3">
                            <h4>Documentos</h4>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="curriculum" class="form-label">Currículum<span
                                            class="text-danger">*</span></label>
                                    <input type="file" name="curriculum" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="contrato" class="form-label">Contrato<span
                                            class="text-danger">*</span></label>
                                    <input type="file" name="contrato" class="form-control" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="contrato_confidencialidad" class="form-label">Contrato de
                                        Confidencialidad<span class="text-danger">*</span></label>
                                    <input type="file" name="contrato_confidencialidad" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="contrato_consentimiento" class="form-label">Contrato de Consentimiento de
                                        Datos<span class="text-danger">*</span></label>
                                    <input type="file" name="contrato_consentimiento" class="form-control" required>
                                </div>
                            </div>

                            <button type="button" class="btn btn-secondary" onclick="prevStep(2)">Anterior</button>
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showStep(step) {
            document.querySelectorAll('.step').forEach(s => s.classList.add('d-none'));
            document.querySelector(`#step${step}`).classList.remove('d-none');

            document.querySelectorAll('.nav-link').forEach(link => link.classList.remove('active'));
            document.querySelector(`#linkStep${step}`).classList.add('active');
        }

        function nextStep(step) {
            showStep(step + 1);
        }

        function prevStep(step) {
            showStep(step - 1);
        }
    </script>
@endsection
