<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiServiceTest extends TestCase
{

    /**
     * Test Api Ping pong response
     */
    public function test_api_ping_pong()
    {
        $response = $this->get('api/ping');

        $response->assertStatus(200);

        $response->assertSeeText("pong");
    }

    /**
     * Test Api welcome message
     */
    public function test_api_welcome_message()
    {
        $response = $this->get('api');

        $response->assertStatus(200);

        $response->assertJson([
            "message" => "Welcome to " . env('APP_NAME') . " api v" . config('api.version')
        ]);
    }

    /**
     * Test Api Version
     */
    public function test_api_version()
    {
        $response = $this->get('api/version');

        $response->assertStatus(200);

        $response->assertJson(['version' => config('api.version')]);
    }

    /**
     * Test get Api authentication providers
     */
    public function test_api_authentication_providers()
    {
        $response = $this->get('/api/providers');

        $response->assertStatus(200);

        $providers = \App\Models\AuthProviders::select(['name', 'callback_url'])->get()->toArray();

        $this->assertNotNull($providers);

        $response->assertJson(['data' => $providers]);
    }

}
