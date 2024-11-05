@extends('layouts.app')

@section('content')
    <div class="container mt-7">
        <h1 class="text-center mb-8">Listado de Empleados</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('empleados.create') }}" class="btn btn-primary mb-3">Nuevo Empleado</a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-bordered w-100 table-sm">
                <thead class="thead-dark text-center">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>cedula</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Celular</th>
                        <th>Correo</th>
                        <th>Departamento</th>
                        <th>Cargo</th>
                        <th>Supervisor</th>
                        <th>Fecha de Contratación</th>
                        <th>Tipo de Jornada</th>
                        <th>Curriculum</th>
                        <th>Contrato</th>
                        <th>Contrato de Confidencialidad</th>
                        <th>Contrato de Consentimiento</th>
                        <th>Acciones</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($empleados as $empleado)
                        <tr>
                            <td>{{ $empleado->id }}</td>
                            <td>{{ $empleado->nombre1 . ' ' . $empleado->nombre2 }}</td>
                            <td>{{ $empleado->apellido1 . ' ' . $empleado->apellido2 }}</td>
                            <td>{{ $empleado->cedula }}</td>
                            <td>{{ $empleado->fecha_nacimiento }}</td>
                            <td>{{ $empleado->celular }}</td>
                            <td>{{ $empleado->correo_institucional }}</td>
                            <td>{{ optional($empleado->departamento)->nombre ?? 'N/A' }}</td>
                            <td>{{ optional($empleado->cargo)->nombre_cargo ?? 'N/A' }}</td>
                            <td>{{ optional($empleado->supervisor)->nombre_supervisor ?? 'N/A' }}</td>

                            <td>{{ $empleado->fecha_contratacion ? \Carbon\Carbon::parse($empleado->fecha_contratacion)->format('d/m/Y') : 'N/A' }}
                            </td>
                            <td>{{ $empleado->jornada_laboral }}</td>
                            
                        
                            <td>
                                @if ($empleado->curriculum)
                                    <a href="{{ asset('storage/' . $empleado->curriculum) }}" class="btn btn-info btn-sm"
                                        target="_blank">Ver Curriculum</a>
                                @else
                                    <span class="text-danger">No tiene curriculum</span>
                                @endif
                            </td>
                            <td>
                                @if ($empleado->contrato)
                                    <a href="{{ asset('storage/' . $empleado->contrato) }}" class="btn btn-info btn-sm"
                                        target="_blank">Ver Contrato</a>
                                @else
                                    <span class="text-danger">No tiene contrato</span>
                                @endif
                            </td>
                            <td>
                                @if ($empleado->contrato_confidencialidad)
                                    <a href="{{ asset('storage/' . $empleado->contrato_confidencialidad) }}"
                                        class="btn btn-info btn-sm" target="_blank">Ver Contrato de Confidencialidad</a>
                                @else
                                    <span class="text-danger">No tiene contrato de confidencialidad</span>
                                @endif
                            </td>
                            <td>
                                @if ($empleado->contrato_consentimiento)
                                    <a href="{{ asset('storage/' . $empleado->contrato_consentimiento) }}"
                                        class="btn btn-info btn-sm" target="_blank">Ver Contrato de Consentimiento</a>
                                @else
                                    <span class="text-danger">No tiene contrato de consentimiento</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('empleados.show', $empleado->id) }}" class="btn btn-info btn-sm"
                                    title="Ver"><i class="fas fa-eye fa-md"></i></a>
                                <a href="{{ route('empleados.edit', $empleado->id) }}" class="btn btn-warning btn-sm"
                                    title="Editar"><i class="fas fa-edit fa-md"></i></a>
                                <form action="{{ route('empleados.destroy', $empleado->id) }}" method="POST"
                                    class="d-inline form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm btn-delete" title="Eliminar">
                                        <i class="fas fa-trash fa-md"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="d-flex justify-content-center my-4">
            {{ $empleados->links() }}
        </div>

    </div>
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
