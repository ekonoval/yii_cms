<?php
namespace Ekv\B\modules\translate\controllers;

use Ekv\B\components\Controllers\BackendControllerBase;
use BTransMovie, CHttpException;


class MovieController extends BackendControllerBase
{
    function actionIndex()
    {
        //$model = new MMovies('search'); $get_name = 'Ekv\models\MMovies';
        $model = new \BTransMovie('search'); $get_name = get_class($model);
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

    private function _redirectMovieIndex()
    {
        $this->redirect(array('/translate/movie/index'));
    }

    function actionUpdate($id)
    {
        $model = $this->loadModel("MTransMovie", $id);
        //$model = $this->loadModel('\Ekv\models\MMovies', $id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['MTransMovie'])) {
            $model->attributes = $_POST['MTransMovie'];
            if ($model->save()) {
                $this->_redirectMovieIndex();
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
        $model = new BTransMovie();

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['MTransMovie'])) {
            $model->attributes = $_POST['MTransMovie'];
            if ($model->save()) {
                $this->_redirectMovieIndex();
            }
        }

        $this->render('create_tpl', array(
            'model' => $model,
        ));
    }

}
