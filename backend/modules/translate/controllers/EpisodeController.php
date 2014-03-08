<?php
namespace Ekv\B\modules\translate\controllers;

use Ekv\B\components\Controllers\BackendControllerBase;

class EpisodeController extends BackendControllerBase
{
    function actionIndex($movieID)
    {
        $model = new \BTransEpisode('search');
        $model->setMovieID($movieID);

        $get_name = get_class($model);
        $model->unsetAttributes(); // clear any default values

        if (isset($_GET[$get_name])) {
            $model->attributes = $_GET[$get_name];
        }

        $this->renderAuto(array(
            'model' => $model
        ));
    }

}
 