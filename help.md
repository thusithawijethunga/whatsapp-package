## WhatsApp Notification

Let's organize the structure and ensure spelling and grammar are correct for a blog post.

### Directory Structure

Here's the directory structure for our package:

```plaintext
promoxp/
└── whatsapp/
    ├── config/
    |   └── whatsapp.php
    ├── src/
    |   ├── Channels/
    |   |   └── WhatsAppChannel.php
    |   ├── Notifications/
    |   |   └── WhatsAppMessage.php
    |   └── WhatsAppServiceProvider.php
    ├── composer.json
    └── README.md
```

### File Contents

1. **WhatsAppChannel.php**: This file contains the logic for sending WhatsApp notifications.

```php
// File: src/Channels/WhatsAppChannel.php

namespace Promoxp\WhatsApp\Channels;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;

class WhatsAppChannel
{
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toWhatsApp($notifiable);

        $response = Http::post(config('whatsapp.api_url'), [
            'appkey'        => config('whatsapp.appkey'),
            'authkey'       => config('whatsapp.authkey'),
            'to'            => $message->recipient(),
            'template_id'   => $notification->templateId(),
            'variables'     => $message->variables(),
        ]);

        return $response->json();
    }
}
```

2. **WhatsAppServiceProvider.php**: This file serves as the service provider for our package.

```php
// File: src/WhatsAppServiceProvider.php

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
```

3. **composer.json**: This file contains metadata about our package.

```json
{
    "name": "promoxp/whatsapp",
    "description": "WhatsApp notification channel for Laravel applications.",
    "type": "library",
    "keywords": ["laravel", "whatsapp", "notification"],
    "license": "MIT",
    "authors": [
        {
            "name": "Your Name",
            "email": "your.email@example.com"
        }
    ],
    "require": {
        "php": "^7.3",
        "illuminate/support": "^8.0"
    },
    "autoload": {
        "psr-4": {
            "Promoxp\\WhatsApp\\": "src/"
        }
    },
    "minimum-stability": "dev",
    "prefer-stable": true
}
```

4. **WhatsAppMessage.php**: This file contains message format about our package.

```php
// File: src/Notifications/WhatsAppMessage.php

namespace Promoxp\WhatsApp\Notifications;

class WhatsAppMessage
{
    protected $variables;
    protected $recipient;

    public function __construct($variables, $recipient)
    {
        $this->variables = $variables;
        $this->recipient = $recipient;
    }

    public function variables()
    {
        return $this->variables;
    }

    public function recipient()
    {
        return $this->recipient;
    }
}
```

5. **whatsapp.php**: This file contains config information about our package.

```php
// File: config/whatsapp.php

return [
    'api_url' => env('WHATSAPP_API_URL', 'https://wap.promoxp.us/api/create-message'),
    'appkey' => env('WHATSAPP_APPKEY', ''),
    'authkey' => env('WHATSAPP_AUTHKEY', ''),
];
```

### Installation

To install the package via Composer, run:

```bash
composer require promoxp/whatsapp
```

### Configuration

After installing the package, configure your WhatsApp API credentials in your Laravel application by publishing the configuration file:

```bash
php artisan vendor:publish --tag=whatsapp-config
```

This command will create a `config/whatsapp.php` file where you can set your `appkey` and `authkey`.

### Usage

To send a WhatsApp notification, use the `HellowNotification` class:

```php
use App\Notifications\HellowNotification;

$user->notify(new HellowNotification('YOUR_TEMPLATE_ID'));
```

Make sure to replace `'YOUR_TEMPLATE_ID'` with the appropriate template ID for your WhatsApp message.

```php
<?php

namespace App\Notifications;

use Promoxp\WhatsApp\Channels\WhatsAppChannel;
use Promoxp\WhatsApp\Notifications\WhatsAppMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class HellowNotification extends Notification implements ShouldQueue
{
    use Queueable, Dispatchable;

    protected $templateId;

    public function __construct($templateId)
    {
        $this->templateId = $templateId;
    }

    public function via($notifiable)
    {
        return [WhatsAppChannel::class];
    }

    public function toWhatsApp($notifiable)
    {
        $whatsapp_number = $notifiable->country_phonecode . $notifiable->mobile;
        return new WhatsAppMessage([
            '{message}' => 'Hello World!', 
            '{app_name}' => 'My WhatsApp',
        ], $whatsapp_number);
    }

    public function templateId()
    {
        return $this->templateId;
    }
}
```

### Join Us

To generate TemplateID, visit the [WhatsApp Saas Platform](https://wap.promoxp.us/).