<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActividadesTabla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('actividades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id')->nullable();
            $table->foreignId('empleado_id')->constrained('empleados')->onDelete('cascade');
            $table->string('descripcion');
            $table->string('codigo_osticket')->nullable();
            $table->string('semanal_diaria');
            // Cambiar el tipo de fecha_inicio a datetime
            $table->dateTime('fecha_inicio')->nullable(); // datetime para fecha y hora
            $table->integer('avance');
            $table->text('observaciones')->nullable();
            $table->string('estado');
            $table->integer('tiempo_estimado');
            $table->integer('tiempo_real_horas')->nullable();
            $table->integer('tiempo_real_minutos')->nullable();
            // Cambiar fecha_fin a datetime
            $table->dateTime('fecha_fin')->nullable();
            $table->boolean('repetitivo');
            $table->string('prioridad');
            $table->string('error');
            // Relación con otros modelos
            $table->foreignId('departamento_id')->constrained('departamentos')->onDelete('cascade');
            $table->foreignId('cargo_id')->constrained('cargos')->onDelete('cascade');
            $table->foreignId('supervisor_id')->constrained('supervisores')->onDelete('cascade');
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
        Schema::dropIfExists('actividades');
    }
}
