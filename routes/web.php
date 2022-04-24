<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Auth::routes();

Route::get('/',[\App\Http\Controllers\Home\HomeController::class,'index'])->name('home.index');

Route::get('fix', function () {
    \App\Models\CrawlUrl::truncate();
    \App\Models\Document::truncate();
    \App\Models\User::truncate();
    \App\Models\Keyword::truncate();
    \App\Models\Category::truncate();

    \DB::table('document_user')->truncate();
    \DB::table('document_keyword')->truncate();
    \DB::table('document_category')->truncate();

    \App\Models\User::create([
        'name' => 'Nguyen Quang Truong',
        'email' => 'truongnq017@gmail.com',
        'password' => \Illuminate\Support\Facades\Hash::make('12345678'),
        'is_admin' => 1
    ]);
});

//TEST
Route::get('test', [\App\Http\Controllers\TestController::class, 'test']);
Route::get('pdftoimage', [\App\Http\Controllers\TestController::class, 'pdftoimage']);
Route::get('downloadpdf', [\App\Http\Controllers\TestController::class, 'downloadpdf']);
Route::get('viewpdf', [\App\Http\Controllers\TestController::class, 'viewpdf']);
