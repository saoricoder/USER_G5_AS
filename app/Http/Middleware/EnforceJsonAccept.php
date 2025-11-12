<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnforceJsonAccept
{
    /**
     * Ensure API requests negotiate JSON by setting the Accept header when missing.
     */
    public function handle(Request $request, Closure $next)
    {
        $accept = $request->headers->get('Accept');

        if (!$accept || stripos($accept, 'application/json') === false) {
            $request->headers->set('Accept', 'application/json');
        }

        return $next($request);
    }
}