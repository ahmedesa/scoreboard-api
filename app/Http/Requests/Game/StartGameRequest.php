<?php

namespace App\Http\Requests\Game;

use Illuminate\Foundation\Http\FormRequest;

class StartGameRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_first_name' => 'required|string',
            'user_last_name' => 'required|string',
            'user_email' => 'required|email|unique:users,email',
        ];
    }
}
