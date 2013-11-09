<?php

namespace Ekv\B\components\User\Auth;
use CPhpAuthManager;
use Yii;

/**
 * Define where roles hierarchy can be gotten and apply role to user
 */
class BAuthManager extends CPhpAuthManager
{
    public function init()
    {
        //--- roles hierarchy ---//
        if ($this->authFile === null) {
            $this->authFile = Yii::getPathOfAlias('backend.config.auth_roles') . '.php';
            $this->authFile = realpath($this->authFile);
        }

        parent::init();

        $appUserObj = yUser();
        // for guests we have already role
        if (!$appUserObj->isGuest) {
            //pa($appUserObj->role, $appUserObj->id);exit;

            /*
             * Link previously defined user role to userID (returned by BUserIdentity::getId())
             */
            $this->assign($appUserObj->role, $appUserObj->id);
        }
    }
}
