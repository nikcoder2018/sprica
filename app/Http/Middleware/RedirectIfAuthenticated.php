<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;
use App\Role;
class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $role = Role::where('id', Auth::user()->role)->first();
            if($role->name=='admin'){
                return redirect(route('admin.dashboard'));
            }
            
            return redirect(RouteServiceProvider::HOME);
        }

        return $next($request);
    }
}
