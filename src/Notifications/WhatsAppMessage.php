<?php

namespace Promoxp\WhatsApp\Notifications; // Adjust the namespace

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
