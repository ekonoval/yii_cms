<?php
namespace Ekv\B\modules\translate\controllers;

use Ekv\B\components\Controllers\BackendControllerBase;
use Ekv\B\modules\translate\forms\WordEditForm;

class WordController extends TranslateController
{
    private $_mainModelName = "BTransWord";

    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        $this->setEximLayout();
    }

    protected function _breadcrumps()
    {
        parent::_breadcrumps();
        $action = $this->getActionId();

        $actionsList = array("index", "updateExt");
        if (in_array($action, $actionsList)) {
            $episodeID = yR()->getParam('episodeID');

            $episodeObj = \BTransEpisode::model()->findByPk($episodeID);

            if ($episodeObj) {
                $this->_addMovieIdBc($episodeObj->movieID);

                //--- add final bc item ---//
                $this->_addBreadCrumpItem(
                    "Episode #{$episodeID}",
                    $this->getEpisodeWordsIndexUrl($episodeID)
                );
            }
        }

    }

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
            'model' => $model,
            'episodeID' => $episodeID
        ));
    }

    private function _redirectWordIndex($episodeID)
    {
        $this->redirect($this->getEpisodeWordsIndexUrl($episodeID));
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

    function actionUpdateExt($id)
    {
        $edit_mode = true;

        /**
         * @var $model \BTransWord
         */
        $model = null;

        //if ($new === true)
        if (false) {
//            $model = new StoreDeliveryMethod;
//            $model->unsetAttributes();
        } else {
            $model = \BTransWord::model()->findByPk($id);
        }

        if (!$model) {
            throw new \CHttpException(404, \Yii::t('StoreModule.admin', 'Incorrect wordID'));
        }

        $form = WordEditForm::create($model);

        //--- check was form posted ---//
        if(yR()->isPostRequest){
            $model->attributes = $_POST[get_class($model)];

            if ($model->validate()) {
                $model->save();
                $this->setFlashMessage(\Yii::t('StoreModule.admin', 'Изменения успешно сохранены'));

                $this->_redirectWordIndex($model->episodeID);
            }
        }

        $this->renderAuto(array(
            'model'=>$model,
            'form'=>$form,
        ));
    }

}
 