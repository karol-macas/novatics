<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleados extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre1', 
        'apellido1',
        'nombre2', 
        'apellido2',
        'cedula',
        'fecha_nacimiento',
        'telefono',
        'celular',
        'correo_institucional',
        'departamento_id',
        'curriculum',
        'contrato',
        'fecha_ingreso'
    ];

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }
}
