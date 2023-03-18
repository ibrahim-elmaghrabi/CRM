<?php

namespace App\Http\Middleware;

use Closure;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RequestId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $uuid = $request->headers->get('X-Request-Id');
        if(is_null($uuid))
        {
            $uuid = Uuid::uuid4()->toString();
            $request->headers->set('X-Request-Id', $uuid);
        }
        $response = $next($request);
        $response->headers->set('X-Request-Id', $uuid);
        return $response;
    }
}
