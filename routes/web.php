<?php

use App\Http\Controllers\Document\DocumentController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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

//TEST
Route::get('test', [TestController::class, 'test']);
Route::get('pdftoimage', [TestController::class, 'pdftoimage']);
Route::get('downloadpdf', [TestController::class, 'downloadpdf']);
Route::get('viewpdf', [TestController::class, 'viewpdf']);
Route::get('crawl', [TestController::class, 'crawl']);

//Crawl data from Pesthubt
Route::get('pest', function () {
    return view('pdf.pest');
});

//Temp URL
Route::get('doc', [DocumentController::class, 'handle'])->name('document.handle');
