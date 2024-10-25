@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm" style="max-width: 600px; margin: auto;">
            <div class="card-header bg-primary text-white text-center">
                <h1><i class="fas fa-edit"></i> Editar Supervisor</h1>
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

                <form action="{{ route('supervisores.update', $supervisor->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Campo Nombre del Supervisor que sera un empleado -->
                    <div class="form-group mb-3">
                        <label for="empleado_id">Empleado</label>
                        <select name="empleado_id" class="form-control" required>
                            <option value="">Seleccione un empleado</option>
                            @foreach ($empleados as $empleado)
                                <option value="{{ $empleado->id }}" {{ $empleado->id == $supervisor->empleado_id ? 'selected' : '' }}>
                                    {{ $empleado->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Descripcion -->
                    <div class="form-group mb-3">
                        <label for="descripcion">Descripcion</label>
                        <textarea name="descripcion" class="form-control" rows="3" required>{{ old('descripcion', $supervisor->descripcion) }}</textarea>
                    </div>

                    <!-- Botones Enviar -->
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-success btn-md">
                            <i class="fas fa-save"></i> Guardar Cambios
                        </button>
                        <a href="{{ route('supervisores.index') }}" class="btn btn-secondary btn-md ms-2">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
                    
