<?php

namespace app\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Flows;
use App\Model\Order;
use Cache;
use DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $minutes = 1;
        $topUsed = Cache::remember('topUsed', $minutes, function () {
            return Flows::orderBy('used', 'desc')->take(env('TOPNUM'))->get();
        });
        $dau = Cache::remember('DAU', $minutes, function () {
            return Flows::where('used', '>', 0)->where('updated_at', '>', DB::raw('CURDATE()'))->count('user_id');
        });
        $paid_dau = Cache::remember('PaidDAU', $minutes, function () {
            return Flows::where('used', '>', 0)->where(DB::raw('(forever + combo + extra)'), '>', env('FREE_FLOWS'))->where('updated_at', '>', DB::raw('CURDATE()'))->count('user_id');
        });
        $total = Cache::remember('total_flows', $minutes, function () {
            return number_format(Flows::sum('used') / MB, 2);
        });
        $revenue = Cache::remember('revenue', $minutes, function () {
            return Order::where('state', '=', 'TRADE_FINISHED')->where(DB::raw("date_format(updated_at, '%Y-%m')"), ">=", DB::raw("date_format(DATE_ADD(UTC_TIMESTAMP(),INTERVAL 8 HOUR),'%Y-%m')"))->sum('amount');
        });
        return view('admin.home')
            ->withRevenue($revenue)
            ->withPaidDau($paid_dau)
            ->withDau($dau)
            ->withTotal($total)
            ->withTopUsed($topUsed);
    }
}
