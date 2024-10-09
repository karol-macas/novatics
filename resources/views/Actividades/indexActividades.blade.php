@extends('layouts.app')
@section('content')
    <div class="container mt-7">
        <h1 class="text-center mb-8">Listado de Actividades</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (Auth::user()->isAdmin())
            <!-- Formulario estilizado para seleccionar un empleado -->
            <form action="{{ route('actividades.indexActividades') }}" method="GET" class="mb-4 p-4 shadow bg-light rounded">
                <div class="form-group">
                    <label for="empleado_id" class="form-label fs-5">Seleccionar Empleado:</label>
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white">
                            <i class="fas fa-user"></i>
                        </span>
                        <select name="empleado_id" id="empleado_id" class="form-select" onchange="this.form.submit()">
                            <option value="">-- Todos los empleados --</option>
                            @foreach ($empleados as $empleado)
                                <option value="{{ $empleado->id }}"
                                    {{ request('empleado_id') == $empleado->id ? 'selected' : '' }}>
                                    {{ $empleado->nombre1 }} {{ $empleado->apellido1 }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>
        @endif


        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('actividades.create') }}" class="btn btn-primary btn-lg">Crear Actividad</a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-bordered w-100 table-sm">
                <thead class="thead-dark text-center">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Empleado</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Código Osticket</th>
                        <th scope="col">Semanal/Diaria</th>
                        <th scope="col">Fecha de Inicio</th>
                        <th scope="col">Avance (%)</th>
                        <th scope="col">Observaciones</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Tiempo Estimado (min)</th>
                        <th scope="col">Tiempo Real (h y m)</th>
                        <th scope="col">Fecha de Fin</th>
                        <th scope="col">Repetitivo</th>
                        <th scope="col">Prioridad</th>
                        <th scope="col">Departamento</th>
                        <th scope="col">Error</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($actividades as $actividad)
                        <tr>
                            <td>{{ $actividad->id }}</td>
                            <td>
                                @if (isset($actividad->clientes['nombre']))
                                    {{ $actividad->clientes['nombre'] }}
                                @endif
                            </td>
                            <td>
                                @if ($actividad->empleado)
                                    {{ $actividad->empleado->nombre1 }} {{ $actividad->empleado->apellido1 }}
                                @else
                                    No asignado
                                @endif
                            </td>

                           
                            

                            <td>{{ $actividad->descripcion }}</td>
                            <td>{{ $actividad->codigo_osticket }}</td>
                            <td>{{ $actividad->semanal_diaria }}</td>
                            <td>{{ $actividad->fecha_inicio->format('d-m-Y') }}</td>
                            @if (Auth::user()->isEmpleado())
                                <td>
                                    <div class="progress" style="height: 25px;">
                                        <div class="progress-bar" role="progressbar"
                                            style="width: {{ $actividad->avance }}%;"
                                            aria-valuenow="{{ $actividad->avance }}" aria-valuemin="0" aria-valuemax="100">
                                            {{ $actividad->avance }}%
                                        </div>
                                    </div>
                                    <form action="{{ route('actividades.updateAvance', $actividad->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <input type="number" name="avance" class="form-control form-control-sm mt-2"
                                            placeholder="Avance" min="0" max="100"
                                            value="{{ $actividad->avance }}" required>
                                        <button type="submit" class="btn btn-outline-success btn-sm mt-2">Actualizar
                                            Avance</button>
                                    </form>
                                </td>
                            @else
                                <td>
                                    <div class="progress" style="height: 25px;">
                                        <div class="progress-bar" role="progressbar"
                                            style="width: {{ $actividad->avance }}%;"
                                            aria-valuenow="{{ $actividad->avance }}" aria-valuemin="0" aria-valuemax="100">
                                            {{ $actividad->avance }}%
                                        </div>
                                    </div>
                                </td>
                            @endif

                            <td>{{ $actividad->observaciones }}</td>
                            @if (Auth::user()->isEmpleado())
                                <td>

                                    <div>
                                        <span
                                            class="badge
                                                {{ $actividad->estado == 'EN CURSO' ? 'badge bg-pastel-morado' : '' }}
                                                {{ $actividad->estado == 'FINALIZADO' ? 'badge bg-pastel-verde' : '' }}
                                                {{ $actividad->estado == 'PENDIENTE' ? 'badge bg-pastel-naranja' : '' }}">
                                            {{ $actividad->estado }}
                                        </span>

                                    </div>

                                    <form action="{{ route('actividades.updateEstado', $actividad->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <select name="estado" class="form-select form-select-sm mt-2" required>
                                            <option value="EN CURSO"
                                                {{ $actividad->estado == 'EN CURSO' ? 'selected' : '' }}>EN CURSO
                                            </option>
                                            <option value="FINALIZADO"
                                                {{ $actividad->estado == 'FINALIZADO' ? 'selected' : '' }}>FINALIZADO
                                            </option>
                                            <option value="PENDIENTE"
                                                {{ $actividad->estado == 'PENDIENTE' ? 'selected' : '' }}>PENDIENTE
                                            </option>
                                        </select>
                                        <button type="submit" class="btn btn-outline-success btn-sm mt-2 ">Actualizar
                                            Estado</button>
                                    </form>
                                </td>
                            @else
                                <td>
                                    <span
                                        class="badge
                                {{ $actividad->estado == 'EN CURSO' ? 'badge bg-pastel-morado' : '' }}
                                {{ $actividad->estado == 'FINALIZADO' ? 'badge bg-pastel-verde' : '' }}
                                {{ $actividad->estado == 'PENDIENTE' ? 'badge bg-pastel-naranja' : '' }}">
                                        {{ $actividad->estado }}
                                    </span>
                                </td>
                            @endif

                            <td>
                                @if (Auth::user()->isEmpleado())
                                    <div>
                                        {{ $actividad->tiempo_estimado }} min
                                    </div>
                                    <form action="{{ route('actividades.updateTiempoEstimado', $actividad->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')

                                        <input type="number" name="tiempo_estimado" class="form-control form-control-sm"
                                            placeholder="Tiempo Estimado" min="0"
                                            value="{{ $actividad->tiempo_estimado }}" required>
                                        <button type="submit" class="btn btn-outline-success btn-sm mt-2">Actualizar

                                    </form>
                                @else
                                    {{ $actividad->tiempo_estimado }}
                                @endif
                            </td>

                            <td>
                                @if ($actividad->estado === 'FINALIZADO')
                                    {{ $actividad->tiempo_real_horas ?? 0 }} h y
                                    {{ $actividad->tiempo_real_minutos ?? 0 }} min
                                @else
                                    N/A
                                @endif
                            </td>

                            <td>{{ $actividad->fecha_fin ? $actividad->fecha_fin->format('d-m-Y') : '' }}</td>

                            <td>{{ $actividad->repetitivo ? 'Sí' : 'No' }}</td>
                            <td>
                                <span
                                    class="badge
                                {{ $actividad->prioridad == 'ALTA' ? 'badge bg-danger text-light' : '' }}
                                {{ $actividad->prioridad == 'MEDIA' ? 'badge bg-warning text-dark' : '' }}
                                {{ $actividad->prioridad == 'BAJA' ? 'badge bg-success text-light' : '' }}">
                                    {{ $actividad->prioridad }}
                                </span>
                            </td>
                            <td>
                                @if (isset($actividad->departamento['nombre']))
                                    {{ $actividad->departamento['nombre'] }}
                                @endif
                            </td>
                            <td>{{ $actividad->error }}</td>
                            <td class="text-center">
                                @if (Auth::user()->isAdmin())
                                    <a href="{{ route('actividades.show', $actividad->id) }}" class="btn btn-info btn-sm"
                                        title="Ver">
                                        <i class="fas fa-eye fa-md"></i>
                                    </a>
                                    <a href="{{ route('actividades.edit', $actividad->id) }}"
                                        class="btn btn-warning btn-sm" title="Editar">
                                        <i class="fas fa-edit fa-md"></i>
                                    </a>
                                    <form action="{{ route('actividades.destroy', $actividad->id) }}" method="POST"
                                        class="d-inline form-delete">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm btn-delete" title="Eliminar">
                                            <i class="fas fa-trash fa-md"></i>
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('actividades.show', $actividad->id) }}" class="btn btn-info btn-sm"
                                        title="Ver">
                                        <i class="fas fa-eye fa-md"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- Paginación -->
        <div class="d-flex justify-content-center my-4">
            {{ $actividades->links('pagination::bootstrap-4') }}
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
