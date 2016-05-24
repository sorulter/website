<?php

namespace app\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Model\Order;
use Input;
use Log;
use Omnipay;

class CallbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function alipayV2()
    {
        Log::info('callback.alipay.v2', ['url' => request()->url(), 'input' => request()->input()]);

        config()->set('laravel-omnipay.gateways.alipay.driver', 'Alipay_SendGoods');
        $gateway = Omnipay::gateway();
        $order_id = Input::get('out_trade_no');
        $trade_no = $request->input('trade_no');
        $trade_status = Input::get('trade_status');
        $buyer_email = $request->input('buyer_email');
        $order = Order::where('order_id', '=', $order_id)->first();

        if (!$order) {
            Log::error('callback.alipay.v2 not found order.', ['order_id' => $order_id,
                'trade_no' => $trade_no, 'buyer_email' => $buyer_email,
            ]);
            return;
        }

        // 1. update to WAIT_BUYER_PAY.
        if ($trade_status == 'WAIT_BUYER_PAY' and $order->state == 'ORDER_CREATED') {
            Order::where('order_id', '=', $order_id)->update(['state' => 'WAIT_BUYER_PAY',
                'trade_no' => $trade_no, 'buyer_email' => $buyer_email,
            ]);
            return 'success';
        }
    }
}
