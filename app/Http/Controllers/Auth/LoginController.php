<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Request;
use Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect the user to the provider authentication page.
     *
     * @param $provider string Authentication provider
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        $target_url =  Socialite::driver($provider)->redirect()->getTargetUrl();

        return response()->json([
            'data' => [
                'url' => $target_url
            ]
        ], 200);
    }

    /**
     * Obtain the user information from provider.
     *
     * @param $provider string Authentication provider
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->stateless()->user();

        $proxy = Request::create(
            '/oauth/token',
            'POST',
            [
                'grant_type' => 'social',
                'client_id' => env('OAUTH_CLIENT_ID'),
                'client_secret' => env('OAUTH_CLIENT_SECRET'),
                'network' => $provider,
                'access_token' => $user->token,
            ]
        );

        $response = app()->handle($proxy);

        return redirect()->away(env("APP_URL")."/oauth/callback?data=" . $response->getContent());
    }
}
