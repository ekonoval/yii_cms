<?php
namespace Ekv\User;

class PasswordManage
{
    private $_algo;

    function __construct()
    {
        $path = \Yii::getPathOfAlias("vendor") . '/ircmaxell/password-compat/lib/password.php';
        require_once $path;

        $this->_algo = PASSWORD_DEFAULT;
    }

    function passwordHash($password, array $options = array())
    {
        return password_hash($password, $this->_algo, $options);
    }

    function passwordGetInfo($hash)
    {
        return password_get_info($hash);
    }

    function passwordNeedsRehash($hash, array $options = array())
    {
        return password_needs_rehash($hash, $this->_algo, $options);
    }

    function passwordVerify($password, $hash)
    {
        return password_verify($password, $hash);
    }
}
