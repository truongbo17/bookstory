<?php

use Illuminate\Support\Facades\Route;

Route::prefix('privacy')->group(function () {
    Route::get('/', function () {
        return view('privacy.index');
    })->name('privacy.index');
});
