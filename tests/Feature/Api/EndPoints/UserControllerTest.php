<?php

namespace Tests\Feature\Api\EndPoints;

use App\Models\User;
use Laravel\Passport\Passport;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserControllerTest extends TestCase
{

    use RefreshDatabase;

    private $base_url;

    /**
     * Get up the base url
     */
    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $api = (string) config('api.version');

        $this->base_url = "api/v{$api}/users";

        $this->seed();
    }

    /**
     * @test Test index method to check everything returns
     */
    public function test_index_method_to_get_all_users()
    {

        $response = $this->get($this->base_url);

        $response->assertStatus(200);

        $data = json_decode(json_encode($response->content()), true);

        $data = json_decode($data, true);

        $this->assertEquals(count($data['data']), User::all()->count());

        $response->assertJsonStructure([
            "data",
            "links",
            "meta"
        ]);
    }

    /**
     * @test Assert user details can be obtained from API.
     */
    public function test_user_details_show()
    {
        $user = factory(User::class)->create();

        $url = $this->base_url . '/' . $user->id;

        $response = $this->get($url);

        $response->assertStatus(200);

        $response->assertJson([
            'data' => [
                'name' => $user->name
            ]
        ], false);
    }

    /**
     * @test Assert created data and API data are same.
     */
    public function test_store_method_to_store_user()
    {

        $request = [
            'name' => 'Sithira Munasinghe',
            'email' => 'testme@test.com',
            'password' => '12345678'
        ];

        $response = $this->postJson($this->base_url, $request);

        $response->assertStatus(201);

        $response->assertJson([
            'data' => [
                'name' => 'Sithira Munasinghe',
                'email' => 'testme@test.com',
            ]
        ], false);

    }

    /**
     * @test Test if a given user can update via the API.
     */
    public function test_update_method_to_update_a_user()
    {

        $user = factory(User::class)->create();

        $url = $this->base_url . '/' . $user->id;

        Passport::actingAs($user);

        $response = $this->patchJson($url, ['name' => 'Sithira', 'email' => $user->email]);

        $response->assertStatus(200);

        $response->assertJson([
            'data' => [
                'name' => 'Sithira'
            ]
        ], false);
        
    }

    /**
     * @test delete user deletion via the API.
     */
    public function test_user_can_be_deleted_via_the_api()
    {

        $user = factory(User::class)->create();

        $url = $this->base_url . '/' . $user->id;

        Passport::actingAs($user);

        $response = $this->deleteJson($url);

        $response->assertStatus(200);

    }

}