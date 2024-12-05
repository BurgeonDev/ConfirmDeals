<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;

class AdApprovedNotification extends Notification
{
    protected $ad;

    public function __construct($ad)
    {
        $this->ad = $ad;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Your ad "' . $this->ad->title . '" has been approved and is now visible to the public.',
            'ad_id' => $this->ad->id,
        ];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Your ad titled "' . $this->ad->title . '" has been approved.')
            ->action('View Your Ad', route('ad.show', $this->ad->id))
            ->line('Thank you for using our application!');
    }
}
