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

    function actionSqlIndex($movieID)
    {
        $model = new \BTransEpisodeSql('search');
        $model->setMovieID($movieID);

        $model->unsetAttributes();
        $get_name = get_class($model);

        //$model->seasonNum = 4;

        if (isset($_GET[$get_name])) {
            $model->attributes = $_GET[$get_name];
        }

        $this->renderAuto(array(
            'model' => $model
        ));
    }

    function actionSqlIndexOLd()
    {
        $sql = "
            SELECT e.*, m.movieName
            FROM episodes e
                INNER JOIN movies m
                    ON m.movieID = e.movieID
            WHERE
                e.movieID = 5
        ";

        $dataProvider = new \CSqlDataProvider($sql, array(
            //'db' => yDb(),
            'keyField' => 'episodeID',
            'totalItemCount' => 50,//todo fix
            'sort' => array(
                'attributes' => array('seasonNum', 'episodeNum'),
                'defaultOrder' => array('seasonNum' => true, 'episodeNum' => true),
            ),
            'pagination' => array(
                'pageSize' => 10,
            ),
        ));

        $this->renderAuto(array(
            'provider' => $dataProvider
        ));
    }

}
 