<?php

namespace Promoxp\WhatsApp;

use Illuminate\Support\ServiceProvider;

class WhatsAppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/whatsapp.php' => config_path('whatsapp.php'),
        ]);

        // $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        // $this->publishesMigrations([
        //     __DIR__.'/../database/migrations' => database_path('migrations'),
        // ]);

        // $this->loadTranslationsFrom(__DIR__.'/../lang', 'courier');
 
        // $this->publishes([
        //     __DIR__.'/../lang' => $this->app->langPath('vendor/courier'),
        // ]);

        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'courier');
 
        // $this->publishes([
            // __DIR__.'/../resources/views' => resource_path('views/vendor/courier'),
        // ]);

        // Blade::component('package-alert', AlertComponent::class);
        // Blade::componentNamespace('Nightshade\\Views\\Components', 'nightshade');

        // AboutCommand::add('My Package', fn () => ['Version' => '1.0.0']);

        // if ($this->app->runningInConsole()) {
        //     $this->commands([
        //         InstallCommand::class,
        //         NetworkCommand::class,
        //     ]);
        // }

        // $this->publishes([
        //     __DIR__.'/../public' => public_path('vendor/courier'),
        // ], 'public');

        // $this->publishes([
        //     __DIR__.'/../config/package.php' => config_path('package.php')
        // ], 'courier-config');
     
        // $this->publishesMigrations([
        //     __DIR__.'/../database/migrations/' => database_path('migrations')
        // ], 'courier-migrations');
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/whatsapp.php', 'whatsapp');
    }
}
