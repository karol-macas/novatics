@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Listado de Empleados</h1>
    <a href="{{ route('empleados.create') }}" class="btn btn-primary mb-3">Nuevo Empleado</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Correo Institucional</th>
                <th>Departamento</th>
                <th>Curriculum</th>
                <th>Contrato</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($empleados as $empleados)
                <tr>
                    <td>{{ $empleados->nombre1 }}</td>
                    <td>{{ $empleados->apellido1 }}</td>
                    <td>{{ $empleados->correo_institucional }}</td>
                    <td>{{ $empleados->departamento->nombre }}</td>
                    <td>
                        @if($empleados->curriculum)
                            <a href="{{ asset('storage/'.$empleados->curriculum) }}" class="btn btn-info btn-sm">Ver Curriculum</a>
                        @else
                            <span class="text-danger">No tiene curriculum</span>
                        @endif
                    </td>
                    <td>
                        @if($empleados->contrato)
                            <a href="{{ asset('storage/'.$empleados->contrato) }}" class="btn btn-info btn-sm">Ver Contrato</a>
                        @else
                            <span class="text-danger">No tiene contrato</span>
                        @endif
                    </td>
                    
                    <td>
                        <a href="{{ route('empleados.show', $empleados) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('empleados.edit', $empleados) }}" class="btn btn-warning btn-sm">Editar</a>
                        {{-- <form action="{{ route('empleados.destroy', $empleados) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
                        </form> --}}
                        <form action="{{ route('empleados.destroy', $empleados->id) }}" method="POST" style="display:inline-block;">
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
