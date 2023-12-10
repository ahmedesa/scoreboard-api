<?php

namespace App\Repositories;

use App\Models\Game;
use Illuminate\Database\Eloquent\Collection;

class GameRepository
{
    public function getTop10GamesScoresForToday(): Collection|array
    {
        return Game::with('user')
            ->whereDate('created_at', now()->toDateString())
            ->orderByDesc('score')
            ->limit(10)
            ->get();
    }

    public function getCurrentDayRankingForScore(int $score): int
    {
        return Game::where('created_at', now()->toDateString())
            ->where('score', '>', $score)
            ->count() + 1;
    }
}
