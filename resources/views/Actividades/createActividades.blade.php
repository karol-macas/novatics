@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h1>Crear Nueva Actividad</h1>
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

                        <form action="{{ route('actividades.store') }}" method="POST">
                            @csrf
                            <!-- Seleccion del Cliente-->
                            <div class="form-group row mb-2 ">
                                <label for="cliente_id" class="col-md-4 col-form-label text-md-right">Clientes</label>
                                <div class="col-md-6">
                                    <select name="cliente_id" class="form-select" required>
                                        <option value="">Seleccione un cliente</option>
                                        @foreach ($clientes as $cliente)
                                            <option value="{{ $cliente->id }}"
                                                {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                                                {{ $cliente->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- Seleccion del Empleado-->
                            <div class="form-group row mb-2">
                                <label for="empleado_id" class="col-md-4 col-form-label text-md-right">Empleados</label>
                                <div class="col-md-6">
                                    <select name="empleado_id" class="form-select" required>
                                        <option value="">Seleccione un empleado</option>
                                        @foreach ($empleados as $empleado)
                                            <option value="{{ $empleado->id }}"
                                                {{ old('empleado_id') == $empleado->id ? 'selected' : '' }}>
                                                {{ $empleado->nombre1 }} {{ $empleado->apellido1 }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- Descripcion-->
                            <div class="form-group row mb-2">

                                <label for="descripcion" class="col-md-4 col-form-label text-md-right">Descripción</label>
                                <div class="col-md-6">
                                    <textarea name="descripcion" class="form-control">{{ old('descripcion') }}</textarea>
                                </div>
                            </div>
                            <!-- Codigo OSTicket-->
                            <div class="form-group row mb-2">
                                <label for="codigo_osticket" class="col-md-4 col-form-label text-md-right">Código
                                    OSTicket</label>
                                <div class="col-md-6">
                                    <input type="number" name="codigo_osticket" class="form-control"
                                        value="{{ old('codigo_osticket') }}" required>
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="semanal_diaria" class="col-md-4 col-form-label text-md-right">Semanal o
                                    Diaria</label>
                                <div class="col-md-6">
                                    <select name="semanal_diaria" class="form-select" required>
                                        <option value="SEMANAL" {{ old('semanal_diaria') == 'SEMANAL' ? 'selected' : '' }}>
                                            Semanal
                                        </option>
                                        <option value="DIARIO" {{ old('semanal_diaria') == 'DIARIO' ? 'selected' : '' }}>
                                            Diario</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="fecha_inicio" class="col-md-4 col-form-label text-md-right">Fecha de
                                    Inicio</label>
                                <div class="col-md-6">
                                    <input type="date" name="fecha_inicio" class="form-control"
                                        value="{{ old('fecha_inicio') }}" required>
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="avance" class="col-md-4 col-form-label text-md-right">Avance
                                    (%)</label>
                                <div class="col-md-6">
                                    <input type="number" name="avance" class="form-control" value="{{ old('avance') }}"
                                        min="0" max="100" required>
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="observaciones"
                                    class="col-md-4 col-form-label text-md-right">Observaciones</label>
                                <div class="col-md-6">
                                    <textarea name="observaciones" class="form-control">{{ old('observaciones') }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="estado" class="col-md-4 col-form-label text-md-right">Estado</label>
                                <div class="col-md-6">
                                    <select name="estado" id="estado" class="form-select" required>
                                        <option value="EN CURSO" {{ old('estado') == 'EN CURSO' ? 'selected' : '' }}>En
                                            Curso</option>
                                        <option value="FINALIZADO" {{ old('estado') == 'FINALIZADO' ? 'selected' : '' }}>
                                            Finalizado</option>
                                        <option value="PENDIENTE" {{ old('estado') == 'PENDIENTE' ? 'selected' : '' }}>
                                            Pendiente</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="tiempo" class="col-md-4 col-form-label text-md-right">Tiempo
                                    (minutos)</label>
                                <div class="col-md-6">
                                    <input type="number" name="tiempo" class="form-control" value="{{ old('tiempo') }}"
                                        required>
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="fecha_fin" class="col-md-4 col-form-label text-md-right">Fecha de
                                    Fin</label>
                                <div class="col-md-6">
                                    <input type="date" name="fecha_fin" class="form-control"
                                        value="{{ old('fecha_fin') }}" required>
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="repetitivo" class="col-md-4 col-form-label text-md-right">Repetitivo</label>
                                <div class="col-md-6">
                                    <select name="repetitivo" class="form-select" required>
                                        <option value="1" {{ old('repetitivo') == '1' ? 'selected' : '' }}>Sí
                                        </option>
                                        <option value="0" {{ old('repetitivo') == '0' ? 'selected' : '' }}>No
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="prioridad" class="col-md-4 col-form-label text-md-right">Prioridad</label>
                                <div class="col-md-6">
                                    <select name="prioridad" id="prioridad" class="form-select" required>
                                        <option value="ALTA" {{ old('prioridad') == 'ALTA' ? 'selected' : '' }}>Alta
                                        </option>
                                        <option value="MEDIA" {{ old('prioridad') == 'MEDIA' ? 'selected' : '' }}>Media
                                        </option>
                                        <option value="BAJA" {{ old('prioridad') == 'BAJA' ? 'selected' : '' }}>Baja
                                        </option>
                                    </select>
                                </div>
                            </div>



                            <div class="form-group row mb-2">
                                <label for="departamento_id"
                                    class="col-md-4 col-form-label text-md-right">Departamento</label>
                                <div class="col-md-6">
                                    <select name="departamento_id" class="form-select" required>
                                        <option value="">Seleccione un departamento</option>
                                        @foreach ($departamentos as $departamento)
                                            <option value="{{ $departamento->id }}"
                                                {{ old('departamento_id') == $departamento->id ? 'selected' : '' }}>
                                                {{ $departamento->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="error" class="col-md-4 col-form-label text-md-right">Tipo de
                                    Error</label>
                                <div class="col-md-6">
                                    <select name="error" class="form-select" required>
                                        <option value="CLIENTE" {{ old('error') == 'CLIENTE' ? 'selected' : '' }}>
                                            Cliente
                                        </option>
                                        <option value="SOFTWARE" {{ old('error') == 'SOFTWARE' ? 'selected' : '' }}>
                                            Software</option>
                                        <option value="MEJORA ERROR"
                                            {{ old('error') == 'MEJORA ERROR' ? 'selected' : '' }}>Mejora
                                            Error
                                        </option>
                                        <option value="DESARROL LOCALES"
                                            {{ old('error') == 'DESARROL LOCALES' ? 'selected' : '' }}>Desarrol
                                            Locales
                                        </option>
                                        <option value="OTROS" {{ old('error') == 'OTROS' ? 'selected' : '' }}>
                                            Otros
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success mt-2">Guardar</button>
                            <a href="{{ route('actividades.indexActividades') }}" class="btn btn-primary mt-2">Volver</a>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
@endsection
