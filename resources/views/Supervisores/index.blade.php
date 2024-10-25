@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Listado de Supervisores</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('supervisores.create') }}" class="btn btn-primary">Crear Nuevo Supervisor</a>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($supervisores as $supervisor)
                    <tr>
                        <td>{{ $supervisor->nombre_supervisor }}</td>
                        <td>{{ $supervisor->descripcion }}</td>
                        <td>
                            <a href="{{ route('supervisores.show', $supervisor->id) }}" class="btn btn-info">Ver</a>
                            <a href="{{ route('supervisores.edit', $supervisor->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('supervisores.destroy', $supervisor->id) }}" method="POST" style="display:inline;">
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
@endsection
