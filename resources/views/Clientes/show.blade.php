@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white text-center">
                        <h1><i class="fas fa-info-circle"></i> Detalles de Cliente</h1>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered table-striped table-hover">
                            <tbody>
                                <tr>
                                    <th><i class="fas fa-hashtag"></i> ID</th>
                                    <td>{{ $cliente->id }}</td>
                                </tr>
                                <tr>
                                    <th><i class="fas fa-box"></i> Productos</th>
                                    <td>
                                        @if ($cliente->productos->isNotEmpty())
                                            @foreach ($cliente->productos as $producto)
                                                {{ $producto->nombre }} <br>
                                            @endforeach
                                        @else
                                            <span class="text-danger">No tiene productos asociados</span>
                                        @endif
                                    </td>
                                </tr>
                    
                                <tr>
                                    <th><i class="fas fa-user"></i> Nombre</th>
                                    <td>{{ $cliente->nombre }}</td>
                                </tr>
                                <tr>
                                    <th><i class="fa-solid fa-location-dot"></i> Dirección</th>
                                    <td>{{ $cliente->direccion }}</td>
                                </tr>
                                <tr>
                                    <th><i class="fas fa-phone"></i> Teléfono</th>
                                    <td>{{ $cliente->telefono }}</td>
                                </tr>
                                <tr>
                                    <th><i class="fas fa-envelope"></i> Email</th>
                                    <td>{{ $cliente->email }}</td>
                                </tr>
                                <tr>
                                    <th><i class="fa-regular fa-address-book"></i> Contacto</th>
                                    <td>{{ $cliente->contacto }}</td>
                                </tr>
                                <tr>
                                    <th><i class="fas fa-file-pdf"></i> Orden de Trabajo</th>
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
                                    <th><i class="fas fa-file-pdf"></i> Contrato de Mantenimiento</th>
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
                                    <th><i class="fas fa-file-pdf"></i> Documentos Otros</th>
                                    <td>
                                        @if (!empty($urls))
                                            @foreach ($urls as $url)
                                                <a href="{{ $url }}" class="btn btn-info btn-sm mb-2" target="_blank">Ver Documento</a><br>
                                            @endforeach
                                        @else
                                            <span class="text-danger">No tiene documentos otros</span>
                                        @endif
                                    </td>
                                </tr>
                                

                                <tr>
                                    <th><i class="fa-solid fa-credit-card"></i> Precio</th>
                                    <td>{{ $cliente->precio }}</td>
                                </tr>
                                <tr>
                                    <th><i class="fas fa-toggle-on"></i> Estado</th>
                                    <td>{{ $cliente->estado }}</td>
                                </tr>
                                <tr>
                                    <th><i class="fas fa-calendar-plus"></i> Fecha de Creación</th>
                                    <td>{{ $cliente->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th><i class="fas fa-calendar-check"></i> Fecha de Actualización</th>
                                    <td>{{ $cliente->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="mt-4 text-center">
                            <a href="{{ route('clientes.index') }}" class="btn btn-primary">Volver al listado</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
