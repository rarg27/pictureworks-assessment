<?php

use Tests\TestCase;

class AppendUserCommentsEndpointTest extends TestCase
{
    public function test_get_validation_error_on_invalid_inputs()
    {
        $inputSets = [
            [
                'id' => 'string',
                'comments' => 'test',
                'password' => '720DF6C2482218518FA20FDC52D4DED7ECC043AB'
            ],
            [
                'id' => '1',
                'password' => '720DF6C2482218518FA20FDC52D4DED7ECC043AB'
            ],
            [
                'id' => '1',
                'comments' => 'test',
            ],
            [
                'comments' => 'test',
                'password' => '720DF6C2482218518FA20FDC52D4DED7ECC043AB'
            ]
        ];

        foreach ($inputSets as $input) {
            $this->post('/', $input)->assertStatus(422);
        }
    }

    public function test_get_invalid_password_on_wrong_password_input()
    {
        $this->post('/', [
                'id' => '1',
                'comments' => 'test',
                'password' => 'wr0ngpassword'
        ])
            ->assertStatus(401)
            ->assertSee('Invalid password');
    }

    public function test_get_server_error_on_failed_append_user_comment()
    {
        $this->post('/', [
            'id' => '3',
            'comments' => 'test',
            'password' => '720DF6C2482218518FA20FDC52D4DED7ECC043AB'
        ])
            ->assertStatus(500)
            ->assertSee('Could not update database');
    }

    public function test_can_pass_json_and_form_inputs()
    {
        $response = $this->post('/', [
            'id' => '1',
            'comments' => 'test',
            'password' => '720DF6C2482218518FA20FDC52D4DED7ECC043AB'
        ]);

        $response
            ->assertStatus(200)
            ->assertSee('OK');

        $response = $this->json('POST', '/', [
            'id' => '1',
            'comments' => 'test',
            'password' => '720DF6C2482218518FA20FDC52D4DED7ECC043AB'
        ]);

        $response
            ->assertStatus(200)
            ->assertSee('OK');
    }
}
