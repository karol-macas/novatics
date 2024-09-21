@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Listado de Productos</h1>

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
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $producto)
                        <tr>
                            <td>{{ $producto->id }}</td>
                            <td>{{ $producto->nombre }}</td>
                            <td>{{ $producto->descripcion }}</td>
                           
                            <td>
                                <a href="{{ route('productos.show', $producto->id) }}" class="btn btn-info btn-lg" title="Ver">
                                    <i class="fas fa-eye icon-lg"></i> Ver
                                </a>
                                <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning btn-lg" title="Editar">
                                    <i class="fas fa-edit icon-lg"></i> Editar
                                </a>
                                <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-lg" title="Eliminar" onclick="return confirm('¿Estás seguro de querer eliminar este producto?')">
                                        <i class="fas fa-trash icon-lg"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <a href="{{ route('productos.create') }}" class="btn btn-primary btn-lg">Crear Producto</a>
    </div>
@endsection
