<?php

namespace Promoxp\WhatsApp;

use Illuminate\Support\ServiceProvider;
use Promoxp\WhatsApp\Channels\WhatsAppChannel;

class WhatsAppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->when(WhatsAppChannel::class)
                  ->needs('$apiUrl')
                  ->give(config('whatsapp.api_url'));
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/whatsapp.php', 'whatsapp'
        );
    }
}
