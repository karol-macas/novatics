@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h1>Editar Cliente</h1>
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

                <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Campo Producto ID -->
                    <div class="form-group">
                        <label for="id_producto">Producto ID</label>
                        <input type="text" name="id_producto" class="form-control" value="{{ old('id_producto', $cliente->id_producto) }}" required>
                    </div>

                    <!-- Campo Nombre -->
                    <div class="form-group
                    ">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $cliente->nombre) }}" required>
                    </div>

                    <!-- Campo Dirección -->
                    <div class="form-group
                    ">
                        <label for="direccion">Dirección</label>
                        <input type="text" name="direccion" class="form-control" value="{{ old('direccion', $cliente->direccion) }}" required>
                    </div>

                    <!-- Campo Teléfono -->
                    <div class="form-group
                    ">
                        <label for="telefono">Teléfono</label>
                        <input type="text" name="telefono" class="form-control" value="{{ old('telefono', $cliente->telefono) }}" required>
                    </div>

                    <!-- Campo Email -->
                    <div class="form-group
                    ">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $cliente->email) }}" required>
                    </div>

                    <!-- Campo Contacto -->
                    <div class="form-group
                    ">
                        <label for="contacto">Contacto</label>
                        <input type="text" name="contacto" class="form-control" value="{{ old('contacto', $cliente->contacto) }}" required>
                    </div>

                    <!-- Campo Precio -->
                    <div class="form-group
                    ">
                        <label for="precio">Precio</label>
                        <input type="text" name="precio" class="form-control" value="{{ old('precio', $cliente->precio) }}" required>
                    </div>

                    <!-- Campo Contrato -->
                    <div class="form-group
                    ">
                        <label for="contrato">Contrato</label>
                        <input type="text" name="contrato" class="form-control" value="{{ old('contrato', $cliente->contrato) }}" required>
                    </div>

                    <!-- Campo Estado -->
                    <div class="form-group
                    ">
                        <label for="estado">Estado</label>
                        <select name="estado" class="form-control" required>
                            <option value="ACTIVO" {{ old('estado', $cliente->estado) == 'ACTIVO' ? 'selected' : '' }}>Activo</option>
                            <option value="INACTIVO" {{ old('estado', $cliente->estado) == 'INACTIVO' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>


                    <button type="submit" class="btn btn-primary">Guardar Cliente</button>

                    <a href="{{ route('clientes.index') }}" class="btn btn-danger">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection