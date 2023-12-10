<?php

namespace App\Actions\Game;

use App\Http\Requests\Game\EndGameRequest;
use App\Models\Game;
use App\Repositories\GameRepository;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class EndGame
{
    public function __construct(private readonly GameRepository $gameRepository)
    {
    }

    public function execute(EndGameRequest $request): array
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

        $userPosition = $this->gameRepository
            ->getCurrentDayRankingForScore($request->user_score);

        $bestScore = $game->user->bestScoreToday();

        return compact('userPosition', 'bestScore');
    }
}
