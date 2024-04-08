<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        // Da aggiungere le sponsor
        $users = User::with('userDetails', 'roles', 'votes', 'messages', 'reviews')->paginate(8);
        // $users = User::paginate(4);
        

        return response()->json([
            'success' => true,
            'results' => $users,
        ]);
    }

    public function show(string $name)
    {
        // Trova l'utente con i dettagli, i ruoli, i voti e i messaggi
        // $user = User::with('userDetails', 'roles', 'votes', 'messages')->findOrFail($name);
        $user = User::where('name', $name)->with('userDetails', 'roles', 'votes', 'messages','reviews')->firstOrFail();

        return response()->json([
            'success' => true,
            'result' => $user,
        ]);
    }

    /* public function search(Request $request)
    {

        $name = $request->input('name');
        //PROVA DI UNA QUERY http://127.0.0.1:8000/api/users/search/Cilino
        // Trova l'utente con i dettagli, i ruoli, i voti e i messaggi
        $user = User::where('name', 'like', '%'.$name.'%')->get();

        

        return response()->json([
            'success' => true,
            'result' => $user,
        ]);

    } */
    public function search(Request $request)
    {
        $name = $request->query('name');
        if (!empty($name)) {
            $users = User::where('name', 'like', '%'.$name.'%')->get();
            // Resto del codice rimane invariato
        } else {
            // Restituisci un errore o un messaggio appropriato
        }
    }


}
