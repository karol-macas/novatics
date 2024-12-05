@extends('layouts.app')

@section('content')
    <div class="container mt-4" style="max-width: 700px;">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h1 class="mb-0">Crear Nueva Matriz de Cumplimientos</h1>
            </div>

            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('matriz_cumplimientos.store') }}" method="POST">
                    @csrf

                   


                    <!-- Seleccion del empleado del departamento seleccionado -->
                    <div class="form-group mt-3">
                        <label for="empleado_id">Empleado <span class="text-danger">*</span></label>
                        <select name="empleado_id" class="form-control" required>
                            <option value="">Seleccione un Empleado</option>
                            @foreach ($empleados as $empleado)
                                <option value="{{ $empleado->id }}">{{ $empleado->nombre1 . ' ' . $empleado->apellido1 }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!--Se llene automaticamente el cargo del empleado seleccionado-->
                    <div class="form-group mt-3">
                        <label for="cargo_id">Cargo <span class="text-danger">*</span></label>
                        <select name="cargo_id" class="form-control" required>
                            <option value="">Seleccione un Cargo</option>
                            @foreach ($cargos as $cargo)
                                <option value="{{ $cargo->id }}">{{ $cargo->nombre_cargo }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!--Se llene automaticamente el supervisor del empleado seleccionado-->

                    <div class="form-group mt-3">
                        <label for="supervisor_id">Supervisor <span class="text-danger">*</span></label>
                        <select name="supervisor_id" class="form-control" required>
                            <option value="">Seleccione un Supervisor</option>
                            @foreach ($supervisores as $supervisor)
                                <option value="{{ $supervisor->id }}">{{ $supervisor->nombre_supervisor }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Seleccion del Parametro -->
                    <div class="form-group mt-3">
                        <label for="parametro_id">Parámetro <span class="text-danger">*</span></label>
                        <select name="parametro_id" id="parametro_id" class="form-control" required>
                            <option value="">Seleccione un Parámetro</option>
                            @foreach ($parametros as $parametro)
                                <option value="{{ $parametro->id }}">{{ $parametro->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Poner los puntos de la matriz -->
                    <div class="form-group mt-3">
                        <label for="puntos">Puntos <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="number" id="puntos" name="puntos" class="form-control text-center"
                                value="0" readonly>
                            <button type="button" id="incrementarPuntos" class="btn btn-primary">
                                +
                            </button>
                        </div>
                    </div>


                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-primary">Crear Matriz de Cumplimientos</button>
                        <a href="{{ route('matriz_cumplimientos.index') }}" class="btn btn-link">Regresar al listado de
                            Matrices de Cumplimientos</a>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const puntosInput = document.getElementById('puntos');
            const incrementarBtn = document.getElementById('incrementarPuntos');

            incrementarBtn.addEventListener('click', () => {
                // Incrementar puntos
                let puntos = parseInt(puntosInput.value, 10) || 0;
                puntos += 1; // Solo se puede incrementar
                puntosInput.value = puntos;
            });
        });
    </script>

@endsection
