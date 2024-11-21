<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Departamento;
use App\Models\Supervisor;
use App\Models\Cargos;


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
        'cargo_id',
        'supervisor_id',
        'curriculum',
        'contrato',
        'contrato_confidencialidad',
        'contrato_consentimiento',
        'fecha_ingreso',
        'fecha_contratacion',
        'jornada_laboral',
        'fecha_conclusion_contrato',
        'terminacion_contrato',
        'fecha_recontratacion'
    ];

    public function create($empleado_id)
    {
        $empleado = Empleados::with('supervisor')->findOrFail($empleado_id);
        $parametros = Parametro::all();

        return view('matriz_cumplimientos.create', compact('empleado', 'parametros'));
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'departamento_id');
    }

    public function actividades()
    {
        return $this->hasMany(Actividades::class, 'empleado_id');
    }

    public function esSupervisor()
{
    return $this->es_supervisor; // Retorna true si es supervisor
}

    
    public function cargo()
    {
        return $this->belongsTo(Cargos::class, 'cargo_id');
    }


    public function rubros()
    {
        return $this->belongsToMany(Rubro::class, 'empleado_rubro', 'empleado_id', 'rubro_id')
            ->withPivot('monto');
    }


    public function rolesPago()
    {
        return $this->hasMany(RolPago::class);
    }
}
