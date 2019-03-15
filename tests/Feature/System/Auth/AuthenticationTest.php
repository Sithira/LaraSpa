<?php

namespace Tests\Feature\System\Auth;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

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
     * Register a user without social auth.
     */
    public function test_user_can_register_via_password()
    {

        $this->artisan('passport:install');

        $temp_user = factory(User::class)->make();

        $request = [
            'email' => $temp_user->email,
            'name' => $temp_user->name,
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->postJson('/register', $request);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            "access_token",
            "token_type",
            "refresh_token",
            "expires_in"
        ]);
    }
}
