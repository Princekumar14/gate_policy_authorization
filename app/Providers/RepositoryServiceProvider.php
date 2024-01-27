<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // $this->app->bind(RequirementRepositoryInterface::class, RequirementRepository::class);
        $this->app->bind(
            'App\Interfaces\RequirementRepositoryInterface',
            'App\Repositories\RequirementRepository'
        );

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
