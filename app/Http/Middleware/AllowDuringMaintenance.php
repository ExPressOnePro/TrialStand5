<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AllowDuringMaintenance
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Проверяем, включен ли режим технических работ
        if (config('app.maintenance_mode')) {
            // Проверяем роль пользователя
            $user = Auth::user();

            if ($user && $user->hasRole('developer')) {
                return $next($request);
            }

            // Иначе, отображаем страницу с уведомлением
            return response()->view('maintenance');
        }

        // Если режим технических работ выключен, продолжаем выполнение запроса
        return $next($request);
    }
}
