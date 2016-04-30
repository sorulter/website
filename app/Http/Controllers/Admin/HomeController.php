<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Flows;
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
            return Flows::where('used', '>', 0)->where(DB::raw('(free + combo_flows)'), '>', env('FREE_FLOWS'))->where('updated_at', '>', DB::raw('CURDATE()'))->count('user_id');
        });
        return view('admin.home')
            ->withPaidDau($paid_dau)
            ->withDau($dau)
            ->withTopUsed($topUsed);
    }

}
