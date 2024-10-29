<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Supervisor extends Model
{
    use HasFactory;

    protected $table = 'supervisores';

    protected $fillable = [
        'nombre_supervisor',
        'descripcion',
    ];

    // Relación con empleados, si un supervisor puede ser un empleado
    public function empleado()
    {
        return $this->belongsTo(Empleados::class, 'id_empleado'); // Cambia 'id_empleado' si es necesario
    }

    // Relación con departamentos, si un supervisor puede ser de un departamento
    public function departamento()
    {
        return $this->hasMany(Departamento::class);
    }
}
