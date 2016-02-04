<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Flows;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $topUsed = Flows::orderBy('used', 'desc')->limit(env('TOPNUM'))->get();
        return view('admin.home')
            ->withTopUsed($topUsed);
    }

}
