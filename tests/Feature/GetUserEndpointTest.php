<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetUserEndpointTest extends TestCase
{
    public function test_get_validation_error_if_id_not_integer()
    {
        $response = $this->get('/?id=string');

        $response
            ->assertStatus(422)
            ->assertSee('Invalid id');

        $response = $this->get('/?id=1.1');

        $response
            ->assertStatus(422)
            ->assertSee('Invalid id');
    }

    public function test_get_not_found_error_if_user_not_exists()
    {
        $this->get('/?id=3')
            ->assertStatus(404)
            ->assertSee('No such user');
    }

    public function test_multiple_routes_for_get_user_endpoint()
    {
        $response = $this->get('/?id=1');

        $response->assertStatus(200);

        $response = $this->get('/user/1');

        $response->assertStatus(200);
    }
}
