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

    public function empleado()
    {
        return $this->hasOne(Empleados::class, 'nombre1','nombre_supervisor');
    }

    // Relación con departamentos, si un supervisor puede ser de un departamento
    public function departamento()
    {
        return $this->hasMany(Departamento::class);
    }
}
