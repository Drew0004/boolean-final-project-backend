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

        $voteCounts = $user->votes()
        ->select('label', \DB::raw('COUNT(*) as total_votes'))
        ->groupBy('label')
        ->orderBy(\DB::raw('MIN(id)'))
        ->pluck('total_votes', 'label');
        
        // Restituisci la vista con le recensioni filtrate
        return view('admin.reviews.index', compact('reviews', 'user', 'voteCounts'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        $user = Auth::user();
        if (Auth::id() !== $review->user_id) {
            // Se l'utente non è autorizzato, ritorna un errore 403 (Forbidden)
            abort(403, 'Unauthorized');
        }
        // Mostra i dettagli della recensione
        return view('admin.reviews.show', compact('review', 'user'));
    }
}
