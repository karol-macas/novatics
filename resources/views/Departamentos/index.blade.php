@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h1>Listado de Departamentos</h1>
            </div>

            <div class="card-body">
                <a href="{{ route('departamentos.create') }}" class="btn btn-primary mb-4">Crear Nuevo Departamento</a>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($departamentos as $departamento)
                            <tr>
                                <td>{{ $departamento->nombre }}</td>
                                <td>{{ $departamento->descripcion }}</td>
                                <td>
                                    <a href="{{ route('departamentos.edit', $departamento->id) }}" class="btn btn-info">Editar</a>

                                    <form action="{{ route('departamentos.destroy', $departamento->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
