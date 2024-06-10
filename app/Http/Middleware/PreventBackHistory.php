<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PreventBackHistory
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response =  $next($request);
        return $response->header('Cache-Control','nocache,no-store,max-age=0;must-revalidate')
                        ->header('Pragma','no-cache')
                        ->header('Expires','Thu, 01 Jan 1987 01:05:00 GMT');
    }
}
