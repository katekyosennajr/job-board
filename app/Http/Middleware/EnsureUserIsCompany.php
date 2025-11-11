<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsCompany
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->role !== 'company') {
            abort(403, 'Only companies can manage jobs');
        }

        return $next($request);
    }
}