<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Session;

class HomeController extends Controller
{

    /**
     * Display user home.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        return view('user.home');
    }

    /**
     * Display activate page.
     *
     * @since 2015-11-23 23:19:55
     *
     * @return \Illuminate\Http\Response
     */
    public function getActivate()
    {
        if (Session::get('user.activate')) {
            return redirect('/user');
        }
        return view('user.msg')
            ->withType('warning')->withTitle('Please Activate Your Account')
            ->withContent('<p>Before you can login, you must active your account with the code sent to your email address.</p>
            <p>If you did not receive this email, please check your junk/spam folder.Click <a href="/user/activate/resent">here</a> to resend the activation email.</p>');
    }

}
