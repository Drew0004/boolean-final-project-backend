<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// Models
use App\Models\Role;

// Helpers

use Illuminate\Support\Facades\Schema;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Role::truncate();
        Schema::enableForeignKeyConstraints();

        $allRoles = [
            [
                'title' => 'Cantante',
                'icon' => '/images/microphone.png',
            ],
            [
                'title' => 'Chitarrista',
                'icon' => '/images/electric-guitar.png',
            ],
            [
                'title' => 'Bassista',
                'icon' => '/images/bass-guitar.png',
            ],
            [
                'title' => 'Batterista',
                'icon' => '/images/drum.png',
            ],
            [
                'title' => 'Testierista',
                'icon' => '/images/music.png',
            ],
            [
                'title' => 'Pianista',
                'icon' => '/images/grand-piano.png',
            ],
            [
                'title' => 'Violinista',
                'icon' => '/images/violin.png',
            ],
            [
                'title' => 'Trombettista',
                'icon' => '/images/trumpet.png',
            ],
            [
                'title' => 'Sassofonista',
                'icon' => '/images/saxophone.png',
            ],
            [
                'title' => 'Band Musicale',
                'icon' => '/images/music-band.png',
            ],
        ];

        foreach ($allRoles as $singleRole) {
            $role = Role::create([
                'title' => $singleRole['title'],
                'icon' => $singleRole['icon'],
            ]);
        }
    }
}
