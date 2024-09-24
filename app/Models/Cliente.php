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
        'document_type',
        'documento',
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