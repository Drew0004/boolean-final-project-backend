<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Form Request
use App\Http\Requests\StoreReviewRequest as ReviewStoreRequest;

//Models
use App\Models\Review;


class ReviewController extends Controller
{
    public function store(ReviewStoreRequest $request){

        $reviewData = $request->validated();
        $review = Review::create([
            'user_id' => $reviewData['user_id'],
            'firstname' => $reviewData['firstname'],
            'lastname' => $reviewData['lastname'],
            'description' => $reviewData['description'],
        ]);


        return response()->json([
            'success'=> true,
            'message'=> 'Recensione salvata con successo',
        ]);
    }
}
