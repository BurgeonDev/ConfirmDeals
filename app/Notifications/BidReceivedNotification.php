<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class BidReceivedNotification extends Notification
{
    public $ad;

    public function __construct($ad)
    {
        $this->ad = $ad;
    }

    public function via($notifiable)
    {
        return ['database']; // Use only the database channel
    }

    public function toDatabase($notifiable)
    {
        return new DatabaseMessage([
            'message' => 'You have received a new bid on your ad: ' . $this->ad->title,
            'ad_id' => $this->ad->id,
            'user_id' => auth()->id()
        ]);
    }
}
