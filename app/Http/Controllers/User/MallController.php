<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class MallController extends Controller
{
    /**
     * Display a listing of the product types.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.mall.index')->withTitle(trans('mall.title'));
    }
}
