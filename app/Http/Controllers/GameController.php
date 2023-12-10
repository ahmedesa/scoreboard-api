<?php

namespace App\Http\Controllers;

use App\Actions\Game\StartGame;
use App\Http\Requests\Game\StartGameRequest;
use App\Http\Resources\Game\GameResource;
use Illuminate\Http\JsonResponse;

class GameController extends Controller
{
    public function __construct(private readonly StartGame $startGame)
    {
    }

    public function start(StartGameRequest $request): JsonResponse
    {
        $game = $this->startGame->execute($request);

        return $this->responseCreated(null, new GameResource($game));
    }
}
