<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Cache;
use Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Cache::forever('settings', \App\Language::all());
    }
}
