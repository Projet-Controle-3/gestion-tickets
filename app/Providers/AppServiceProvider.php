<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('admin', function ($app) {
            return new \App\Http\Middleware\AdminMiddleware;
        });
        $this->app->singleton('utilisateur', function ($app) {
            return new \App\Http\Middleware\UserMiddleware;
        });
        $this->app->singleton('support', function ($app) {
            return new \App\Http\Middleware\SupportMiddleware;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}