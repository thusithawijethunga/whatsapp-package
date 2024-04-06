<?php

namespace Promoxp\WhatsApp\Channels;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Client\RequestException;

class WhatsAppChannel
{
    public function send($notifiable, Notification $notification)
    {
        try {
            $message = $notification->toWhatsApp($notifiable);

            $response = Http::post(config('whatsapp.api_url'), [
                'appkey'        => config('whatsapp.appkey'),
                'authkey'       => config('whatsapp.authkey'),
                'to'            => $message->recipient(),
                'template_id'   => $notification->templateId(),
                'variables'     => $message->variables(),
            ]);

            $responseData = $response->json();

            // Check if the response contains an error message
            if (isset($responseData['error'])) {
                // Log the error message
                \Log::error('WhatsAppChannel Error: ' . $responseData['error']);
                // You can throw a custom exception or return a specific response
                throw new \Exception($responseData['error']);
            }

            \Log::info('WhatsAppChannel:', $responseData);

            return $responseData;

        } catch (RequestException $e) {
            // Handle HTTP request errors (e.g., connection errors)
            \Log::error('WhatsAppChannel: HTTP Request Error - ' . $e->getMessage());
            // You can also throw a custom exception or return a specific response
            throw new \Exception('Failed to send WhatsApp notification: HTTP Request Error');
        }
    }
}
