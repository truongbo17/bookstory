<?php

use App\Http\Controllers\Search\SearchController;
use Illuminate\Support\Facades\Route;

Route::get('search', [SearchController::class, 'search'])->middleware('locale')->name('search');
