<?php

namespace App\Http\Controllers\User;

use App;
use App\Http\Controllers\Controller;
use App\Model\LogsA;
use App\Model\LogsB;
use App\Model\LogsC;
use App\Model\LogsD;
use App\Model\LogsE;

class LogsController extends Controller
{
    /**
     * Display a listing of the logs.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = request()->user();
        switch (App\logshash($user->id)) {
            case 'a':
                $logs = new LogsA;
                break;

            case 'b':
                $logs = new LogsB;
                break;

            case 'c':
                $logs = new LogsC;
                break;

            case 'd':
                $logs = new LogsD;
                break;

            case 'e':
                $logs = new LogsE;
                break;
        }
        return view('user.logs.index')->withLogs($logs->where("user_id", "=", request()->user()->id)->paginate(env('PERPAGE')));
        dd($logs);
    }

}
