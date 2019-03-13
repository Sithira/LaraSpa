<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiServiceTest extends TestCase
{

    public function test_api_welcome_message()
    {
        $response = $this->get('api');

        $response->assertStatus(200);

        $response->assertJson([
            "message" => "Welcome to " . env('APP_NAME') . " api v" . config('api.version')
        ]);
    }

    public function test_api_ping_pong()
    {
        $response = $this->get('api/ping');

        $response->assertStatus(200);

        $response->assertSeeText("pong");
    }

    public function test_api_version()
    {
        $response = $this->get('api/version');

        $response->assertStatus(200);

        $response->assertJson(['version' => config('api.version')]);
    }

}
