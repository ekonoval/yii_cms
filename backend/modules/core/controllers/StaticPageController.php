<?php
namespace Ekv\B\modules\core\controllers;

use Ekv\B\components\Controllers\BackendControllerBase;

class StaticPageController extends BackendControllerBase
{
    public function init()
    {
        parent::init();
        //pa("exit"); exit;
    }

    function actionIndex()
    {

        $model = new \BStatPage('search');
        $this->initIndexModel($model);

        $this->renderAuto(array(
            'model' => $model
        ));
    }
}
 