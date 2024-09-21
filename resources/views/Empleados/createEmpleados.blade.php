@extends('layouts.app')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@section('content')
<div class="container">
    <h1>Nuevo Empleado</h1>
    <form action="{{ route('empleados.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="nombre1">Primer Nombre</label>
            <input type="text" name="nombre1" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="nombre2">Segundo Nombre</label>
            <input type="text" name="nombre2" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="apellido1">Primer Apellido</label>
            <input type="text" name="apellido1" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="apellido2">Segundo Apellido</label>
            <input type="text" name="apellido2" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="cedula">Cédula</label>
            <input type="text" class="form-control" id="cedula" name="cedula" value="{{ old('cedula') }}">
            @error('cedula')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="fecha_nacimiento">Fecha de Nacimiento</label>
            <input type="date" name="fecha_nacimiento" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" name="telefono" class="form-control">
        </div>
        <div class="form-group">
            <label for="celular">Celular</label>
            <input type="text" name="celular" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="correo_institucional">Correo Institucional</label>
            <input type="email" name="correo_institucional" class="form-control" required>
        </div>
        {{-- <div class="form-group">
            <label for="departamento_id">Departamento</label>
            <select name="departamento_id" class="form-control" required>
                @foreach($departamentos as $departamento)
                    <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
                @endforeach
            </select>
        </div> --}}
        <div class="form-group">
            <label for="departamento">Departamento</label>
            <select name="departamento_id" id="departamento" class="form-control">
                <option value="">Selecciona un Departamento</option>
                @foreach($departamentos as $departamento)
                    <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="curriculum">Currículum</label>
            <input type="file" name="curriculum" class="form-control">
        </div>
        <div class="form-group">
            <label for="contrato">Contrato Escaneado</label>
            <input type="file" name="contrato" class="form-control">
        </div>
        <div class="form-group">
            <label for="fecha_ingreso">Fecha de Ingreso</label>
            <input type="date" name="fecha_ingreso" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection
