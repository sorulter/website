<?php

namespace app\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Route;
use View;

define('MB', 1000000);
define('GB', 1000 * MB);

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        if (!app()->runningInConsole()) {
            list(, $action) = explode('@', Route::getCurrentRoute()->getActionName());
            View::share('action', $action);

            // share user info to global
            if (request()->user() != null) {
                if (request()->user()->activate == -1) {
                    exit(view("pub.msg")->withType('danger')->withTitle(trans("base.blocked"))->withContent(trans("base.break_the_eual")));
                }
                if (request()->user()->activate == -2) {
                    exit(view("pub.msg")->withType('danger')->withTitle(trans("base.paused"))->withContent(trans("base.how_to_recovery", ['url' => env('QQ_QUN_URL'), 'no' => env('QQ_QUN_NO')])));
                }
                View::share('user', request()->user());
            }
        }
    }
}
