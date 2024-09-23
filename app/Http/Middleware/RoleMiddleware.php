<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Verificamos si el usuario está autenticado
        if (!Auth::check()) {
            return redirect('login')->with('error', 'Debes iniciar sesión para acceder a esta página.');
        }

        // Obtenemos el usuario autenticado
        $user = Auth::user();

        // Verificamos si el usuario tiene el rol necesario o es administrador
        if ($user instanceof User && !$user->isRole($role) && !$user->isAdmin()) {
            return redirect('login')->with('error', 'No tienes permisos para acceder a esta página.');
        }
    }
}