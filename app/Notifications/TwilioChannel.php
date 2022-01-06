<?php

namespace App\Notifications;

use Twilio\Rest\Client;
use Illuminate\Notifications\Notification;

class TwilioChannel
{
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toTwilio($notifiable);

        error_log(print_r(['message' => json_encode($message)], true), 3, storage_path() . '/logs/twilio-sms.log');

        $client = new Client(
            config('services.twilio.account_sid'),
            config('services.twilio.auth_token')
        );
        
        $client->messages->create(
            $notifiable->patient_sms_phone_number,
            [
                'from' => config('services.twilio.number'),
                'body' => $message->content
            ]
        );
    }
}