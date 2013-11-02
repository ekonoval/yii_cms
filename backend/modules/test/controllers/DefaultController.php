<?php

use Ekv\B\components\Controllers\BackendControllerBase;

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
}
