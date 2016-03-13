<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Validator;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
     */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;
    protected $loginPath = "/login";
    protected $redirectPath = '/user';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->middleware('guest', ['except' => 'getLogout']);

        if (session()->has('redirectPath')) {
            $this->redirectPath = session()->get('redirectPath');
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        Validator::extend('black', function ($attribute, $value, $parameters) {
            $black = [
                'mailnesia.com',
                'sharklasers.com',
                'guerrillamail.info',
                'grr.la',
                'guerrillamail.biz',
                'guerrillamail.com',
                'guerrillamail.de',
                'guerrillamail.net',
                'guerrillamail.org',
                'guerrillamailblock.com',
                'spam4.me',

                'mailnesia.com',
                'mailinator.com',
                # Airmail
                'thrma.com',
                'zetmail.com',
                'anappthat.com',
                'eelmail.com',
                'tafmail.com',
                'grandmamail.com',
                'abyssmail.com',
                'boximail.com',
                '6paq.com',
                'getairmail.com',
                # TempMail
                'dlemail.ru',
                'flemail.ru',
                'walkmail.ru',
                'shotmail.ru',
                # YopMail
                'yopmail.fr',
                'cool.fr.nf',
                'jetable.fr.nf',
                'nospam.ze.tc',
                'nomail.xl.cx',
                'mega.zik.dj',
                'speed.1s.fr',
                'courriel.fr.nf',
                'moncourrier.fr.nf',
                'monemail.fr.nf',
                'monmail.fr.nf',

                'www.bccto.me',
                'bccto.me',
                'mail.bccto.me',

                'euaqa.com',

            ];
            // in the black list.
            if (in_array(mb_split('@', $value)[1], $black)) {
                return false;
            }
            return true;
        });
        return Validator::make($data, [
            'email' => 'required|email|max:255|unique:users|black',
            'password' => 'required|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
