<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

//Models
use App\Models\User;
use App\Models\UserDetails;

//Helpers
use Illuminate\Support\Facades\Schema;

class UserDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        UserDetails::truncate();
        Schema::enableForeignKeyConstraints();



        $allUserDetails = [
            [
                'demo' => 'demo prova ',
                'picture' => 'picture prova',
                'bio' => 'Bio non molto lunga di...',
                'cellphone' => '+39 3385698137',
                'members' => 'Breve descrizione dei members'
            ],
            [
                'demo' => 'demo prova ',
                'picture' => 'picture prova',
                'bio' => 'Bio non molto lunga di...',
                'cellphone' => '+39 3385698137',
                'members' => 'Breve descrizione dei members'
            ],
            [
                'demo' => 'demo prova ',
                'picture' => 'picture prova',
                'bio' => 'Bio non molto lunga di...',
                'cellphone' => '+39 3385698137',
                'members' => 'Breve descrizione dei members'
            ],
            [
                'demo' => 'demo prova ',
                'picture' => 'picture prova',
                'bio' => 'Bio non molto lunga di...',
                'cellphone' => '+39 3385698137',
                'members' => 'Breve descrizione dei members'
            ],
            [
                'demo' => 'demo prova ',
                'picture' => 'picture prova',
                'bio' => 'Bio non molto lunga di...',
                'cellphone' => '+39 3385698137',
                'members' => 'Breve descrizione dei members'
            ],
        ];

        //dichiaro un'array di id unici vuoto
        $uniqueId = []; 
        
        foreach ($allUserDetails as $singleUserDetail){
            //prendo un utente random 
            $randomUser = User::inRandomOrder()->whereNotIn('id', $uniqueId)->first();
            // verifico se l'utente è valido e non è già stato selezionato in precedenza
            if ($randomUser) {
                $userId = $randomUser->id;

                // aggiungo l'id dell'utente selezionato all'array di quelli unici
                $uniqueId[] = $userId;
            };
            $userDetails= UserDetails::create([
                'user_id' => $userId,
                'demo' => $singleUserDetail['demo'],
                'picture' => $singleUserDetail['picture'],
                'bio' => $singleUserDetail['bio'],
                'cellphone' => $singleUserDetail['cellphone'],
                'members' => $singleUserDetail['members'],
            ]);
        }
    }
}
