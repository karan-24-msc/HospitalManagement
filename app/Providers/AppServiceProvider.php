<?php

namespace App\Providers;

use App\Helpers\GlobalHelper;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        Inertia::share('currentUrl', function () {
            return GlobalHelper::currentUrl();
        });
    }
}
