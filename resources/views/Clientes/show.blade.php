@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h1>Detalles de Cliente</h1>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>ID</th>
                                    <td>{{ $cliente->id }}</td>
                                </tr>
                                <tr>
                                    <th>Producto</th>
                                    <td>{{ $cliente->producto->nombre }}</td>
                                <tr>
                                    <th>Nombre</th>
                                    <td>{{ $cliente->nombre }}</td>
                                </tr>
                                <tr>
                                    <th>Dirección</th>
                                    <td>{{ $cliente->direccion }}</td>
                                </tr>
                                <tr>
                                    <th>Teléfono</th>
                                    <td>{{ $cliente->telefono }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $cliente->email }}</td>
                                </tr>
                                <tr>
                                    <th>Contacto</th>
                                    <td>{{ $cliente->contacto }}</td>
                                </tr>
                                <tr>
                                    <th>Orden de Trabajo</th>
                                    <td>
                                        @if ($cliente->orden_trabajo)
                                            <a href="{{ asset('storage/' . $cliente->orden_trabajo) }}"
                                                class="btn btn-info btn-sm">Ver Orden de Trabajo</a>
                                        @else
                                            <span class="text-danger">No tiene orden de trabajo</span>
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th>Contrato de Mantenimiento</th>
                                    <td>
                                        @if ($cliente->contrato_mantenimiento_licencia)
                                            <a href="{{ asset('storage/' . $cliente->contrato_mantenimiento_licencia) }}"
                                                class="btn btn-info btn-sm">Ver Contrato de Mantenimiento</a>
                                        @else
                                            <span class="text-danger">No tiene contrato de mantenimiento</span>
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th>Documentos Otros</th>
                                    <td>
                                        @if ($cliente->documento_otros)
                                            <a href="{{ asset('storage/' . $cliente->documento_otros) }}"
                                                class="btn btn-info btn-sm">Ver Documentos Otros</a>
                                        @else
                                            <span class="text-danger">No tiene documentos otros</span>
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th>Precio</th>
                                    <td>{{ $cliente->precio }}</td>
                                </tr>

                                <tr>
                                    <th>Estado</th>
                                    <td>{{ $cliente->estado }}</td>
                                </tr>
                                <tr>
                                    <th>Fecha de Creación</th>
                                    <td>{{ $cliente->created_at }}</td>
                                </tr>
                                <tr>
                                    <th>Fecha de Actualización</th>
                                    <td>{{ $cliente->updated_at }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('clientes.index') }}" class="btn btn-primary">Volver al listado</a>

                </div>

            </div>
        </div>
    </div>
@endsection
