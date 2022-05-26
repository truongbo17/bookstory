<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
//        if (env('PORT_SERVER')) {
//            $port_server = env('PORT_SERVER');
//            $request->url = str_replace(":$port_server", "", $request->url());
//        }

        return $next($request);
    }
}
