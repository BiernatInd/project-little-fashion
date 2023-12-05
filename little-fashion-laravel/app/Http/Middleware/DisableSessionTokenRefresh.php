<?php

namespace App\Http\Middleware;

use Closure;

class DisableSessionTokenRefresh
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // Wyłącz automatyczne odświeżanie tokena sesji
        $response->headers->remove('Refresh-Token');

        return $response;
    }
}
