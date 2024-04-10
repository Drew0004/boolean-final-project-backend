<?php

namespace Database\Seeders;

use App\Models\Message;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

//Models
use App\Models\User;

//Helpers
use Illuminate\Support\Facades\Schema;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Message::truncate();
        Schema::enableForeignKeyConstraints();

        $allMessages = config('messages');

        foreach ($allMessages as $singleMessage){
            
            $randomUser = User::inRandomOrder()->first();
            $userId = $randomUser->id;
            
            $messages = Message::create([

                'user_id' => $singleMessage['user_id'],
                'firstname' => $singleMessage['firstname'],
                'lastname' => $singleMessage['lastname'],
                'email' => $singleMessage['email'],
                'message' => $singleMessage['message'],
            ]);
        }
    }
}
