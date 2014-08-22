<?php
namespace Ekv\B\modules\user\controllers;

use CWebUser;
use Ekv\B\components\Controllers\BackendControllerBase;
use Ekv\B\components\User\Auth\BUser;
use Ekv\B\components\User\Auth\BUserIdentity;
use Ekv\B\modules\user\forms\FrmUserLogin;
use Yii;

class AuthController extends BackendControllerBase
{
    /**
     * @var CWebUser
     */
    private $appUser;

    public function init()
    {
        parent::init();

        $this->appUser = yUser();
    }

    function actionLogin()
    {
        $this->layout = null;
        //--- redirect already signed in users to index ---//
        if (!$this->appUser->isGuest) {
            $this->redirect('/');
        }

        $model = new \BUserLoginForm();
        $form = FrmUserLogin::create($model);

        //--- form submitted ---//
        if ($this->isEditFormPosted($model)) {
            if ($model->validate()) {
                $duration = 0;
                // Authenticate user and redirect to the dashboard
                if ($model->rememberMe) {
                    $duration = 84600 * 7;// Remember for one week
                }

                $this->appUser->login($model->getIdentity(), $duration);

                $this->redirect(yUser()->returnUrl);

            }
            //pa($model);
        }

        $this->renderAuto(array('form' => $form));
    }

//    function actionLogin1()
//    {
//        if (yR()->getParam("top_login_form_submitted")) {
//            $username = @$_REQUEST["login"];
//            $pwd = @$_REQUEST["password"];
//
//            //$username = "admin";
//            //$pwd = "1";
//
//            $identity = new BUserIdentity($username, $pwd);
//
//            if ($identity->authenticate()) {
//                yUser()->login($identity);
//                yUser()->setFlash('login_success', "Greeting '{$username}'");
//                //pa($_SESSION);exit;
//
//                $this->redirectIndex();
//            } else {
//                //echo $identity->errorCode;
//                yUser()->setFlash("login_failed", "Login error #{$identity->errorCode}");
//            }
//        }
//
//        $this->render("login");
//    }

    function actionLogout()
    {
        if ($this->appUser->isGuest == false) {
            $this->appUser->logout();
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

        if ($this->appUser->checkAccess(BUser::ROLE_ADMIN)) {
            echo "<h2>I'm admin  </h2>\n";
        } elseif (yUser()->checkAccess(BUser::ROLE_MODER)) {
            echo "<h2>I'm MODER  </h2>\n";
        } else {
            pa("access denied");
        }
    }
}
