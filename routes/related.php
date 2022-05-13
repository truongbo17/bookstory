<?php

use App\Http\Controllers\Document\RelatedDocument;
use Illuminate\Support\Facades\Route;

Route::prefix('related')->middleware('locale')->group(function () {
    Route::get('{related_slug}', [RelatedDocument::class, 'showDetail'])->name('related.show_detail');
});
