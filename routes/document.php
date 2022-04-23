<?php

use Illuminate\Support\Facades\Route;

Route::prefix('document')->group(function () {
    Route::get('{document_slug}', [\App\Http\Controllers\Document\DocumentController::class, 'show'])->name('document.show_detail');
});
