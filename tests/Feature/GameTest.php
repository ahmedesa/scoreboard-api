<?php

namespace Tests\Feature;

use Tests\TestCase;

class GameTest extends TestCase
{
    protected string $endpoint = '/api/games/';
    protected string $usersTable = 'users';
    protected string $gamesTable = 'games';

    /**
     * @test
     */
    public function itCanStartAGame()
    {
        $payload = [
            'user_name' => 'John',
            'user_first_name' => 'Doe',
            'user_email' => 'john.doe@example.com',
        ];

        $this->postJson($this->endpoint . 'start', $payload)
            ->assertStatus(201);

        $this->assertDatabaseHas($this->usersTable, [
            'email' => $payload['user_email'],
            'first_name' => $payload['user_name'],
            'last_name' => $payload['user_first_name'],
        ]);

        $this->assertDatabaseHas($this->gamesTable, [
            'user_id' => 1,
            'score' => 0,
        ]);
    }
}
