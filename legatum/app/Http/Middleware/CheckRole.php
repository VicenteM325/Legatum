<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (auth()->check() && auth()->user()->role->nombre === $role) {
            return $next($request);
        }

        abort(403, 'No tienes permiso para acceder.');
    }
}
