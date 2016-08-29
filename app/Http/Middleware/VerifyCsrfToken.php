<?php

namespace app\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
        'user/billing/result',
        'api/v1/*',
        'user/callback/*',
    ];

    public function handle($request, Closure $next)
    {
        if ($request instanceof \Dingo\Api\Http\Request) {
            return $next($request);
        }

        return $next($request);
    }
}
