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
            'user_first_name' => 'John',
            'user_last_name' => 'Doe',
            'user_email' => 'john.doe@example.com',
        ];

        $this->postJson($this->endpoint . 'start', $payload)
            ->assertStatus(201);

        $this->assertDatabaseHas($this->usersTable, [
            'email' => $payload['user_email'],
            'first_name' => $payload['user_first_name'],
            'last_name' => $payload['user_last_name'],
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

        $endedGame = Game::factory()->create([
            'user_id' => $user->id,
            'score' => 850,
        ]);

        $gameToBeEnded = Game::factory()->create([
            'user_id' => $user->id,
            'score' => 0,
        ]);

        $finalScore = 800;

        $payload = [
            'game_id' => $gameToBeEnded->id,
            'user_id' => $user->id,
            'user_score' => $finalScore,
        ];

        $this->postJson($this->endpoint . 'end', $payload)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'userPosition' => 1,
                    'bestScore' => 850,
                ],
            ]);

        $this->assertDatabaseHas('games', [
            'id' => $gameToBeEnded->id,
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

    /**
     * @test
     */
    public function itCanGetTopUsersForTheDay()
    {
        $today = now()->toDateString();

        $userWithHighestScore = User::factory()->create();

        Game::factory()->create([
            'user_id' => $userWithHighestScore->id,
            'score' => 1000,
            'created_at' => $today,
        ]);

        User::factory(15)
            ->create()
            ->each(function (User $user) use ($today) {
                Game::factory()->create([
                    'user_id' => $user->id,
                    'score' => rand(0, 1000),
                    'created_at' => $today,
                ]);
            });

        $this->getJson($this->endpoint . 'top-10-games')
            ->assertStatus(200)
            ->assertJsonCount(10, 'data')
            ->assertJson([
                'data' => [
                    0 => [
                        'user' => [
                            'id' => $userWithHighestScore->id,
                        ],
                        'score' => 1000,
                    ],
                ],
            ]);
    }
}
