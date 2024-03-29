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

        $userDetails = config('userdetails');

        //dichiaro un'array di id unici vuoto
        // $uniqueId = []; 
        
        foreach ($userDetails as $singleUserDetail){
            
            // //prendo un utente random il quale id non è presente nell'array
            // $randomUser = User::inRandomOrder()->whereNotIn('id', $uniqueId)->first();
            // // verifico se l'utente è valido e non è già stato selezionato in precedenza
            // if ($randomUser) {
            //     $userId = $randomUser->id;

            //     // aggiungo l'id dell'utente selezionato all'array di quelli unici
            //     $uniqueId[] = $userId;
            // };
            
            $userDetails= UserDetails::create([
                'user_id' => $singleUserDetail['id'],
                'demo' => $singleUserDetail['demo'],
                'picture' => $singleUserDetail['picture'],
                'bio' => $singleUserDetail['bio'],
                'cellphone' => $singleUserDetail['cellphone'],
                'members' => $singleUserDetail['members'],
            ]);
        }
    }
}
