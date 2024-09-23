@extends('layouts.app')
@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h1>Crear Nuevo Cliente</h1>
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

                <form action="{{ route('clientes.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group ">
                        <label for="id_producto">Producto</label>
                        <select name="id_producto" class="form-control" required>
                            <option value="">Seleccione un producto</option>
                            @foreach ($productos as $producto)
                                <option value="{{ $producto->id }}"
                                    {{ old('id_producto') == $producto->id ? 'selected' : '' }}>
                                    {{ $producto->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Campo Nombre -->
                    <div class="form-group
                    ">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
                    </div>

                    <!-- Campo Dirección -->
                    <div class="form-group
                    ">
                        <label for="direccion">Dirección</label>
                        <input type="text" name="direccion" class="form-control" value="{{ old('direccion') }}" required>
                    </div>

                    <!-- Campo Teléfono -->
                    <div class="form-group
                    ">
                        <label for="telefono">Teléfono</label>
                        <input type="text" name="telefono" class="form-control" value="{{ old('telefono') }}" required>
                    </div>

                    <!-- Campo Email -->
                    <div class="form-group
                    ">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    </div>

                    <!-- Campo Contacto -->
                    <div class="form-group
                    ">
                        <label for="contacto">Contacto</label>
                        <input type="text" name="contacto" class="form-control" value="{{ old('contacto') }}">

                    </div>

                    <!-- Campo Precio -->
                    <div class="form-group
                    ">
                        <label for="precio">Precio</label>
                        <input type="number" name="precio" class="form-control" value="{{ old('precio') }}" required>
                    </div>

                    <!-- Campo Contrato -->
                    <div class="form-group">
                        <label for="contrato">Contrato</label>
                        <input type="file" name="contrato" class="form-control">
                    </div>

                    <!-- Campo Estado -->
                    <div class="form-group
                    ">
                        <label for="estado">Estado</label>
                        <select name="estado" class="form-control" required>
                            <option value="ACTIVO" {{ old('estado') == 'ACTIVO' ? 'selected' : '' }}>Activo</option>
                            <option value="INACTIVO" {{ old('estado') == 'INACTIVO' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar Cliente</button>

                    <a href="{{ route('clientes.index') }}" class="btn btn-danger">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
