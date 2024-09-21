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
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('empleado_id');
            $table->string('descripcion');
            $table->string('codigo_osticket');
            $table->string('semanal_diaria');
            $table->date('fecha_inicio');
            $table->integer('avance');
            $table->text('observaciones')->nullable();
            $table->string('estado');
            $table->integer('tiempo');
            $table->date('fecha_fin');
            $table->boolean('repetitivo');
            $table->string('prioridad');
            $table->unsignedBigInteger('departamento_id');
            $table->string('error')->nullable();
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
