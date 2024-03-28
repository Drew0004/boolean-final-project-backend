<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//models
use App\Models\User;
use App\Models\UserDetails;


// Facades
use Illuminate\Support\Facades\Auth;

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

}
