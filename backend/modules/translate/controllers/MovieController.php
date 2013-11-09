<?php
namespace Ekv\B\modules\translate\controllers;
use Ekv\B\components\Controllers\BackendControllerBase;
use Ekv\models\MMovies;


class MovieController extends BackendControllerBase
{
    function actionIndex()
    {
        $res = MMovies::model()->findAll();

        /**
         * @var $rval MMovies
         */
        foreach($res as $rval){
            pa($rval->createDate, $rval->getAttributes());
        }
    }

    function actionRisk()
    {
        pa($this->action);
    }

}
