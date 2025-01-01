<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Bus\Queueable;  // Add this import for Queueable

class BidStatusNotification extends Notification
{
    use Queueable;  // Use the Queueable trait
    protected $bid;
    protected $status;

    public function __construct($bid, $status)
    {
        $this->bid = $bid;
        $this->status = $status;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Your bid of ' . $this->bid->offer . ' on the ad "' . $this->bid->ad->title . '" has been ' . $this->status . '.',
            'bid_id' => $this->bid->id,
            'ad_id' => $this->bid->ad_id,
            'status' => $this->status,
            'url' => route('bids.myBids', $this->bid->id), // Ensure this route exists
        ];
    }


    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Your bid on the ad "' . $this->bid->ad->title . '" has been ' . $this->status . '.')
            ->action('View Your Bid', route('bids.myBids', $this->bid->id))
            ->line('Thank you for using our application!');
    }
}
