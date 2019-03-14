<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Socialite;
use Tests\TestCase;

class LoginTest extends TestCase
{

    /**
     * Current urls for the social providers
     *
     * @var array
     */
    public $socialLoginRedirects = [
        'facebook' => 'https://www.facebook.com/v3.0/dialog/oauth',
        'google' => 'https://accounts.google.com/o/oauth2/auth',
        'github' => 'https://github.com/login/oauth/authorize',
        'twitter' => 'https://api.twitter.com/oauth/authenticate'
    ];

    /**
     * Test a google user can login or not
     */
    public function test_a_google_user_can_login()
    {
        $providerMock = \Mockery::mock('Laravel\Socialite\Contracts\Provider');

        $providerMock->shouldReceive('redirect')->andReturn(new RedirectResponse($this->socialLoginRedirects['google']));

        Socialite::shouldReceive('driver')->with('google')->andReturn($providerMock);

        //Check that the user is redirected to the Social Platform Login Page
        $loginResponse = $this->call('GET', route('social-login', ['provider' => 'google']));

        $loginResponse->assertStatus(302);

        $redirectLocation = $loginResponse->headers->get('Location');

        $this->assertContains(
            $this->socialLoginRedirects['google'],
            $redirectLocation,
            sprintf(
                'The Social Login Redirect does not match the expected value for the provider %s. Expected to contain %s but got %s',
                'google',
                $this->socialLoginRedirects['google'],
                $redirectLocation
            )
        );

    }

    /**
     * Test local login for the system.
     */
    public function test_a_local_user_can_login_using_password()
    {

        $this->seed();

        $this->artisan('passport:install');

        $passport = \DB::table('oauth_clients')->where('id', '=', 2)->first();

        $user = factory(User::class)->create();

        $body = [
            'grant_type' => 'password',
            'client_id' => '2',
            'client_secret' => $passport->secret,
            'username' => $user->email,
            'password' => 'password'
        ];

        $response = $this->postJson('oauth/token', $body);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            "access_token",
            "token_type",
            "refresh_token",
            "expires_in"
        ]);
    }

}
