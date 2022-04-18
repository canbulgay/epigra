<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\CapsuleRepositoryInterface;
use App\Repositories\CapsuleRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CapsuleRepositoryInterface::class, CapsuleRepository::class);
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
