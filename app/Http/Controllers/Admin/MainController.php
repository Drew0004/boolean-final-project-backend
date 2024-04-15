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
use Illuminate\Support\Facades\DB;

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
        
        $sponsoredUser =  User::whereHas('sponsors', function ($query) use ($now) {
            $query->where('expired_at', '>', $now);
        })
        ->get();

        $usersWithoutSponsorship = User::whereDoesntHave('sponsors')->get();

        // $user = auth()->user();
        // $userDetails = UserDetails::all();

        return view('admin.dashboard', compact('user', 'sponsoredUser', 'usersWithoutSponsorship'));
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
        // $totalVotes = $user->votes()->count();
        // $totalReviews = $user->reviews()->count();
        // $totalMessages = $user->messages()->count();

        $user_id = Auth::user()->id;
        // Query media voti per mese/anno
        $voteAvg = DB::table('user_vote')
        ->select(DB::raw('YEAR(created_at) AS year'), DB::raw('MONTH(created_at) AS month'), DB::raw('COUNT(*) AS vote_count'))
        ->where('user_id', $user_id)
        ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
        ->orderByDesc('year')
        ->orderByDesc('month')
        ->get();

        // Query media messaggi per mese/anno
        $messagesAvg = DB::table('messages')
        ->select(DB::raw('YEAR(created_at) AS year'), DB::raw('MONTH(created_at) AS month'), DB::raw('COUNT(*) AS message_count'))
        ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
        ->orderByDesc('year')
        ->orderByDesc('month')
        ->get();

        // Query media recensioni per mese/anno
        $reviewsAvg = DB::table('reviews')
        ->select(DB::raw('YEAR(created_at) AS year'), DB::raw('MONTH(created_at) AS month'), DB::raw('COUNT(*) AS message_count'))
        ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
        ->orderByDesc('year')
        ->orderByDesc('month')
        ->get();


        // Ottieni la somma dei voti per ciascuna etichetta per l'utente autenticato
        // $voteCounts = $user->votes()
        // ->select('label', \DB::raw('COUNT(*) as total_votes'))
        // ->groupBy('label')
        // ->pluck('total_votes', 'label');


        return view('admin.users.statistics', compact('user', 'voteAvg', 'messagesAvg', 'reviewsAvg',));
    }


}
