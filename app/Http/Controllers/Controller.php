<?php

namespace App\Http\Controllers;

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
                View::share('user', request()->user());
            }
        }
    }

}
