<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Routing\Route;

class VisibleSections
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userVisible = Auth()->user()->permissions->toArray();
        $controller = strstr(request()->route()->getName(), '.', true) ? strstr(request()->route()->getName(), '.', true) : request()->route()->getName();
        $prefix = str_replace('-', '_', trim(request()->route()->getPrefix(), '/')); 

        //dd($userVisible, $controller);
        if (array_key_exists($controller, $userVisible)) {

            if ($userVisible[$controller]) return $next($request);
           
            return abort(404); 
        }

        
        if (array_key_exists($prefix, $userVisible)) {

            if ($userVisible[$prefix]) return $next($request);
           
            return abort(404); 
        }

        return $next($request);

    }
}
