<div class="container mt-7">
    <h1 class="text-center mb-8">Listado de Actividades 2</h1>

    <div class="table-responsive">
        <table class="table table-hover table-bordered w-100 table-sm">
            <thead class="thead-dark text-center">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">
                        Cliente
                        <input type="text" wire:model="cliente_filter" class="form-control form-control-sm" placeholder="Filtrar...">
                    </th>
                    <th scope="col">
                        Empleado
                        <input type="text" wire:model="empleado_filter" class="form-control form-control-sm" placeholder="Filtrar...">
                    </th>
                    <th scope="col">
                        Descripción
                        <input type="text" wire:model="descripcion_filter" class="form-control form-control-sm" placeholder="Filtrar...">
                    </th>
                    <th scope="col">
                        Código Osticket
                        <input type="text" wire:model="codigo_filter" class="form-control form-control-sm" placeholder="Filtrar...">
                    </th>
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
                        <td>{{ $actividad->cliente ? $actividad->cliente->nombre : 'No asignado' }}</td>
                        <td>{{ $actividad->empleado ? $actividad->empleado->nombre1 . ' ' . $actividad->empleado->apellido1 : 'No asignado' }}</td>
                        <td>{{ $actividad->descripcion }}</td>
                        <td>{{ $actividad->codigo_osticket }}</td>
                        <td>{{ $actividad->semanal_diaria }}</td>
                        <td>{{ $actividad->fecha_inicio->format('d-m-Y') }}</td>
                        <td>
                            <div class="progress" style="height: 25px;">
                                <div class="progress-bar" role="progressbar" style="width: {{ $actividad->avance }}%;" aria-valuenow="{{ $actividad->avance }}" aria-valuemin="0" aria-valuemax="100">
                                    {{ $actividad->avance }}%
                                </div>
                            </div>
                        </td>
                        <td>{{ $actividad->observaciones }}</td>
                        <td>
                            <span class="badge {{ $actividad->estado == 'EN CURSO' ? 'badge bg-pastel-morado' : ($actividad->estado == 'FINALIZADO' ? 'badge bg-pastel-verde' : 'badge bg-pastel-naranja') }}">
                                {{ $actividad->estado }}
                            </span>
                        </td>
                        <td>{{ $actividad->tiempo_estimado }}</td>
                        <td>{{ $actividad->estado === 'FINALIZADO' ? ($actividad->tiempo_real_horas ?? 0) . ' h y ' . ($actividad->tiempo_real_minutos ?? 0) . ' min' : 'N/A' }}</td>
                        <td>{{ $actividad->fecha_fin ? $actividad->fecha_fin->format('d-m-Y') : '' }}</td>
                        <td>{{ $actividad->repetitivo ? 'Sí' : 'No' }}</td>
                        <td>
                            <span class="badge {{ $actividad->prioridad == 'ALTA' ? 'badge bg-danger text-light' : ($actividad->prioridad == 'MEDIA' ? 'badge bg-warning text-dark' : 'badge bg-success text-light') }}">
                                {{ $actividad->prioridad }}
                            </span>
                        </td>
                        <td>{{ $actividad->departamento->nombre }}</td>
                        <td>{{ $actividad->error }}</td>
                        <td class="text-center">
                            @if (Auth::user()->isAdmin())
                                <a href="{{ route('actividades.show', $actividad->id) }}" class="btn btn-info btn-sm" title="Ver"><i class="fas fa-eye fa-md"></i></a>
                                <a href="{{ route('actividades.edit', $actividad->id) }}" class="btn btn-warning btn-sm" title="Editar"><i class="fas fa-edit fa-md"></i></a>
                                <form action="{{ route('actividades.destroy', $actividad->id) }}" method="POST" class="d-inline form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm btn-delete" title="Eliminar"><i class="fas fa-trash fa-md"></i></button>
                                </form>
                            @else
                                <a href="{{ route('actividades.show', $actividad->id) }}" class="btn btn-info btn-sm" title="Ver"><i class="fas fa-eye fa-md"></i></a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center my-4">
        {{ $actividades->links('pagination::bootstrap-4') }}
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
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
