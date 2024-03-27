<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Models
use App\Models\Vote;

// Helpers

use Illuminate\Support\Facades\Schema;

class VoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Vote::truncate();
        Schema::enableForeignKeyConstraints();

        $allVotes = [
            [
                'label' => 'Pessimo',
                'vote' => '1',
            ],
            [
                'label' => 'Scarso',
                'vote' => '2',
            ],
            [
                'label' => 'Nella Media',
                'vote' => '3',
            ],
            
            [
                'label' => 'Molto buono',
                'vote' => '4',
            ],
            [
                'label' => 'Eccellente',
                'vote' => '5',
            ],    
        ];

        foreach ($allVotes as $singleVote) {
            $vote = Vote::create([
                'label' => $singleVote['label'],
                'vote' => $singleVote['vote'],
            ]);
        }
    }
}
