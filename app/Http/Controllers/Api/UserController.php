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
        $users = User::with('userDetails', 'roles', 'votes', 'messages')->paginate(5);
        // $users = User::paginate(4);

        return response()->json([
            'success' => true,
            'results' => $users,
        ]);
    }

    public function show(User $user)
    {
        $user = User::with('userDetails', 'roles', 'votes', 'messages')->firstOrFail();

        return response()->json([
            'success' => true,
            'results' => $user,
        ]);
    }
}
