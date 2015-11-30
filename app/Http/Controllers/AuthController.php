<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Input;
use Validator;

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

    /**
     * Logout.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout()
    {
        // $this->ssdb->del('proxier.rememberme_token.' . Cookie::get('rememberme_token'));
        // Session::flush();
        (new User)->logout(Cookie::get('rememberme_token'));
        return view('user.logout')->withCookie(Cookie::forget('rememberme_token'));
    }

    public function getRegister()
    {
        return view('user.register');
    }

    public function postRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique_mail',
        ]);

        if ($validator->fails()) {
            return redirect('register')
                ->withErrors($validator, 'register')
                ->withInput();
        }

        // store
        $state = (new User)->register($request->email, $request->password);

        (new User)->login($request->email, $request->password);
        return redirect('/user');
    }

}
