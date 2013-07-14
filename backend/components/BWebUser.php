<?php

class BWebUser extends CWebUser
{

    const ROLE_SUPER = 2;

    function getRole()
    {
        $role = null;

        if(!$this->isGuest){
            $user_id = $this->getId();
            if($user_id == BUserIdentity::SUPER_ADMIN_ID){
                $role = self::ROLE_SUPER;
            }
        }

        return $role;
    }
}
