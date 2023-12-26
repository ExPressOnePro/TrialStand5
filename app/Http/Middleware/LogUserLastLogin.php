<?php

namespace App\Http\Middleware;

use App\Models\StandPublishers;
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
        $ip = $request->ip();

//        $currentDate = Carbon::now();
//        $startOfWeek = Carbon::now()->startOfWeek(); // Понедельник текущей недели
//        $endOfWeek = Carbon::now()->endOfWeek(); // Воскресенье текущей недел
//
//        $weekData = StandPublishers::whereBetween('created_at', [$startOfWeek, $endOfWeek])->get();
//


        if (Auth::check()) {

            $user = User::find(Auth::id());
            $info = json_decode($user->info, true);
            $info['last_login'] = Carbon::now()->format('Y-m-d H:i:s');
            $infoJson = json_encode($info);
            $user->info = $infoJson;
            $user->user_agent = $userAgent;
            $user->ip = $ip;
            $user->save();

        }
        return $response;
    }
}
