<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadoRubroTable extends Migration
{
    public function up()
    {
        Schema::create('empleado_rubro', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empleado_id')->constrained()->onDelete('cascade');
            $table->foreignId('rubro_id')->constrained()->onDelete('cascade');
            $table->decimal('monto', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('empleado_rubro');
    }
};