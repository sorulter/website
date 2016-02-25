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
        // Forbidden user to read that not activate.
        if (request()->user()->activate == 0) {
            return view('pub.redirect')->withType('danger')
                ->withTo('/user')
                ->withTime(5)
                ->withTitle('Notice!')
                ->withContent('Please activate your account first.');
        }

        $help = Articles::find($id);
        return view('user.helps.show')->withHelp($help);
    }

}
