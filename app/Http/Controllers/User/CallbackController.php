<?php

namespace app\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Model\Order;
use GuzzleHttp\Client;
use Input;
use Log;
use Omnipay;
use Parser;

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

        // 2. Auto send goods
        if ($trade_status == 'WAIT_SELLER_SEND_GOODS' && $order->state == 'WAIT_BUYER_PAY') {
            Order::where('order_id', '=', $order_id)->update(['state' => 'WAIT_SELLER_SEND_GOODS',
                'trade_no' => $trade_no, 'buyer_email' => $buyer_email,
            ]);

            $options = [
                'trade_no' => $trade_no,
                'logistics_name' => 'NotNeed',
                'create_transport_type' => 'EXPRESS',
            ];
            $gateway->setKey(env('ALIPAY_KEY'));
            $response = $gateway->purchase($options)->send();

            $client = new Client();
            $resp = $client->get($response->getRedirectUrl());
            $body = Parser::xml($resp->getBody()->getContents());

            // For alipay notify.
            if (request()->method() == 'POST') {
                Log::info('callback.alipay.v2 auto send goods.');
                return 'success';
            }

            // For user.
            return redirect('https://lab.alipay.com/consume/queryTradeDetail.htm?actionName=CONFIRM_GOODS&tradeNo=' . $trade_no);
        }
    }
}
