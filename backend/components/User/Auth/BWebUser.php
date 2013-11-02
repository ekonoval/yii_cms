<?php

namespace Ekv\B\components\User\Auth;
use Ekv\B\components\User\Auth\BUserIdentity;
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
     * Access for property ->role (Used in BAuthManager)
     * @return mixed
     */
    function getRole()
    {
        $role = null;

        if (!$this->isGuest) {
            $user_id = $this->getId();
            $mUser = \MUser::model()->findByPk($user_id);

            if (!is_null($mUser)) {
//                $role = BUser::ROLE_ADMIN;
//                $role = BUser::ROLE_MODER;
                $role = $mUser->role;
            }
        }

        return $role;
    }
}
