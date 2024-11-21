@extends('layouts.app')

@section('content')
    <h1>Registrar Cumplimiento</h1>
    <form action="{{ route('matriz_cumplimientos.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="parametro_id">Parámetro</label>
            <select name="parametro_id" id="parametro_id" class="form-control" required>
                <option value="" disabled selected>Seleccione un parámetro</option>
                @foreach ($parametros as $parametro)
                    <option value="{{ $parametro->id }}">{{ $parametro->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="supervisor_id">Supervisor</label>
            <input type="text" class="form-control" value="{{ $empleados->supervisor->nombre_supervisor }}" readonly>
            <input type="hidden" name="supervisor_id" value="{{ $empleados->supervisor->id }}">
        </div>

        <div class="form-group">
            <label for="puntos">Puntos</label>
            <input type="number" name="puntos" id="puntos" class="form-control" min="0" required>
        </div>

        <div class="form-group">
            <label for="empleado_id">Empleado</label>
            <input type="number" name="empleado_id" id="empleado_id" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="cargo_id">Cargo</label>
            <input type="number" name="cargo_id" id="cargo_id" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="supervisor_id">Supervisor</label>
            <input type="number" name="supervisor_id" id="supervisor_id" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
@endsection
