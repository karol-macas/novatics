<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Actividades extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',  // Cooperativa
        'empleado_id',  // ID de empleado
        'descripcion',  // Actividades
        'codigo_osticket',  // CODIGO OSTICKET
        'semanal_diaria',  // Solo permite "SEMANAL" o "DIARIO"
        'fecha_inicio',  // Fecha inicio
        'avance',  // Avance como porcentaje entre 0 y 100
        'observaciones',  // Comentario (opcional)
        'estado',  // Estado
        'tiempo_estimado',
        'tiempo_real',
        'fecha_fin',  // Fecha final
        'repetitivo',  // Repetitivo (NO/SÍ)
        'prioridad',  // Prioridad
        'departamento_id',  // ID de departamento
        'error',  // Error
    ];

    protected $dates = ['fecha_inicio', 'fecha_fin']; // Asegúrate de incluir esto

    public function empleados()
    {
        return $this->belongsTo(Empleados::class, 'empleado_id');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'departamento_id');
    }
}
