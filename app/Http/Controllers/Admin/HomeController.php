<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Flows;
use Cache;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $minutes = 10;
        $topUsed = Cache::remember('topUsed', $minutes, function () {
            return Flows::orderBy('used', 'desc')->take(env('TOPNUM'))->get();
        });
        $dau = Cache::remember('DAU', $minutes, function () {
            return Flows::where('used', '>', 0)->where('updated_at', '>', 'CURDATE()')->count('user_id');
        });
        return view('admin.home')
            ->withDau($dau)
            ->withTopUsed($topUsed);
    }

}
