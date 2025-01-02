<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class CompleteProfileNotification extends Notification
{
    use Queueable;

    public function __construct() {}

    public function via($notifiable)
    {
        return ['database', 'mail']; // Send notification via mail and database
    }
    public function toDatabase($notifiable)
    {
        return new DatabaseMessage([
            'message' => 'Your profile is incomplete. Please complete your profile.',
            'url' => route('userProfile.edit'),

        ]);
    }



    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Hello ' . $notifiable->first_name . ',')
            ->line('Your profile is incomplete. Please complete your profile to enjoy full access to the system.')
            ->action('Complete Profile', url('/user/profile/edit')) // Link to the profile edit page
            ->line('Thank you for using our application!');
    }
}
