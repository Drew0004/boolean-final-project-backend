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
                'icon' => 'microphone.png',
            ],
            [
                'title' => 'Chitarrista',
                'icon' => 'electric-guitar.png',
            ],
            [
                'title' => 'Bassista',
                'icon' => 'bass-guitar.png',
            ],
            [
                'title' => 'Batterista',
                'icon' => 'drum.png',
            ],
            [
                'title' => 'Testierista',
                'icon' => 'music.png',
            ],
            [
                'title' => 'Pianista',
                'icon' => 'grand-piano.png',
            ],
            [
                'title' => 'Violinista',
                'icon' => 'violin.png',
            ],
            [
                'title' => 'Trombettista',
                'icon' => 'trumpet.png',
            ],
            [
                'title' => 'Sassofonista',
                'icon' => 'saxophone.png',
            ],
            [
                'title' => 'Band Musicale',
                'icon' => 'music-band.png',
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
