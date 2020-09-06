<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

use App\Role;
class Employee
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

        if($role->name != 'employee'){
            if($role->name == 'admin'){
                return redirect('/admin');
            }

            return back();
        }

        return $next($request); 
    }
}
