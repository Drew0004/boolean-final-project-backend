<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Vote;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ottieni l'ID dell'utente attualmente loggato
        $userId = Auth::id();

        // Filtra le recensioni per l'ID dell'utente loggato
        $reviews = Review::where('user_id', $userId)->get();
        $user = Auth::user();
        
        // Restituisci la vista con le recensioni filtrate
        return view('admin.reviews.index', compact('reviews', 'user'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        // Mostra i dettagli della recensione
        return view('admin.reviews.show', compact('review'));
    }
}
