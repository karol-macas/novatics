@extends('layouts.app')

@section('content')
    <div class="container mt-7">
            
            <h1 class="text-center mb-8">Listado de Departamentos</h1>
    
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
    
            <div class="d-flex justify-content-between mb-3">
                <a href="{{ route('departamentos.create') }}" class="btn btn-primary btn-lg">Crear Nuevo Departamento</a>
    
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped w-100 table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
    
                    <tbody>
                        @foreach ($departamentos as $departamento)
                            <tr>
                                <td>{{ $departamento->nombre }}</td>
                                <td>{{ $departamento->descripcion }}</td>
                                <td class="text-center">
    
                                    <a href="{{ route('departamentos.show', $departamento->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye
                                        "></i>
                                    </a>

                                    <a href="{{ route('departamentos.edit', $departamento->id) }}"
                                        class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('departamentos.destroy', $departamento->id) }}" method="POST"
                                        class="d-inline form-delete">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm btn-delete" title="Eliminar">
                                            <i class="fas fa-trash fa-md"></i>
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
