<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Input;

class AuthController extends Controller
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
        // check fields.
        if ($data['email'] == '' || $data['password'] == '') {
            return response()->json(['ok' => false, 'msg' => 'Please enter username and password.']);
        }
        if ((new User)->login($data['email'], $data['password'])) {
            // dd($data, $data['rememberme'], $data['rememberme'] == "true");
            if ($data['rememberme'] == 'true') {
                $remembermeToken = Str::random(60);
                // set token expire time to 30 days.
                $cookie = cookie('rememberme_token', $remembermeToken, 43200);
                $this->ssdb->setx("proxier.rememberme_token.${remembermeToken}", $data['email'], 2592000);
                return response()->json(['ok' => true, 'msg' => 'login success.'])->withCookie($cookie);
            } else {
                return response()->json(['ok' => true, 'msg' => 'login success.']);
            }

        } else {
            return response()->json(['ok' => false, 'msg' => 'username or password error.']);
        }

    }

}
