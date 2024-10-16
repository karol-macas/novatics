<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Actividades;

class ActividadesTable extends DataTableComponent
{
    protected $model = Actividades::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),

            Column::make("Cliente", "cliente.nombre")
                ->sortable(),
                
            Column::make("Empleado", "empleado.nombre1" )
                ->sortable(),
              
            Column::make("Descripcion", "descripcion")
                ->sortable(),
            Column::make("Codigo osticket", "codigo_osticket")
                ->sortable(),
            Column::make("Semanal diaria", "semanal_diaria")
                ->sortable(),
            Column::make("Fecha inicio", "fecha_inicio")
                ->sortable(),
            Column::make("Avance", "avance")
                ->sortable(),
            Column::make("Observaciones", "observaciones")
                ->sortable(),
            Column::make("Estado", "estado")
                ->sortable(),
            Column::make("Tiempo estimado", "tiempo_estimado")
                ->sortable(),
            Column::make("Tiempo real horas", "tiempo_real_horas")
                ->sortable(),
            Column::make("Tiempo real minutos", "tiempo_real_minutos")
                ->sortable(),
            Column::make("Fecha fin", "fecha_fin")
                ->sortable(),
            Column::make("Repetitivo", "repetitivo")
                ->sortable(),
            Column::make("Prioridad", "prioridad")
                ->sortable(),
            Column::make("Departamento id", "departamento_id")
                ->sortable(),
            Column::make("Error", "error")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }

    public function query()
    {
        return Actividades::query()
            ->with('cliente')
            ->with('empleado')
            ->with('departamento');
    }

}
