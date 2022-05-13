<?php

namespace App\Http\Middleware;

use App\Crawler\Enum\UserStatus;
use Auth;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Session;

class CheckActiveUser
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
        if (auth()->user()->status != UserStatus::ACTIVE) {
            Session::flush();
            Auth::logout();

            return redirect('login');
        }
        return $next($request);
    }
}
