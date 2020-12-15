<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

use App\Role;
class Admin
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
        $role = Role::where('id', Auth::user()->role)->first();
        if($role->title != 'admin'){
            if($role->title == 'employee'){
                return redirect('/');
            }

            return back();
        }

        return $next($request);
    }
}
