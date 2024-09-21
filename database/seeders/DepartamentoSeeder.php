<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Departamento;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departamentos = [
            ['nombre' => 'Gerencia General'],
            ['nombre' => 'Gerencia Comercial'],
            ['nombre' => 'Marketing'],
            ['nombre' => 'Desarrollo'],
            ['nombre' => 'QA'],
            ['nombre' => 'Análisis de Datos y Seg. Información'],
        ];

        foreach ($departamentos as $departamento) {
            Departamento::create($departamento);
        }
    }
}
