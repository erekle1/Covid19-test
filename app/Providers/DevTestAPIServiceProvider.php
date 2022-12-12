<?php

namespace App\Providers;

use App\Services\DevTestAPIService;
use Illuminate\Container\Container;
use Illuminate\Support\ServiceProvider;

class DevTestAPIServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(DevTestAPIService::class,function ($app){
            return new DevTestAPIService(fn () => Container::getInstance()->make('config'));
        });
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
