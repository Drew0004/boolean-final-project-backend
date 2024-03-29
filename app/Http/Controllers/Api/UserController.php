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
        // Da aggiungere i ruoli
        $users = User::with('userDetails')->paginate(5);
        // $users = User::paginate(4);

        return response()->json([
            'success' => true,
            'results' => $users,
        ]);
    }

    public function show(User $user)
    {
        $user = User::with('userDetails', 'roles')->firstOrFail();

        return response()->json([
            'success' => true,
            'results' => $user,
        ]);
    }
}
