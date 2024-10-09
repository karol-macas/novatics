@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white text-center">
                        <h1><i class="fas fa-info-circle"></i> Detalles de la Actividad</h1>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-hover">
                            <tbody>
                                <tr>
                                    <th><i class="fas fa-hashtag"></i> ID</th>
                                    <td>{{ $actividades->id }}</td>
                                </tr>
                                <tr>
                                    <th><i class="fas fa-user-tie"></i> Cliente</th>
                                    <td>{{ $actividades->cliente ? $actividades->cliente->nombre : 'N/A' }}</td>
                                    <!-- Verifica si existe cliente antes de acceder a nombre -->
                                </tr>
                                <tr>
                                    <th><i class="fas fa-user"></i> Empleado</th>
                                    <td>{{ $actividades->empleado ? $actividades->empleado->nombre1 . ' ' . $actividades->empleado->apellido1 : 'N/A' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th><i class="fas fa-align-left"></i> Descripción</th>
                                    <td>{{ $actividades->descripcion }}</td>
                                </tr>
                                <tr>
                                    <th><i class="fa-solid fa-ticket"></i> Código Osticket</th>
                                    <td>{{ $actividades->codigo_osticket }}</td>
                                </tr>
                                <tr>
                                    <th><i class="far fa-calendar-alt"></i> Frecuencia</th>
                                    <td>{{ $actividades->semanal_diaria }}</td>
                                </tr>
                                <tr>
                                    <th>
                                        <i class="fa-solid fa-calendar-check"></i> Fecha de Inicio
                                    </th>
                                    <td>{{ $actividades->fecha_inicio ? $actividades->fecha_inicio->format('d/m/Y') : 'N/A' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th><i class="fa-solid fa-chart-column"></i> Avance</th>
                                    <td>{{ $actividades->avance }}%</td>
                                </tr>
                                <tr>
                                    <th><i class="fas fa-comment"></i> Observaciones</th>
                                    <td>{{ $actividades->observaciones }}</td>
                                </tr>
                                <tr>
                                    <th><i class="fas fa-tasks"></i> Estado</th>
                                    <td>{{ $actividades->estado }}</td>
                                </tr>
                                <tr>
                                    <th><i class="fas fa-clock"></i> Tiempo Estimado</th>
                                    <td>{{ $actividades->tiempo_estimado }} minutos</td>
                                </tr>
                                <tr>
                                    <th><i class="fa-solid fa-calendar-xmark"></i> Fecha de Fin</th>
                                    <td>{{ $actividades->fecha_fin ? $actividades->fecha_fin->format('d/m/Y') : 'N/A' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th><i class="fas fa-sync-alt"></i> Repetitivo</th>
                                    <td>{{ $actividades->repetitivo ? 'Sí' : 'No' }}</td>
                                </tr>
                                <tr>
                                    <th><i class="fas fa-exclamation-circle"></i> Prioridad</th>
                                    <td>{{ $actividades->prioridad }}</td>
                                </tr>
                                <tr>
                                    <th><i class="fas fa-building"></i> Departamento</th>
                                    <td>{{ $actividades->departamento->nombre }}</td>
                                </tr>
                                <tr>
                                    <th><i class="fas fa-bug"></i> Tipo de Error</th>
                                    <td>{{ $actividades->error }}</td>
                                </tr>
                                <tr>
                                    <th><i class="fa-solid fa-calendar-plus"></i> Creacion de la Actividad</th>
                                    <td>
                                        @if ($actividades->created_at)
                                            {{ $actividades->created_at->format('d/m/Y H:i') }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th><i class="fa-solid fa-calendar-check"></i> Actualizacion de la Actividad</th>
                                    <td>
                                        @if ($actividades->updated_at)
                                            {{ $actividades->updated_at->format('d/m/Y H:i') }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="mt-3 text-center">
                            <a href="{{ route('actividades.indexActividades') }}" class="btn btn-primary">Volver al listado</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
