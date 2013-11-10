<?php
namespace Ekv\B\modules\translate\controllers;

use Ekv\B\components\Controllers\BackendControllerBase;
use Ekv\models\MMovies;


class MovieController extends BackendControllerBase
{
    function actionIndex()
    {
        //$model = new MMovies('search');
        $model = new \OldMovies('search');
        $model->unsetAttributes(); // clear any default values

        if (isset($_GET['OldMovies'])) {
            $model->attributes = $_GET['OldMovies'];
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
