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

    public function messages(): array
    {
        return [
            'username.required' => 'Il campo nome è obbligatorio.',
            'username.string' => 'Il campo nome deve essere una stringa.',
            'username.max' => 'Il campo nome non può superare i 255 caratteri.',
            'city.required' => 'Il campo città è obbligatorio.',
            'city.string' => 'Il campo città deve essere una stringa.',
            'city.max' => 'Il campo città non può superare i 255 caratteri.',
            'demo.mimes' => 'Il file demo deve essere di tipo mp3 o wav.',
            'picture.image' => 'Il file immagine deve essere un\'immagine.',
            'bio.string' => 'Il campo bio deve essere una stringa.',
            'bio.max' => 'Il campo bio non può superare i 1024 caratteri.',
            'cellphone.string' => 'Il campo cellulare deve essere una stringa.',
            'cellphone.max' => 'Il campo cellulare non può superare i 24 caratteri.',
            'members.string' => 'Il campo members deve essere una stringa.',
            'members.max' => 'Il campo members non può superare i 1024 caratteri.',
            'roles.required' => 'Seleziona almeno un ruolo per l\'utente.',
            'roles.min' => 'Seleziona almeno un ruolo per l\'utente.',
            'roles.exists' => 'Uno o più ruoli selezionati non sono validi.',
        ];
    }
}