@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-7">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white text-center">
                        <h1><i class="fa-solid fa-user-tie"></i> Editar Cliente</h1>
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

                        <form action="{{ route('clientes.update', $cliente->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <fieldset class="border p-3 mb-4">
                                <legend class="text-primary"><i class="fa-solid fa-user-tie"></i> Información del Cliente
                                </legend>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="id_producto">Producto</label>
                                        <select name="id_producto" class="form-control" required>
                                            <option value="">Seleccione un producto</option>
                                            @foreach ($productos as $producto)
                                                <option value="{{ $producto->id }}"
                                                    {{ old('id_producto', $cliente->id_producto) == $producto->id ? 'selected' : '' }}>
                                                    {{ $producto->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Campo Nombre -->
                                    <div class="form-group col-md-6">
                                        <label for="nombre">Nombre</label>
                                        <input type="text" name="nombre" class="form-control"
                                            value="{{ old('nombre', $cliente->nombre) }}" required>
                                    </div>

                                    <!-- Campo Dirección -->
                                    <div class="form-group col-md-6">
                                        <label for="direccion">Dirección</label>
                                        <input type="text" name="direccion" class="form-control"
                                            value="{{ old('direccion', $cliente->direccion) }}" required>
                                    </div>

                                    <!-- Campo Teléfono -->
                                    <div class="form-group col-md-6">
                                        <label for="telefono">Teléfono</label>
                                        <input type="text" name="telefono" class="form-control"
                                            value="{{ old('telefono', $cliente->telefono) }}" required>
                                    </div>

                                    <!-- Campo Email -->
                                    <div class="form-group col-md-6">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" class="form-control"
                                            value="{{ old('email', $cliente->email) }}" required>
                                    </div>

                                    <!-- Campo Contacto -->
                                    <div class="form-group col-md-6">
                                        <label for="contacto">Contacto</label>
                                        <input type="text" name="contacto" class="form-control"
                                            value="{{ old('contacto', $cliente->contacto) }}">
                                    </div>

                                    <!-- Campo Precio -->
                                    <div class="form-group col-md-6">
                                        <label for="precio">Precio</label>
                                        <input type="text" name="precio" class="form-control"
                                            value="{{ old('precio', $cliente->precio) }}" required>
                                    </div>

                                    <!-- Campo Estado -->
                                    <div class="form-group col-md-6">
                                        <label for="estado">Estado</label>
                                        <select name="estado" class="form-control" required>
                                            <option value="ACTIVO"
                                                {{ old('estado', $cliente->estado) == 'ACTIVO' ? 'selected' : '' }}>Activo
                                            </option>
                                            <option value="INACTIVO"
                                                {{ old('estado', $cliente->estado) == 'INACTIVO' ? 'selected' : '' }}>
                                                Inactivo
                                            </option>
                                        </select>
                                    </div>
                                </div>

                            </fieldset>

                            <fieldset class="border p-3 mb-4">
                                <legend class="text-primary"><i class="fa-solid fa-file"></i> Documentos</legend>
                                <div class="row">

                                    <!-- Campo Orden de Trabajo -->
                                    <div class="form-group col-md-6">
                                        <label for="orden_trabajo">Orden de Trabajo</label>
                                        <input type="file" name="orden_trabajo" class="form-control">
                                        @if ($cliente->orden_trabajo)
                                            <p class="mt-1">Archivo actual: <a
                                                    href="{{ asset('storage/' . $cliente->orden_trabajo) }}"
                                                    target="_blank">Ver
                                                    Orden de Trabajo</a></p>
                                        @endif
                                    </div>

                                    <!-- Campo Contrato Mantenimiento -->
                                    <div class="form-group col-md-6">
                                        <label for="contrato_mantenimiento_licencia">Contrato de Mantenimiento</label>
                                        <input type="file" name="contrato_mantenimiento_licencia" class="form-control">
                                        @if ($cliente->contrato_mantenimiento_licencia)
                                            <p class="mt-1">Archivo actual: <a
                                                    href="{{ asset('storage/' . $cliente->contrato_mantenimiento_licencia) }}"
                                                    target="_blank">Ver Contrato de Mantenimiento</a></p>
                                        @endif
                                    </div>

                                    <!-- Campo Documentos Otros -->
                                    <div class="form-group col-md-6">
                                        <label for="documento_otros">Documentos Otros</label>
                                        <input type="file" name="documento_otros" class="form-control">
                                        @if ($cliente->documento_otros)
                                            <p class="mt-1">Archivo actual: <a
                                                    href="{{ asset('storage/' . $cliente->documento_otros) }}"
                                                    target="_blank">Ver
                                                    Documentos Otros</a></p>
                                        @endif
                                    </div>
                                </div>
                            </fieldset>

                            <div class="d-flex justify-content-between mt-4">
                                <button type="submit" class="btn btn-primary">Actualizar Cliente</button>
                                <a href="{{ route('clientes.index') }}" class="btn btn-danger">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
