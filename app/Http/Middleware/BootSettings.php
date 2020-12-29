<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;

class BootSettings
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
        $response = $next($request);
        $user = $request->user();
        if ($user) {
            $setting = $user->settings()->where('key', 'theme')->first();
            Config::set('view.paths', [
                resource_path($setting ? $setting->value : 'default' . '/views')
            ]);
        }
        return $response;
    }
}
