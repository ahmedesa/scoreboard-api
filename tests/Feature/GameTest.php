<?php

namespace Tests\Feature;

use App\Models\Game;
use App\Models\User;
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

    /** @test */
    public function itCanEndAGame()
    {
        $user = User::factory()->create();

        $game = Game::factory()->create([
            'user_id' => $user->id,
            'score' => 0,
        ]);

        $finalScore = 800;

        $payload = [
            'game_id' => $game->id,
            'user_id' => $user->id,
            'user_score' => $finalScore,
        ];

        $this->postJson($this->endpoint . 'end', $payload)
            ->assertStatus(200)
            ->assertSee([
                '800',
            ]);

        $this->assertDatabaseHas('games', [
            'id' => $game->id,
            'score' => $finalScore,
        ]);
    }

    /** @test */
    public function itCantEndAGameTwice()
    {
        $user = User::factory()->create();

        $game = Game::factory()->create([
            'user_id' => $user->id,
            'score' => 100,
        ]);

        $finalScore = 800;

        $payload = [
            'game_id' => $game->id,
            'user_id' => $user->id,
            'user_score' => $finalScore,
        ];

        $this->postJson($this->endpoint . 'end', $payload)
            ->assertStatus(422);

    }
}
