@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-7">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white text-center">
                        <h1><i class="fas fa-edit"></i> Editar Actividad</h1>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('empleados.update', $empleados->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <fieldset class="border p-3 mb-4">
                                <legend class="text-primary"><i class="fas fa-user"></i> Información del Empleado
                                </legend>
                                <!-- Nombres y Apellidos -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombre1">Primer Nombre</label>
                                            <input type="text" class="form-control" id="nombre1" name="nombre1"
                                                value="{{ $empleados->nombre1 }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombre2">Segundo Nombre</label>
                                            <input type="text" class="form-control" id="nombre2" name="nombre2"
                                                value="{{ $empleados->nombre2 }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="apellido1">Primer Apellido</label>
                                            <input type="text" class="form-control" id="apellido1" name="apellido1"
                                                value="{{ $empleados->apellido1 }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="apellido2">Segundo Apellido</label>
                                            <input type="text" class="form-control" id="apellido2" name="apellido2"
                                                value="{{ $empleados->apellido2 }}" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Fecha de Nacimiento y Cédula -->
                                <div class="row">
                                    <div class="col-md-6 mt-3">
                                        <div class="form-group">
                                            <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                                            <input type="date" class="form-control" id="fecha_nacimiento"
                                                name="fecha_nacimiento" value="{{ $empleados->fecha_nacimiento }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <div class="form-group">
                                            <label for="cedula">Cédula</label>
                                            <input type="text" class="form-control" id="cedula" name="cedula"
                                                value="{{ $empleados->cedula }}" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Teléfono y Celular -->
                                <div class="row">
                                    <div class="col-md-6 mt-3">
                                        <div class="form-group">
                                            <label for="telefono">Teléfono</label>
                                            <input type="text" class="form-control" id="telefono" name="telefono"
                                                value="{{ $empleados->telefono }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6 mt-3">
                                        <div class="form-group">
                                            <label for="celular">Celular</label>
                                            <input type="text" class="form-control" id="celular" name="celular"
                                                value="{{ $empleados->celular }}" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Correo Institucional, Departamento, Supervisor y Cargo -->
                                <div class="row">

                                    <div class="col-md-6 mt-3">
                                        <div class="form-group">
                                            <label for="correo_institucional">Correo Institucional</label>
                                            <input type="email" class="form-control" id="correo_institucional"
                                                name="correo_institucional" value="{{ $empleados->correo_institucional }}"
                                                required>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mt-3">
                                        <div class="form-group">
                                            <label for="departamento_id">Departamento</label>
                                            <select class="form-control" id="departamento_id" name="departamento_id"
                                                required>
                                                @foreach ($departamentos as $departamento)
                                                    <option value="{{ $departamento->id }}"
                                                        {{ $empleados->departamento_id == $departamento->id ? 'selected' : '' }}>
                                                        {{ $departamento->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mt-3">
                                        <div class="form-group">
                                            <label for="supervisor_id">Supervisor</label>
                                            <select class="form-control" id="supervisor_id" name="supervisor_id"
                                                required>
                                                @foreach ($supervisores as $supervisor)
                                                    <option value="{{ $supervisor->id }}"
                                                        {{ $empleados->supervisor_id == $supervisor->id ? 'selected' : '' }}>
                                                        {{ $supervisor->nombre_supervisor }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mt-3">
                                        <div class="form-group">
                                            <label for="cargo_id">Cargo</label>
                                            <select class="form-control" id="cargo_id" name="cargo_id" required>
                                                @foreach ($cargos as $cargo)
                                                    <option value="{{ $cargo->id }}"
                                                        {{ $empleados->cargo_id == $cargo->id ? 'selected' : '' }}>
                                                        {{ $cargo->nombre_cargo }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>

                                </div>


                                <div class="row">
                                    <div class="col-md-6 mt-3">
                                        <div class="form-group">
                                            <label for="jornada_laboral">Jornada Laboral</label>
                                            <select name="jornada_laboral" id="jornada_laboral" class="form-select">
                                                <option value="">Selecciona una Opcion</option>
                                                <option value="Diurna">Medio Tiempo</option>
                                                <option value="Nocturna">Tiempo Completo</option>
                                 
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mt-3">
                                        <div class="form-group">
                                            <label for="fecha_ingreso">Fecha de Ingreso</label>
                                            <input type="date" class="form-control" id="fecha_ingreso"
                                                name="fecha_ingreso" value="{{ $empleados->fecha_ingreso }}" required>
                                        </div>

                                    </div>

                                </div>


                                <!-- Fecha de Contratacion -->
                                <div class="row">
                                    <div class="col-md-6 mt-3">
                                        <div class="form-group mt-3">
                                            <label for="fecha_contratacion" class="form-label">Fecha de
                                                Contratación</label>
                                            <input type="date" class="form-control" id="fecha_contratacion"
                                                name="fecha_contratacion" value="{{ $empleados->fecha_contratacion }}"
                                                required>

                                        </div>
                                    </div>
                                </div>

                                <!-- Fecha de Conclusion -->
                                <div class="row">
                                    <div class="col-md-6 mt-3">
                                        <div class="form-group mt-3">
                                            <label for="fecha_conclusion" class="form-label">Fecha de
                                                Conclusion</label>
                                            <input type="date" class="form-control" id="fecha_conclusion"
                                                name="fecha_conclusion" value="{{ $empleados->fecha_conclusion }}">

                                        </div>
                                    </div>
                                </div>

                                <!-- Terminacion Voluntaria -->
                                <div class="row">
                                    <div class="col-md-6 mt-3">
                                        <div class="form-group mt-3">
                                            <label for="terminacion_voluntaria" class="form-label">Terminacion
                                                Voluntaria<span class="text-danger">*</span></label>
                                            <select name="terminacion_voluntaria" id="terminacion_voluntaria"
                                                class="form-select">
                                                <option value="">Selecciona una Opcion</option>
                                                <option value="Si">Si</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Fecha de Recontratacion -->
                                <div class="row">
                                    <div class="col-md-6 mt-3">
                                        <div class="form-group mt-3">
                                            <label for="fecha_recontratacion" class="form-label">Fecha de
                                                Recontratacion</label>
                                            <input type="date" class="form-control" id="fecha_recontratacion"
                                                name="fecha_recontratacion"
                                                value="{{ $empleados->fecha_recontratacion }}">
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="border p-3 mb-4">
                                <legend class="text-primary"><i class="fa-solid fa-file"></i> Documentos</legend>
                                <div class="row">
                                    <div class="form-group col-md-6">

                                        <label for="curriculum">Currículum</label>
                                        <input type="file" class="form-control" id="curriculum" name="curriculum">
                                        @if ($empleados->curriculum)
                                            <small class="form-text text-muted">Archivo actual: <a
                                                    href="{{ asset('storage/' . $empleados->curriculum) }}"
                                                    target="_blank">Ver
                                                    Currículum</a></small>
                                        @endif

                                    </div>
                                    <div class="form-group col-md-6">

                                        <label for="contrato">Contrato</label>
                                        <input type="file" class="form-control" id="contrato" name="contrato">
                                        @if ($empleados->contrato)
                                            <small class="form-text text-muted">Archivo actual: <a
                                                    href="{{ asset('storage/' . $empleados->contrato) }}"
                                                    target="_blank">Ver
                                                    Contrato</a></small>
                                        @endif

                                    </div>
                                </div>

                                <!-- Contratos adicionales -->
                                <div class="row">
                                    <div class="form-group col-md-6">

                                        <label for="contrato_confidencialidad">Contrato de Confidencialidad</label>
                                        <input type="file" class="form-control" id="contrato_confidencialidad"
                                            name="contrato_confidencialidad">
                                        @if ($empleados->contrato_confidencialidad)
                                            <small class="form-text text-muted">Archivo actual: <a
                                                    href="{{ asset('storage/' . $empleados->contrato_confidencialidad) }}"
                                                    target="_blank">Ver Contrato de Confidencialidad</a></small>
                                        @endif

                                    </div>
                                    <div class="form-group col-md-6">

                                        <label for="contrato_consentimiento">Contrato de Consentimiento de
                                            Datos</label>
                                        <input type="file" class="form-control" id="contrato_consentimiento"
                                            name="contrato_consentimiento">
                                        @if ($empleados->contrato_consentimiento)
                                            <small class="form-text text-muted">Archivo actual: <a
                                                    href="{{ asset('storage/' . $empleados->contrato_consentimiento) }}"
                                                    target="_blank">Ver Contrato de Consentimiento de Datos</a></small>
                                        @endif

                                    </div>
                                </div>

                            </fieldset>

                            <fieldset>
                                <!-- Step 4: Información de Pago -->
                                <legend class="text-primary"><i class="fa-solid fa-file"></i> Informacion de Pago</legend>

                                <div class="form-group col-md-6">

                                    <label for="rubros">Selecciona Rubros</label>
                                    <div id="rubros">
                                        @foreach ($rubros as $rubro)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="rubros[]"
                                                    id="rubro{{ $rubro->id }}" value="{{ $rubro->id }}"
                                                    {{ in_array($rubro->id, $empleados->rubros->pluck('id')->toArray()) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="rubro{{ $rubro->id }}">
                                                    {{ $rubro->nombre }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div id="montos-container"></div>



                                </div>

                            </fieldset>

                            <!-- Botones -->
                            <div class="d-flex justify-content-between mt-4">
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                                <a href="{{ route('empleados.indexEmpleados') }}" class="btn btn-secondary">Volver</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('rubros').addEventListener('change', function(event) {
            const montosContainer = document.getElementById('montos-container');
            montosContainer.innerHTML = '';

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

                // ver los montos actuales
                const montoActual = document.createElement('input');
                montoActual.type = 'number';
                montoActual.className = 'form-control';
                montoActual.id = `monto${rubroId}`;
                montoActual.name = `montos[${rubroId}]`;
                montoActual.value = 0;

                // Campo de entrada para el monto
                const input = document.createElement('input');
                input.type = 'number';
                input.name = `montos[${rubroId}]`;
                input.id = `monto${rubroId}`;
                input.className = 'form-control';
                input.placeholder = 'Ingrese el monto';

                // Agregar los elementos al div
                montoDiv.appendChild(label);
                montoDiv.appendChild(montoActual);

                // Agregar el div al contenedor
                montosContainer.appendChild(montoDiv);



            });
        });
    </script>
@endsection
