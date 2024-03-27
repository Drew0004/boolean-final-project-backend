<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Models
use App\Models\User;
use App\Models\Vote;

//support
use Illuminate\Support\Facades\DB;


class UserVoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 15; $i++) { 
            $randomUser = User::inRandomOrder()->first();
            $randomVote = Vote::inRandomOrder()->first();
        
            // Verifico se la coppia esiste già nella tabella
            $existigData = DB::table('user_vote')
                ->where('user_id', $randomUser->id)
                ->where('vote_id', $randomVote->id)
                ->exists();
        
            // Se la coppia non esiste, inserisco il nuovo dato
            if (!$existigData) {
                DB::table('user_vote')->insert([
                    ['user_id' => $randomUser->id, 'vote_id' => $randomVote->id]
                ]);
            }
        }
    }
}
