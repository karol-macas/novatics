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
                                <a class="nav-link" id="linkStep2" style="color: black;" onclick="showStep(2)">Detalles del
                                    Contrato</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="linkStep3" style="color: black;" onclick="showStep(3)">Documentación
                                    Requerida</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="linkStep3" style="color: black;" onclick="showStep(4)">Información
                                    de Pago </a>
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
                                    <input type="text" name="nombre2" class="form-control" placeholder="Segundo nombre">
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
                                    <input type="text" name="telefono" class="form-control" placeholder="Teléfono">
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

                        <div class="step d-none" id="step2">
                            <h4>Detalles del Contrato</h4>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="departamento" class="form-label">Departamento<span
                                            class="text-danger">*</span></label>
                                    <select name="departamento_id" id="departamento" class="form-select" required
                                        onchange="updateSupervisor()">
                                        <option value="">Selecciona un Departamento</option>
                                        @foreach ($departamentos as $departamento)
                                            <option value="{{ $departamento->id }}"
                                                data-supervisor-id="{{ $departamento->supervisor_id }}"
                                                data-supervisor-nombre="{{ $departamento->supervisor ? $departamento->supervisor->nombre_supervisor : 'No Supervisor' }}">
                                                {{ $departamento->nombre }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="supervisor" class="form-label">Supervisor<span
                                            class="text-danger">*</span></label>
                                    <select name="supervisor_id" id="supervisor" class="form-select" required>
                                        <option value="">Selecciona un Supervisor</option>
                                    </select>

                                </div>
                            </div>

                            <div class ="row mb-3">

                                <div class="col-md-6">
                                    <label for="cargo" class="form-label">Cargo<span
                                            class="text-danger">*</span></label>
                                    <select name="cargo_id" id="cargo" class="form-select" required>
                                        <option value="">Selecciona un Cargo</option>
                                        @foreach ($cargos as $cargo)
                                            <option value="{{ $cargo->id }}">{{ $cargo->nombre_cargo }}</option>
                                        @endforeach
                                    </select>
                                </div>



                                <div class="col-md-6">
                                    <label for="fecha_ingreso" class="form-label">Fecha de Ingreso<span
                                            class="text-danger">*</span></label>
                                    <input type="date" name="fecha_ingreso" class="form-control" required>
                                </div>
                            </div>

                            <div class ="row mb-3">
                                <div class="col-md-6">
                                    <label for="jornada_laboral" class="form-label">Tipo de Jornada<span
                                            class="text-danger">*</span></label>
                                    <select name="jornada_laboral" id="jornada_laboral" class="form-select" required>
                                        <option value="">Selecciona una Opcion</option>
                                        <option value="Tiempo Completo">Tiempo Completo</option>
                                        <option value="Medio Tiempo">Medio Tiempo</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="fecha_contratacion" class="form-label">Fecha de Contratación<span
                                            class="text-danger">*</span></label>
                                    <input type="date" name="fecha_contratacion" class="form-control" required>

                                </div>
                            </div>

                            <div class ="row mb-3">
                                <div class="col-md-6">
                                    <label for="fecha_conclusion" class="form-label">Fecha de Conclusion<span
                                            class="text-danger">*</span></label>
                                    <input type="date" name="fecha_conclusion" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label for="terminacion_voluntaria" class="form-label">Terminacion Voluntaria<span
                                            class="text-danger">*</span></label>
                                    <select name="terminacion_voluntaria" id="terminacion_voluntaria"
                                        class="form-select">
                                        <option value="">Selecciona una Opcion</option>
                                        <option value="Si">Si</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class ="row mb-3">
                                <div class="col-md-6">
                                    <label for="fecha_recontratacion" class="form-label">Fecha de Recontratacion<span
                                            class="text-danger">*</span></label>
                                    <input type="date" name="fecha_recontratacion" class="form-control">
                                </div>
                            </div>


                            <button type="button" class="btn btn-secondary" onclick="prevStep(1)">Anterior</button>
                            <button type="button" class="btn btn-primary" onclick="nextStep(2)">Siguiente</button>
                        </div>
                        <!-- Step 3: Documentos Requeridos -->
                        <div class="step d-none" id="step3">
                            <h4>Documentos Requeridos</h4>
                            <div class="row mb-3">
                                <div class="col-md-8">
                                    <label for="curriculum" class="form-label">Currículum<span
                                            class="text-danger">*</span></label>
                                    <input type="file" name="curriculum" class="form-control">
                                </div>

                            </div>

                            <div class="row mb-3">
                                <div class="col-md-8">
                                    <label for="contrato" class="form-label">Contrato<span
                                            class="text-danger">*</span></label>
                                    <input type="file" name="contrato" class="form-control">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-8">
                                    <label for="contrato_confidencialidad" class="form-label">Contrato de
                                        Confidencialidad<span class="text-danger">*</span></label>
                                    <input type="file" name="contrato_confidencialidad" class="form-control">
                                </div>

                            </div>

                            <div class="row mb-3">
                                <div class="col-md-8">
                                    <label for="contrato_consentimiento" class="form-label">Contrato de Consentimiento de
                                        Datos<span class="text-danger">*</span></label>
                                    <input type="file" name="contrato_consentimiento" class="form-control">
                                </div>

                            </div>

                            <button type="button" class="btn btn-secondary" onclick="prevStep(2)">Anterior</button>
                            <button type="button" class="btn btn-primary" onclick="nextStep(3)">Siguiente</button>

                        </div>

                        <!-- Step 4: Informacion de Pago -->
                        <div class="step d-none" id="step4">
                            <h4>Información de Pago</h4>

                            <div class="form-group mt-4">
                                <label for="rubros">Selecciona Rubros</label>
                                <div id="rubros">
                                    @foreach ($rubros as $rubro)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="rubros[]"
                                                id="rubro{{ $rubro->id }}" value="{{ $rubro->id }}">
                                            <label class="form-check-label" for="rubro{{ $rubro->id }}">
                                                {{ $rubro->nombre }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div id="montos-container"></div> <!-- Aquí se agregarán dinámicamente los campos de monto -->

                            <button type="button" class="btn btn-secondary" onclick="prevStep(3)">Anterior</button>
                            <button type="submit" class="btn btn-success">Guardar</button>




                    </form>

                </div>
            </div>
        </div>

        <script>
            document.getElementById('rubros').addEventListener('change', function(event) {
        const montosContainer = document.getElementById('montos-container');
        montosContainer.innerHTML = ''; // Limpiar el contenedor

        // Obtener todos los checkboxes seleccionados
        const checkboxes = document.querySelectorAll('#rubros input[type="checkbox"]:checked');
        checkboxes.forEach(function(checkbox) {
            const rubroId = checkbox.value;
            const rubroNombre = checkbox.nextElementSibling.textContent;

            // Crear un div para cada monto
            const montoDiv = document.createElement('div');
            montoDiv.className = 'form-group mb-3';

            // Etiqueta para el rubro
            const label = document.createElement('label');
            label.textContent = `Monto para ${rubroNombre}`;
            label.htmlFor = `monto${rubroId}`;

            // Campo de entrada para el monto
            const input = document.createElement('input');
            input.type = 'number';
            input.name = `montos[${rubroId}]`;
            input.id = `monto${rubroId}`;
            input.className = 'form-control';
            input.placeholder = 'Ingrese el monto';

            // Agregar el label y el input al div
            montoDiv.appendChild(label);
            montoDiv.appendChild(input);

            // Agregar el div al contenedor principal
            montosContainer.appendChild(montoDiv);
        });
    });
           

            function updateSupervisor() {
                const departamentoSelect = document.getElementById('departamento');
                const supervisorSelect = document.getElementById('supervisor');
                const selectedOption = departamentoSelect.options[departamentoSelect.selectedIndex];

                // Limpiar la selección anterior
                supervisorSelect.innerHTML = '<option value="">Selecciona un Supervisor</option>';

                // Obtener el ID y el nombre del supervisor
                const supervisorId = selectedOption.dataset.supervisorId;
                const supervisorNombre = selectedOption.dataset.supervisorNombre;

                if (supervisorId) {
                    // Crear la opción del supervisor basada en el ID y el nombre del supervisor
                    const option = document.createElement('option');
                    option.value = supervisorId;
                    option.textContent = supervisorNombre; // Mostrar el nombre del supervisor
                    supervisorSelect.appendChild(option);
                }
            }



            function showStep(step) {
                document.querySelectorAll('.step').forEach(s => s.classList.add('d-none'));
                document.querySelector(`#step${step}`).classList.remove('d-none');

                document.querySelectorAll('.nav-link').forEach(link => link.classList.remove('active'));
                document.querySelector(`#linkStep${step}`).classList.add('active');
            }

            function nextStep(step) {
                // Selecciona el paso actual
                const currentStep = document.querySelector(`#step${step}`);
                const requiredFields = currentStep.querySelectorAll('[required]');

                let isValid = true;

                // Validación de campos requeridos
                requiredFields.forEach(field => {
                    if (!field.value) {
                        isValid = false;
                        field.classList.add('is-invalid'); // Agrega la clase de error
                    } else {
                        field.classList.remove('is-invalid'); // Remueve la clase de error si está completo
                    }
                });

                if (isValid) {
                    showStep(step + 1); // Solo avanza si todos los campos están llenos
                } else {
                    // Despliega un mensaje de advertencia en el caso de que haya campos vacíos
                    alert("Por favor complete todos los campos requeridos antes de continuar.");
                }
            }

            function prevStep(step) {
                showStep(step - 1);
            }
        </script>
    @endsection
