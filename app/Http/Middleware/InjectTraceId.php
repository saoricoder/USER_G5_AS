<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class InjectTraceId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Obtener o generar un Trace ID
        $traceId = $request->header('X-Trace-Id') ?: (string) Str::uuid();

        // Añadir el Trace ID a la solicitud para que esté disponible en toda la app
        $request->headers->set('X-Trace-Id', $traceId);

        // Procesar la solicitud
        $response = $next($request);

        // Añadir el Trace ID a la cabecera de la respuesta
        $response->headers->set('X-Trace-Id', $traceId);

        return $response;
    }
}
