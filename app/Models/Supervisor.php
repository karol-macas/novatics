<?php 
/*****************************************************
 * Nombre del Proyecto: ERP 
 * Modulo: Supervisor
 * Version: 1.0
 * Desarrollado por: Karol Macas
 * Fecha de Inicio: 
 * Ultima Modificación: 
 ****************************************************/

 namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Supervisor extends Model
    {
        use HasFactory;

        protected $fillable = [
            'nombre_supervisor',
            'descripcion',
        ];
    }

?>
