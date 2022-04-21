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
    \App\Models\User::truncate();
    \App\Models\Keyword::truncate();
    \DB::table('document_user')->truncate();
    \DB::table('document_keyword')->truncate();

    \App\Models\User::create([
        'name' => 'Nguyen Quang Truong',
        'email' => 'truongnq017@gmail.com',
        'password' => \Illuminate\Support\Facades\Hash::make('12345678'),
        'is_admin' => 1
    ]);
});

Route::get('test', [\App\Http\Controllers\TestController::class, 'test']);
