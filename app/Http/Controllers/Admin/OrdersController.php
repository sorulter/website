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

    /**
     * Display a listing of paid orders.
     *
     * @return \Illuminate\Http\Response
     */
    public function paid()
    {
        $orders = new Order;
        return view('admin.orders.index')->withOrders($orders->where('amount', '>', 0)->where('state', '=', 'TRADE_FINISHED')->orderBy('id', 'DESC')->paginate(env('PERPAGE')));
    }

    /**
     * Display a listing of unpaid orders.
     *
     * @return \Illuminate\Http\Response
     */
    public function unpaid()
    {
        $orders = new Order;
        return view('admin.orders.index')->withOrders($orders->where('amount', '>', 0)->where('state', '!=', 'TRADE_FINISHED')->orderBy('id', 'DESC')->paginate(env('PERPAGE')));
    }

}
