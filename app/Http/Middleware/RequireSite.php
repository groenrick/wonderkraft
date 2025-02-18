<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RequireSite
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!current_site()) {
            abort(404);
        }

        return $next($request);
    }
}
