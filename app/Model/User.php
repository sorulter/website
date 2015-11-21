<?php namespace App\Model;

use Session;

class User extends Base
{
    private $MailNS = 'user.email.';
    private $PasswordNS = 'user.password.';
    private $RemembermeTokenNS = 'rememberme_token.';

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
        $rs = $this->_ssdb->get("{$this->_ns}{$this->PasswordNS}{$email}");
        if ($rs->data == $password) {
            Session::put("user", ['email' => $email, 'login' => true]);
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

}
