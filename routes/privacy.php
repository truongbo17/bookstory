<?php

use Illuminate\Support\Facades\Route;

Route::prefix('privacy')->middleware('locale')->group(function () {
    Route::get('/', function () {
        return view('privacy.index');
    })->name('privacy.index');
});
