<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nombre1');
            $table->string('apellido1');
            $table->string('nombre2')->nullable();
            $table->string('apellido2')->nullable();
            $table->string('cedula')->unique();
            $table->date('fecha_nacimiento');
            $table->string('telefono');
            $table->string('celular');
            $table->string('correo_institucional')->unique();
            // cada empleado pertenece a un departamento
            $table->foreignId('id_departamento')->constrained('departamentos')->onDelete('cascade');
            $table->string('curriculum')->nullable();
            $table->string('contrato')->nullable();
            $table->string('contrato_confidencialidad')->nullable();
            $table->string('contrato_consentimiento')->nullable();
            $table->date('fecha_ingreso');
            // Supervisor del empleado
            $table->foreignId('id_supervisor')->constrained('supervisor')->onDelete('cascade');
            // Cargo del empleado
            $table->foreignId('id_cargo')->constrained('cargos')->onDelete('cascade');   
            //fecha de contratacion
            $table->date('fecha_contratacion');
            //tipo de jornada laboral del empleado (tiempo completo, medio tiempo, etc)
            $table->string('jornada_laboral');
            //fecha de conclusion del contrato
            $table->date('fecha_conclusion_contrato');
            //termacion voluntaria o involuntaria del contrato de trabajo(si, no)
            $table->string('terminacion_contrato');
            //fecha de recontratacion
            $table->date('fecha_recontratacion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleados');
    }
}
