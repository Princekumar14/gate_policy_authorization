<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CsrfCorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next): Response
    {
        return $next($request)
        ->header('Access-Control-Allow-Origin', '*')  //  https://www.stitchspares.com
        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE')
        ->header('Access-Control-Allow-Headers', 'Content-Type, processData, ngrok-skip-browser-warning, X-CSRF-TOKEN');
    }
}
