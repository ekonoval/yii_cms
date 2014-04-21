<?php

use Ekv\B\components\User\Auth\BTest;
use Ekv\B\components\Controllers\BackendControllerBase;

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

        $pwdManageObj = new \Ekv\components\User\PasswordManage();

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
                pa($error);
                $this->render('error', array('error' => $error));
            }
        }
    }

    function actionGrid()
    {
        //$this->setImport(array('test.models.*'));
        Yii::import('test.models.*');

        $model = new \BTestEpisode('search');

        $get_name = get_class($model);
        $model->unsetAttributes(); // clear any default values

        if (isset($_GET[$get_name])) {
            $model->attributes = $_GET[$get_name];
        }

        $this->render("test.views.default.grid_tpl", array('model' => $model));

    }

}