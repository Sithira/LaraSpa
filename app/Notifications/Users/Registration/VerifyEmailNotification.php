<?php

namespace App\Notifications\Users\Registration;


use App\Mail\Users\Registration\VerifyEmail;
use Illuminate\Notifications\Notification;

class VerifyEmailNotification extends Notification
{

    /**
     * Get the notification's channels.
     *
     * @param  mixed $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return VerifyEmail
     */
    public function toMail($notifiable)
    {
        return (new VerifyEmail($notifiable))->to($notifiable->email);
    }

}
