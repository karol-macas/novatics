@extends('layouts.app')

@section('content')
    <div class="container mt-4" style="max-width: 700px;">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h1 class="mb-0">Crear Nuevo Rubro</h1>
            </div>

            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('rubros.store') }}" method="POST">
                    @csrf

                    <!-- Campo Nombre -->
                    <div class="form-group">
                        <label for="nombre">Nombre <span class="text-danger">*</span></label>
                        <input type="text" name="nombre" class="form-control" placeholder="Ingrese un nombre del Rubro" value="{{ old('nombre') }}" required>
                    </div>

                    <!-- Campo Descripción -->
                    <div class="form-group mt-4">
                        <label for="descripcion">Descripción <span class="text-danger">*</span></label>
                        <textarea name="descripcion" class="form-control" placeholder="Describe el rubro">{{ old('descripcion') }}</textarea>
                    </div>

                    <!-- Tipo de Rubro -->
                    <div class="form-group mt-4">
                        <label for="tipo">Tipo de Rubro <span class="text-danger">*</span></label>
                        <select name="tipo" class="form-control" required>
                            <option value="">Seleccione un tipo de rubro</option>
                            <option value="Ingreso" {{ old('tipo') === 'Ingreso' ? 'selected' : '' }}>Ingreso</option>
                            <option value="Egreso" {{ old('tipo') === 'Egreso' ? 'selected' : '' }}>Egreso</option>
                        </select>   
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <button type="submit" class="btn btn-primary">Guardar Rubro</button>
                        <a href="{{ route('rubros.index') }}" class="btn btn-outline-danger">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection