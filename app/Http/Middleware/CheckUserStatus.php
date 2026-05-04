<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if (Auth::user()->status == 0) {
                Auth::logout();
                return redirect()
                    ->route('login')
                    ->withErrors([
                        'email' => 'Your account has been blocked.'
                    ]);
            }
        }
        return $next($request);
    }
}
