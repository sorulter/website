<?php

namespace App\Http\Controllers\User;

use Agent;
use App\Http\Controllers\Controller;
use Debugbar;
use View;

class CellularController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!(Agent::is('iPhone') && Agent::is('Safari'))) {
            return abort(404);
        }
    }

    /**
     * Display a listing of the cellular type.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        return view('user.cellular.index');
    }

    /**
     * Generate mobileconfig
     *
     */
    public function getConfig($net)
    {
        Debugbar::disable();
        $data = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n" .
        (string) View::make('user.cellular.apn');

        return response($data)
            ->header('Content-Type', 'application/x-apple-aspen-config');
    }
}
