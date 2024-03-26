<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

//Models

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

        foreach ($allUserDetails as $singleUserDetail){
            $UserDetails= UserDetails::create([
                'demo' => $singleUserDetail['demo'],
                'picture' => $singleUserDetail['picture'],
                'bio' => $singleUserDetail['bio'],
                'cellphone' => $singleUserDetail['cellphone'],
                'members' => $singleUserDetail['members'],
            ]);
        }
    }
}
