<?php
use Ekv\F\components\System\FrontendControllerBase;

class SiteController extends FrontendControllerBase
{
    public function actionIndex()
    {

        $this->pageTitle = 'Index page';
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

}