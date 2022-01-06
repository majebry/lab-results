<?php

namespace App\Notifications\Messages;

class TwilioMessage
{
    public $content;
    
    public function content(string $message)
    {
        $this->content = $message;

        return $this;
    }
}