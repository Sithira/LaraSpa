<?php

namespace App\Models;

use App\Models\Scopes\ScopeIsActive;
use App\Notifications\Users\Registration\ThankYouEmail;
use App\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'provider_id', 'provider', 'avatar', 'access_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'access_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        self::addGlobalScope(new ScopeIsActive);
    }

    /**
     *  Send the user verification post depends on the type
     *  of the user's provider.
     */
    public function sendEmailVerificationNotification()
    {
        // check for the user provider
        if ($this->provider != 'local') {
            $this->notify(new ThankYouEmail);
            return;
        }

        $this->notify(new VerifyEmail);
    }

}
