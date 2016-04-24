<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Model\Products;

class MallController extends Controller
{
    /**
     * Display a listing of the product types.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = new Products;
        return view('user.mall.index')->withTitle(trans('mall.title'))
            ->withCombos($products->where('type', '=', 'combo')->orderBy('price', 'DESC')->get());
    }
}
