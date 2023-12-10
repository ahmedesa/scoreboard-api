<?php

namespace App\Actions\Game;

use App\Http\Requests\Game\EndGameRequest;
use App\Models\Game;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class EndGame
{
    public function execute(EndGameRequest $request): Game
    {
        $game = Game::where('id', $request->game_id)
            ->where('user_id', $request->user_id)
            ->firstOrFail();

        if ($game->isEnded()) {
            throw new UnprocessableEntityHttpException('Game is already ended !');
        }

        $game->update([
            'score' => $request->user_score,
        ]);

        return $game;
    }
}
