<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next): Response
    {
        // Verificamos si el usuario está logueado y si su columna 'roles' es 'admin'
        // Nota: Asegúrate que en tu DB el texto sea exactamente 'admin'
        if (auth()->check() && auth()->user()->roles === 'admin') {
            return $next($request);
        }

        // Si no es admin, lo mandamos a la web pública con un mensaje
        return redirect('/')->with('error', 'Acceso denegado. No eres administrador.');
    }
}

