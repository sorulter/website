<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Model\User;
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

    /**
     * Resent activate mail.
     *
     * @since 2015-11-24 00:05:29
     *
     * @return \Illuminate\Http\Response
     */
    public function getResentActivateMail()
    {
        ;
        if ((new User)->isLimitSendMail()) {
            return view('user.msg')->withType('warning')->withTitle('Limited.Try again later.')->withContent("<p>Don't request too many.</p>");
        }
        if (parent::sendActivateMail()) {
            return view('user.msg')->withType('success')->withTitle('Success.')->withContent("<p>Send mail success.Please check your mail.</p>");
        } else {
            return view('user.msg')->withType('danger')->withTitle('Failed.')->withContent("<p>Send mail failed.Try again later.</p>");
        }
    }

}
