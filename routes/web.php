<?php

use App\Http\Controllers\PestHubt\DownloadDocument;
use App\Http\Controllers\Api\PdfToImage;
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

Route::middleware('locale')->get('/', [HomeController::class, 'index'])->name('home.index');

//TEST
Route::get('test', [TestController::class, 'test']);
Route::get('pdftoimage', [TestController::class, 'pdftoimage']);
Route::get('downloadpdf', [TestController::class, 'downloadpdf']);
Route::get('viewpdf', [TestController::class, 'viewpdf']);
Route::get('crawl', [TestController::class, 'crawl']);
Route::get('pdf', [PdfToImage::class, 'pdfToImage']);

//Crawl data from Pesthubt
Route::get('pest', function () {
    return view('pdf.pest');
});

Route::middleware('locale')->group(function () {
    //Temp URL
    Route::get('doc', [DocumentController::class, 'handle'])->middleware(['signed_route'])->name('document.handle');

    //Change Language
    Route::get('change-language/{language}', [HomeController::class, 'changeLanguage'])->name('user.change-language');
});

Route::get('download-pesthubt', [DownloadDocument::class, 'download'])->name('pesthubt.download');
