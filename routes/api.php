<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Controllers
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\VoteController;




/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::name('api.')->group(function() {
    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });


    Route::resource('users', UserController::class)->only([
        'index',
        'show',
    ]);

    Route::resource('roles', RoleController::class)->only([
        'index',
    ]);

    /* Route::get('users/search/{name}', [UserController::class, 'search']); */
    Route::get('users/search', [UserController::class, 'search']);

    Route::get('/sponsor', [UserController::class, 'sponsor']);

    // Rotta store messaggi
    Route::post('/messages',[MessageController::class, 'store'])->name('messages.store');
    // Rotta store reviews
    Route::post('/reviews',[ReviewController::class, 'store'])->name('reviews.store');
    // Rotta store votes
    Route::post('/votes',[VoteController::class, 'store'])->name('votes.store');

});


