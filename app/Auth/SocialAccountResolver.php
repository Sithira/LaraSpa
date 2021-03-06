<?php
/**
 * Created by PhpStorm.
 * User: sithira
 * Date: 2019-03-03
 * Time: 09:56
 */

namespace App\Auth;


use Adaojunior\Passport\SocialUserResolverInterface;
use App\Events\Registered;
use App\Helpers\HTTPMessages;
use App\Models\AuthProviders;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Socialite;

class SocialAccountResolver implements SocialUserResolverInterface
{

    /**
     * Resolves user by given network and access token.
     *
     * @param string $network
     * @param string $accessToken
     * @param string|null $accessTokenSecret
     * @return mixed
     */
    public function resolve($network, $accessToken, $accessTokenSecret = null)
    {
        return $this->getUserFromSocialProvider($network, $accessToken);
    }

    /**
     * Creates the user from social network provider's key.
     *
     * @param $provider
     * @param $token
     * @return User
     */
    private function getUserFromSocialProvider($provider, $token)
    {

        if ($this->isProviderAvailable($provider)) {
            $social_user = Socialite::driver($provider)->userFromToken($token);

            return $this->findOrCreateUser($social_user, $provider);
        }

        return response()->json(['status' => HTTPMessages::ERROR, 'message' => 'Requested provider disabled for not added yet']);
    }

    /**
     * Find or create user, update the token and provider id if already exists
     *
     * @param $user
     * @param $provider
     * @return User
     */
    private function findOrCreateUser($user, $provider): Model
    {

        $auth_user = User::where('email', '=', $user->email)->first();

        if (is_null($auth_user)) {

            $auth_user = User::create([
                'email_verified_at' => now()->toDateTimeString(),
                'email' => $user->email,
                'provider_id' => $user->id,
                'provider' => $provider,
                'access_token' => $user->token,
                'avatar' => $user->avatar,
                'name' => $user->name,
            ]);

            // fire the user registered event.
            event(new Registered($auth_user));
        }
        else
        {
            $auth_user->update([
                'access_token' => $user->token
            ]);
        }

        return $auth_user;
    }

    /**
     * Check for the provider availability
     *
     * @param null $provider
     * @return bool
     */
    private function isProviderAvailable($provider = null): bool
    {

        // check if the provider is null or not
        if (is_null($provider)) {
            return false;
        }

        // to lower case
        $provider = strtolower($provider);

        // check for the provider availability
        $auth_provider = AuthProviders::where('name', $provider)
            ->first();

        if (is_null($auth_provider)) {
            return false;
        }

        return true;
    }
}