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
        return view('admin.ports.index')->withPorts($ports->paginate(env('PERPAGE')));
    }

    /**
     * Filter used ports.
     */
    public function getIndexUsed()
    {
        $ports = new Ports;
        return view('admin.ports.index')->withPorts($ports->where('user_id', '<>', '0')->paginate(env('PERPAGE')));
    }

    /**
     * Filter empty ports
     */
    public function getIndexEmpty()
    {
        $ports = new Ports;
        return view('admin.ports.index')->withPorts($ports->where('user_id', '==', '0')->paginate(env('PERPAGE')));
    }

    /**
     * Display ports adding page.
     */
    public function getAddPorts()
    {
        return view('admin.ports.add');
    }

    /**
     * Save ports.
     */
    public function postAddPorts()
    {
    }

}
