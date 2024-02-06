<?php

namespace App\Http\Middleware;

use App\Http\Controllers\ActivatedController;
use App\Models\Settings;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ConfirmEachNewRegisteredUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Settings::query()->find(1)->value('confirm_each_new_registered_user')){

            if (Auth()->user()->activated) {

                return $next($request);
            }

            return redirect()->route('activated');

        }

        return $next($request);
        
    }
}
