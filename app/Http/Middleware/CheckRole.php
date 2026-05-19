<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Si el usuario no ha iniciado sesión, mándalo al login
        if (!auth()->check()) {
            return redirect('login');
        }

        $user = auth()->user();

        // 2. Buscamos de forma directa si el usuario tiene asignado alguno de los roles permitidos
        $hasPermission = \Illuminate\Support\Facades\DB::table('user_roles')
            ->join('roles', 'user_roles.role_id', '=', 'roles.id')
            ->where('user_roles.user_id', $user->id)
            ->whereIn('roles.name', $roles)
            ->exists();

        // 3. Si NO tiene el rol requerido, disparamos el Error 403
        if (!$hasPermission) {
            abort(403, 'No tienes permisos para acceder a esta sección.');
        }

        return $next($request);
    }
}