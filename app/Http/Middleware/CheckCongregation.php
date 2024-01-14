<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckCongregation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
//        if (Auth::user()->congregation_id == 1) {
//            return redirect()->route('home');
//        }
        if (auth()->user()->hasRole('Guest')) {
            return redirect('home');
        }

        return $next($request);
    }
}
