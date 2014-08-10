<?php

use Ekv\B\components\User\Auth\BTest;
use Ekv\B\components\Controllers\BackendControllerBase;

class SiteController extends BackendControllerBase
{
    function actionStatPage($statPageUrl = "")
    {
        echo "<h2>stat page  </h2>\n";
        pa($_GET);

        pa($statPageUrl);
    }

    /**
     * Renders index
     */
    public function actionIndex()
    {
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