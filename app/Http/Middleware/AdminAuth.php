<?php

namespace App\Http\Middleware;

use Closure;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Verify the user's id, if not in the array, arbort.
        if (!in_array($request->user()->id, mb_split(',', env('ADMINIDS')))) {
            app()->abort(404);
        }

        return $next($request);
    }
}
