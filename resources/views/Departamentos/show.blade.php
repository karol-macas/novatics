@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h1>Detalles del Departamento</h1>
                </div>

                <div class="card-body">
                    <div class="form-group
                    ">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" class="form-control" value="{{ $departamento->nombre }}" readonly>
                    </div>

                    <div class="form-group
                    ">
                        <label for="descripcion">Descripción</label>
                        <input type="text" name="descripcion" class="form-control" value="{{ $departamento->descripcion }}" readonly>
                    </div>

                    <div class="form-group
                    ">
                        <a href="{{ route('departamentos.index') }}" class="btn btn-primary">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection