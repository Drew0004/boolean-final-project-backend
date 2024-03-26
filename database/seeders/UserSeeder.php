<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// Models
use App\Models\User;

// Helpers

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        User::truncate();
        Schema::enableForeignKeyConstraints();

        $allUsers = [
            [
                'name' => 'Mario Cilino',
                'email' => 'mario.cilino@gmail.com',
                'password' => 'mariocilino30',
                'city' => 'Milano'
            ],
            [
                'name' => 'Paola Gagliardi',
                'email' => 'paola.gagliardi@gmail.com',
                'password' => 'paolagagliardi30',
                'city' => 'Firenze'
            ],
            [
                'name' => 'The Rock Army',
                'email' => 'rock.army@hotmail.it',
                'password' => 'rockarmy30',
                'city' => 'Padova'
            ],
            [
                'name' => 'Nathan Drake',
                'email' => 'nathan.drake@gmail.com',
                'password' => 'nathandrake30',
                'city' => 'Toronto'
            ],
            [
                'name' => 'Jazzy Sons',
                'email' => 'jazzysons@outlook.com',
                'password' => 'jazzysons30',
                'city' => 'Venezia'
            ],
        ];

        foreach ($allUsers as $singleUser) {
            $user = User::create([
                'name' => $singleUser['name'],
                'email' => $singleUser['email'],
                'password' => Hash::make($singleUser['password']),
                'city' => $singleUser['city'],
            ]);
        }
    }
}
