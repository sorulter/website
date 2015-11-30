<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Route;
use Session;
use View;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        // global variables of view
        View::share('user', Session::get('user'));
        if (Route::getCurrentRoute()) {
            list(, $action) = explode('@', Route::getCurrentRoute()->getActionName());
            View::share('action', $action);
        }
    }

}
