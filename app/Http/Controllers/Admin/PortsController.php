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
        $this->validate(request(), [
            'name' => 'required',
            'min' => 'different:max|numeric|min:1000|max:60000',
            'max' => 'different:min|numeric|min:1000|max:60000',
        ]);
        $input = request()->input();
        $data = [];
        for ($i = $input['min']; $i <= $input['max']; $i++) {
            if (Ports::where('node_name', '=', $input['name'])->where('port', '=', $i)->first() == null) {
                $data[] = ['node_name' => $input['name'], 'port' => $i];
            }
        }

        if (Ports::insert($data)) {
            return redirect()->back()->withMsg('Add ports success.');
        } else {
            return redirect()->back()->withMsg('Add ports failed.');
        }

    }

}
