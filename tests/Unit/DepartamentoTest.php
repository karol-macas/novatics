<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Empleados;
use App\Models\Departamento;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DepartamentoTest extends TestCase
{
    use RefreshDatabase;

    public function test_crear_departamento()
    {
        $departamento = Departamento::create([
            'nombre' => 'Marketing',
            'descripcion' => 'Departamento de marketing',
        ]);

        $this->assertDatabaseHas('departamentos', ['nombre' => 'Marketing']);
    }

    public function test_departamento_tiene_empleados()
    {
        $departamento = Departamento::create([
            'nombre' => 'Desarrollo',
            'descripcion' => 'Departamento de desarrollo',
        ]);

        $empleado = Empleados::create([
            'nombre1' => 'Pedro',
            'apellido1' => 'López',
            'departamento_id' => $departamento->id,
        ]);

        $this->assertTrue($departamento->empleados->contains($empleado));
    }
}
