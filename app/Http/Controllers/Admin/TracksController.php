<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Track;

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

}
