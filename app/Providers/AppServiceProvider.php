<?php

namespace App\Providers;

use App\Http\Repository\Contracts\TestInterface;
use App\Http\Repository\FarmRepository;
use App\Http\Repository\TestRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    // i have to bind the TestInface with the TestRepository
      $this->app->bind(TestInterface::class, TestRepository::class);
      $this->app->bind(FarmRepository::class, FarmRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
