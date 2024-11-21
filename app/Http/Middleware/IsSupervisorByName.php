<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Supervisor;

class IsSupervisor
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        // Obtener el nombre completo del empleado
        $nombreCompletoEmpleado = $user->nombre1 . ' ' . $user->apellido1;

        // Verificar si el nombre completo del empleado coincide con algún supervisor
        $isSupervisor = Supervisor::where('nombre_supervisor', $nombreCompletoEmpleado)->exists();

        if ($isSupervisor) {
            return $next($request); // Deja pasar al supervisor
        }

        return redirect()->route('home')->with('error', 'No tienes acceso a este módulo.');
    }
}
