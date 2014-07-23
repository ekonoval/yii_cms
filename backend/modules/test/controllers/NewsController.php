<?php
namespace Ekv\B\modules\test\controllers;

use BTestNews;
use BTestNewsCategory;
use CHtml;
use Ekv\B\components\Controllers\BackendControllerBase;
use Ekv\B\modules\test\forms\NewsEditForm;
use Ekv\models\MNews;

class NewsController extends BackendControllerBase
{
    public function init()
    {
        parent::init();
        $this->setEximLayout();
    }


    function actionIndex()
    {
        $model = new BTestNews("search");

        $model->unsetAttributes();
        $this->assignFormGetAttributes($model);

        $this->renderAuto(array('model' => $model));
    }

    function actionTest()
    {
        $model = MNews::model()->with('categoriesRel')->findByPk(569, 'categoriesRel.catEnabled = 1');
        //pa($model);exit;
        pa($model->debugRes());

    }

    function actionUpdate()
    {
        $newsID = yR()->getQuery("newsID");

        $modelNews = BTestNews::model()->findByPk($newsID);

        if (!$modelNews) {
            throw new \CHttpException(404, \Yii::t('StoreModule.admin', 'Incorrect ID'));
        }
        $modelNews->preselectCategoryIds = true;

        //$form = OrderEditForm::create($modelBase);
        $form = NewsEditForm::create($modelNews);
        $form["base"]["categoryIdsRelated"]->items = $this->getCetegoriesList();

        //--- check was form posted ---//
        if($this->isEditFormPosted($modelNews)){
            if (
                $modelNews->validate()
            ) {
                $baseSaveRes = $modelNews->save(false);
                if($baseSaveRes){
                }
                $this->setFlashMessage(\Yii::t('StoreModule.admin', 'Изменения успешно сохранены'));

                $this->redirect($this->createUrlBackend('index'));
            }
        }else{
            $modelNews->preselectCategoriesConnected();
        }

        $this->renderAuto(array(
            'model' => $modelNews,
            'form' => $form,
        ));
    }

    private function getCetegoriesList()
    {
        $res = BTestNewsCategory::model()->findAll();
        $data = CHtml::listData($res, 'idCat', 'catName');
        return $data;
    }

    function actionUpdateCustom()
    {
        $newsID = yR()->getQuery("newsID");

        //$modelNews = BTestNews::model()->with(BTestNews::REL_NEWS2CATS)->findByPk($newsID);
        $modelNews = BTestNews::model()->findByPk($newsID);
        //$modelNews->news2CategoryConns;
        //pa($modelNews);exit;

        if (!$modelNews) {
            throw new \CHttpException(404, \Yii::t('StoreModule.admin', 'Incorrect ID'));
        }



        //--- check was form posted ---//
        if ($this->isEditFormPosted($modelNews)) {

            if ($modelNews->validate()) {
                $baseSaveRes = $modelNews->save(false);
                if ($baseSaveRes) {
                }
                $this->setFlashMessage(\Yii::t('StoreModule.admin', 'Изменения успешно сохранены'));

                $this->redirect($this->createUrlBackend('index'));
            }
        } else {
            $modelNews->preselectCategoriesConnected();
        }

        $this->renderAuto(array(
            'model' => $modelNews,
            //'form' => $form,
        ));
    }
}
 