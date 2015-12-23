<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Model\Order;

class BillingController extends Controller
{
    /**
     * Display index of the billing.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        // get user's order.
        $order = new Order;
        return view('user.billing.index')->withOrders($order->where("user_id", "=", request()->user()->id)->paginate(2));
    }

    /**
     * Display charge page
     *
     * @return \Illuminate\Http\Response
     */
    public function getCharge()
    {
        return view('user.billing.charge');
    }

}
