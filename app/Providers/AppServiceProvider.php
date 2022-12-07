<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;
use URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // dd(Hash::make("silverben98@gmail.com"));

        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
        // URL::forceScheme('https');
        // Blade::withoutDoubleEncoding();
        // Paginator::useBootstrapThree();
    }
}
