<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class GameFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => createOrRandomFactory(User::class),
            'score' => $this->faker->numberBetween(0, 1000),
        ];
    }
}
