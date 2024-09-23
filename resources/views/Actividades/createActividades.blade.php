@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
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

                    <!-- Selección de Cliente -->
                    <div class="form-group">
                        <label for="cliente_id">Cliente</label>
                        <select name="cliente_id" class="form-control" required>
                            <option value="">Seleccione un cliente</option>
                            @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->id }}"
                                    {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                                    {{ $cliente->nombre }}
                                </option>
                            @endforeach
                        </select>
                    

                    <!-- Selección de Empleado Nonbre y Apellido -->
                    <div class="form-group">
                        <label for="empleado_id">Empleado</label>
                        <select name="empleado_id" class="form-control" required>
                            <option value="">Seleccione un empleado</option>
                            @foreach ($empleados as $empleado)
                                <option value="{{ $empleado->id }}"
                                    {{ old('empleado_id') == $empleado->id ? 'selected' : '' }}>
                                    {{ $empleado->nombre1 }} {{ $empleado->apellido1 }}
                                </option>
                            @endforeach
                        </select>

                    

                    <!-- Campo Descripción -->
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <input type="text" name="descripcion" class="form-control" value="{{ old('descripcion') }}"
                            required>
                    </div>

                    <!-- Campo Código OSTicket -->
                    <div class="form-group">
                        <label for="codigo_osticket">Código OSTicket</label>
                        <input type="text" name="codigo_osticket" class="form-control"
                            value="{{ old('codigo_osticket') }}" required>
                    </div>

                    <!-- Campo Semanal o Diaria -->
                    <div class="form-group">
                        <label for="semanal_diaria">Semanal o Diaria</label>
                        <select name="semanal_diaria" class="form-control" required>
                            <option value="SEMANAL" {{ old('semanal_diaria') == 'SEMANAL' ? 'selected' : '' }}>Semanal
                            </option>
                            <option value="DIARIO" {{ old('semanal_diaria') == 'DIARIO' ? 'selected' : '' }}>Diario</option>
                        </select>
                    </div>

                    <!-- Campo Fecha de Inicio -->
                    <div class="form-group">
                        <label for="fecha_inicio">Fecha de Inicio</label>
                        <input type="date" name="fecha_inicio" class="form-control" value="{{ old('fecha_inicio') }}"
                            required>
                    </div>

                    <!-- Campo Avance -->
                    <div class="form-group">
                        <label for="avance">Avance (%)</label>
                        <input type="number" name="avance" class="form-control" value="{{ old('avance') }}"
                            min="0" max="100" required>
                    </div>

                    <!-- Campo Observaciones -->
                    <div class="form-group">
                        <label for="observaciones">Observaciones</label>
                        <textarea name="observaciones" class="form-control">{{ old('observaciones') }}</textarea>
                    </div>

                    <!-- Campo Estado -->
                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <select name="estado" class="form-control" required>
                            <option value="EN CURSO" {{ old('estado') == 'EN CURSO' ? 'selected' : '' }}>En Curso</option>
                            <option value="FINALIZADO" {{ old('estado') == 'FINALIZADO' ? 'selected' : '' }}>Finalizado
                            </option>
                            <option value="PENDIENTE" {{ old('estado') == 'PENDIENTE' ? 'selected' : '' }}>Pendiente
                            </option>
                        </select>
                    </div>

                    <!-- Campo Tiempo -->
                    <div class="form-group">
                        <label for="tiempo">Tiempo (minutos)</label>
                        <input type="number" name="tiempo" class="form-control" value="{{ old('tiempo') }}" required>
                    </div>

                    <!-- Campo Fecha de Fin -->
                    <div class="form-group">
                        <label for="fecha_fin">Fecha de Fin</label>
                        <input type="date" name="fecha_fin" class="form-control" value="{{ old('fecha_fin') }}"
                            required>
                    </div>

                    <!-- Campo Repetitivo -->
                    <div class="form-group">
                        <label for="repetitivo">Repetitivo</label>
                        <select name="repetitivo" class="form-control" required>
                            <option value="1" {{ old('repetitivo') == '1' ? 'selected' : '' }}>Sí</option>
                            <option value="0" {{ old('repetitivo') == '0' ? 'selected' : '' }}>No</option>
                        </select>
                    </div>

                    <!-- Campo Prioridad -->
                    <div class="form-group">
                        <label for="prioridad">Prioridad</label>
                        <select name="prioridad" class="form-control" required>
                            <option value="ALTA" {{ old('prioridad') == 'ALTA' ? 'selected' : '' }}>Alta</option>
                            <option value="MEDIA" {{ old('prioridad') == 'MEDIA' ? 'selected' : '' }}>Media</option>
                            <option value="BAJA" {{ old('prioridad') == 'BAJA' ? 'selected' : '' }}>Baja</option>
                        </select>
                    </div>

                    <!-- Seleccionar el Departamento -->
                    <div class="form-group">
                        <label for="departamento_id">Departamento</label>
                        <select name="departamento_id" class="form-control" required>
                            <option value="">Seleccione un departamento</option>
                            @foreach ($departamentos as $departamento)
                                <option value="{{ $departamento->id }}"
                                    {{ old('departamento_id') == $departamento->id ? 'selected' : '' }}>
                                    {{ $departamento->nombre }}
                                </option>
                            @endforeach
                        </select>
                    

                    <!-- Campo Error -->
                    <div class="form-group">
                        <label for="error">Tipo de Error</label>
                        <select name="error" class="form-control" required>
                            <option value="CLIENTE" {{ old('error') == 'CLIENTE' ? 'selected' : '' }}>Cliente</option>
                            <option value="SOFTWARE" {{ old('error') == 'SOFTWARE' ? 'selected' : '' }}>Software</option>
                            <option value="MEJORA ERROR" {{ old('error') == 'MEJORA ERROR' ? 'selected' : '' }}>Mejora
                                Error</option>
                            <option value="DESARROLLO" {{ old('error') == 'DESARROLLO' ? 'selected' : '' }}>Desarrollo
                            </option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success mt-2">Guardar</button>
                    <a href="{{ route('actividades.indexActividades') }}" class="btn btn-primary mt-2">Volver</a>
                </form>
            </div>
        </div>
    </div>
@endsection
