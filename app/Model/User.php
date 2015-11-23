<?php namespace App\Model;

use Illuminate\Support\Str;
use Session;

class User extends Base
{
    private $MailNS = 'user.email.';
    private $PasswordNS = 'user.password.';
    private $RemembermeTokenNS = 'rememberme_token.';
    private $WalletNS = 'user.wallet.';
    private $MailActivateCodeNS = 'activate.mail.';
    private $LastSendMailTime = 'mail.send.limit.';

    /**
     * Check the mail is exist.If exist return true
     *
     * @since 2015-11-20 02:07:50
     * @param String $mail
     *
     * @return Boolean
     */
    public function has($mail)
    {
        $mail = $this->_ssdb->get($this->_ns . $this->MailNS . $mail);
        return $mail->data != null;
    }

    /**
     * Register new user.
     *
     * @since 2015-11-20 02:09:32
     * @param String $mail
     * @param String $password
     *
     * @return Boolean
     */
    public function register($mail, $password)
    {
        $data2store = [
            $this->_ns . $this->MailNS . $mail, 0,
            $this->_ns . $this->PasswordNS . $mail, $password,
            $this->_ns . $this->WalletNS . $mail, env('INIT_WALLAT'),
        ];
        $rs = $this->_ssdb->multi_set($data2store);

        if ($rs->data == sizeof($data2store) / 2 && $rs->data == 'ok') {
            return true;
        } else {
            return false;
        }
    }

    /**
     * User login.
     *
     * @since 2015-11-21 01:49:09
     * @param String $email
     * @param String $password
     *
     * @return Boolean
     */
    public function login($email, $password)
    {
        $keys = [
            "{$this->_ns}{$this->PasswordNS}{$email}",
            "{$this->_ns}{$this->WalletNS}{$email}",
            "{$this->_ns}{$this->MailNS}{$email}",
        ];
        $rs = $this->_ssdb->multi_get($keys);
        if ($rs->data[$keys[0]] != null && $rs->data[$keys[0]] == $password) {
            Session::put("user", [
                'email' => $email,
                'login' => true,
                'wallet' => $rs->data[$keys[1]],
                'activate' => $rs->data[$keys[2]],
            ]);
            return true;
        } else {
            return false;
        }
    }

    /**
     * Login by remember token.
     *
     * @since 2015-11-21 11:35:57
     * @param String $token
     *
     * @return Boolean
     */
    public function loginByRememberMeToken($token)
    {
        $res = $this->_ssdb->get("{$this->_ns}{$this->RemembermeTokenNS}{$token}");
        if ($res->data) {
            Session::put('user', ['email' => $res->data, 'login' => true]);
            return true;
        } else {
            return false;
        }
    }

    /**
     * Check user is login.
     *
     * @since 2015-11-21 02:27:11
     *
     * @return Boolean
     */
    public function isLogin()
    {
        dd(Session::get('user.email'), Session::get('user.login'));
        if (Session::get('user.email') == "" && Session::get('user.login')) {
            return false;
        }
        return true;
    }

    /**
     * Logout.
     *
     * @since 2015-11-21 12:00:04
     * @param String $token Token of remember me.
     *
     * @return Boolean
     */
    public function logout($token)
    {
        Session::forget('user');
        if ($this->_ssdb->del("{$this->_ns}{$this->RemembermeTokenNS}{$token}")->code != 'ok') {
            return false;
        }
        return true;
    }

    /**
     * Set activate code.
     *
     * @since 2015-11-23 8:47:13
     *
     * @return String
     */
    public function activateCode()
    {
        $email = Session::get('user.email');
        $code = Str::random(32);
        $rs = $this->_ssdb->setx("{$this->_ns}{$this->MailActivateCodeNS}{$code}", $email, 900);
        if ($rs->code == 'ok') {
            return $code;
        }
    }

    /**
     * Check activate code.
     *
     * @since 2015-11-23 23:35:37
     * @param String $code
     *
     * @return Boolean
     */
    public function activate($code)
    {
        $rs = $this->_ssdb->get("{$this->_ns}{$this->MailActivateCodeNS}{$code}");
        if ($rs->code == 'ok') {
            $rs2 = $this->_ssdb->set("{$this->_ns}{$this->MailNS}{$rs->data}", 1);
            if ($rs2->code == 'ok') {
                $keys = [
                    "{$this->_ns}{$this->WalletNS}{$rs->data}",
                ];
                $rs3 = $this->_ssdb->get($keys);
                Session::put('user', [
                    'email' => $rs->data,
                    'login' => true,
                    'wallet' => $rs3->data,
                    'activate' => $rs2->data,
                ]);
                return true;
            }
        }
        return false;
    }

    /**
     * Check send mail is limit.
     *
     * @since 2015-11-24 00:16:43
     *
     * @return Boolean
     */
    public function isLimitSendMail()
    {
        $email = Session::get('user.email');
        $rs = $this->_ssdb->get("{$this->_ns}{$this->LastSendMailTime}{$email}");
        if ((time() - $rs->data) < env('MAIL_SENT_LIMIT_TIME')) {
            $rs2 = $this->_ssdb->set("{$this->_ns}{$this->LastSendMailTime}{$email}", time());
            return true;
        }
        return false;
    }

}
