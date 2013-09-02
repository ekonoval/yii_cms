<?php
namespace Ekv\User;

class PasswordManage
{
    private $_algo;
    private $_options = array();

    function __construct()
    {
        $path = \Yii::getPathOfAlias("vendor") . '/ircmaxell/password-compat/lib/password.php';
        require_once $path; //include workaround for 5.3.7 < php < 5.5

        $this->_algo = PASSWORD_DEFAULT;
    }

    function passwordHash($password)
    {
        return password_hash($password, $this->_algo, $this->_options);
    }

    function passwordGetInfo($hash)
    {
        return password_get_info($hash);
    }

    function passwordNeedsRehash($hash)
    {
        return password_needs_rehash($hash, $this->_algo, $this->_options);
    }

    function passwordVerify($password_plain, $hash)
    {
        return password_verify($password_plain, $hash);
    }
}
