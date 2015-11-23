<?php

namespace App\Http\Middleware;

use App\Model\User;
use Closure;
use Cookie;
use Session;

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
        (new User)->loginByRememberMeToken(Cookie::get('rememberme_token'));

        // check login status.
        if (!Session::get('user')) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('/login');
            }
        }

        // check user is activate
        if (!Session::get('user.activate') && !in_array($request->path(), ['user/activate', 'user/activate/resent'])) {
            return redirect('/user/activate');
        }
        return $next($request);
    }
}
