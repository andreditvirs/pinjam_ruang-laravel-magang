<?php

namespace App\Http\Middleware;

use Closure;
use Cookie;
use GuzzleHttp\Cookie\CookieJar;
use App\Http\Controllers\GuzzleController;

class HomeAuthMiddleware
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
        $cookie = Cookie::get('access_token');
        $valid = GuzzleController::validasiUser($cookie);
        if (!is_null($cookie) || $valid) {
            return $next($request);
        }
        return redirect('login');
    }
}
