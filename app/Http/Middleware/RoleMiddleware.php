<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{


    public function handle($request, Closure $next, $role, $permission = null)
    {
        if(is_null($request->user())){
            return response()->view('errors.error401');
        }

       /* if(is_null($request->user())){
            abort(401);
        }*/


        /*if (is_null(!auth()->user()->hasRole($role))) {
            abort(404);
        }*/

        if($permission !== null && !auth()->user()->can($permission)) {
        abort(404);
    }
        return $next($request);
    }
}
