<?php

namespace App\Http\Requests\Game;

use Illuminate\Foundation\Http\FormRequest;

class EndGameRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'game_id' => 'required|integer',
            'user_id' => 'required|integer',
            'user_score' => 'required|integer|between:0,1000',
        ];
    }
}
