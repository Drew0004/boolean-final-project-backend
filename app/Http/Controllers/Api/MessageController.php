<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Form Request
use App\Http\Requests\StoreMessageRequest as MessageStoreRequest;

//Models
use App\Models\Message;


class MessageController extends Controller
{
    public function store(MessageStoreRequest $request){

        $messageData = $request->validated();
        $message = Message::create([
            'user_id' => $messageData['user_id'],
            'firstname' => $messageData['firstname'],
            'lastname' => $messageData['lastname'],
            'email' => $messageData['email'],
            'message' => $messageData['message'],
        ]);


        return response()->json([
            'success'=> true,
            'message'=> 'contatto salvato con successo',
        ]);
    }
}
