<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\MainController;
use App\Http\Controllers\Admin\MainController as AdminMainController;
use App\Http\Controllers\Admin\MessageController as AdminMessageController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\VoteController as AdminVoteController;






/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [MainController::class, 'index'])->name('home');

Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth')
    ->group(function () {

    Route::get('/dashboard', [AdminMainController::class, 'dashboard'])->name('dashboard');
    Route::get('/users/statistics', [AdminMainController::class, 'statistics'])->name('statistics');

    Route::resource('reviews', ReviewController::class);
    Route::resource('messages', AdminMessageController::class);
    Route::resource('votes', AdminVoteController::class);

    Route::delete('/messages/{message}/restore', [AdminMessageController::class, 'restore'])->name('messages.restore');

    Route::delete('/messages/{message}/forcedelete', [AdminMessageController::class, 'forcedelete'])->name('messages.forcedelete');

    // Rotte dell'utente
    Route::get('/users/edit', [AdminMainController::class, 'edit'])->name('edit');
    Route::put('/users/update', [AdminMainController::class, 'update'])->name('update');
    Route::get('/users/destroy', [AdminMainController::class, 'destroy'])->name('destroy');
    Route::get('/reviews', [AdminReviewController::class, 'index'])->name('reviews.index');
    Route::get('/reviews/{review}', [AdminReviewController::class, 'show'])->name('reviews.show');


});

require __DIR__.'/auth.php';
