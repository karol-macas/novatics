<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Empleados;
use App\Models\Departamento;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmpleadosTest extends TestCase
{
    use RefreshDatabase;

    public function test_crear_empleado()
    {
        $departamento = Departamento::create([
            'nombre' => 'Desarrollo',
            'descripcion' => 'Departamento de desarrollo',
        ]);

        $empleado = Empleados::create([
            'nombre1' => 'Juan',
            'apellido1' => 'Pérez',
            'nombre2' => 'Carlos',
            'apellido2' => 'Gómez',
            'cedula' => '1234567890',
            'fecha_nacimiento' => '1990-05-10',
            'telefono' => '0998765432',
            'celular' => '0987654321',
            'correo_institucional' => 'juan.perez@empresa.com',
            'departamento_id' => $departamento->id,
            'curriculum' => 'cv.pdf',
            'contrato' => 'contrato.pdf',
            'contrato_confidencialidad' => 'confidencialidad.pdf',
            'contrato_consentimiento' => 'consentimiento.pdf',
            'fecha_ingreso' => '2022-01-15',
        ]);

        $this->assertDatabaseHas('empleados', ['correo_institucional' => 'juan.perez@empresa.com']);
    }

    public function test_empleado_pertenece_a_departamento()
    {
        $departamento = Departamento::create([
            'nombre' => 'Desarrollo',
            'descripcion' => 'Departamento de desarrollo',
        ]);

        $empleado = Empleados::create([
            'nombre1' => 'Juan',
            'apellido1' => 'Pérez',
            'departamento_id' => $departamento->id,
        ]);

        $this->assertInstanceOf(Departamento::class, $empleado->departamento);
    }
}
