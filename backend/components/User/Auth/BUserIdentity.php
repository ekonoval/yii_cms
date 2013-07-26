<?php

namespace Ekv\B\User\Auth;
use CUserIdentity;

class BUserIdentity extends CUserIdentity
{
    const SUPER_ADMIN_ID = 1;

    private $_idInt;

    public function authenticate()
    {
//        $record = User::model()->findByAttributes(array('username' => $this->username));
//        if ($record === null) {
//            $this->errorCode = self::ERROR_USERNAME_INVALID;
//        } else {
//            if ($record->password !== crypt($this->password, $record->password)) {
//                $this->errorCode = self::ERROR_PASSWORD_INVALID;
//            } else {
//                $this->_id = $record->id;
//                $this->setState('title', $record->title);
//                $this->errorCode = self::ERROR_NONE;
//            }
//        }

        $admin_login = "admin";
        $admin_pwd = "1";

        if ($this->username != $admin_login) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } else {
            if ($this->password != $admin_pwd) {
                $this->errorCode = self::ERROR_PASSWORD_INVALID;
            } else {
                $this->_idInt = 1;
                $this->setState('title', "Administrator");
                $this->errorCode = self::ERROR_NONE;
            }
        }

        return !$this->errorCode;
    }

    public function getId()
    {
        return $this->_idInt;
    }
}