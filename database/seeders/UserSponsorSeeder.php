<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// importo i models
use App\Models\User;
use App\Models\Sponsor;

//support
use Illuminate\Support\Facades\DB;

class UserSponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sponsorships = config('sponsorships');

        // Generazione random
        // for ($i = 0; $i < 10; $i++) { 
        //     $randomUser = User::inRandomOrder()->first();
        //     $randomSponsor = Sponsor::inRandomOrder()->first();
        
        //     // Verifico se la coppia esiste già nella tabella
        //     $existigData = DB::table('user_sponsor')
        //         ->where('user_id', $randomUser->id)
        //         ->where('sponsor_id', $randomSponsor->id)
        //         ->exists();
        
        //     // Se la coppia non esiste, inserisco il nuovo dato
        //     if (!$existigData) {
        //         DB::table('user_sponsor')->insert([
        //             ['user_id' => $randomUser->id, 'sponsor_id' => $randomSponsor->id]
        //         ]);
        //     }
        // }

        //Generazione stabilita da noi

        foreach($sponsorships as $singleSponsor){
            DB::table('user_sponsor')->insert([
                ['user_id' => $singleSponsor['user_id'], 'sponsor_id' => $singleSponsor['sponsor_id']]
            ]);
        }
    }
}
