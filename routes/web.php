<?php

use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Test\PestHubtController;
use App\Http\Controllers\TestController;
use App\Models\Category;
use App\Models\CrawlUrl;
use App\Models\Document;
use App\Models\Keyword;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
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

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::get('fix', function () {
    CrawlUrl::truncate();
    Document::truncate();
    User::truncate();
    Keyword::truncate();
    Category::truncate();

    DB::table('document_user')->truncate();
    DB::table('document_keyword')->truncate();
    DB::table('document_category')->truncate();

    User::create([
        'name' => 'Nguyen Quang Truong',
        'email' => 'truongnq017@gmail.com',
        'password' => Hash::make('12345678'),
        'is_admin' => 1
    ]);
});

//TEST
Route::get('test', [TestController::class, 'test']);
Route::get('pdftoimage', [TestController::class, 'pdftoimage']);
Route::get('downloadpdf', [TestController::class, 'downloadpdf']);
Route::get('viewpdf', [TestController::class, 'viewpdf']);

//Crawl data from Pesthubt
Route::get('pest', [PestHubtController::class, 'pesthubt']);
