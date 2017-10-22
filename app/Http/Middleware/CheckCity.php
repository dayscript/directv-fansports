<?php

namespace App\Http\Middleware;

use Closure;

class CheckCity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        if(($user = auth()->user())
           && (!$user->city)
           && !$request->is('actualizar-ciudad')
           && !$request->is('users/'.$user->id)
           && !$request->is('login/*')
        ){
            return redirect('actualizar-ciudad')->with('redirect','/'.$request->path());
//            request()->
//            dd(auth()->user());
        }
        return $response;
    }
}
