<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    /**
     * Display user home.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        return view('user.home');
    }

    /**
     * Check account and server status.
     *
     */
    public function status()
    {
        return view('user.status');
    }

}
