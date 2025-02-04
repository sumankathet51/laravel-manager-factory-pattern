<?php

namespace App\Providers;

use App\Managers\ErpManager;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Application;

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
        $this->app->singleton('erp-manager', function ($app) {
            return app(ErpManager::class);
        });
        Application::macro('tenant', function () {
            return $this->make('tenant');
        });

        Application::macro('settings', function () {
            return $this->make('settings');
        });

        Application::macro('erpDriver', function () {
            return $this->make('erp-manager')->driver();
        });
    }
}
