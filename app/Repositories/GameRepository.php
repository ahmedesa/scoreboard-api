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
}
