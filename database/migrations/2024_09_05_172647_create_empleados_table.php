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
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nombre1');
            $table->string('apellido1');
            $table->string('nombre2')->nullable();
            $table->string('apellido2')->nullable();
            $table->string('cedula')->unique();
            $table->date('fecha_nacimiento');
            $table->string('telefono')->nullable();
            $table->string('celular');
            $table->string('correo_institucional')->unique();
            $table->foreignId('departamento_id')->nullable()->constrained('departamentos')->onDelete('cascade');
            $table->string('curriculum')->nullable();
            $table->string('contrato')->nullable();
            $table->string('contrato_confidencialidad')->nullable();
            $table->string('contrato_consentimiento')->nullable();
            $table->date('fecha_ingreso');
            
            $table->boolean('es_supervisor')->default(false); // Indica si el empleado es supervisor
            
            $table->foreignId('supervisor_id')->constrained('supervisores')->onDelete('cascade');
            $table->foreignId('cargo_id')->nullable()->constrained('cargos')->onDelete('cascade');
            $table->date('fecha_contratacion');
            $table->string('jornada_laboral');
            $table->date('fecha_conclusion_contrato')->nullable();
            $table->string('terminacion_contrato')->nullable();
            $table->date('fecha_recontratacion')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('empleados');
    }
}
