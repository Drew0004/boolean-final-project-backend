<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVoteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            /* 'label' => 'required|max:255', // Imposta la lunghezza massima appropriata */
            'vote' => 'required|numeric|min:1|max:5', // Assicurati che il voto sia un numero compreso tra 1 e 5
        ];
    }
}
