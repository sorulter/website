<?php

namespace app\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Model\Flows;
use App\Model\Order;
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
        $hasCombo = Flows::where('user_id', '=', request()->user()->id)
            ->where('combo', '>', 0)
            ->where('combo_end_date', '>', date('Y-m-d'))
            ->first();
        $count = Order::where('created_at', '>', date('Y-m'))->where('user_id', '=', request()->user()->id)->count();

        return view('user.mall.index')->withTitle(trans('mall.title'))
            ->withCount($count)
            ->withHasCombo($hasCombo)
            ->withExtras($products->where('type', '=', 'extra')->orderBy('price', 'DESC')->get())
            ->withForevers($products->where('type', '=', 'forever')->orderBy('price', 'DESC')->get())
            ->withCombos($products->where('type', '=', 'combo')->orderBy('price', 'DESC')->get());
    }

    public function payment()
    {
        $this->validate(request(), [
            'product' => 'exists:products,id',
            'index' => 'required|in:0,1,2,3,4,5,6,7,8,9,10,11',
            'payment' => 'required|in:alipay',
        ]);

        $discount = 0;
        $input = request()->all();
        $product = Products::find($input['product']);
        if ($product->type !== 'combo') {
            $this->validate(request(), [
                'index' => 'required|in:0,1,2,3,4,5,6,7,8',
            ]);
        }

        if (Order::where('created_at', '>', date('Y-m'))
            ->where('user_id', '=', request()->user()->id)
            ->count() >= env('ORDERS_LIMIT_PER_MONTH')) {
            return view('pub.redirect')
                ->withTitle(trans('base.tips'))
                ->withContent(trans('mall.orders_limit_per_month', ['limit' => env('ORDERS_LIMIT_PER_MONTH')]))
                ->withType('warning')
                ->withTime(10)
                ->withTo(route('user/mall'));
        }

        $fee_rate = 0.01;
        $unit_price = $product->price;
        $fee = ($input['index'] + 1) * $unit_price * $fee_rate;
        $orig = ($input['index'] + 1) * $unit_price + $fee;

        if ($input['payment'] == 'alipay') {
            $discount = $discount + $fee;
        }

        $amount = $orig - $discount;

        $order = new Order();
        $order->user_id = request()->user()->id;
        $order->order_id = date("Ymd-His") . '-' . substr((string) microtime(), 2, 6);
        $order->state = 'ORDER_CREATED';
        $order->amount = $amount;
        $order->quantity = $input['index'] + 1;
        $order->original = $orig;
        $order->discount = $discount;
        $order->product_id = $product->id;
        $order->unit_price = $product->price;
        $order->flows_type = $product->type;
        $order->flows_amount = $product->amount;
    }
}
