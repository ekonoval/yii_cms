<?php

use Ekv\Backend\Controllers\BackendControllerBase;

class UserController extends BackendControllerBase
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
        if(yR()->getParam("top_login_form_submitted")){
            $username = @$_REQUEST["login"];
            $pwd = @$_REQUEST["password"];

            $username = "admin";
            $pwd = "1";

            $identity = new BUserIdentity($username, $pwd);

            if ($identity->authenticate()) {
                yUser()->login($identity);
                $this->redirectIndex();
            } else {
                echo $identity->errorCode;
            }
        }else{
            $this->render("login");
        }
    }

    function actionLogout()
    {
        if(yUser()->isGuest == false){
            yUser()->logout();
        }

        $this->redirect("/");
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
