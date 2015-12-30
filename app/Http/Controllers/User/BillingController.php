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
        $order = Order::where('state', '=', 'obligation')->first();

        return view('user.billing.charge')->withOrder($order);
    }

    /**
     * Charge
     */
    public function postCharge()
    {
        if (!in_array(request()->input('amount'),
            ['1', '10', '20', '30', '50', '100', '200', '300', '500', '1000']
        )) {
            return view('pub.redirect')
                ->withType('warning')->withTitle('Ellegal request!')
                ->withContent('')->withTo('')->withTime(3);
        }

        // Create order
        $order = new Order;
        if ($order->order(request()->input('amount'), request()->user()->id)) {
            session()->set('order', $order);
            return redirect('user/billing/payment');
        } else {
            return view('pub.redirect')
                ->withType('warning')->withTitle('Create order failed!')
                ->withContent('')->withTo('')->withTime(3);
        }

    }

    /**
     * Display payment page.
     */
    public function getPayment()
    {
        $order = session()->get('order');
        // Check order
        if ($order == null) {
            return view('pub.redirect')
                ->withType('warning')->withTitle('Ellegal order!')
                ->withContent('')->withTo('/user/billing/charge')->withTime(3);
        }

    }

    /**
     * Continue to pay
     */
    public function getContinue($order_id)
    {
        $order = Order::where('order_id', '=', $order_id)->find(1);
        if ($order == null) {
            return view('pub.redirect')
                ->withType('warning')->withTitle('Ellegal order!')
                ->withContent('')->withTo('/user/billing/charge')->withTime(3);
        }

        session()->set('order', $order);
        return redirect('user/billing/payment');
    }

}
