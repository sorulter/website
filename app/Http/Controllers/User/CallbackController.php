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
        $trade_no = Input::get('trade_no');
        $trade_status = Input::get('trade_status');
        $buyer_email = Input::get('buyer_email');
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
                Log::info('callback.alipay.v2 2.notify>>auto send goods.');
                return 'success';
            }
        } elseif ($trade_status == 'WAIT_SELLER_SEND_GOODS' and request()->method() == 'GET') {
            // For user.
            Log::info('callback.alipay.v2 2.user>>redirect user to page for confirm good.');
            return redirect('https://lab.alipay.com/consume/queryTradeDetail.htm?actionName=CONFIRM_GOODS&tradeNo=' . $trade_no);
        }

        // 3. wait user confirm good.
        if ($trade_status == 'WAIT_BUYER_CONFIRM_GOODS' && $order->state == 'WAIT_SELLER_SEND_GOODS') {
            Order::where('order_id', '=', $order_id)->update(['state' => 'WAIT_BUYER_CONFIRM_GOODS',
                'trade_no' => $trade_no, 'buyer_email' => $buyer_email,
            ]);

            // For alipay notify.
            if (request()->method() == 'POST') {
                Log::info('callback.alipay.v2 3.notify>>wait user confirm good.');
                return 'success';
            }
        } elseif ($trade_status == 'WAIT_BUYER_CONFIRM_GOODS' and request()->method() == 'GET') {
            // For user.
            Log::info('callback.alipay.v2 3.user>>redirect user to page for confirm good.');
            return redirect('https://lab.alipay.com/consume/queryTradeDetail.htm?actionName=CONFIRM_GOODS&tradeNo=' . Input::get('trade_no'));
        }

        // 4.trade finished
        if ($trade_status == 'TRADE_FINISHED' && $order->state == 'WAIT_BUYER_CONFIRM_GOODS') {
            // todo

            Order::where('order_id', '=', $order_id)->update(['state' => 'TRADE_FINISHED']);
            Log::info('callback.alipay.v2 4.notify>>trade finished.');
            return 'success';
        }
        // close trade.
        if ($trade_status == 'TRADE_CLOSED') {
            Order::where('order_id', '=', $order_id)->update(['state' => 'TRADE_CLOSED']);
            Log::info('callback.alipay.v2 4.notify>>trade closed.');
            return 'success';
        }

        Log::error('error trade notify/return.');
        abort(404);
    }
}
