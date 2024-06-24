<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LastUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (
            auth()->check()
            && cache()->add('users.online.' . auth()->user()->id, true, now()->addSeconds(60))
        ) {
            auth()->user()->last_seen_at = now();
            auth()->user()->save();
        }
        return $next($request);
    }
}
