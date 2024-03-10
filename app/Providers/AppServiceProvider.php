<?php

namespace App\Providers;

use App\Interfaces\API\AuthAPIInterface;
use App\Interfaces\API\CustomerAPIInterface;
use App\Interfaces\API\MedicationAPIInterface;
use App\Services\API\AuthAPIService;
use App\Services\API\CustomerAPIService;
use App\Services\API\MedicationAPIService;
use Illuminate\Support\ServiceProvider;

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
        //binding the interfaces and the services
        $this->app->bind(AuthAPIInterface::class, AuthAPIService::class);
        $this->app->bind(MedicationAPIInterface::class, MedicationAPIService::class);
        $this->app->bind(CustomerAPIInterface::class, CustomerAPIService::class);
    }
}
