<?php

namespace App\Http\Middleware;

use Closure;

class Activate
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
        if ($request->user()->activate < 1) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                switch ($request->user()->activate) {
                    case 0:
                        return view('pub.redirect')
                            ->withTo('/user')
                            ->withTime(3)
                            ->withType('warning')
                            ->withTitle(trans('base.need_activate_title'))
                            ->withContent(trans('base.need_activate'));
                        break;

                    case -1:
                        return view("pub.msg")->withType('danger')->withTitle(trans("base.blocked"))->withContent(trans("base.break_the_eual"));

                        break;
                }
            }
        }

        return $next($request);
    }
}
