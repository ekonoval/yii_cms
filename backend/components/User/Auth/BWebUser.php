<?php

namespace Ekv\B\User\Auth;
use BUser;
use Ekv\B\User\Auth\BUserIdentity;
use CWebUser;

class BWebUser extends CWebUser
{
    function __construct()
    {
        /*
         * Required to have separate sessions for backend and frontend user
         */
        $this->setStateKeyPrefix("backend_user");
    }

    /**
     * Access for ->role
     * @return mixed
     */
    function getRole()
    {
        $role = null;

        if (!$this->isGuest) {
            $user_id = $this->getId();
            if ($user_id == BUserIdentity::SUPER_ADMIN_ID) {
//                $role = BUser::ROLE_ADMIN;
                $role = BUser::ROLE_MODER;
            }
        }

        return $role;
    }
}
