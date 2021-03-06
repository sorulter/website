<?php

namespace app\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Hashids;

class InvitationController extends Controller
{
    public function index()
    {
        $uid = request()->user()->id;
        $hash = Hashids::connection('invitation')->encode($uid);

        return view('user.invitation.index')
            ->withHash($hash)
            ->withTitle(trans('invitation.link'))
            ->withAct('index');
    }
}
