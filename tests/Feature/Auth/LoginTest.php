<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{

    /**
     * Test the local login
     */
    public function test_login_user_login_view()
    {
        $response = $this->get(route('login'));

        $response->assertSuccessful();

        $response->assertViewIs('auth.login');
    }

    public function test_user_can_be_logged_in()
    {

        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('login'));

        $response->assertRedirect('/home');

    }
    
}
