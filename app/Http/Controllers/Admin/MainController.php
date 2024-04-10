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

// Carbon
use Carbon\Carbon;

class MainController extends Controller
{

    public function dashboard()
    {
        // Recupera l'utente autenticato
        $user = Auth::user();

        $now = Carbon::now();
        
        $sponsoredUser = $user->sponsors()->where('expired_at', '>', $now)->get();
        // $user = auth()->user();
        // $userDetails = UserDetails::all();

        return view('admin.dashboard', compact('user', 'sponsoredUser'));
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

        
        // Gestione immagine
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

        // Gestione demo
        $demoPath = $user->userDetails->demo;
        if (isset($userData['demo'])) {
            if ($demoPath != null) {
                Storage::disk('public')->delete($demoPath);
            }

            $demoPath = Storage::disk('public')->put('audio', $userData['demo']);
        }
        else if (isset($userData['delete_demo'])) {
            Storage::disk('public')->delete($demoPath);

            $demoPath = null;
        }

        $userData['demo'] = $demoPath;

        //Fixato cambio nome
        $user->name = $userData['username'];
        
        $user->updateOrFail($userData);
        $user->userDetails->updateOrFail($userData);
        

        if (isset($userData['roles'])) {
            // $user->roles->sync($userData['roles']);
            $user->roles()->sync($userData['roles']);
        }
        else {
            // $user->roles->detach();
            $user->roles()->detach();
        }

        return redirect()->route('admin.dashboard');   
    }

    public function statistics()
    {
        // Ottieni l'utente autenticato
        $user = Auth::user();

        // Otteni la somma dei voti, messaggi e recensioni per l'utente autenticato
        $totalVotes = $user->votes()->count();
        $totalReviews = $user->reviews()->count();
        $totalMessages = $user->messages()->count();

        // Ottieni la somma dei voti per ciascuna etichetta per l'utente autenticato
        $voteCounts = $user->votes()
        ->select('label', \DB::raw('COUNT(*) as total_votes'))
        ->groupBy('label')
        ->pluck('total_votes', 'label');


        return view('admin.users.statistics', compact('user', 'totalVotes', 'totalReviews', 'totalMessages', 'voteCounts'));
    }


}
