<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Actividades;



class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_producto',
        'nombre',
        'direccion',
        'telefono',
        'email',
        'contacto',
        'orden_trabajo',
        'contrato_mantenimiento_licencia',
        'documento_otros',
        'precio',
        'estado'
    ];

    public function actividades()
    {
        return $this->hasMany(Actividades::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }
}