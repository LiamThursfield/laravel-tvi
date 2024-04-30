<?php

namespace App\Http\Middleware;

use App\Models\CMS\Redirect;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class CheckForCmsRedirect
{
    public function handle(Request $request, Closure $next): Response
    {
        $redirect = $this->getRedirectFromRequest($request);
        if (is_null($redirect)) {
            return $next($request);
        }

        return redirect(
            $redirect->url_to,
            $redirect->http_status
        );
    }

    protected function getRedirectFromRequest(Request $request): ?Redirect
    {
        $path = $request->path();
        if (! Str::startsWith($path, '/')) {
            $path = '/' . $path;
        }

        /** @var ?Redirect $redirect */
        $redirect = Redirect::active()->where('url_from', $path)->first();

        return $redirect;
    }
}
