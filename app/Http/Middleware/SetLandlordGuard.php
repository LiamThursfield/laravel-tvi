<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLandlordGuard
{
    public function handle(Request $request, Closure $next): Response
    {
        $guard = auth()->getDefaultDriver() === 'api' ?
            'landlord-api' : 'landlord-web';

        auth()->setDefaultDriver($guard);

        return $next($request);
    }
}
