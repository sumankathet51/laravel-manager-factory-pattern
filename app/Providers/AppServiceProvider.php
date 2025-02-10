<?php

namespace App\Providers;

use App\Contracts\Erp\Adapters\ErpInvoiceAdapterContract;
use App\Managers\ErpManager;
use App\Services\CommandHistory;
use App\Services\Erp\Default\Adapters\ErpInvoiceAdapter;
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

        $this->app->singleton('erp-manager', function (Application $app) {
            return app(ErpManager::class);
        });

        $this->app->singleton(CommandHistory::class, function (Application $app) {
            return new CommandHistory();
        });

        $this->app->bind(ErpInvoiceAdapterContract::class, ErpInvoiceAdapter::class);

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
