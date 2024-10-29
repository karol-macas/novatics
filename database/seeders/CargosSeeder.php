<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Cargos;

class CargosSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Cargos::create([
            'nombre_cargo' => 'Gerente General',
            'descripcion' => '',
            'codigo_afiliacion' => '1918200000101',
            'salario_basico' => 0,            
            'departamento_id' => 10,
        ]);

        Cargos::create([
            'nombre_cargo' => 'Asistente de Gerencia',
            'descripcion' => '',
            'codigo_afiliacion' => '1910000000028',
            'salario_basico' => 0,
            'departamento_id' => 10,

        ]);

        Cargos::create([
            'nombre_cargo' => 'Desarrollador Junior',
            'descripcion' => '',
            'codigo_afiliacion' => '1230000000011',
            'salario_basico' => 0,
            'departamento_id' => 3,
        ]);

        Cargos::create([
            'nombre_cargo' => 'Desarrollador Semi Senior',
            'descripcion' => '',
            'codigo_afiliacion' => '1210000000007',
            'salario_basico' => 0,
            'departamento_id' => 3,
        ]);

        Cargos::create([
            'nombre_cargo' => 'Arquitecto de Software',
            'descripcion' => '',
            'codigo_afiliacion' => '0',
            'salario_basico' => 0,
            'departamento_id' => 1,
        ]);

        Cargos::create([
            'nombre_cargo' => 'Diseñador Multimedia/Web',
            'descripcion' => '',
            'codigo_afiliacion' => '1209642000019',
            'salario_basico' => 0,
            'departamento_id' => 5,
        ]);

        Cargos::create([
            'nombre_cargo' => 'Gerente Comercial',
            'descripcion' => '',
            'codigo_afiliacion' => '1507500000009',
            'salario_basico' => 0,
            'departamento_id' => 7,
        ]);

        Cargos::create([
            'nombre_cargo' => 'Coordinador de Atencion al Cliente',
            'descripcion' => '',
            'codigo_afiliacion' => '0',
            'salario_basico' => 0,
            'departamento_id' => 2,
        ]);

        Cargos::create([
            'nombre_cargo' => 'Asistente de Coordinación',
            'descripcion' => '',
            'codigo_afiliacion' => '0',
            'salario_basico' => 0,
            'departamento_id' => 2,
        ]);

        Cargos::create([
            'nombre_cargo' => 'Analista de atención al cliente',
            'descripcion' => '',
            'codigo_afiliacion' => '0',
            'salario_basico' => 0,
            'departamento_id' => 2,
        ]);

        Cargos::create([
            'nombre_cargo' => 'Coordinador de TICs',
            'descripcion' => '',
            'codigo_afiliacion' => '0',
            'salario_basico' => 0,
            'departamento_id' => 3,
        ]);

        Cargos::create([
            'nombre_cargo' => 'DBA',
            'descripcion' => '',
            'codigo_afiliacion' => '0',
            'salario_basico' => 0,
            'departamento_id' => 3,
        ]);


        Cargos::create([
            'nombre_cargo' => 'Oficial de Seguridad de la Información',
            'descripcion' => '',
            'codigo_afiliacion' => '0',
            'salario_basico' => 0,
            'departamento_id' => 4,
        ]);

        Cargos::create([
            'nombre_cargo' => 'Analista de Datos',
            'descripcion' => '',
            'codigo_afiliacion' => '0',
            'salario_basico' => 0,
            'departamento_id' => 4,
        ]);

        Cargos::create([
            'nombre_cargo' => 'Coordinador de Área de Marketing y Diseño',
            'descripcion' => '',
            'codigo_afiliacion' => '0',
            'salario_basico' => 0,
            'departamento_id' => 5,
        ]);

        Cargos::create([
            'nombre_cargo' => 'Coordinador de Área Financiera',
            'descripcion' => '',
            'codigo_afiliacion' => '0',
            'salario_basico' => 0,
            'departamento_id' => 6,
        ]);

        Cargos::create([
            'nombre_cargo' => 'Asistente Contable',
            'descripcion' => '',
            'codigo_afiliacion' => '0',
            'salario_basico' => 0,
            'departamento_id' => 6,
        ]);

        Cargos::create([
            'nombre_cargo' => 'Contador General',
            'descripcion' => '',
            'codigo_afiliacion' => '0',
            'salario_basico' => 0,
            'departamento_id' => 6,
        ]);

        Cargos::create([
            'nombre_cargo' => 'Vendedor',
            'descripcion' => '',
            'codigo_afiliacion' => '0',
            'salario_basico' => 0,
            'departamento_id' => 7,
        ]);

        Cargos::create([
            'nombre_cargo' => 'Auditoría Informática Interna',
            'descripcion' => '',
            'codigo_afiliacion' => '0',
            'salario_basico' => 0,
            'departamento_id' => 8,
        ]);

    }

}