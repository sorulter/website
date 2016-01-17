<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    /**
     * Display settings index.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        return view('user.settings.index');
    }
}
