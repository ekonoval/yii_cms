<?php

class UserController extends EController
{
    function actionLogin()
    {
        pa($_REQUEST);
        pa(Yii::app()->session->sessionID); //exit;
        //yUser()->logout();
        pa("is_guest", yUser()->isGuest);exit;




        $username = @$_REQUEST["login"];
        $pwd = @$_REQUEST["password"];

        $username = "admin";
        $pwd = "1";

        $identity = new BUserIdentity($username, $pwd);

        if ($identity->authenticate()) {
            yUser()->login($identity);
        } else {
            echo $identity->errorCode;
        }

        pa("is_guest", yUser()->isGuest);

        pa("backend action user login");
    }

    function actionTest()
    {
        $sesObj = Yii::app()->session;
        pa($sesObj->sessionID, $sesObj->getSavePath());

        //$sesObj['xxx'] = time();
        //Yii::app()->session['time']  = time();

        //$_SESSION["xxx"] = 22;
        pa($_SESSION);

        //session_start();

    }
}
