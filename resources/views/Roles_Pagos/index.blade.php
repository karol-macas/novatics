@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h1 class="mb-0">Roles de Pago</h1>
            </div>

            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('roles_pagos.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Crear Rol de Pago
                    </a>

                    <form action="{{ route('roles_pagos.index') }}" method="GET">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Buscar por empleado" value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-secondary">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="table-responsive mt-4">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Empleado</th>
                                <th>Rubros</th>
                                <th>Fecha de Inicio</th>
                                <th>Fecha de Fin</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($rolesPagos as $rolPago)
                                <tr>
                                    <td>{{ $rolPago->empleado->nombre }} {{ $rolPago->empleado->apellido }}</td>
                                    <td>
                                        @foreach ($rolPago->rubros as $rubro)
                                            <span class="badge badge-primary">{{ $rubro->nombre }}</span>
                                        @endforeach
                                    </td>
                                    <td>{{ $rolPago->fecha_inicio }}</td>
                                    <td>{{ $rolPago->fecha_fin }}</td>
                                    <td>{{ $rolPago->total_ingreso}}</td>
                                    <td>{{ $rolPago->total_egreso}}</td>
                                    <td>{{ $rolPago->salario_neto}}</td>
                                  
                                    <td>
                                        <a href="{{ route('roles_pagos.show', $rolPago->id) }}" class="btn btn-primary">
                                            <i class="fas fa-eye
                                            "></i> Ver
                                        </a>

                                        <a href="{{ route('roles_pagos.edit', $rolPago->id) }}" class="btn btn-warning">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>

                                        <form action="{{ route('roles_pagos.destroy', $rolPago->id) }}" method="POST" class="d-inline form-delete">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fas fa-trash"></i> Eliminar
                                            </button>
                                        </form>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No hay roles de pago registrados.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $rolesPagos->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection

                                   