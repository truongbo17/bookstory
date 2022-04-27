<?php

namespace App\Http\Middleware;

use App\Crawler\Enum\UserStatus;
use Closure;
use Illuminate\Http\Request;

class CheckActiveUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
//        if(auth()->user()->status != UserStatus::ACTIVE){
//            return redirect('login');
//        }
        return $next($request);
    }
}
