<?php

namespace App\Http\Controllers;

use App\Actions\Game\EndGame;
use App\Actions\Game\StartGame;
use App\Http\Requests\Game\EndGameRequest;
use App\Http\Requests\Game\StartGameRequest;
use App\Http\Resources\Game\GameResource;
use App\Repositories\GameRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GameController extends Controller
{
    public function __construct(
        private readonly StartGame $startGame,
        private readonly EndGame $endGame,
        private readonly GameRepository $gameRepository,
    ) {
    }

    public function start(StartGameRequest $request): JsonResponse
    {
        $game = $this->startGame->execute($request);

        return $this->responseCreated(null, new GameResource($game));
    }

    public function end(EndGameRequest $request): JsonResponse
    {
        $game = $this->endGame->execute($request);

        return $this->responseSuccess(null, new GameResource($game));
    }

    public function topGamesForToday(): AnonymousResourceCollection
    {
        $topGamesForToday = $this->gameRepository->getTop10GamesScoresForToday();

        return GameResource::collection($topGamesForToday);
    }
}
