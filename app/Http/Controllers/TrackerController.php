<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class TrackerController extends Controller
{
    /**
     * Log ad source name and redirect to register page.
     *
     * @return \Illuminate\Http\Response
     */
    public function ad($name)
    {
        session(['ad_source' => $name]);

        return redirect()->route('register');
    }

}
