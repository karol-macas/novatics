<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTable extends Migration
{
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            //tabla de users el id
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->string('nombre1');
            $table->string('apellido1');
            $table->string('nombre2')->nullable();
            $table->string('apellido2')->nullable();
            $table->string('cedula')->unique();
            $table->date('fecha_nacimiento');
            $table->string('telefono');
            $table->string('celular');
            $table->string('correo_institucional')->unique();
            $table->foreignId('id_departamento')->constrained('departamentos')->onDelete('cascade');
            $table->string('curriculum')->nullable();
            $table->string('contrato')->nullable();
            $table->string('contrato_confidencialidad')->nullable();
            $table->string('contrato_consentimiento')->nullable();
            $table->date('fecha_ingreso');
            $table->foreignId('id_supervisor')->constrained('supervisores')->onDelete('cascade');
            $table->foreignId('id_cargo')->constrained('cargos')->onDelete('cascade');
            $table->date('fecha_contratacion');
            $table->string('jornada_laboral');
            $table->date('fecha_conclusion_contrato');
            $table->string('terminacion_contrato');
            $table->date('fecha_recontratacion');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('empleados');
    }
}
