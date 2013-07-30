<?php

use Ekv\B\User\Auth\BTest;
use Ekv\B\Controllers\BackendControllerBase;

class SiteController extends BackendControllerBase
{
    /**
     * Renders index
     */
    public function actionIndex()
    {
        //echo "<h2>Backend index  </h2>\n";

        //\Ekv\Product\Helpers\ProductDetailedHelper::staticTest();

        //\Ekv\Frontend\ProductFormatter::main();

        //pa(Yii::getPathAliases());exit;
        $this->render('index');
    }

    function actionTest()
    {
        //$obj = new BTest();
        echo "<h2>Test  </h2>\n";
        //$hash = password_hash("risking", PASSWORD_DEFAULT);
        //pa($hash);

        $pwdManageObj = new Ekv\User\PasswordManage();

        $pwd = "risking";
        $hash = $pwdManageObj->passwordHash($pwd);
        pa($hash, strlen($hash), $pwdManageObj->passwordVerify($pwd, $hash));exit;

        $this->render('index');
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest) {
                echo $error['message'];
            } else {
                //pa($error);
                $this->render('error', array('error' => $error));
            }
        }

    }
}