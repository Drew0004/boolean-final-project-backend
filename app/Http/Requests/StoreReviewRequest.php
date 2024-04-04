<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
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
            'firstname'=> 'required|max:74',
            'lastname'=> 'required|max:74',
            'description'=> 'required|max:2048',
            // eventuale accettazione dei termini
            // 'accepted'=>'required|boolean|accepted'


        ];
    }
}
