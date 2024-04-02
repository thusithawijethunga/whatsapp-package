<?php

namespace Promoxp\WhatsApp\Channels;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;

class WhatsAppChannel
{
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toWhatsApp($notifiable);

        $response = Http::post(config('whatsapp.api_url'), [
            'appkey' => config('whatsapp.appkey'),
            'authkey' => config('whatsapp.authkey'),
            'to' => $notifiable->phone_number,
            'template_id' => $notification->templateId(),
            'variables' => $message->variables(),
        ]);

        return $response->json();
    }
}
