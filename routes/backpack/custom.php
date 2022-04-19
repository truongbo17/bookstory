<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('crawl-url', 'CrawlUrlCrudController');
    Route::crud('url', 'UrlCrudController');
    Route::crud('document', 'DocumentCrudController');
    Route::crud('category', 'CategoryCrudController');
    Route::crud('keyword', 'KeywordCrudController');
    Route::crud('news', 'NewsCrudController');
    Route::crud('user', 'UserCrudController');
    Route::post('url/{id}/update_status_url', 'UrlCrudController@updateStatus');
}); // this should be the absolute last line of this file
