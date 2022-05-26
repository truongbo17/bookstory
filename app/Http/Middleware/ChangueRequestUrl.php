<?php

namespace App\Http\Middleware;

use Config;
use Str;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use URL;

class ChangueRequestUrl
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        URL::forceRootUrl(Config::get('app.url'));

        if (Str::contains(Config::get('app.url'), 'https://')) {
            URL::forceScheme('https');
        }

        return $next($request);
    }
}
