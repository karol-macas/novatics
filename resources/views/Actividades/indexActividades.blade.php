@extends('layouts.app')
@section('content')
    <div class="container mt-4">
        <h1>Listado de Actividades</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Empleado</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Código OSTicket</th>
                        <th scope="col">Semanal/Diaria</th>
                        <th scope="col">Fecha de Inicio</th>
                        <th scope="col">Avance (%)</th>
                        <th scope="col">Observaciones</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Tiempo (minutos)</th>
                        <th scope="col">Fecha de Fin</th>
                        <th scope="col">Repetitivo</th>
                        <th scope="col">Prioridad</th>
                        <th scope="col">Departamento</th>
                        <th scope="col">Error</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($actividades as $actividad)
                        <tr>
                            <td>{{ $actividad->id }}</td>
                            <td>{{ $actividad->Cliente->nombre }}</td>
                            <td>
                                @if (isset($actividad->empleados['nombre1']))
                                    {{ $actividad->empleados['nombre1'] }}
                                    {{ $actividad->empleados['apellido1'] }}
                                @endif
                            </td>
                            <td>{{ $actividad->descripcion }}</td>
                            <td>{{ $actividad->codigo_osticket }}</td>
                            <td>{{ $actividad->semanal_diaria }}</td>
                            <td>{{ $actividad->fecha_inicio }}</td>
                            <td>
                                <div class="progress" style="height: 25px;">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $actividad->avance }}%;"
                                        aria-valuenow="{{ $actividad->avance }}" aria-valuemin="0" aria-valuemax="100">
                                        {{ $actividad->avance }}%
                                    </div>
                                </div>
                                @if (Auth::user()->isEmpleado())
                                    <form action="{{ route('actividades.update', $actividad->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <input type="number" name="avance" class="form-control form-control-sm mt-2" placeholder="Avance" min="0" max="100" required>

                                        <button type="submit" class="btn btn-primary btn-sm mt-2">Actualizar Avance</button>
                                        
                                    </form>
                                @endif
                            </td>

                            <td>{{ $actividad->observaciones }}</td>
                            <td>
                                <span
                                    class="
                                {{ $actividad->estado == 'EN CURSO' ? 'badge bg-pastel-morado' : '' }}
                                {{ $actividad->estado == 'FINALIZADO' ? 'badge bg-pastel-verde' : '' }}
                                {{ $actividad->estado == 'PENDIENTE' ? 'badge bg-pastel-naranja' : '' }}">
                                    {{ $actividad->estado }}
                                </span>
                            </td>
                            <td>{{ $actividad->tiempo }}</td>
                            <td>{{ $actividad->fecha_fin }}</td>
                            <td>{{ $actividad->repetitivo ? 'Sí' : 'No' }}</td>
                            <td>
                                <span
                                    class="
                                {{ $actividad->prioridad == 'ALTA' ? 'badge bg-danger text-dark' : '' }}
                                {{ $actividad->prioridad == 'MEDIA' ? 'badge bg-warning text-dark' : '' }}
                                {{ $actividad->prioridad == 'BAJA' ? 'badge bg-success text-dark' : '' }}">
                                    {{ $actividad->prioridad }}
                                </span>
                            </td>
                            <td>
                                @if (isset($actividad->departamento['nombre']))
                                    {{ $actividad->departamento['nombre'] }}
                                @endif
                            </td>
                            <td>{{ $actividad->error }}</td>
                            <td>
                                @if (Auth::user()->isAdmin())
                                    <a href="{{ route('actividades.show', $actividad->id) }}" class="btn btn-info btn-sm"
                                        title="Ver">
                                        <i class="fas fa-eye fa-lg"></i>
                                    </a>
                                    <a href="{{ route('actividades.edit', $actividad->id) }}"
                                        class="btn btn-warning btn-sm" title="Editar">
                                        <i class="fas fa-edit fa-lg"></i>
                                    </a>
                                    <form action="{{ route('actividades.destroy', $actividad->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Eliminar">
                                            <i class="fas fa-trash fa-lg"></i>
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('actividades.show', $actividad->id) }}" class="btn btn-info btn-sm"
                                        title="Ver">
                                        <i class="fas fa-eye fa-lg"></i>
                                    </a>

                                    <a href="{{ route('actividades.edit', $actividad->id) }}"
                                        class="btn btn-warning btn-sm" title="Editar">
                                        <i class="fas fa-edit fa-lg"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <a href="{{ route('actividades.create') }}" class="btn btn-primary">Crear Actividad</a>
    </div>
@endsection
