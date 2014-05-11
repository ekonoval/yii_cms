<?php
namespace Ekv\B\modules\test\controllers;

use Ekv\B\components\Controllers\BackendControllerBase;
use Ekv\B\modules\test\classes\SqliteToMysql;

class DefaultController extends BackendControllerBase
{
    function actionIndex()
    {
        pa("exit"); exit;
    }

    function actionRisk()
    {
        pa($this->action);
    }

    function actionImport()
    {
        $importObj = new SqliteToMysql();
        $importObj->main();
    }

    function actionGrid()
    {
        $model = new \BTestEpisode('search');

        $get_name = get_class($model);
        $model->unsetAttributes(); // clear any default values

        if (isset($_GET[$get_name])) {
            $model->attributes = $_GET[$get_name];
        }

        $this->renderAuto(array(
            'model' => $model
        ));
    }

    function actionSimple()
    {
        $this->layout = "//layouts/LSimple";

        $this->renderAuto();
    }
}
