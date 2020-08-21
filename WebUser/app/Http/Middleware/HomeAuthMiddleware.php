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
        $access_token = Cookie::get('access_token');
        $valid = GuzzleController::validasiUser($access_token); //beranda
        if (!is_null($access_token) && $valid) {
            return $next($request); //if has token & valid, next request to home page.
        }
        return redirect('login');
    }
}
