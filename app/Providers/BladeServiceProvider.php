<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        Blade::if('rtl', function () {
            return locale() == 'ar';
        });

        Blade::if('ltr', function () {
            return locale() == 'en';
        });

        Blade::if('user', function () {
            return auth()->guard('user')->check();
        });

        Blade::if('admin', function () {
            return auth()->guard('admin')->check();
        });

        Blade::if('judge', function () {
            return auth()->guard('judge')->check();
        });

        Blade::if('count', function ($countable) {
            return count($countable) > 0;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
