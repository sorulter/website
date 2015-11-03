<?php

namespace App\Http\Middleware;

use Closure;
use Cookie;
use Session;
use SSDB;

class Auth
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
        // check remember me token.
        $rememberme_token = Cookie::get('rememberme_token');
        if ($rememberme_token) {
            $db = config('database.ssdb.default');
            $ssdb = new SSDB\Client($db['host'], $db['port']);
            $res = $ssdb->get('proxier.rememberme_token.' . $rememberme_token);
            if ($res->data) {
                Session::put('user', ['username' => $res->data, 'login' => true]);
            }
        }
        // check login status.
        if (!Session::get('user')) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('/login');
            }
        }
        return $next($request);
    }
}
