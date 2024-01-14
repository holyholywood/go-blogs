<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpFoundation\Response;

class OpenAPIAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $serverIP = Env("SERVER_IP");
        $requestIP = $request->ip();
        if ($serverIP == $requestIP) {
            return $next($request);
        }
        throw new UnauthorizedException();
    }
}
