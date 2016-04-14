<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Track;
use Carbon\Carbon;

class TracksController extends Controller
{
    /**
     * Display a listing of the tracks.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tracks = new Track;
        return view('admin.tracks.index')->withTracks($tracks->orderBy('id', 'DESC')->paginate(env('PERPAGE')));
    }

    public function today()
    {
        $tracks = new Track;
        return view('admin.tracks.index')->withTracks($tracks->where('day', '=', Carbon::now()->toDateString())->orderBy('id', 'DESC')->paginate(env('PERPAGE')));
    }

}
