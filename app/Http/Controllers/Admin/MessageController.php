<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;

//Models
use App\Models\Message;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //tutti i messaggi che l'ur ha ricevuto associati all'id
        // Recupero l'ID dell'utente corrente
        $userId = auth()->id();
        // Recupera tutti i messaggi associati all'ID dell'utente corrente
        $receivedMessages = Message::where('user_id', $userId)->get();
        //Passo $receivedMessages alla vista Blade per visualizzarli
        return view('admin.messages.index', compact('receivedMessages'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMessageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        //show del singolo messaggio 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMessageRequest $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        //l'ur puo cancellare il messaggio ricevuto sia da messaggio singolo
        //che da tabella messaggi ricevuti nell'index(messaggi totali)
    }
}
