<?php

use App\Http\Controllers\Document\DocumentController;
use Illuminate\Support\Facades\Route;

Route::prefix('documents')->group(function () {
    Route::get('/', [DocumentController::class, 'list'])->name('document.list_index');
    Route::get('{document_slug}', [DocumentController::class, 'showDetail'])->name('document.show_detail');
    Route::get('download/{document_id}', [DocumentController::class, 'download'])->name('document.detail_download')->middleware('auth');
});
