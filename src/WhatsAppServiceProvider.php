<?php

namespace Promoxp\WhatsApp;

use Illuminate\Support\ServiceProvider;

class WhatsAppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     */
    public function boot()
    {
        // Publish configuration file
        if ($this->app->runningInConsole()) {
            $this->publishes(
                [
                    __DIR__ . '/../config/whatsapp.php' => config_path('whatsapp.php'),
                ],
                'whatsapp-config',
            );
        }
    }

    public function register()
    {
        // Merge package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/whatsapp.php', 'whatsapp');
    }
}
