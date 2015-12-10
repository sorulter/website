<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class ActivationController extends Controller
{
    /**
     * Display activation result.
     *
     * @return \Illuminate\Http\Response
     */
    public function getActivate(Request $request, $token)
    {
        //
        if (sizeof(User::where('activate_code', '=', $token)->get()) == 1) {
            User::where('activate_code', '=', $token)->update(
                array('activate' => 1, 'activate_code' => '')
            );
            return view('user.redirect')->withType('success')
                ->withTitle('Activate Success!')
                ->withContent('')
                ->withTo('/login')
                ->withTime(3);
        }
    }
}
