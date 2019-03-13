<?php

namespace App\Mail\Users\Registration;

use App\Models\User;
use Carbon\Carbon;
use Config;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use URL;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public $url;

    /**
     * Create a new message instance.
     *
     * @param Notifiable $notifiable
     */
    public function __construct($notifiable)
    {
        $this->user = $notifiable;

        $this->url = $this->verificationUrl($notifiable);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mails.users.registration.verify');
    }


    /**
     * Get the verification URL for the given notifiable.
     *
     * @param  mixed  $notifiable
     * @return string
     */
    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            ['id' => $notifiable->getKey()]
        );
    }

}
