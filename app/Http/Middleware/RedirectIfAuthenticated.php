<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next, $guard = null)
    {
        dd("RedirectIfAuthenticated");
        if ($guard == "admin" && Auth::guard($guard)->check()) {
            return redirect()->route('admin.dashboard');
        }

        // if (Auth::guard($guard)->check()) {
        //     return redirect()->route('/');
        // }
        return $next($request);
    }
}
