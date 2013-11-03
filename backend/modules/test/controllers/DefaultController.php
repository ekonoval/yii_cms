<?php

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
}
