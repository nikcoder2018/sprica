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

        if($role->title != 'employee'){
            if($role->title == 'admin'){
                return redirect('/admin');
            }

            return back();
        }

        return $next($request); 
    }
}
