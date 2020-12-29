<?php

namespace App\Providers;

use App\GeneralSetting;
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
        Cache::forever('tatilmi_bak', \App\Language::all());
    }
}
