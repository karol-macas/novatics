@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h1>Detalles de la Actividad</h1>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $actividades->id }}</td>
                            </tr>
                            <tr>
                                <th>Cliente</th>
                                <td>{{ $actividades->cliente_id }}</td>
                            </tr>
                            <tr>
                                <th>Empleado</th>
                                <td>{{ $actividades->empleado_id }}</td>
                            </tr>
                            <tr>
                                <th>Descripción</th>
                                <td>{{ $actividades->descripcion }}</td>
                            </tr>
                            <tr>
                                <th>Código Osticket</th>
                                <td>{{ $actividades->codigo_osticket }}</td>
                            </tr>
                            <tr>
                                <th>Semanal o Diaria</th>
                                <td>{{ $actividades->semanal_diaria }}</td>
                            </tr>
                            <tr>
                                <th>Fecha de Inicio</th>
                                <td>{{ $actividades->fecha_inicio }}</td>
                            </tr>
                            <tr>
                                <th>Avance</th>
                                <td>{{ $actividades->avance }}%</td>
                            </tr>
                            <tr>
                                <th>Observaciones</th>
                                <td>{{ $actividades->observaciones }}</td>
                            </tr>
                            <tr>
                                <th>Estado</th>
                                <td>{{ $actividades->estado }}</td>
                            </tr>
                            <tr>
                                <th>Tiempo</th>
                                <td>{{ $actividades->tiempo }} minutos</td>
                            </tr>
                            <tr>
                                <th>Fecha de Fin</th>
                                <td>{{ $actividades->fecha_fin }}</td>
                            </tr>
                            <tr>
                                <th>Repetitivo</th>
                                <td>{{ $actividades->repetitivo ? 'Sí' : 'No' }}</td>
                            </tr>
                            <tr>
                                <th>Prioridad</th>
                                <td>{{ $actividades->prioridad }}</td>
                            </tr>
                            <tr>
                                <th>Departamento</th>
                                <td>{{ $actividades->departamento_id }}</td>
                            </tr>
                            <tr>
                                <th>Error</th>
                                <td>{{ $actividades->error }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class=" mt-3 ">
                        <a href="{{ route('actividades.indexActividades') }}" class="btn btn-primary">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
