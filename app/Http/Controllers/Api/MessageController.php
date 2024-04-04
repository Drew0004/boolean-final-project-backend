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

        $message = Message::create($request->validated());


        return response()->json([
            'success'=> true,
            'message'=> 'contatto salvato con successo',
        ]);
    }
}
