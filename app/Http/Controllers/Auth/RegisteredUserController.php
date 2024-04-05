<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

// Models
use App\Models\Role;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $roles = Role::all();
        return view('auth.register', compact('roles'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $message = [
            'name.required' => 'Il campo nome è obbligatorio.',
            'email.required' => 'Il campo email è obbligatorio.',
            'email.email' => 'Inserisci un indirizzo email valido.',
            'email.unique' => 'Questo indirizzo email è già registrato.',
            'password.required' => 'Il campo password è obbligatorio.',
            'password.confirmed' => 'La conferma della password non corrisponde.',
            'city.required' => 'Il campo città è obbligatorio.',
            'roles.required' => 'Seleziona almeno un ruolo per l\'utente.',
        ];
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'city' => ['required', 'string', 'max:255'],
            'roles' => ['required', 'array', 'min:1', 'exists:roles,id'],
        ], $message);

        // Creo l'utente
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'city' => $request->city,
        ]);

        // Inserisco l'id dell'utente nella tabella user details
        $user->userDetails()->create([
            'user_id' => $user->id,
        ]);

        // Ci aggancio i ruoli
        $user->roles()->sync($request->roles);

        event(new Registered($user));

        Auth::login($user);

        // return redirect(RouteServiceProvider::HOME);
        return redirect()->route('admin.edit');
    }
}
