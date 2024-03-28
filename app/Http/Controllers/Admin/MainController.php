<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;

//models
use App\Models\User;
use App\Models\Role;
use App\Models\UserDetails;


// Facades
use Illuminate\Support\Facades\Auth;

// Helpers
use Illuminate\Support\Facades\Storage;

class MainController extends Controller
{

    public function dashboard()
    {
        // Recupera l'utente autenticato
        $user = Auth::user();
        // $user = auth()->user();
        // $userDetails = UserDetails::all();

        return view('admin.dashboard', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(UpdateUserRequest $request)
    {
        //Da fixare cambio della demo audio
        
        $userData = $request->validated();

        $user_id = Auth::user()->id;
        
        $user = User::where('id',$user_id )->first();

        

        $picturePath = $user->userDetails->picture;
        if (isset($userData['picture'])) {
            if ($picturePath != null) {
                Storage::disk('public')->delete($picturePath);
            }

            $picturePath = Storage::disk('public')->put('images', $userData['picture']);
        }
        else if (isset($userData['delete_picture'])) {
            Storage::disk('public')->delete($picturePath);

            $picturePath = null;
        }

        $userData['picture'] = $picturePath;

        //Fixato cambio nome
        $user->name = $userData['username'];
        
        $user->updateOrFail($userData);
        $user->userDetails->updateOrFail($userData);
        

        if (isset($userData['roles'])) {
            // $user->roles->sync($userData['roles']);
            $user->roles()->sync($userData['roles']);
        }
        else {
            $user->roles->detach();
        }

        return redirect()->route('admin.dashboard');   
    }


}
