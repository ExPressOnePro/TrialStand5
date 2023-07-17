<?php

namespace App\Http\Middleware;

use App\Models\User;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class LogUserLastLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        $userAgent = $request->header('User-Agent');

        if (Auth::check()) {
            $user = Auth::user();
            User::find($user->id)->update(
                ['last_login' => Carbon::now()],
                ['user_agent' => $userAgent]
            );
        }
        return $response;
    }
}
