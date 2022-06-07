<?php

use Illuminate\Support\Facades\Route;

Route::prefix('authors')->middleware('locale')->group(function () {
    Route::get('/', [\App\Http\Controllers\Author\AuthorController::class, 'list'])->name('author.list_index');
    Route::get('{author_id}', [\App\Http\Controllers\Author\AuthorController::class, 'showDetail'])->name('author.show_detail');
});
