<?php

class UserController extends EController
{
    /**
     * @var CWebUser
     */
    private $_appUser;

    public function init()
    {
        parent::init();

        $this->_appUser = yUser();
    }

    function actionLogin()
    {
        if(Yii::app()->request->getParam("top_login_form_submitted")){
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
        }else{
            $this->render("login");
        }
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

    function actionAccess()
    {

        if($this->_appUser->checkAccess(BUser::ROLE_ADMIN)){
            echo "<h2>I'm admin  </h2>\n";
        }
    }
}
