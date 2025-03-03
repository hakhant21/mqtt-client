<?php

namespace Hakhant\Broker\Providers;

use Hakhant\Broker\Client;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;
use Hakhant\Broker\Contracts\ClientInterface;

class ClientServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            // Publishing the configuration file.
            $this->publishes([
                __DIR__.'/../../config/mqtt.php' => config_path('mqtt.php'),
            ], 'mqtt');

            $this->info('Please run "php artisan vendor:publish --provider="Hakhant\Broker\Providers\ClientServiceProvider" --tag="mqtt" to create a config/mqtt.php file.');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../../config/mqtt.php', 'mqtt');

        // Register the main class to use with the facade
        $this->app->singleton(ClientInterface::class, function () {
            $configs = config('mqtt.default');

            return new Client($configs);
        });
    }    
}
