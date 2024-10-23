@extends('layouts.app')

@section('content')
    <div class="container mt-7">
        <h1 class="text-center mb-8">Listado de Clientes</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('clientes.create') }}" class="btn btn-primary">Crear Cliente</a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered w-100 table-sm">
                <thead class="thead-dark text-center">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Productos</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Teléfono</th>
                        <th scope="col">Email</th>
                        <th scope="col">Contacto</th>
                        <th scope="col">Contrato de Implementacion</th>
                        <th scope="col">Convenio de Datos</th>
                        <th scope="col">Documentos Otros</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->id }}</td>
                            <td>
                                @foreach($cliente->productos as $producto)
                                    <span>{{ $producto->nombre }}</span>@if(!$loop->last), @endif
                                @endforeach
                            </td>
                            <td>{{ $cliente->nombre }}</td>
                            <td>{{ $cliente->direccion }}</td>
                            <td>{{ $cliente->telefono }}</td>
                            <td>{{ $cliente->email }}</td>
                            <td>{{ $cliente->contacto }}</td>
                            <td>
                                @if ($cliente->contrato_implementacion)
                                    <a href="{{ asset('storage/' . $cliente->contrato_implementacion) }}"
                                        class="btn btn-info btn-sm" target="_blank">Ver</a>
                                @else
                                    <span class="text-danger">No tiene contrato de implementación</span>
                                @endif
                            </td>
                            <td>
                                @if ($cliente->convenio_datos)
                                    <a href="{{ asset('storage/' . $cliente->convenio_datos) }}" class="btn btn-info btn-sm"
                                        target="_blank">Ver</a>
                                @else
                                    <span class="text-danger">No tiene convenio de datos</span>
                                @endif
                            </td>
                            <td>
                                @if ($cliente->documento_otros)
                                    @php
                                        $documentos = json_decode($cliente->documento_otros, true) ?? [];
                                    @endphp
                                    @foreach ($documentos as $documento)
                                        <a href="{{ asset('storage/' . $documento) }}" class="btn btn-info btn-sm mb-2" target="_blank">Ver Documento</a><br>
                                    @endforeach
                                @else
                                    <span class="text-danger">No tiene documentos otros</span>
                                @endif
                            </td>
                            <td>{{ $cliente->precio }}</td>
                            <td>{{ $cliente->estado }}</td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('clientes.show', $cliente->id) }}" class="btn btn-info btn-sm"
                                        title="Ver">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-warning btn-sm"
                                        title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST"
                                        class="d-inline form-delete">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm btn-delete" title="Eliminar">
                                            <i class="fas fa-trash fa-md"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- Paginación -->
        <div class="d-flex justify-content-center my-4">
            {{ $clientes->links('pagination::bootstrap-4') }}
        </div>
    </div>
    {{-- SweetAlert script --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // SweetAlert para confirmación de eliminación
        document.querySelectorAll('.form-delete').forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Esta acción no se puede deshacer",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                })
            });
        });
    </script>
@endsection
