<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

//Models
use App\Models\User;
use App\Models\Review;

//Helpers
use Illuminate\Support\Facades\Schema;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Review::truncate();
        Schema::enableForeignKeyConstraints();

        $allReviews = config('reviews');

        foreach ($allReviews as $singleReview){
            
            $randomUser = User::inRandomOrder()->first();
            $userId = $randomUser->id;
            
            $messages = Review::create([
                'user_id' => $userId,
                'firstname' => $singleReview['firstname'],
                'lastname' => $singleReview['lastname'],
                'description' => $singleReview['description'],
            ]);
        }
    }
}
