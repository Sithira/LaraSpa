<?php

namespace App\Models;

use App\Models\Scopes\ScopeIsActive;
use App\Notifications\Users\Registration\ThankYouEmailNotification;
use App\Notifications\Users\Registration\VerifyEmailNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Silber\Bouncer\Database\HasRolesAndAbilities;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasApiTokens, SoftDeletes, HasRolesAndAbilities;

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
        // check for the user provider and the configurations
        if ($this->provider != 'local' && (boolean)config('base.emails.social_login.enabled')) {
            $this->notify(new ThankYouEmailNotification);
            return;
        }

        if ((boolean)config(('base.emails.email_login.enabled'))) {
            $this->notify(new VerifyEmailNotification);
        }

    }

    /*-----------------------------------------------------------------------
     * Model Specific Relationships
     *-----------------------------------------------------------------------
     *
     * Set the model specific relationships
     *
     */

    /*-----------------------------------------------------------------------
     * Attribute Setters and Getters
     *-----------------------------------------------------------------------
     *
     * Set the model specific attribute setters and getters
     *
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

}
