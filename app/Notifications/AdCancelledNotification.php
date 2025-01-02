<?php

namespace App\Notifications;

use App\Models\Ad;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdCancelledNotification extends Notification
{
    use Queueable;

    private $ad;

    public function __construct(Ad $ad)
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
            'message' => 'Your ad "' . $this->ad->title . '" has been canceled and is no longer visible to the public.',
            'ad_id' => $this->ad->id,
            'url' => route('ad.show', $this->ad->id), // Keep the same URL if the ad details are still accessible
        ];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Ad Cancelled')
            ->line('Your ad titled "' . $this->ad->title . '" has been canceled.')
            ->action('View Your Ad', route('ad.show', $this->ad->id))
            ->line('If you have any questions, please contact support.');
    }
}
