<?php

namespace App\Http\Middleware;
use App\Models\UserMenuAccess;
use Auth;
use Closure;

class CheckUserAccess
{
    public function handle($request, Closure $next)
    {
        $status = UserMenuAccess::join('sub_menus', 'user_menu_accesses.sub_menu_id', '=', 'sub_menus.id')
            ->where('sub_menus.route_name', explode('.', $request->route()->getName())[0] . '.index')
            ->where('user_menu_accesses.user_id', Auth::id())
            ->select('user_menu_accesses.status')
            ->first();

        //     dd(UserMenuAccess::join('sub_menus', 'user_menu_accesses.sub_menu_id', '=', 'sub_menus.id')
        //     ->where('sub_menus.route_name', explode('.', $request->route()->getName())[0] . '.index')->first(),
        //  explode('.', $request->route()->getName())[0] . '.index');

        if ($status->status == 0) {
            return abort(401);
        }
        return $next($request);
    }
}
