<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'utilisateur') {
            return $next($request);
        }

        return redirect('/')->with('error', 'Accès réservé aux utilisateurs');
    }
}