<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
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

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'cliente_producto');
    }
}
