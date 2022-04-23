<?php

use Illuminate\Support\Facades\Route;

Route::prefix('contact')->group(function (){
    Route::get('/',[\App\Http\Controllers\Contact\ContactController::class,'create'])->name('contact.create');
    Route::post('send',[\App\Http\Controllers\Contact\ContactController::class,'send'])->name('contact.send');
});
