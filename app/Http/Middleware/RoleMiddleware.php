<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{


    public function handle($request, Closure $next, $role, $permission = null)
    {
        /*if(is_null($request->user())){
                    abort(401);
                }*/
        /*if (is_null(!auth()->user()->hasRole($role))) {
            abort(404);
        }*/

        if(is_null($request->user())){
            return response()->view('errors.error401');
        }

        if(!auth()->user()->hasRole($role)) {
            return response()->view('errors.423Locked');
        }
        if($permission !== null && !auth()->user()->can($permission)) {
            return response()->view('errors.423Locked');
        }


        return $next($request);
    }
}
