@extends('layouts.app')

@section('content')
    <div class="container mt-7">
            
            <h1 class="text-center mb-8">Listado de Cargos</h1>

            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Descripción</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cargos as $cargo)
                                            <tr>
                                                <td>{{ $cargo->nombre }}</td>
                                                <td>{{ $cargo->descripcion }}</td>
                                                <td>
                                                    <a href="{{ route('cargos.edit', $cargo) }}" class="btn btn-primary btn-sm">Editar</a>
                                                    <form action="{{ route('cargos.destroy', $cargo) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
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
            </div>
    </div>
@endsection
    
          