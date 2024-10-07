@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white text-center">
                        <h1><i class="fas fa-info-circle"></i> Detalles del Empleado</h1>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-hover">
                            <tbody>
                                <tr>
                                    <th><i class="fas fa-hashtag"></i> ID</th>
                                    <td>{{ $empleados->id }}</td>
                                </tr>
                                <tr>
                                    <th><i class="fas fa-user"></i> Nombres</th>
                                    <td>{{ $empleados->nombre1 . ' ' . $empleados->nombre2 }}</td>
                                </tr>
                                <tr>
                                    <th><i class="fas fa-user"></i> Apellidos</th>
                                    <td>{{ $empleados->apellido1 . ' ' . $empleados->apellido2 }}</td>
                                </tr>
                                <tr>
                                    <th><i class="fa-solid fa-cake-candles"></i> Fecha de Nacimiento</th>
                                    <td>{{ $empleados->fecha_nacimiento }}</td>
                                </tr>
                                <tr>
                                    <th><i class="fas fa-phone"></i> Teléfono</th>
                                    <td>{{ $empleados->telefono }}</td>
                                </tr>
                                <tr>
                                    <th><i class="fas fa-mobile-alt"></i> Celular</th>
                                    <td>{{ $empleados->celular }}</td>
                                </tr>
                                <tr>
                                    <th><i class="fas fa-envelope"></i> Correo Institucional</th>
                                    <td>{{ $empleados->correo_institucional }}</td>
                                </tr>
                                <tr>
                                    <th><i class="fas fa-building"></i> Departamento</th>
                                    <td>{{ $empleados->departamento->nombre }}</td>
                                </tr>

                                <tr>
                                    <th><i class="fas fa-calendar-alt"></i> Fecha de Ingreso</th>
                                    <td>{{ $empleados->fecha_ingreso ? \Carbon\Carbon::parse($empleados->fecha_ingreso)->format('d/m/Y') : 'N/A' }}
                                    </td>
                                </tr>

                                @if ($empleados->curriculum)
                                    <tr>
                                        <th><i class="fas fa-file-pdf"></i> Curriculum</th>
                                        <td><a href="{{ asset('storage/' . $empleados->curriculum) }}" target="_blank">Ver
                                                Curriculum</a></td>
                                    </tr>
                                @else
                                    <tr>
                                        <th><i class="fas fa-file-pdf"></i> Curriculum</th>
                                        <td>N/A</td>
                                    </tr>
                                @endif
                                @if ($empleados->contrato)
                                    <tr>
                                        <th><i class="fas fa-file-pdf"></i> Contrato</th>
                                        <td><a href="{{ asset('storage/' . $empleados->contrato) }}" target="_blank">Ver
                                                Contrato</a></td>
                                    </tr>
                                @else
                                    <tr>
                                        <th><i class="fas fa-file-pdf"></i> Contrato</th>
                                        <td>N/A</td>
                                    </tr>
                                @endif
                                @if ($empleados->contrato_confidencialidad)
                                    <tr>
                                        <th><i class="fas fa-file-pdf"></i> Contrato de Confidencialidad</th>
                                        <td><a href="{{ asset('storage/' . $empleados->contrato_confidencialidad) }}"
                                                target="_blank">Ver Contrato de Confidencialidad</a></td>
                                    </tr>
                                @else
                                    <tr>
                                        <th><i class="fas fa-file-pdf"></i> Contrato de Confidencialidad</th>
                                        <td>N/A</td>
                                    </tr>
                                @endif
                                @if ($empleados->contrato_consentimiento)
                                    <tr>
                                        <th><i class="fas fa-file-pdf"></i> Contrato de Consentimiento de Datos</th>
                                        <td><a href="{{ asset('storage/' . $empleados->contrato_consentimiento) }}"
                                                target="_blank">Ver Contrato de Consentimiento de Datos</a></td>
                                    </tr>
                                @else
                                    <tr>
                                        <th><i class="fas fa-file-pdf"></i> Contrato de Consentimiento de Datos</th>
                                        <td>N/A</td>
                                    </tr>
                                @endif
                                <tr>
                                    <th><i class="fas fa-calendar-plus"></i> Creación del Empleado</th>
                                    <td>
                                        @if ($empleados->created_at)
                                            {{ $empleados->created_at->format('d/m/Y H:i') }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th><i class="fas fa-calendar-check"></i> Actualización del Empleado</th>
                                    <td>
                                        @if ($empleados->updated_at)
                                            {{ $empleados->updated_at->format('d/m/Y H:i') }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="mt-3 text-center">
                            <a href="{{ route('empleados.indexEmpleados') }}" class="btn btn-primary">Volver al listado</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
