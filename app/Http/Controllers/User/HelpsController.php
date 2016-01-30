<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Model\Articles;

class HelpsController extends Controller
{
    /**
     * Display a listing of the helps.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $helps = new Articles;
        return view('user.helps.index')->withHelps($helps->where('category_id', '=', env('HELPS_CAT_ID'))->paginate(env('PERPAGE')));

    }

    /**
     * Display the specified help.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $help = Articles::find($id);
        return view('user.helps.show')->withHelp($help);
    }

}
