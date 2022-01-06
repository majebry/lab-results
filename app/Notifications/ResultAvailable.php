<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\Messages\TwilioMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;

class ResultAvailable extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [TwilioChannel::class];
    }

    /**
     * Get the Vonage / SMS representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\NexmoMessage
     */
    public function toNexmo($notifiable)
    {
        // check if notifiable has a phone number?
        
        return (new NexmoMessage)
            ->content("Your result is available @ PMTestResults .com
Use order# {$notifiable->id} & {$notifiable->formatted_date_of_birth} To get your report. 
Thank you");
    }

    public function toTwilio($notifiable)
    {
        return (new TwilioMessage)
            ->content("Your result is available @ PMTestResults .com
Use order# {$notifiable->id} & {$notifiable->formatted_date_of_birth} To get your report. 
Thank you");
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
