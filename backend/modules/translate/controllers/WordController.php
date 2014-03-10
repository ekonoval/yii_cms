<?php
namespace Ekv\B\modules\translate\controllers;

use Ekv\B\components\Controllers\BackendControllerBase;

class WordController extends BackendControllerBase
{
    private $_mainModelName = "BTransWord";

    function actionIndex($episodeID)
    {
        $model = new \BTransWord('search');
        $model->setEpisodeIDPreselected($episodeID);

        $get_name = get_class($model);
        $model->unsetAttributes(); // clear any default values

        if (isset($_GET[$get_name])) {
            $model->attributes = $_GET[$get_name];
        }

        $this->renderAuto(array(
            'model' => $model
        ));
    }

    private function _redirectWordIndex($episodeID)
    {
        $this->redirect(yApp()->createUrl("translate/word/index", array("episodeID" => $episodeID)));
    }

    function actionUpdate($id)
    {
        $model = $this->loadModel($this->_mainModelName, $id);
        //$model = $this->loadModel('\Ekv\models\MMovies', $id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST[$this->_mainModelName])) {
            $model->attributes = $_POST[$this->_mainModelName];
            if ($model->save()) {
                $this->_redirectWordIndex($model->episodeID);
            }
        }

        $this->render('update_tpl', array(
            'model' => $model,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new \BTransWord();

        if (isset($_POST[$this->_mainModelName])) {
            $model->attributes = $_POST[$this->_mainModelName];
            if ($model->save()) {
                $this->_redirectWordIndex($model->episodeID);
            }
        }

        $this->render('create_tpl', array(
            'model' => $model,
        ));
    }

}
 