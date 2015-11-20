<?php namespace App\Model;

class User extends Base
{
    private $MailNS = 'user.mail.';
    private $PasswordNS = 'user.password.';

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

        dd($data2store, $rs);
    }
}
