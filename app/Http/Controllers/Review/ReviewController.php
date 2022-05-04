<?php

namespace App\Http\Controllers\Review;

use App\Http\Controllers\Controller;
use App\Http\Requests\SendReviewRequest;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function send(Request $request)
    {
        if (Review::create($request->all())) {
            return redirect(url()->previous() . '#success')->with('success', 'Thank you for your review !');
        }
    }
}
