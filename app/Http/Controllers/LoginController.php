<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Input;
use Session;

class LoginController extends Controller
{
    /**
     * Display login page.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        return view('user.login');
    }

    /**
     * Process login post action.
     *
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        $data = Input::all();
        $raw = $this->ssdb->get("proxier.user.password.${data['username']}");
        if ($data['password'] === $raw->data) {
            Session::put("user", ['username' => $data['username'], 'login' => true]);
            if (Input::has('rememberme')) {
                $remembermeToken = Str::random(60);
                // set token expire time to 30 days.
                $cookie = cookie('rememberme_token', $remembermeToken, 43200);
                $this->ssdb->setx("proxier.rememberme_token.${remembermeToken}", $data['username'], 600);
            }
            return response()->json(['ok' => true, 'msg' => 'login success.', 'tk' => $remembermeToken])->withCookie($cookie);
        } else {
            return response()->json(['ok' => false, 'msg' => 'username or password error.']);
        }

    }

}
