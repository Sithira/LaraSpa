<?php

namespace App\Listeners;

use App\Events\Registered;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class SendEmailVerificationNotification
{
    /**
     * Handle the event.
     *
     * @param Registered $event
     * @return void
     */
    public function handle(Registered $event)
    {
        if ((boolean)config('base.emails.enabled')) {
            if ($event->user instanceof MustVerifyEmail && !$event->user->hasVerifiedEmail()) {
                $event->user->sendEmailVerificationNotification();
            }
        }

    }
}
