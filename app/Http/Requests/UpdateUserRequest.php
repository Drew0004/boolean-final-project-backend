<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'username' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'demo' => 'nullable|mimes:mp3,wav',  //Da aggiungere forse dimensione max
            'delete_demo' => 'nullable|boolean',
            'picture' => 'nullable|image',
            'delete_picture' => 'nullable|boolean',
            'bio' => 'nullable|string|max:1024',
            'cellphone' => 'nullable|string|max:24',
            'members' => 'nullable|string|max:1024',
            'roles' => 'required|array|min:1|exists:roles,id',

        ];
    }
}