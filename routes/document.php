<?php

use Illuminate\Support\Facades\Route;

Route::prefix('documents')->group(function () {
    Route::get('/', [\App\Http\Controllers\Document\DocumentController::class, 'list'])->name('document.list_index');
    Route::get('{document_slug}', [\App\Http\Controllers\Document\DocumentController::class, 'showDetail'])->name('document.show_detail');
    Route::get('download/{document_id}', [\App\Http\Controllers\Document\DocumentController::class, 'download'])->name('document.detail_download');
});
