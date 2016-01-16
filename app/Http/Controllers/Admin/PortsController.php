<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Ports;

class PortsController extends Controller
{
    /**
     * Display a listing of the ports.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $ports = new Ports;
        return view('admin.ports.index')->withPorts($ports->paginate(2));
    }

}
