<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  $permission
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        if($request->user()==NULL) {
            return redirect('/404');
        } else {
            if (!$request->user()->hasPermission($permission)) {
                $name = $request->user()->getPermissionDisplayName($permission);
                return redirect('/404')->with('error', 'Не достаточно прав! Для операции: "' . $name . '"');
            }
        }
        return $next($request);
    }
}
