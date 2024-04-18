<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ottieni l'ID dell'utente attualmente loggato
        $userId = auth()->id();

        // Filtra le recensioni per l'ID dell'utente loggato
        $reviews = Review::where('user_id', $userId)->get();

        // Restituisci la vista con le recensioni filtrate
        return view('reviews.index', compact('reviews'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validazione manuale dei dati del modulo
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Creazione di una nuova recensione associata all'utente autenticato
        auth()->user()->reviews()->create($validatedData);

        // Reindirizzamento con messaggio di successo
        return redirect()->route('reviews.index')->with('success', 'Review created successfully!');
    }
}
