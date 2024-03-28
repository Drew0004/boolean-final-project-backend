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
        return view('admin.reviews.index', compact('reviews'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.reviews.create');
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

        // Creazione di una nuova recensione
        $review = new Review;
        $review->user_id = auth()->user()->id;
        $review->firstname = $validatedData['firstname'];
        $review->lastname = $validatedData['lastname'];
        $review->description = $validatedData['description'];
        $review->save();

        // Reindirizzamento con messaggio di successo
        return redirect()->route('admin.reviews.index')->with('success', 'Review created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        return view('admin.reviews.show', compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        return view('admin.reviews.edit', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     */
    
    public function update(Request $request, Review $review)
    {
        // Validazione manuale dei dati del modulo
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Aggiornamento della recensione
        $review->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'description' => $request->description,
        ]);

        // Reindirizzamento con messaggio di successo
        return redirect()->route('admin.reviews.index')->with('success', 'Review updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        $review->delete();

    return redirect()->route('admin.reviews.index')->with('success', 'Review deleted successfully!');
    }
}
