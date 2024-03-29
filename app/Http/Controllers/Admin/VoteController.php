<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreVoteRequest;
use App\Http\Requests\UpdateVoteRequest;

//Models
use App\Models\Vote;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId= auth()->id();
        $receivedVotes = Vote::where('user_id', $userId)->get();
        //Passo $receivedVotes alla vista Blade per visualizzarli
        return view('admin.reviews.index', compact('receivedVotes'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVoteRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Vote $vote)
    {
        //show del singolo messaggio 
        return view('admin.reviews.show', compact('vote'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vote $vote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVoteRequest $request, Vote $vote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vote $vote)
    {
        //
    }
}
