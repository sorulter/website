<?php

namespace app\Http\Controllers\User;

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
            ->withForevers($products->where('type', '=', 'forever')->orderBy('price', 'DESC')->get())
            ->withCombos($products->where('type', '=', 'combo')->orderBy('price', 'DESC')->get());
    }

    public function payment()
    {
        $discount = 0;
        $input = request()->all();

        $fee_rate = 0.01;
        $unit_price = Products::find($input['product'])->price;
        $fee = ($input['index'] + 1) * $unit_price * $fee_rate;
        $orig = ($input['index'] + 1) * $unit_price + $fee;

        if ($input['payment'] == 'alipay') {
            $discount = $discount + $fee;
        }

        $subtotal = $orig - $discount;
    }
}
