<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vote;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

// Form Request
use App\Http\Requests\StoreVoteRequest as VoteStoreRequest;

class VoteController extends Controller
{
    public function store(VoteStoreRequest $request)
    {
        $validatedData = $request->validated();

        // Assicurati che i nomi delle chiavi corrispondano alle colonne della tabella pivot
        $user = User::find($validatedData['user_id']);

        // Imposta la label in base al voto
        $label = $this->setLabelFromVote($validatedData['vote']);

        DB::table('user_vote')->insert([
            [
                'user_id' => $validatedData['user_id'], 
                'vote_id' => $validatedData['vote'],
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Voto salvato con successo',
        ]);
    }

    /**
     * Imposta la label in base al voto.
     *
     * @param int $vote
     * @return string
     */
    private function setLabelFromVote(int $vote): string
    {
        // Esempio: se il voto è 1, impostalo come "Scarso"; se è 5, impostalo come "Eccellente", ecc.
        switch ($vote) {
            case 1:
                return 'Pessimo';
            case 2:
                return 'Scarso';
            case 3:
                return 'Nella Media';
            case 4:
                return 'Molto Buono';
            case 5:
                return 'Eccellente';
            default:
                return 'Sconosciuto';
        }
    }
}
