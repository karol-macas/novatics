@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h1>Editar Actividad</h1>
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

                <form action="{{ route('actividades.update', $actividades->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Campo Cliente ID -->
                    <div class="form-group">
                        <label for="cliente_id">Cliente ID</label>
                        <input type="text" name="cliente_id" class="form-control" value="{{ old('cliente_id', $actividades->cliente_id) }}" >
                    </div>

                    <!-- Campo Empleado ID -->
                    <div class="form-group">
                        <label for="empleado_id">Empleado</label>
                        <select name="empleado_id" class="form-control" required>
                            @foreach ($empleados as $empleado)
                                <option value="{{ $empleado->id }}" {{ old('empleado_id', $actividades->empleado_id) == $empleado->id ? 'selected' : '' }}>
                                    {{ $empleado->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Campo Descripción -->
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <input type="text" name="descripcion" class="form-control" value="{{ old('descripcion', $actividades->descripcion) }}" required>
                    </div>

                    <!-- Campo Código OSTicket -->
                    <div class="form-group">
                        <label for="codigo_osticket">Código OSTicket</label>
                        <input type="text" name="codigo_osticket" class="form-control" value="{{ old('codigo_osticket', $actividades->codigo_osticket) }}" required>
                    </div>

                    <!-- Campo Semanal o Diaria -->
                    <div class="form-group">
                        <label for="semanal_diaria">Semanal o Diaria</label>
                        <select name="semanal_diaria" class="form-control" required>
                            <option value="SEMANAL" {{ old('semanal_diaria', $actividades->semanal_diaria) == 'SEMANAL' ? 'selected' : '' }}>Semanal</option>
                            <option value="DIARIO" {{ old('semanal_diaria', $actividades->semanal_diaria) == 'DIARIO' ? 'selected' : '' }}>Diario</option>
                        </select>
                    </div>

                    <!-- Campo Fecha de Inicio -->
                    <div class="form-group">
                        <label for="fecha_inicio">Fecha de Inicio</label>
                        <input type="date" name="fecha_inicio" class="form-control" value="{{ old('fecha_inicio', $actividades->fecha_inicio->format('Y-m-d')) }}" required>
                    </div>

                    <!-- Campo Avance -->
                    <div class="form-group">
                        <label for="avance">Avance (%)</label>
                        <input type="number" name="avance" class="form-control" value="{{ old('avance', $actividades->avance) }}" min="0" max="100" required>
                    </div>

                    <!-- Campo Observaciones -->
                    <div class="form-group">
                        <label for="observaciones">Observaciones</label>
                        <textarea name="observaciones" class="form-control">{{ old('observaciones', $actividades->observaciones) }}</textarea>
                    </div>

                    <!-- Campo Estado -->
                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <select name="estado" class="form-control" required>
                            <option value="EN CURSO" {{ old('estado', $actividades->estado) == 'EN CURSO' ? 'selected' : '' }}>En Curso</option>
                            <option value="FINALIZADO" {{ old('estado', $actividades->estado) == 'FINALIZADO' ? 'selected' : '' }}>Finalizado</option>
                            <option value="PENDIENTE" {{ old('estado', $actividades->estado) == 'PENDIENTE' ? 'selected' : '' }}>Pendiente</option>
                        </select>
                    </div>

                    <!-- Campo Tiempo -->
                    <div class="form-group">
                        <label for="tiempo">Tiempo (minutos)</label>
                        <input type="number" name="tiempo" class="form-control" value="{{ old('tiempo', $actividades->tiempo) }}" required>
                    </div>

                    <!-- Campo Fecha de Fin -->
                    <div class="form-group">
                        <label for="fecha_fin">Fecha de Fin</label>
                        <input type="date" name="fecha_fin" class="form-control" value="{{ old('fecha_fin', $actividades->fecha_fin->format('Y-m-d')) }}" required>
                    </div>

                    <!-- Campo Repetitivo -->
                    <div class="form-group">
                        <label for="repetitivo">Repetitivo</label>
                        <select name="repetitivo" class="form-control" required>
                            <option value="1" {{ old('repetitivo', $actividades->repetitivo) ? 'selected' : '' }}>Sí</option>
                            <option value="0" {{ old('repetitivo', $actividades->repetitivo) ? '' : 'selected' }}>No</option>
                        </select>
                    </div>

                    <!-- Campo Prioridad -->
                    <div class="form-group">
                        <label for="prioridad">Prioridad</label>
                        <select name="prioridad" class="form-control" required>
                            <option value="ALTA" {{ old('prioridad', $actividades->prioridad) == 'ALTA' ? 'selected' : '' }}>Alta</option>
                            <option value="MEDIA" {{ old('prioridad', $actividades->prioridad) == 'MEDIA' ? 'selected' : '' }}>Media</option>
                            <option value="BAJA" {{ old('prioridad', $actividades->prioridad) == 'BAJA' ? 'selected' : '' }}>Baja</option>
                        </select>
                    </div>

                    <!-- Campo Departamento ID -->
                    <div class="form-group">
                        <label for="departamento_id">Departamento</label>
                        <select name="departamento_id" class="form-control" required>
                            @foreach ($departamentos as $departamento)
                                <option value="{{ $departamento->id }}" {{ old('departamento_id', $actividades->departamento_id) == $departamento->id ? 'selected' : '' }}>
                                    {{ $departamento->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Campo Error -->
                    <div class="form-group">
                        <label for="error">Tipo de Error</label>
                        <select name="error" class="form-control" required>
                            <option value="CLIENTE" {{ old('error', $actividades->error) == 'CLIENTE' ? 'selected' : '' }}>Cliente</option>
                            <option value="SOFTWARE" {{ old('error', $actividades->error) == 'SOFTWARE' ? 'selected' : '' }}>Software</option>
                            <option value="MEJORA ERROR" {{ old('error', $actividades->error) == 'MEJORA ERROR' ? 'selected' : '' }}>Mejora Error</option>
                            <option value="DESARROLLO" {{ old('error', $actividades->error) == 'DESARROLLO' ? 'selected' : '' }}>Desarrollo</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success mt-2">Guardar</button>
                    <a href="{{ route('actividades.indexActividades') }}" class="btn btn-primary mt-2">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
