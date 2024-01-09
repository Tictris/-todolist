<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request, Closure $next)
    {
        //get the token from the request
        $token = $request->bearerToken();

        //check if the token is valid
        if($token && Auth::guard('api')->check()){
            return $next($request);
        }

        //if not valid
        else{
            return redirect()->route('home');
        }
    }
}
