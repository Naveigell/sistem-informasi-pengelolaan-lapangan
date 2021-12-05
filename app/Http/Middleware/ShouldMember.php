<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ShouldMember
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param mixed ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!auth('member')->check()) {
            abort(404);
        }

        return $next($request);
    }
}
