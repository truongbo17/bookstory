<?php

namespace App\Providers;

use Config;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Storage;
use Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // \URL::forceRootUrl(Config::get('app.url'));

        // if (Str::contains(Config::get('app.url'), 'https://')) {
        //     \URL::forceScheme('https');
        // }

        Storage::disk(config('crawl.pdf_disk'))->buildTemporaryUrlsUsing(function ($path, $expiration, $options) {
            return URL::temporarySignedRoute(
                'document.handle',
                $expiration,
                array_merge($options, ['path' => $path])
            );
        });
    }
}
