<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home.index');
});

Route::get('fix', function () {
    \App\Models\CrawlUrl::truncate();
    \App\Models\Document::truncate();
    \DB::table('document_user')->truncate();
});

Route::get('test', [\App\Http\Controllers\TestController::class, 'test']);
