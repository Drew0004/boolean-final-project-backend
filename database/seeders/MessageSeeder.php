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



        $allMessages = [
            [
                'firstname' => 'Gino',
                'lastname' => 'Paoli',
                'email' => 'gino.paoli@gmail.com',
                'message' => 'Salve, sono interessato 
                alla vostra musica e vorrei discutere un 
                possibile ingaggio per un evento. 
                Potremmo parlare dei dettagli? Grazie.',
            ],
            [
                'firstname' => 'Vincenzo',
                'lastname' => 'De Santi',
                'email' => 'vincenzodesanti@hotmail.it',
                'message' => 'Ciao, mi piacerebbe collaborare 
                con te per un progetto musicale. 
                Possiamo discutere le opzioni? 
                Attendo tue notizie. Grazie.',
            ],
            [
                'firstname' => 'Francesca',
                'lastname' => 'Roberti',
                'email' => 'francesca.roberti87@libero.com',
                'message' => "Salve, sono interessata alla 
                vostra musica e vorrei prenotarvi per un'esibizione. 
                Potremmo discutere disponibilità e tariffe? Grazie.",
            ],
            [
                'firstname' => 'Gianluigi',
                'lastname' => 'Cecco',
                'email' => 'gianluigi.cecco@gmail.com',
                'message' => "Ciao, vorremmo prenotarvi 
                per un concerto. Possiamo parlare delle 
                vostre date disponibili e delle tariffe? 
                Grazie mille.",
            ],
        ];


        foreach ($allMessages as $singleMessage){
            
            $randomUser = User::inRandomOrder()->first();
            $userId = $randomUser->id;
            
            $messages = Message::create([
                'user_id' => $userId,
                'firstname' => $singleMessage['firstname'],
                'lastname' => $singleMessage['lastname'],
                'email' => $singleMessage['email'],
                'message' => $singleMessage['message'],
            ]);
        }
    }
}
