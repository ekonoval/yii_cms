<?php

namespace Ekv\B\User\Auth;
use CUserIdentity;
use Ekv\User\PasswordManage;

/**
 * Check whether user can be authentified.
 * No role id is checked here. Only user availability
 */
class BUserIdentity extends CUserIdentity
{
    /**
     * @deprecated
     */
    const SUPER_ADMIN_ID = 1;

    private $_idInt;

    public function authenticate()
    {
        /**
         * @var $mUser \MUser
         */
        $mUser = \MUser::model()->find(" `login` = :login AND enabled = 1", array(':login' => $this->username));

        //--- user not found ---//
        if (is_null($mUser)) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } else {
            $pwdManageObj = new PasswordManage();
            //--- wrong pwd ---//
            if ($pwdManageObj->passwordVerify($this->password, $mUser->password) == false) {
                $this->errorCode = self::ERROR_PASSWORD_INVALID;
            } else {
                //--- everything ok ---//
                $this->_idInt = $mUser->id;
                $this->setState('title', $mUser->real_name);
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