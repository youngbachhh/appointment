<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ExpectJsonMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $headerAccept = $request->headers->get('Accept');
        $headerAccept = 'application/json,'.$headerAccept;
        $headerAccept = trim($headerAccept, ',');
        $request->headers->set('Accept', $headerAccept);

        return $next($request);
    }
}
