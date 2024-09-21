@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h1>Detalles de Producto</h1>
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $producto->id }}</td>
                            </tr>
                            <tr>
                                <th>Nombre</th>
                                <td>{{ $producto->nombre }}</td>
                            </tr>
                            <tr>
                                <th>Descripción</th>
                                <td>{{ $producto->descripcion }}</td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('productos.index') }}" class="btn btn-primary">Volver al listado</a>

                </div>
                    
        </div>
    </div>
</div>
@endsection



