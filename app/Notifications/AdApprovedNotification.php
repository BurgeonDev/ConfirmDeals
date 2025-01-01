<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Bus\Queueable;  // Add this import for Queueable

class AdApprovedNotification extends Notification
{
    use Queueable;  // Use the Queueable trait

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
            'url' => route('ad.show', $this->ad->id),
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
