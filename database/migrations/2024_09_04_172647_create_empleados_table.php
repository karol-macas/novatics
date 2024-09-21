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
            $table->string('nombre1');
            $table->string('apellido1');
            $table->string('nombre2')->nullable();
            $table->string('apellido2')->nullable();
            $table->string('cedula')->unique();
            $table->date('fecha_nacimiento');
            $table->string('telefono');
            $table->string('celular');
            $table->string('correo_institucional')->unique();
            // Verifica si la tabla departamentos existe antes de agregar la clave foránea
            if (Schema::hasTable('departamentos')) {
                $table->foreignId('departamento_id')->constrained('departamentos')->onDelete('cascade');
            } else {
                $table->unsignedBigInteger('departamento_id')->nullable(); // Asegura que la columna exista aunque la FK no se agregue
            }
            $table->string('curriculum')->nullable();
            $table->string('contrato')->nullable();
            $table->date('fecha_ingreso');
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
