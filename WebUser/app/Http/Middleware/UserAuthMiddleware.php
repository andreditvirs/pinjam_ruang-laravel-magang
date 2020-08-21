<?php

namespace App\Http\Middleware;

use Closure;
use Cookie;
use GuzzleHttp\Cookie\CookieJar;
use App\Http\Controllers\GuzzleController;

class UserAuthMiddleware
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
        $access_token= Cookie::get('access_token');
        $valid = GuzzleController::validasiUser($access_token);
        if (is_null($access_token) || !$valid) { //if not valid -> login
            return $next($request);
        }

        return redirect('home'); //if has token or valid
    }
}
