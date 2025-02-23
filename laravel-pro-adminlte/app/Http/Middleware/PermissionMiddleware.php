<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PermissionMiddleware
{
    public function handle(Request $request, Closure $next, ...$permissions)
    {
        if (!auth()->check()) {
            abort(Response::HTTP_FORBIDDEN, 'Acesso negado');
        }

        // Se o usuário não tiver nenhuma das permissões fornecidas
        if (!auth()->user()->hasAnyPermission($permissions) || auth()->user()->profile()->type !== 'admin') {
            abort(Response::HTTP_FORBIDDEN, 'Acesso negado');
        }

        return $next($request);
    }
}
