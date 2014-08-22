<?php
namespace Ekv\B\modules\core\controllers;

use BStatPage;
use CDbCriteria;
use EController;
use Ekv\B\components\Controllers\BackendControllerBase;
use Ekv\B\modules\core\forms\StatPageForm;

class StaticPageController extends BackendControllerBase
{
    public function init()
    {
        parent::init();
        //pa("exit"); exit;
    }

    protected function _breadcrumps()
    {
        parent::_breadcrumps();

        $this->_addBreadCrumpItem('Static pages', $this->createUrl('index'));
    }


    function actionIndex()
    {

        $this->pageTitle = "Static-page index";

        $model = new BStatPage('search');
        $this->initIndexModel($model);

        $this->renderAuto(array(
            'model' => $model
        ));
    }

    function actionUpdate($createMode = false)
    {
        $pageID = yR()->getQuery("pageID");

        if(!$createMode){
            $model = BStatPage::model()->findByPk($pageID);
        }else{
            $model = new BStatPage();
        }

        $this->checkEditModel($model);

        //$form = OrderEditForm::create($modelBase);
        $form = StatPageForm::create($model);

        //--- check was form posted ---//
        if($this->isEditFormPosted($model)){
            if (
                $model->validate()
            ) {
                $baseSaveRes = $model->save(false);
                if($baseSaveRes){
                }
                $this->setFlashMessage(\Yii::t('StoreModule.admin', 'Изменения успешно сохранены'));

                $this->redirectControllerIndexUrl();
            }
        }else{

        }

        $this->render('update_tpl', array(
            'model' => $model,
            'form' => $form,
        ));
    }

    function actionCreate()
    {
        $this->actionUpdate(true);
    }

    function actionDelete()
    {
        $ids = parent::actionDelete();

        if(!empty($ids)){
            $model = new BStatPage();

            $criteria = new CDbCriteria;
            $criteria->addInCondition('idPage', $ids);

            $model->deleteAll($criteria);
        }

    }

}
 