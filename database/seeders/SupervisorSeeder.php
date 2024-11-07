<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supervisor;

class SupervisorSeeder extends Seeder
{
    public function run()
    {
        // Crear algunos supervisores de ejemplo
        Supervisor::create([
            'nombre_supervisor' => 'Juan Carlos Guayasamin Cattani',
            'descripcion' => 'f'
        ]);


        Supervisor::create([
            'nombre_supervisor' => 'Adriana Bentacourt',
            'descripcion' => 'f'
        ]);

        Supervisor::create([
            'nombre_supervisor' => 'William Pillajo',
            'descripcion' => 'f'
        ]);

        Supervisor::create([
            'nombre_supervisor' => 'Santiago Guayasamin',
            'descripcion' => 'f'
        ]);

        Supervisor::create([
            'nombre_supervisor' => 'Gabriel Guallasamin',
            'descripcion' => 'f'
        ]);

        Supervisor::create([
            'nombre_supervisor' => 'Karina Diaz',
            'descripcion' => 'f'
        ]);

        Supervisor::create([
            'nombre_supervisor' => 'Juan Carlos Guayasamin Marcillo',
            'descripcion' => 'f'
        ]);

        
        Supervisor::create([
            'nombre_supervisor' => 'Jennifer Fariaz',
            'descripcion' => 'f'
        ]);
    }
}

