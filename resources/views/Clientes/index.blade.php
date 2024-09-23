@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h1>Listado de Clientes</h1>

                <a href="{{ route('clientes.create') }}" class="btn btn-primary">Crear Cliente</a>
            </div>

            <div class="card-body">
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
                                <th>Producto ID</th>
                                <th>Nombre</th>
                                <th>Dirección</th>
                                <th>Teléfono</th>
                                <th>Email</th>
                                <th>Contacto</th>
                                <th>Precio</th>
                                <th>Contrato</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clientes as $cliente)
                                <tr>
                                    <td>{{ $cliente->id }}</td>
                                    <td>{{ $cliente->producto->nombre }}</td>
                                    <td>{{ $cliente->nombre }}</td>
                                    <td>{{ $cliente->direccion }}</td>
                                    <td>{{ $cliente->telefono }}</td>
                                    <td>{{ $cliente->email }}</td>
                                    <td>{{ $cliente->contacto }}</td>
                                    <td>{{ $cliente->precio }}</td>
                                    <td>
                                        @if($cliente->contrato)
                                            <a href="{{ asset('storage/'.$cliente->contrato) }}" class="btn btn-info btn-sm">Ver Contrato</a>
                                        @else
                                            <span class="text-danger">No tiene contrato</span>
                                        @endif
                                    </td>
                                    
                                    <td>{{ $cliente->estado }}</td>
                                    <td>
                                        <a href="{{ route('clientes.show', $cliente->id) }}" class="btn btn-info btn" title="Ver">
                                            <i class="fas fa-eye
                                            "></i> Ver
                                        </a>
                                        <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-warning btn" title="Editar">
                                            <i class="fas fa-edit
                                            "></i> Editar
                                        </a>
                                        <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger mt-1" title="Eliminar" onclick="return confirm('¿Estás seguro de querer eliminar este cliente?')">
                                                <i class="fas fa-trash
                                                "></i> Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection



