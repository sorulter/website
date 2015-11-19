<?php namespace App\Model;

class User extends Base
{
    private $MialNS = 'user.mail.';

/**
 *
 * Check the mail is exist.If exist return true
 *
 * @param String $mail
 * @return Boolean
 */
    public function has($mail)
    {
        $mail = $this->_ssdb->get($this->_ns . $this->MialNS . $mail);
        return $mail->data != null;
    }
}
