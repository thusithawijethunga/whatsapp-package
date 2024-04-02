# promoxp/whatsapp

WhatsApp Notification Channel for Laravel Applications

## Introduction

This package provides a custom notification channel for sending notifications via WhatsApp in Laravel applications. It integrates with the WhatsApp API to send messages to specified recipients.

## Installation

You can install the package via Composer:

```bash
composer require promoxp/whatsapp
```

## Configuration

After installing the package, you need to configure your WhatsApp API credentials in your Laravel application. Publish the configuration file using the following Artisan command:

```bash
php artisan vendor:publish --tag=whatsapp-config
```

This will create a `config/whatsapp.php` file where you can set your `appkey` and `authkey`.

## Usage

To send a WhatsApp notification, you can use the `HellowNotification` class:

```php
use App\Notifications\HellowNotification;

$user->notify(new HellowNotification('YOUR_TEMPLATE_ID'));
```

Make sure to replace `'YOUR_TEMPLATE_ID'` with the appropriate template ID for your WhatsApp message.

```php
<?php

namespace App\Notifications;

use Promoxp\WhatsApp\Notifications\WhatsAppChannel;
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


## Support

If you encounter any issues or have questions about the package, please feel free to [open an issue](https://github.com/thusithawijethunga/whatsapp-package/issues) on GitHub.

## License

This package is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Join Us

[WhatsApp Saas Platform](https://wap.promoxp.us/).
