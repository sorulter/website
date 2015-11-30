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
     * Resent activate mail.
     *
     * @since 2015-11-24 00:05:29
     *
     * @return \Illuminate\Http\Response
     */
    public function getResentActivateMail()
    {
        if (Session::get('user.activate')) {
            return redirect('/user');
        };
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
