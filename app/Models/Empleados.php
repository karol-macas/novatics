<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Empleados extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
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
        'contrato_confidencialidad',
        'contrato_consentimiento',
        'fecha_ingreso'
    ];

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }

    public function actividades()
    {
        return $this->hasMany(Actividades::class, 'empleado_id');
    }
    
}
