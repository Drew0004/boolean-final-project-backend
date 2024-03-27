<?php

namespace Database\Seeders;

use App\Models\Sponsor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Helpers

use Illuminate\Support\Facades\Schema;

class SponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Sponsor::truncate();
        Schema::enableForeignKeyConstraints();
        $allSponsorships = [
            [
                'price' => '2.99',
                'type' => 'Bronze',
                'hours' => '24'
            ],
            [
                'price' => '5.99',
                'type' => 'Silver',
                'hours' => '72'
            ],
            [
                'price' => '9.99',
                'type' => 'Gold',
                'hours' => '144'
            ],
        ];

        foreach ($allSponsorships as $singleSponsorship){
            
            $sponsors = Sponsor::create([
                'price' => $singleSponsorship['price'],
                'type' => $singleSponsorship['type'],
                'hours' => $singleSponsorship['hours'],
            ]);
        }
    }
}
