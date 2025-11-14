<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if ($request->user()->role !== $role) {
            abort(403);
        }

        return $next($request);
    }
}
