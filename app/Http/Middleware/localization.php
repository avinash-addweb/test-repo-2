<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class localization
{

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $localList = getLocaleList(true);
        //$local = ($request->hasHeader('lang_code')) ? $request->header('lang_code') : app()->getLocale();
        $defaultLocale = app()->getLocale();
        if (\str_contains($request->getRequestUri(),'/api/') && $request->wantsJson()) {
            //for api
            $local = $request?->input('lang_code') ?? $defaultLocale;
        } else {
            //for web
            $local = $request?->input('lang_code') ?? ($request?->session()?->has('lang_code')?$request?->session()?->get('lang_code'):$defaultLocale) ?? $defaultLocale;
        }
        //$local = $request?->input('lang_code') ?? ($request?->session()?->has('lang_code')?$request?->session()?->get('lang_code'):$defaultLocale) ?? $defaultLocale;
        $local = (!empty($localList) && in_array($local, $localList, true)) ? $local : getDefaultLocale();
        app()->setLocale($local);
        return $next($request);
    }
}
