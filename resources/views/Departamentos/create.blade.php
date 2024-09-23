@extends('layouts.app')
@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h1>Crear Nuevo Departamento</h1>
            </div>

            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('departamentos.store') }}" method="POST">
                    @csrf

                    <!-- Campo Nombre -->
                    <div class="form-group
                    ">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
                    </div>

                    <!-- Campo Descripción -->
                    <div class="form-group
                    ">
                        <label for="descripcion">Descripción</label>
                        <input type="text" name="descripcion" class="form-control" value="{{ old('descripcion') }}" required>
                    </div>

                    <!-- Botón Enviar -->
                    <div class="form-group
                    ">
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection