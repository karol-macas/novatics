@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Listado de Departamentos</h1>

        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('departamentos.create') }}" class="btn btn-primary">Crear Departamento</a>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success mt-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive mt-4">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($departamentos as $departamento)
                        <tr>
                            <td>{{ $departamento->id }}</td>
                            <td>{{ $departamento->nombre }}</td>
                            <td>
                                <a href="{{ route('departamentos.show', $departamento->id) }}" class="btn btn-info btn-lg" title="Ver">
                                    <i class="fas fa-eye icon-lg"></i> Ver
                                </a>

                                <a href="{{ route('departamentos.edit', $departamento->id) }}" class="btn btn-warning btn-lg" title="Editar">
                                    <i class="fas fa-edit icon-lg"></i> Editar
                                </a>

                                <form action="{{ route('departamentos.destroy', $departamento->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-lg" title="Eliminar" onclick="return confirm('¿Estás seguro de querer eliminar este departamento?')">
                                        <i class="fas fa-trash icon-lg"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection



