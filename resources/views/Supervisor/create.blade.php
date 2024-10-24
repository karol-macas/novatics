@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-sm" style="max-width: 600px; margin: auto;">
            <div class="card-header text-center bg-primary text-white">
                <h2><i class="fa-solid fa-building"></i> Crear Nuevo Supervisor</h2>
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

                <form action="{{ route('supervisores.store') }}" method="POST">
                    @csrf

                    <!-- Campo Nombre -->
                    <div class="form-group mb-3">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
                    </div>

                    <!-- Campo nombre del supervisor que sera un empleado -->
                    <div class="form-group mb-3">
                        <label for="empleado_id">Empleado</label>
                        <select name="empleado_id" class="form-control" required>
                            <option value="">Seleccione un empleado</option>
                            @foreach ($empleados as $empleado)
                                <option value="{{ $empleado->id }}">{{ $empleado->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Descripcion -->
                    <div class="form-group mb-3">
                        <label for="descripcion">Descripcion</label>
                        <textarea name="descripcion" class="form-control" rows="3" required>{{ old('descripcion') }}</textarea>
                    </div>

                    <!-- Botones Enviar -->
                    <div class="form-group text-center mt-4">
                        <button type="submit" class="btn btn-success me-2">
                            <i class="fas fa-save"></i> Guardar
                        </button>
                        <a href="{{ route('supervisores.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

                    