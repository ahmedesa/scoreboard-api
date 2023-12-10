<?php

namespace App\Actions\Game;

use App\Http\Requests\Game\StartGameRequest;
use App\Models\Game;
use App\Models\User;

class StartGame
{
    public function execute(StartGameRequest $request): Game
    {
        $user = User::factory()->create([
            'first_name' => $request->user_name,
            'last_name' => $request->user_first_name,
            'email' => $request->user_email,
        ]);

        return Game::create(['user_id' => $user->id]);
    }
}
