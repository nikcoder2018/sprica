<?php

namespace App\Providers;

use Illuminate\View\FileViewFinder;
use Illuminate\View\ViewServiceProvider as ConcreteViewServiceProvider;

class ViewServiceProvider extends ConcreteViewServiceProvider
{
    /**
     * Register the view finder implementation.
     *
     * @return void
     */
    public function registerViewFinder()
    {
        $this->app->bind('view.finder', function ($app) {
            $paths = $app['config']['view.paths'];

            $user = auth()->user();
            if ($user) {
                $setting = $user->settings()->where('key', 'theme')->first();
                $path = $setting ? $setting->value : env('APP_THEME', 'default');
                $paths = [
                    resource_path($path . '/views'),
                ];
            }

            return new FileViewFinder($app['files'], $paths);
        });
    }
}
