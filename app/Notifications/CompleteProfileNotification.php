<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CompleteProfileNotification extends Notification
{
    use Queueable;

    public function __construct()
    {
        // Add any additional data you want to pass to the notification
    }

    public function via($notifiable)
    {
        return ['mail', 'database']; // Send notification via mail and database
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Hello ' . $notifiable->first_name . ',')
            ->line('Your profile is incomplete. Please complete your profile to enjoy full access to the system.')
            ->action('Complete Profile', url('/user/profile/edit')) // Link to the profile edit page
            ->line('Thank you for using our application!');
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Your profile is incomplete. Please complete your profile.',
            'action_url' => url('/user/profile/edit'),
        ];
    }
}
