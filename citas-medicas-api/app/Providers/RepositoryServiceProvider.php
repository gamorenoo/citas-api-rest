<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\AppointmentRepositoryInterface;
use App\Repositories\AppointmentRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AppointmentRepositoryInterface::class,AppointmentRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
