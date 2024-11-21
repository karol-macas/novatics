<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parametro extends Model
{
    use HasFactory;

    protected $table = 'parametros'; // Nombre de la tabla en la base de datos
    protected $fillable = ['nombre']; // Campos asignables

    public function create()
    {
        $parametros = Parametro::all(); // Cargar los parámetros desde la base de datos
        return view('matriz_cumplimientos.create', compact('parametros')); // Enviar a la vista
    }
}
