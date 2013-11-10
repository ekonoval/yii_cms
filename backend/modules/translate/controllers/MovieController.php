<?php
namespace Ekv\B\modules\translate\controllers;

use Ekv\B\components\Controllers\BackendControllerBase;
use Ekv\models\MMovies;


class MovieController extends BackendControllerBase
{
    function actionIndex()
    {
        //$model = new MMovies('search'); $get_name = 'Ekv\models\MMovies';
        $model = new \MTransMovie('search'); $get_name = get_class($model);
        //$model = new \OldMovies('search'); $get_name = "OldMovies";
        $model->unsetAttributes(); // clear any default values

        if (isset($_GET[$get_name])) {
            $model->attributes = $_GET[$get_name];
        }

//        $res = MMovies::model()->findAll();
//        /**
//         * @var $rval MMovies
//         */
//        foreach($res as $rval){
//            //pa($rval->createDate, $rval->getAttributes());
//        }

        $this->renderAuto(array(
            'model' => $model
        ));
    }

    function actionRisk()
    {
        pa($this->action);
    }



}
