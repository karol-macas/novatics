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

                    <!-- Campo Nombre del Supervisor -->
                    <div class="form-group mb-3">
                        <label for="nombre_supervisor">Nombre del Supervisor</label>
                        <input type="text" name="nombre_supervisor" class="form-control" value="{{ old('nombre_supervisor') }}" required>
                    </div>

                    <!-- Campo empleado -->
                    <div class="form-group mb-3">
                        <label for="empleado_id">Empleado</label>
                        <select name="empleado_id" class="form-control" required>
                            <option value="">Seleccione un empleado</option>
                            @foreach ($empleados as $empleado)
                                <option value="{{ $empleado->id }}">{{ $empleado->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Descripción -->
                    <div class="form-group mb-3">
                        <label for="descripcion">Descripción</label>
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
