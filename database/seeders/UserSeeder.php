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

        $users = config('users');

        foreach ($users as $singleUser) {
            $user = User::create([
                'name' => $singleUser['name'],
                'email' => $singleUser['email'],
                'password' => Hash::make($singleUser['password']),
                'city' => $singleUser['city'],
            ]);
        }
    }
}
