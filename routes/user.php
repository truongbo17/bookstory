<?php

use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->middleware(['auth', 'auth.active'])->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('user.dashbroad_index');
    Route::get('profile', [UserController::class, 'profile'])->name('user.profile');
    Route::get('edit', [UserController::class, 'edit'])->name('user.dashbroad_edit');
    Route::post('update', [UserController::class, 'update'])->name('user.dashbroad_update');
    Route::post('deactive', [UserController::class, 'deactive'])->name('user.deactive');
});


Route::prefix('user')->middleware(['auth', 'auth.active'])->group(function () {
    Route::get('document', [UserController::class, 'listDocument'])->name('user.document.list');
    Route::get('document/add', [UserController::class, 'addDocument'])->name('user.document.add');
    Route::post('document/store', [UserController::class, 'storeDocument'])->name('user.document.store');
});
