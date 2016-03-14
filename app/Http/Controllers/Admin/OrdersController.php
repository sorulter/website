<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Order;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = new Order;
        return view('admin.orders.index')->withOrders($orders->orderBy('id', 'DESC')->paginate(env('PERPAGE')));
    }

}
