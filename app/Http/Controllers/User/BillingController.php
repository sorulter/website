<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Model\Flows;
use App\Model\Order;
use GuzzleHttp\Client;
use Input;
use Omnipay;
use Parser;

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
        return view('user.billing.index')->withOrders($order->where("user_id", "=", request()->user()->id)->paginate(env('PERPAGE')));
    }

    /**
     * Display charge page
     *
     * @return \Illuminate\Http\Response
     */
    public function getCharge()
    {
        $order = Order::where('state', '=', 'ORDER_CREATED')->where('user_id', '=', request()->user()->id)->first();

        return view('user.billing.charge')->withOrder($order);
    }

    /**
     * Charge
     */
    public function postCharge()
    {
        if (!in_array(request()->input('amount'),
            ['0.01', '9', '10', '27', '30', '55', '80', '100', '300', '500', '1000']
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

        $gateway = Omnipay::gateway();
        $options = [
            'out_trade_no' => $order->order_id,
            'subject' => 'iProxier charge ' . $order->amount . ' RMB.',
            'price' => $order->amount,
            'quantity' => 1,
            'payment_type' => '1',
            'logistics_fee' => '0.00',
            'logistics_type' => 'EXPRESS',
            'logistics_payment' => 'BUYER_PAY_AFTER_RECEIVE',
            'receive_name' => 'user@iProxier',
            'receive_address' => 'user@iProxier',

        ];
        $gateway->setKey(env('ALIPAY_KEY'));

        $response = $gateway->purchase($options)->send();
        $response->redirect();

    }

    /**
     * Continue to pay
     */
    public function getContinue($order_id)
    {
        $order = Order::where('order_id', '=', $order_id)->first();
        if ($order == null) {
            return view('pub.redirect')
                ->withType('warning')->withTitle('Ellegal order(1)!')
                ->withContent('')->withTo('/user/billing/charge')->withTime(3);
        }

        session()->put('order', $order);
        return redirect('user/billing/payment');
    }

    public function result()
    {
        config()->set('laravel-omnipay.gateways.alipay.driver', 'Alipay_SendGoods');
        $gateway = Omnipay::gateway();

        $trade_status = Input::get('trade_status');
        $order_id = Input::get('out_trade_no');

        $order = Order::where('order_id', '=', $order_id)->first();
        // dd($order);

        // 1.
        if ($trade_status == 'WAIT_BUYER_PAY') {
            if ($order->state == 'ORDER_CREATED') {
                Order::where('order_id', '=', $order_id)->update(['state' => 'WAIT_BUYER_PAY']);
            }
            return 'success';
        }

        // 2. Auto send goods
        if ($trade_status == 'WAIT_SELLER_SEND_GOODS') {
            if ($order->state == 'WAIT_BUYER_PAY') {
                Order::where('order_id', '=', $order_id)->update(['state' => 'WAIT_SELLER_SEND_GOODS']);
            }

            $options = [
                'trade_no' => Input::get('trade_no'),
                'logistics_name' => 'NotNeed',
                'create_transport_type' => 'EXPRESS',
            ];
            $gateway->setKey('im0wj61hn550wqzou577aa8sny353u2c');
            $response = $gateway->purchase($options)->send();

            $client = new Client();
            $resp = $client->get($response->getRedirectUrl());
            $body = Parser::xml($resp->getBody()->getContents());

            // For alipay notify.
            if (request()->method() == 'POST') {
                return 'success';
            }

            // For user.
            return redirect('https://lab.alipay.com/consume/queryTradeDetail.htm?actionName=CONFIRM_GOODS&tradeNo=' . Input::get('trade_no'));
        }

        // 3.
        if ($trade_status == 'WAIT_BUYER_CONFIRM_GOODS') {
            if ($order->state == 'WAIT_SELLER_SEND_GOODS') {
                Order::where('order_id', '=', $order_id)->update(['state' => 'WAIT_BUYER_CONFIRM_GOODS']);
            }

            // For alipay notify.
            if (request()->method() == 'POST') {
                return 'success';
            }

            // For user.
            return redirect('https://lab.alipay.com/consume/queryTradeDetail.htm?actionName=CONFIRM_GOODS&tradeNo=' . Input::get('trade_no'));
        }

        // 4.
        if ($trade_status == 'TRADE_FINISHED') {
            if ($order->state == 'WAIT_BUYER_CONFIRM_GOODS') {
                $flows = Flows::find($order->user_id);

                switch ($order->amount) {

                    // forever flows
                    case '10.00':
                        $flows->increment('forever', 1 * GB);
                        break;

                    case '55.00':
                        $flows->increment('forever', 6 * GB);
                        break;

                    case '100.00':
                        $flows->increment('forever', 12 * GB);
                        break;

                    case '500.00':
                        $flows->increment('forever', 60 * GB);
                        break;

                    case '1000.00':
                        $flows->increment('forever', 120 * GB);
                        break;

                    // combo flows
                    case '9.00':
                        $flows->ComboFlowsCharge(4.5 * GB, 1);
                        break;

                    case '27.00':
                        $flows->ComboFlowsCharge(4.5 * GB, 3);
                        break;

                    case '30.00':
                        $flows->ComboFlowsCharge(15 * GB, 1);
                        break;

                    case '80.00':
                        $flows->ComboFlowsCharge(15 * GB, 3);
                        break;

                    case '300.00':
                        $flows->ComboFlowsCharge(15 * GB, 12);
                        break;
                }

                Order::where('order_id', '=', $order_id)->update(['state' => 'TRADE_FINISHED']);
            }

            return 'success';
        }

        return abort(404);

    }

}
