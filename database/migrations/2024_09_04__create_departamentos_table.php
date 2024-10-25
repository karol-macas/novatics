<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartamentosTable extends Migration
{
    public function up()
    {
        Schema::create('departamentos', function (Blueprint $table) {
            $table->id();
            $table -> string('nombre');
            $table -> string('descripcion');
            //tomar el id del supervisor para relacionarlo con el departamento
            $table->foreignId('id_supervisor')->constrained('supervisores')->onDelete('cascade');
            //cada departamento tiene sus cargos
            $table->foreignId('id_cargos')->constrained('cargos')->onDelete('cascade');

          
             
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('departamentos');
    }
}
