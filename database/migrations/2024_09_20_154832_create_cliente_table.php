<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClienteTable extends Migration
{
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('direccion');
            $table->string('telefono');
            $table->string('email');
            $table->string('contacto')->default('Sin contacto');
            $table->string('orden_trabajo')->nullable();
            $table->string('contrato_mantenimiento_licencia')->nullable();
            $table->string('documento_otros')->nullable();
            $table->decimal('precio', 10, 2);
            $table->enum('estado', ['ACTIVO', 'INACTIVO']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
