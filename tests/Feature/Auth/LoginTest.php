<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Socialite;
use Tests\TestCase;

class LoginTest extends TestCase
{

    public $socialLoginRedirects = [
        'facebook' => 'https://www.facebook.com/v3.0/dialog/oauth',
        'google' => 'https://accounts.google.com/o/oauth2/auth',
        'github' => 'https://github.com/login/oauth/authorize',
        'twitter' => 'https://api.twitter.com/oauth/authenticate'
    ];

    /**
     * Test the local login
     */
    public function test_login_user_login_view()
    {
        $response = $this->get(route('login'));

        $response->assertSuccessful();

        $response->assertViewIs('auth.login');
    }

    /**
     * Test a user login.
     */
    public function test_user_can_be_logged_in()
    {

        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('login'));

        $response->assertRedirect('/home');

    }

    /**
     * Test a google user can login or not
     */
    public function test_a_google_user_can_user()
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


}
