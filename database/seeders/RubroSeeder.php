<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rubro;

class RubroSeeder extends Seeder
{
    public function run()
    {
        // Crear algunos rubros de ejemplo
        Rubro::create([
            'nombre' => 'Salario',
            'descripcion' => 'Pago de salarios a empleados',
            'tipo_rubro' => 'egreso',
        ]);

        Rubro::create([
            'nombre' => 'Venta de productos',
            'descripcion' => 'Ingreso generado por la venta de productos',
            'tipo_rubro' => 'ingreso',
        ]);

        Rubro::create([
            'nombre' => 'Servicios públicos',
            'descripcion' => 'Gastos en electricidad, agua y otros servicios públicos',
            'tipo_rubro' => 'egreso',
        ]);

        Rubro::create([
            'nombre' => 'Intereses bancarios',
            'descripcion' => 'Ingreso por intereses de depósitos bancarios',
            'tipo_rubro' => 'ingreso',
        ]);

        Rubro::create([
            'nombre' => 'Mantenimiento',
            'descripcion' => 'Costos de mantenimiento de la oficina y equipo',
            'tipo_rubro' => 'egreso',
        ]);
    }
}
