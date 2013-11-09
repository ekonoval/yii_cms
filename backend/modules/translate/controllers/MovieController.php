<?php
namespace Ekv\B\modules\translate\controllers;
use Ekv\B\components\Controllers\BackendControllerBase;


class MovieController extends BackendControllerBase
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
