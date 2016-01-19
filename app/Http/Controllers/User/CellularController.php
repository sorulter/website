<?php

namespace App\Http\Controllers\User;

use Agent;
use App\Http\Controllers\Controller;

class CellularController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!(Agent::is('iPhone') && Agent::is('Safari'))) {
            return abort(404);
        }
    }
}
