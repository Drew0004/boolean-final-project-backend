<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Role;
use App\Models\Sponsor;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            RoleSeeder::class,
            UserDetailsSeeder::class,
            UserRoleSeeder::class,
            VoteSeeder::class,
            UserVoteSeeder::class,
            MessageSeeder::class,
            SponsorSeeder::class,
            UserSponsorSeeder::class,
        ]);
    }
}
