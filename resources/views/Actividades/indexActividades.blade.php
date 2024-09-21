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
                        <th>ID</th>
                        <th>Cliente ID</th>
                        <th>Empleado ID</th>
                        <th>Descripción</th>
                        <th>Código OSTicket</th>
                        <th>Semanal/Diaria</th>
                        <th>Fecha de Inicio</th>
                        <th>Avance (%)</th>
                        <th>Observaciones</th>
                        <th>Estado</th>
                        <th>Tiempo (minutos)</th>
                        <th>Fecha de Fin</th>
                        <th>Repetitivo</th>
                        <th>Prioridad</th>
                        <th>Departamento ID</th>
                        <th>Error</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($actividades as $actividad)
                        <tr>
                            <td>{{ $actividad->id }}</td>
                            <td>{{ $actividad->cliente_id }}</td>
                            <td>{{ $actividad->empleado_id }}</td>
                            <td>{{ $actividad->descripcion }}</td>
                            <td>{{ $actividad->codigo_osticket }}</td>
                            <td>{{ $actividad->semanal_diaria }}</td>
                            <td>{{ $actividad->fecha_inicio }}</td>
                            <td>{{ $actividad->avance }}</td>
                            <td>{{ $actividad->observaciones }}</td>
                            <td>{{ $actividad->estado }}</td>
                            <td>{{ $actividad->tiempo }}</td>
                            <td>{{ $actividad->fecha_fin }}</td>
                            <td>{{ $actividad->repetitivo ? 'Sí' : 'No' }}</td>
                            <td>{{ $actividad->prioridad }}</td>
                            <td>{{ $actividad->departamento_id }}</td>
                            <td>{{ $actividad->error }}</td>
                            <td>
                                <a href="{{ route('actividades.show', $actividad->id) }}" class="btn btn-info btn-sm" title="Ver">
                                    <i class="fas fa-eye fa-lg"></i>
                                </a>
                                <a href="{{ route('actividades.edit', $actividad->id) }}" class="btn btn-warning btn-sm" title="Editar">
                                    <i class="fas fa-edit fa-lg"></i>
                                </a>
                                <form action="{{ route('actividades.destroy', $actividad->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Eliminar">
                                        <i class="fas fa-trash fa-lg"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <a href="{{ route('actividades.create') }}" class="btn btn-primary">Crear Actividad</a>
    </div>
@endsection

@section('scripts')
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
@endsection
