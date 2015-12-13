<?php namespace App\Providers;

/**
 * Created by Johan Vester
 * johan@wasitworth.it
 *
 * Date: 13/12/15
 *
 * (c) 2015 wasitworth.it
 */

// Core
use Illuminate\Support\ServiceProvider;

// Services
use App\Services\ReviewService;

class ResourceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $services = [
            App\Services\ReviewService::class,
            App\Services\ProductService::class,
            App\Services\AuthService::class,
        ];

        foreach ($services as $service) {
            $this->app->singleton($service, function($app) use ($service) {
                return new $service;
            });
        }
    }
}