<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Accès refusé.'], 403);
            }
            return redirect()->route('dashboard')->with('error', 'Accès réservé aux administrateurs.');
        }

        return $next($request);
    }
}
