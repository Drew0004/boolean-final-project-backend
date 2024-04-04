<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vote;
use Illuminate\Http\Request;

//Form Request
use App\Http\Requests\StoreVoteRequest as VoteStoreRequest;



class VoteController extends Controller
{
    public function store(VoteStoreRequest $request){

        $voteData = $request->validated();
        $vote = Vote::create([
            'user_id' => $voteData['user_id'],
            'label' => $voteData['label'],
            'vote' => $voteData['vote'],
        ]);


        return response()->json([
            'success'=> true,
            'message'=> 'Voto salvato con successo',
        ]);
    }
}
