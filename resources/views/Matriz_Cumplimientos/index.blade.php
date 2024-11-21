@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="text-center mb-4">Matriz de Cumplimientos</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <a href="{{ route('matriz_cumplimientos.create') }}" class="btn btn-primary">Añadir Cumplimiento</a>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Parámetro</th>
                    <th>Puntos</th>
                    <th>Empleado</th>
                    <th>Cargo</th>
                    <th>Supervisor</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cumplimientos as $cumplimiento)
                    <tr>
                        <td>{{ $cumplimiento->id }}</td>
                        <td>{{ $cumplimiento->parametro }}</td>
                        <td>{{ $cumplimiento->puntos }}</td>
                        <td>{{ $cumplimiento->empleado->nombre }}</td>
                        <td>{{ $cumplimiento->cargo->nombre }}</td>
                        <td>{{ $cumplimiento->supervisor->nombre_supervisor }}</td>
                        <td>
                            <a href="{{ route('matriz_cumplimientos.edit', $cumplimiento) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('matriz_cumplimientos.destroy', $cumplimiento) }}" method="POST" style="display:inline-block;">
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