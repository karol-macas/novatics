<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Actividades;
use App\Models\Empleados;

class ActividadesTable extends Component
{
    use WithPagination;

    // Variables de filtros
    public $cliente_filter;
    public $empleado_filter;
    public $descripcion_filter;
    public $codigo_filter;
    public $estado_filter;

    public function render()
    {
        // Consultar actividades con los filtros necesarios
        $actividades = Actividades::when($this->cliente_filter, function ($query) {
            return $query->whereHas('cliente', function ($query) {
                $query->where('nombre', 'like', '%' . $this->cliente_filter . '%');
            });
        })->when($this->empleado_filter, function ($query) {
            return $query->whereHas('empleado', function ($query) {
                $query->where('nombre1', 'like', '%' . $this->empleado_filter . '%')
                    ->orWhere('apellido1', 'like', '%' . $this->empleado_filter . '%');
            });
        })->when($this->descripcion_filter, function ($query) {
            return $query->where('descripcion', 'like', '%' . $this->descripcion_filter . '%');
        })->when($this->codigo_filter, function ($query) {
            return $query->where('codigo_osticket', 'like', '%' . $this->codigo_filter . '%');
        })->when($this->estado_filter, function ($query) {
            return $query->where('estado', $this->estado_filter);
        })->paginate(10);

        return view('livewire.actividades-table', [
            'actividades' => $actividades,
            'empleados' => Empleados::all(), // Esto solo es necesario si los nombres de empleados se van a usar en filtros o tablas.
        ]);
    }

    // Reiniciar la paginación al actualizar filtros específicos
    public function updatedDescripcionFilter()
    {
        $this->resetPage();
    }

    public function updatedCodigoFilter()
    {
        $this->resetPage();
    }

    public function updatedClienteFilter()
    {
        $this->resetPage();
    }

    public function updatedEmpleadoFilter()
    {
        $this->resetPage();
    }

    public function updatedEstadoFilter()
    {
        $this->resetPage();
    }

    // Función de exportación (por implementar)
    public function export()
    {
        // Lógica de exportación aquí
    }
}
