<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;

//Models
use App\Models\Message;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Facades
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        //tutti i messaggi che l'ur ha ricevuto associati all'id
        // Recupero l'ID dell'utente corrente
        $userId = auth()->id();
        // Recupera tutti i messaggi associati all'ID dell'utente corrente
        $receivedMessages = Message::where('user_id', $userId)->get();

        $softDeletedMessages = Message::onlyTrashed()->get();
        //Passo $receivedMessages alla vista Blade per visualizzarli
        return view('admin.messages.index', compact('receivedMessages', 'softDeletedMessages', 'user'));

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
        $user = Auth::user();
        // Verifico se l'utente è autorizzato a visualizzare il messaggio
        if (Auth::id() !== $message->user_id) {
            // Se l'utente non è autorizzato, ritorna un errore 403 (Forbidden)
            abort(403, 'Unauthorized');
        }

        // Se l'utente è autorizzato, mostra il messaggio
        return view('admin.messages.show', compact('message', 'user'));

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
        $message->delete();
        return redirect()->route('admin.messages.index')->with('success', 'Messaggio cancellato con successso');
    
    }

    public function restore($id){
        $message = Message::withTrashed()->find($id);

        if (!$message) {
            abort(404, 'Not Found');
        }
        $message->restore();
        return redirect()->route('admin.messages.index')->with('success', 'Messaggio cancellato con successso');
    }

    public function forcedelete($id)
    {
        $message = Message::withTrashed()->find($id);

        if (!$message) {
            abort(404, 'Not Found');
        }
        $message->forceDelete();
        return redirect()->route('admin.messages.index')->with('success', 'Messaggio cancellato con successso');
    }
}
