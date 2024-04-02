<?php

namespace Promoxp\WhatsApp\Channels;

class WhatsAppMessage
{
    protected $variables;
    protected $whatsapp_number;

    public function __construct($variables,$whatsapp_number)
    {
        $this->variables        = $variables;
        $this->whatsapp_number  = $whatsapp_number;
    }

    public function variables()
    {
        return $this->variables;
    }

    public function whatsappNumber()
    {
        return $this->whatsapp_number;
    }
}
