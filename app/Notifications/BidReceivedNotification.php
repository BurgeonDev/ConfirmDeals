<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Messages\MailMessage;

class BidReceivedNotification extends Notification
{
    public $ad;

    public function __construct($ad)
    {
        $this->ad = $ad;
    }

    public function via($notifiable)
    {
        return ['database', 'mail']; // Use both database and mail channels
    }

    public function toDatabase($notifiable)
    {
        return new DatabaseMessage([
            'message' => 'You have received a new bid on your ad: ' . $this->ad->title,
            'ad_id' => $this->ad->id,
            'user_id' => auth()->id()
        ]);
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Bid Received')
            ->line('You have received a new bid on your ad: ' . $this->ad->title)
            ->action('View Ad', url('/user/ad/' . $this->ad->id))
            ->line('Thank you for using our platform!');
    }
}
