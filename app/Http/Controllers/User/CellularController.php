<?php

namespace App\Http\Controllers\User;

use Agent;
use App\Http\Controllers\Controller;
use Debugbar;
use Uuid;
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
        $ApnUUID = Uuid::generate();
        $ConfigUUID = Uuid::generate();
        $data = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n" .
        View::make('user.cellular.apn')
            ->with('apnUUID', $ApnUUID)
            ->with('configUUID', $ConfigUUID)
            ->render();

        return response($data)
            ->header('Content-Type', 'application/x-apple-aspen-config');
    }
}
