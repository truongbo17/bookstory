<?php

use Illuminate\Support\Facades\Route;

Route::prefix('review')->middleware('locale')->group(function () {
    Route::post('send', [\App\Http\Controllers\Review\ReviewController::class, 'send'])->name('review.send');
});
